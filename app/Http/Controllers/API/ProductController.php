<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\KategoriModel;
use App\Models\SubKategoriModel;
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
            'lokasi_toko' => 'required|integer', 
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
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
            'id_brand' => $request->id_brand,
            'nama_product'   => $request->nama_product,
            'harga' => $request->harga,
            'diskon' => $request->diskon,
            'keterangan' => $request->keterangan,
            'lokasi_toko' => $request->lokasi_toko,
            'stock' => $request->stock,
            'type_product' =>$request->type_product,
            'thumbnail'     => $thumbnail->hashName(),
            'status'     => $request->status
        ]);

        return response()->json(['data'=>$product]);
    }

    public function katByProd()
    {   
        $Kat = ProductModel::join('kategori', 'products.id_kategori', '=', 'kategori.id')
                ->where('products.status', 1)
                ->whereNotNull('products.thumbnail')
                ->distinct()
                ->get(['products.id_kategori', 'kategori.nama_kategori']);
        
        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data kategori berdasarkan product',
            'data' => $Kat
        ]);
    }

    public function prodByKat($id_kat)
    {
        // Ambil data produk berdasarkan id_kategori
        $products = ProductModel::where('id_kategori', $id_kat)
                ->where('status', 1)
                ->where('thumbnail', '<>', '')
                ->get();

        // Kembalikan response dalam bentuk JSON
        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data produk berdasarkan kategori',
            'data' => $products
        ]);
    }

    public function subSubKatBySubKat($id_SubKat)
    {
        $subSubKat = ProductModel::join('sub_kategori', 'products.id_sub_kategori', '=','sub_kategori.id_sub')
                     ->join('sub_sub_kategori', 'products.id_sub_sub_kategori', '=', 'sub_sub_kategori.id_sub_sub')
                     ->where('products.id_sub_kategori', $id_SubKat)
                     ->where('products.status', 1)
                     ->whereNotNull('products.thumbnail')
                     ->distinct()
                     ->get(['products.id_sub_kategori','sub_kategori.nama_sub_kategori','products.id_sub_sub_kategori','sub_sub_kategori.nama_sub_sub_kategori']);
                    
        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data sub sub kategori berdasarkan sub kategori',
            'data' => $subSubKat
        ]);
    }

    public function subKatByProd($id_kat)
    {
        $subKat = ProductModel::join('kategori', 'products.id_kategori', '=', 'kategori.id')
                ->join('sub_kategori', 'products.id_sub_kategori', '=', 'sub_kategori.id_sub')
                ->where('products.id_kategori', $id_kat)
                ->where('products.status', 1)
                ->whereNotNull('products.thumbnail')
                ->distinct()
                ->get(['products.id_kategori', 'kategori.nama_kategori', 'products.id_sub_kategori', 'sub_kategori.nama_sub_kategori']);
        
        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data product berdasarkan sub kategori',
            'data' => $subKat
        ]);
    }

    public function sale()
    {
        $sale = ProductModel::where(['status' => 1, 'type_product' => 2])->get();

        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data product sale',
            'data' => $sale
        ]);
    }

    public function katWithProd($id_kat)
    {
        // Ambil kategori dengan join ke tabel sub_kategori dan product
        $kategori = KategoriModel::where('id', $id_kat)
            ->with(['product' => function($query) use ($id_kat) {
                $query->join('sub_kategori', 'products.id_sub_kategori', '=', 'sub_kategori.id_sub')
                      ->select(
                          'products.id',
                          'products.id_kategori',
                          'products.nama_product',
                          'products.harga',
                          'products.lokasi_toko',
                          'products.thumbnail',
                          'products.keterangan',
                          'products.status',
                          'sub_kategori.nama_sub_kategori'
                      )
                      ->where(['products.status' => 1, 'products.id_kategori' => $id_kat]);
            }])
            ->select('id', 'nama_kategori')
            ->first();
    
        // Ambil sub_kategori terkait dengan kategori ini
        $sub_kategori = SubKategoriModel::where('id_kat', $id_kat)
            ->select('id as id_sub', 'nama_sub_kategori')
            ->first();
    
        // Struktur JSON yang diinginkan
        $result = [
            'id' => $kategori->id,
            'nama_kategori' => $kategori->nama_kategori,
            'sub_kategori' => $sub_kategori,
            'product' => $kategori->product,
        ];
    
        return response()->json([
            'success' => true,
            'message' => 'Sukses menampilkan data kategori dengan produk',
            'data' => $result
        ]);
    }
}
