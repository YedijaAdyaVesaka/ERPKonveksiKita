<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfqListModel extends Model
{
    use HasFactory;
    protected $table = "t_rfq_list";
    protected $primaryKey = 'id_rfq_list';
    public $incrementing = false;
    protected $fillable = ['id_rfq_list', 'id_rfq', 'kode_produk',
        'qty','satuan'
    ];
    public $timestamps = false;

}
