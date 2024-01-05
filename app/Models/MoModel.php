<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoModel extends Model
{
    use HasFactory;
    protected $table = 't_mo';
    protected $primaryKey = 'id';
    protected $fillable = ['kode_mo','kode_bom','qty', 'status'];
    public $timestamps = false;
}
