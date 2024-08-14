<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubSubKategoriModel;
use Validator;

class SubSubKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subSubKategori = SubSubKategoriModel::all();

        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data sub sub Kategori',
            'data' => $subSubKategori
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
        $validator = Validator::make($request->all(),[
            'id_kat' => 'required|integer',
            'id_sub' => 'required|integer',
            'id_sub_sub' => 'required|integer',
            'nama_sub_sub_kategori' => 'required|string|max:100'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $subkat = SubSubKategoriModel::create([
            'id_kat' => $request->id_kat,
            'id_sub' => $request->id_sub,
            'id_sub_sub' => $request->id_sub_sub,
            'nama_sub_sub_kategori' => $request->nama_sub_sub_kategori
        ]);

        return response()->json(['data'=>$subkat]);
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
