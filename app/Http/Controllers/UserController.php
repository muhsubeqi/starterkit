<?php

namespace App\Http\Controllers;

use App\Helper\FileStorage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected array $rules = [
        'name' => 'required',
        'email' => 'nullable',
        'image' => 'nullable',
        'status' => 'nullable',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = [
            ["data" => 'id', "name" => 'id', "class" => 'text-center', "sortable" => false, "searchable" => false],
            ["data" => 'image', "name" => 'image', "sortable" => false, "searchable" => false],
            ["data" => 'name', "name" => 'name', "class" => "align-middle"],
            ["data" => 'email', "name" => 'email', "class" => "align-middle"],
            ["data" => 'role', "name" => 'role', "class" => "align-middle"],
            ["data" => 'status', "name" => 'status', "class" => "align-middle"],
        ];

        if (Gate::allows('user.edit') || Gate::allows('user.delete')) {
            $columns[] = ["data" => 'action', "name" => 'action', "class" => 'text-center', "sortable" => false, "searchable" => false];
        }

        $roles = Role::all()->pluck('name', 'id');

        return view('pages.user.index', compact('roles', 'columns'));
    }

    public function list(Request $request)
    {
        $data = User::select('*');

        return DataTables::eloquent($data)
            ->addIndexColumn()
            ->editColumn('image', function (User $user) {
                if ($user->image) {
                    return '<img src="' . asset('storage/images/user/' . $user->image) . '" width="50px" height="50px" />';
                }
            })
            ->addColumn('role', function (User $user) {
                return $user->getRoleNames()->implode(', ') ?? '';
            })
            ->editColumn('status', function (User $user) {
                if ($user->status == 1) {
                    return '<span class="badge bg-success text-white">Active</span>';
                } else {
                    return '<span class="badge bg-danger text-white">Inactive</span>';
                }
            })
            ->addColumn('action', function (User $user) {
                $user->role = $user->getRoleNames()->implode(', ');
                $roleId = Role::where('name', $user->role)->first() ? Role::where('name', $user->role)->first() : Role::orderBy('id', 'desc')->first();
                return view('pages.user.partials.action', ['row' => $user, 'roleId' => $roleId]);
            })
            ->rawColumns(['role', 'image', 'status', 'action'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $dataValidated = $request->validate($this->rules);
            $dataValidated['password'] = Hash::make('12345678');
            $dataValidated['status'] = 1;
            $role = Role::find($request->role);

            if (!$request->has('status')) {
                $dataValidated['status'] = 0;
            }

            if ($request->has('image')) {
                $image = $request->file('image');
                $path = 'public/images/user';
                $filename = FileStorage::upload($image, $path);
                $dataValidated['image'] = $filename;
            }

            $user = User::create($dataValidated);
            $user->assignRole($role->name);
            $data = [
                'status' => 200,
                'message' => 'Successfully created user',
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'message' => $th->getMessage()
            ];
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $dataValidated = $request->validate($this->rules);
            $dataValidated['status'] = 1;
            $role = Role::find($request->role);

            if (!$request->has('status')) {
                $dataValidated['status'] = 0;
            }

            if ($request->has('image')) {
                $image = $request->file('image');
                $path = 'public/images/user/';
                if ($user->image) {
                    FileStorage::delete($user->image, $path);
                }
                $filename = FileStorage::upload($image, $path);
                $dataValidated['image'] = $filename;
            }

            $user->update($dataValidated);
            $user->syncRoles($role->name);
            $data = [
                'status' => 200,
                'message' => 'Successfully updated user',
                'data' => $user
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 500,
                'message' => $th->getMessage()
            ];
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {

            if ($user->image) {
                $path = 'public/images/user/';
                FileStorage::delete($user->image, $path);
            }
            $user->delete();
            $data = [
                'status' => 200,
                'message' => 'success',
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 200,
                'message' => 'error',
            ];
        }
        return response()->json($data);
    }
}