<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;
    protected $table = 'produks'; //nama tabel sesuai didatabase mysql
    protected $fillable = ['kode_produk','nama_produk','deskripsi','harga','jumlah_produk','image','created_at','update_at'];
}
