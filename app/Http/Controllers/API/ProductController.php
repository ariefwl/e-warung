<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use Validator;

class ProductController extends Controller
{
    public function index()
    {
        //get all product
        $product = ProductModel::all();

        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data product',
            'data' => $product
        ]);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required|integer',
            'id_sub_kategori' => 'required|integer',
            'id_sub_sub_kategori' => 'required|integer',
            'id_brand' => 'required|integer',
            'nama_product' => 'required|string|max:100',
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
            'id_sub_kategori'   => $request->id_sub_kategori,
            'id_sub_sub_kategori'   => $request->id_sub_sub_kategori,
            'id_brand'   => $request->id_brand,
            'nama_product'   => $request->nama_product,
            'harga' => $request->harga,
            'keterangan'   => $request->keterangan,
            'thumbnail'     => $thumbnail->hashName(),
            'status'     => $request->status
        ]);

        return response()->json(['data'=>$product]);
    }
}
