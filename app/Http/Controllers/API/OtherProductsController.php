<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\otherProduct;
use Validator;

class OtherProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = otherProduct::where('status', 1)->get();

        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data product lainya',
            'data' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:100',
            'icon'     => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //Post data
        $icon = $request->file('icon');
        $icon->storeAs('public/icon', $icon->hashName());

        //create post
        $product = otherProduct::create([
            'nama_produk'   => $request->nama_produk,
            'keterangan'   => $request->keterangan,
            'icon'     => $icon->hashName(),
        ]);

        return response()->json(['data'=>$product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
