<?php

namespace App\Http\Controllers;

use App\Models\Offer_petanis;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Offer_petanisController extends Controller
{
    private $hashids;

    public function __construct()
    {
        $this->hashids = app('hashids');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('offerpetanis.create',[
            'title' => 'Create Product'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $offer_image_controller = new Offer_ImagesController();
        $request->validate([
            'name_product' => 'required',
            'quantity' => 'required',
            'price_start_sell' => 'required'
        ]);
        $offering_petani = Offer_petanis::create(
            [
                'id_petani' => Auth::user()->id,
                'name_product' => $request->name_product,
                'quantity' => $request->quantity,
                'price_start_sell' => $request->price_start_sell
            ]
        );
        $offer_image_controller->store($request,$offering_petani->id);
        return redirect()->route('offerpetanis.index')->with('success','selamat buat pembayaran berhasil');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hashids = new Hashids();
        $data = Offer_petanis::where('id','=',$this->hashids->decode($id))->first();
        return view('offerpetanis.show',compact('data','hashids'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Offer_petanis::where('id','=',$id)->first();

        return view('offerpetanis.edit',[
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name_product' => 'required',
            'quantity' => 'required',
            'price_start_sell' => 'required'
        ]);

        Offer_petanis::where('id','=',$id)->update($request->all());
        return redirect()->route('offerpetanis.index')->with('success','update data success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Offer_petanis::where('id','=',$id)->delete();
        return redirect()->route('offerpetanis.index')->with('success','destroy success');
    }
}
