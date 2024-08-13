<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required|integer',
            'idsub_kategori' => 'required|integer',
            'nama_product' => 'required|string|max:30',
            'harga' => 'required|integer',
            'thumbnail'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //Post data
        $thumbnail = $request->file('thumbnail');
        $thumbnail->storeAs('public/product', $thumbnail->hashName());

        //create post
        $product = ProductModel::create([
            'id_kategori'   => $request->id_kategori,
            'idsub_kategori'   => $request->idsub_kategori,
            'nama_product'   => $request->nama_product,
            'harga' => $request->harga,
            'keterangan'   => $request->keterangan,
            'thumbnail'     => $thumbnail->hashName(),
            'status'     => $request->status
        ]);

        return response()->json(['data'=>$product]);
    }
}
