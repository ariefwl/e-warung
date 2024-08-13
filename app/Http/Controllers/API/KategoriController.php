<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\KategoriModel;

class KategoriController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama_kategori' => 'required|string|max:20'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $kat = KategoriModel::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return response()->json(['data'=>$kat]);
    }
}
