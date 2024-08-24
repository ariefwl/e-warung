<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IklanModel;
use Validator;

class IklanController extends Controller
{
    public function index()
    {
        $iklan = IklanModel::where('status', 1)->get();

        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data iklan',
            'data' => $iklan
        ]);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'judul_iklan' => 'required|string|max:100',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //Post data
        $image = $request->file('image');
        $image->storeAs('public/banner', $image->hashName());

        //create post
        $product = IklanModel::create([
            'judul_iklan'   => $request->judul_iklan,
            'image'     => $image->hashName()
        ]);

        return response()->json(['data'=>$product]);
    }

    public function iklanatas()
    {
        $iklan = IklanModel::where(['status'=> 1, 'posisi' => 1])->get();

        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data iklan atas',
            'data' => $iklan
        ]);
    }

    public function iklanbawah()
    {
        $iklan = IklanModel::where(['status'=> 1, 'posisi' => 2])->get();

        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data iklan bawah',
            'data' => $iklan
        ]);
    }
}
