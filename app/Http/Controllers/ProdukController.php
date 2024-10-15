<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Http\Requests\StoreprodukRequest;
use App\Http\Requests\UpdateprodukRequest;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Viewproduk()
    {
        $produk = Produk::all();
        return view('produk',['produk'=> $produk]);
    }
    public function CreateProduk(Request $request)
    {
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk
        ]);

        return redirect('/produk');
    }
    public function ViewAddProduk()
    {
        return view('addproduk'); //menampilkan view dari appproduk.blade.php
    }

    public function DeleteProduk($kode_produk)
    {
        Produk :: where('kode_produk', $kode_produk)->delete();

        return redirect('/produk');
    }

    //fungsi untuk view edit produk
    public function ViewEditProduk($kode_produk)
    {
        $ubahproduk = Produk::where('kode_produk',$kode_produk)->first();

        return view('editproduk',compact('ubahproduk'));
    }
    //fungsi untuk mengubah data produk
    public function UpdateProduk(Request $request,$kode_produk)
    {
        Produk::where('kode_produk', $kode_produk)->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk
        ]);

        return redirect('/produk');
    }
}
