<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Requests\StoreprodukRequest;
use App\Http\Requests\UpdateprodukRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth; // Pastikan hanya ini yang digunakan untuk Auth
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function Viewproduk()
    {
        // $produk = Produk::all();
        $isAdmin =Auth::user()->role=='admin';

        $produk = $isAdmin ? Produk::all() : Produk::where('user_id', Auth::user()->id)->get();

        return view('produk',['produk'=> $produk]);
    }
    public function CreateProduk(Request $request)
    {
        $imageName = null;
        if ($request->hasFile('image')){
            $imageFile = $request->file('image');
            $imageName = time().'_'.$imageFile->getClientOriginalName();
            $imageFile -> storeAs('public/image', $imageName);
        }

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk,
            'image' => $imageName,
            'user_id' => Auth::user()->id
        ]);

        return redirect(Auth::user()->role.'/produk');
    }
    public function ViewAddProduk()
    {
        return view('addproduk'); //menampilkan view dari appproduk.blade.php
    }

    public function DeleteProduk($kode_produk)
    {
        Produk :: where('kode_produk', $kode_produk)->delete();

        return redirect(Auth::user()->role.'/produk');
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
        $imageName = null;
        if ($request->hasFile('image')){
            $imageFile = $request->file('image');
            $imageName = time().'_'. $imageFile->getClientOriginalName();
            $imageFile->storeAs('public/image', $imageName);
        }


        Produk::where('kode_produk', $kode_produk)->update([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'jumlah_produk' => $request->jumlah_produk,
            'image' => $imageName
        ]);

        return redirect(Auth::user()->role.'/produk');
    }

    public function ViewLaporan()
    {
        // Mengambil semua data produk
        $products = Produk::all();
        return view('laporan', ['products' => $products]);
    }

    public function print()
    {
        // Mengambil semua data produk
        $products = Produk::all();

        // Load view untuk PDF dengan data produk
        $pdf = Pdf::loadView('report', compact('products'));

        // Menampilkan PDF langsung di browser
        return $pdf->stream('laporan-produk.pdf');
    }
}
