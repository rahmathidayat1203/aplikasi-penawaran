<?php

namespace App\Http\Controllers;

use App\Models\Distributors;
use Illuminate\Http\Request;

class DistributorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $distributors = Distributors::latest()->paginate(5);
        return view('distributor.index', compact('distributors'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('distributor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'no_hp' => 'required', 'email' => 'required']);
        Distributors::create($request->all());
        return redirect()->route('distributors.index')->with('success', 'Distributor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $distributors = Distributors::where('id','=',$id)->first();
        return view('distributor.show', compact('distributors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $distributors = Distributors::where('id','=',$id)->first();
        return view('distributor.edit', compact('distributors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required', 'no_hp' => 'required', 'email' => 'required']);
        $distributors = Distributors::where('id','=',$id);
        $distributors->update($request->except(['_token','_method']));
        return redirect()->route('distributors.index')->with('success', 'Distributor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $distributors = Distributors::where('id','=',$id);
        $distributors->delete();
        return redirect()->route('distributors.index')->with('success', 'Distributor deleted successfully.');
    }
}
