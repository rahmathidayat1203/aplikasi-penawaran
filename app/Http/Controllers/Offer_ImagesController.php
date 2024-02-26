<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;

class Offer_ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_petani)
    {
        if ($request->hasFile('image')) {
            // Menyimpan file yang di-upload ke dalam folder public/images
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName(); // Nama file yang unik
            $path = $file->move(public_path('images'), $filename); // Memindahkan file ke folder public/images

            // Membuat URL untuk file yang disimpan
            $url = asset('images/' . $filename);

            // Simpan URL ke dalam database atau lakukan proses selanjutnya
            // Misalnya, simpan data ke dalam model Offering atau model terkait lainnya
            $offering = new Images(); // Asumsi menggunakan model Offering
            $offering->id_petani = $id_petani;
            $offering->id_offering_petani = $request->id_offering_petani;
            $offering->link_image = $url; // Simpan URL ke field link_image
            $offering->save();

            return redirect()->back()->with('success', 'File berhasil di-upload dan data telah disimpan.');
        }

        // Tambahkan pesan error jika file tidak ada dalam request
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Images $images)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Images $images)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Images $images)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Images $images)
    {
        //
    }
}
