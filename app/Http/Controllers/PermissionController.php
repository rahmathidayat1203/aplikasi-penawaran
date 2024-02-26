<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $title = "Permission";
        if ($request->ajax()) {
            $data = DB::table('permissions')->select('*');

            // Use DataTables API
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showUrl = route('permissions.show', $row->id);
                    $editUrl = route('permissions.edit', $row->id);
                    $deletePermission = "deletePermission(" . $row->id . ")"; // Ensure deleteRole is properly defined in your JS

                    // Combine buttons into one string
                    $btn = '<a href="' . $showUrl . '" class="show btn btn-success btn-sm">Show</a> ';
                    $btn .= '<a href="' . $editUrl . '" class="edit btn btn-info btn-sm">Edit</a> ';
                    $btn .= '<button onclick="' . $deletePermission . '" class="delete btn btn-danger btn-sm">Delete</button>';

                    return $btn;
                })
                ->rawColumns(['action']) // Tell DataTables that 'action' column contains raw HTML
                ->make(true); // Finalize and send JSON response
        }

        return view('permission.index', [
            'title' => $title
        ]);
    }

    public function create()
    {
        $title = "Permision Create";
        return view('permission.create', [
            'title' => $title
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name.*' => 'required'
        ]);

        $input = $request->name;

        foreach ($input as $key => $value) {
            Permission::create([
                'name' => $value
            ]);
        }

        return redirect()->route('permissions.index')->with('success', 'permission created');
    }
    public function show($id){
        $permission = Permission::where('id', '=', $id)->first();
        $title = "Permission Show";
        return view('permission.show', [
            'permission' => $permission,
            'title' => $title
        ]);
    }
    public function edit($id)
    {
        $permission = Permission::where('id', '=', $id)->first();
        $title = "Permission Edit";
        return view('permission.edit', [
            'permission' => $permission,
            'title' => $title
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Permission::where('id', '=', $id)->update([
            'name' => $request->name
        ]);

        return redirect()->route('permissions.index')->with('success', 'permission updated');
    }

    public function destroy($id)
    {
        try {
            Permission::where('id', '=', $id)->delete();
            return response()->json([
                'status' =>'success',
                'message' => 'delete success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' =>'success',
                'message' => $e->getMessage()
            ]);
        }
    }
}
