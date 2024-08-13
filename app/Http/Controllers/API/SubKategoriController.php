<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubKategoriModel;
use Validator;

class SubKategoriController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'id_sub' => 'required|integer',
            'nama_sub_kategori' => 'required|string|max:50'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $subkat = SubKategoriModel::create([
            'id_sub' => $request->id_sub,
            'nama_sub_kategori' => $request->nama_sub_kategori
        ]);

        return response()->json(['data'=>$subkat]);
    }
}
