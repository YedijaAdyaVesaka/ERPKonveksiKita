<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProSemenModel extends Model
{
    use HasFactory;
    protected $table = "prosemen";
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'kode_bom_list', 'qty_order'];
    public $timestamps = false;
}
