<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BomListModel extends Model
{
    use HasFactory;
    protected $table = "t_bom_list";
    protected $primaryKey = 'kode_bom_list';
    public $incrementing = false;
    protected $fillable = ['kode_bom','kode_produk','qty', 'satuan'];
    public $timestamps = false;
}
