<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    use HasFactory;
    protected $table = "t_produk";
    protected $primaryKey = 'id';
    protected $fillable = ['nama_produk', 'id_reference', 'deskripsi',
        'gambar', 'qty', 'harga', 'status'
    ];
    public $timestamps = false;
}
