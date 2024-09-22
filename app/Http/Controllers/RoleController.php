<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    protected array $rules = [
        'name' => 'required',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $columns = [
            ["data" => 'id', "name" => 'id', "class" => 'text-center', "sortable" => false, "searchable" => false],
            ["data" => 'name', "name" => 'name', "sortable" => false, "searchable" => false],
        ];

        if (Gate::allows('role.edit') || Gate::allows('role.delete')) {
            $columns[] = ["data" => 'action', "name" => 'action', "class" => 'text-center', "sortable" => false, "searchable" => false];
        }

        $permission_groups = User::getpermissionGroups();
        $permissions = [];
        foreach ($permission_groups as $group) {
            $group->permissions = User::getpermissionByGroupName($group->group_name)->toArray();

            $permissions[] = [
                'group_name' => $group->group_name,
                'permissions' => $group->permissions
            ];
        }
        return view('pages.role.index', compact('permissions', 'columns'));
    }

    public function list()
    {
        $data = Role::select('*');
        return DataTables::eloquent($data)
            ->addColumn('action', function (Role $role) {
                $rolePermissions = $role->permissions->pluck('id')->toArray();
                return view('pages.role.partials.action', ['row' => $role, 'rolePermissions' => json_encode($rolePermissions)]);
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $dataValidated = $request->validate($this->rules);

            Role::create($dataValidated);
            $data = [
                'status' => 200,
                'message' => 'success',
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {
            $dataValidated = $request->validate($this->rules);

            $role->update($dataValidated);
            $data = [
                'status' => 200,
                'message' => 'success',
                'data' => $role
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
    public function destroy(Role $role)
    {
        try {
            $role->delete();
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

    public function rolePermission(Request $request, Role $role)
    {
        try {
            $rolePermissions = $role->permissions->pluck('id')->toArray();
            $permissions = $request->permission;
            if (!empty($rolePermissions)) {
                foreach ($rolePermissions as $item) {
                    $role->revokePermissionTo($item);
                }
            }
            if (!empty($permissions)) {
                foreach ($permissions as $item) {
                    $role->givePermissionTo((int) $item);
                }
            }
            return [
                'status' => 200,
                'message' => 'success',
            ];
        } catch (\Throwable $th) {
            return [
                'status' => 500,
                'message' => 'error',
                'data' => $th->getMessage()
            ];
        }

    }
}