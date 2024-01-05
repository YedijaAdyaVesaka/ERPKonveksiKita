<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SQListModel extends Model
{
    use HasFactory;
    protected $table = "t_sq_list";
    protected $primaryKey = 'id_sq_list';
    public $incrementing = false;
    protected $fillable = ['id_sq_list', 'id_sq', 'kode_produk',
        'qty','satuan', 'total'
    ];
    public $timestamps = false;
    
}
