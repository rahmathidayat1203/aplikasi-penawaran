<?php

namespace App\Http\Controllers;

use App\Models\Petanis;
use Illuminate\Http\Request;

class PetanisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petanis = Petanis::latest()->paginate(5);
        return view('petanis.index',compact('petanis'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petanis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'no_hp' => 'required',
            'email' => 'required'
        ]);
        Petanis::create($request->except(['_token','_method']));
        return redirect()->route('petanis.index')->with('success','create data petani success');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $petanis = Petanis::where('id','=',$id)->first();
        return view('petanis.show',compact('petanis'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = "Petani Edit";
        $petanis = Petanis::where('id','=',$id)->first();

        return view('petanis.edit',[
            'petanis' => $petanis,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required',
            'no_hp' => 'required',
            'email' => 'required'
        ]);
        $petanis = Petanis::where('id','=',$id);
        $petanis->update($request->all());
        return redirect()->route('petanis.index')->with('success','update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $petanis = Petanis::where('id','=',$id);
        $petanis->delete();
        return redirect()->route('petanis.index')->with('success','delete data success');
    }
}
