<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SQModel extends Model
{
    protected $table = "t_sq";
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id_sq', 'id_pelanggan', 'tanggal_transaksi', 
        'status', 'total_harga','metode_pembayaran'
    ];
    public $timestamps = false;
}
