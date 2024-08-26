<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfficialStoreModel;
use Validator;

class OfficialStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offstore = OfficialStoreModel::where('status', 1)->get();

        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data official store',
            'data' => $offstore
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
            'nama_store' => 'required|string|max:100',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //Post data
        $image = $request->file('image');
        $image->storeAs('public/officialStore', $image->hashName());

        //create post
        $offStore = OfficialStoreModel::create([
            'nama_store'   => $request->nama_store,
            'keterangan'   => $request->keterangan,
            'image'     => $image->hashName(),
            'link_facebook' => $request->link_facebook,
            'link_x' => $request->link_x
        ]);

        return response()->json(['data'=>$offStore]);
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
