<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfqModel extends Model
{
    use HasFactory;
    protected $table = 't_rfq';
    protected $primaryKey = 'id_rfq';
    public $incrementing = false;
    protected $fillable = ['id_rfq', 'id_vendor', 'tanggal', 
        'status', 'total_harga','pembayaran'
    ];
    public $timestamps = false;
}
