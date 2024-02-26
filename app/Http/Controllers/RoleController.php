<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        $title = "Roles";
        if ($request->ajax()) {
            $data = Role::select('*');
            return DataTables::of($data)->addIndexColumn()->addColumn('action', function ($row) {
                $btn = '';
                $btn .= '<a href="' . route('roles.show', $row->id) . '"class="edit btn btn-success btn-sm ml-2">Show</a>';
                $btn .= '<a href="' . route('roles.edit', $row->id) . '"class="edit btn btn-info btn-sm ml-2">edit</a>';
                $btn .= '<button type="button" data-id="' . $row->id . '" class="deleteRecord btn btn-danger btn-sm ml-2">Delete</button>';

                return $btn;
            })->rawColumns(['action'])->make(true);
        }
        return view('roles.index', ['title' => $title]);
    }

    public function create()
    {
        $title = "Roles Create";
        $permission = Permission::get();
        return view('roles.create', ['title' => $title, 'permission' => $permission]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);
        $role = Role::create([
            'name' => $request->name
        ]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('roles.index')->with('success', 'roles created');
    }

    public function edit($id)
    {
        $title = 'Roles edit';
        $role = DB::table('roles')->find($id);
        $permissions = DB::table('permissions')->get();

        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('permission_id')
            ->all();
        return view('roles.edit', ['role' => $role,'permissions' => $permissions ,'rolePermissions' => $rolePermissions, 'title' => $title]);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required|array',
        ]);
        DB::table('roles')->where('id', $id)->update([
            'name' => $request->input('name'),
        ]);
        DB::table('role_has_permissions')->where('role_id', $id)->delete();
        $permissions = $request->input('permission');
        $rolePermissions = [];
        foreach ($permissions as $permission) {
            $rolePermissions[] = [
                'role_id' => $id,
                'permission_id' => $permission,
            ];
        }

        DB::table('role_has_permissions')->insert($rolePermissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function show($id)
    {
        $title = 'Roles Show';
        $role = DB::table('roles')->find($id);
        $rolePermissions = DB::table('permissions')
            ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->where('role_has_permissions.role_id', $id)
            ->get();
        return view('roles.show', ['role' => $role, 'rolePermissions' => $rolePermissions, 'title' => $title]);
    }

    public function destroy($id){
        try {
            DB::table("roles")->where('id','=',$id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'delete success'
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'fails',
                'message' => $e->getMessage()
            ],200);
        }
    }
}
