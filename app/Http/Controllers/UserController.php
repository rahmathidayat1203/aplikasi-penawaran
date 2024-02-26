<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = User::select('*');
            return DataTables::of($data)->addIndexColumn()->addColumn('action',function($row){
                $btn = '';
                $btn .= '<a href="' . route('users.show', $row->id) . '"class="edit btn btn-success btn-sm ml-2">Show</a>';
                $btn .= '<a href="' . route('users.edit', $row->id) . '"class="edit btn btn-info btn-sm ml-2">edit</a>';
                $btn .= '<button type="button" data-id="' . $row->id . '" class="deleteRecord btn btn-danger btn-sm ml-2">Delete</button>';

                return $btn;
            })->rawColumns(['action'])->make(true);
        }
        return view('users.index');
    }
    public function create(){
        return view('users.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create($request->all());
        return redirect()->route('users.index')->with('success','user created');
    }
    public function edit($id){
        $user = User::where('id','=',$id)->first();
        return view('users.edit',[
            'user' => $user
        ]);
    }
    public function show($id){
        $user = User::where('id','=',$id)->first();
        return view('users.show',[
            'user' => $user
        ]);
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('id','=',$id);
        $user->update($request->all());

        return redirect()->route('users.index')->with('success','data updated');
    }
    public function destroy($id){
        User::where('id','=',$id)->delete();
        return redirect()->route('users.index')->with('success','data deleted');
    }
}
