<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        $columns = [
            ["data" => 'id', "name" => 'id', "class" => 'text-center', "sortable" => false, "searchable" => false],
            ["data" => 'name', "name" => 'name', "class" => "align-middle"],
            ["data" => 'group_name', "name" => 'group_name', "class" => "align-middle"],
        ];

        return view('pages.permission.index', compact('columns'));
    }

    public function list()
    {
        $data = Permission::select('*');
        return DataTables::eloquent($data)
            ->rawColumns(['action'])
            ->toJson();
    }
}