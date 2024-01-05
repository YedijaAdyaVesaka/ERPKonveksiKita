<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaryawanModel extends Model
{
    use HasFactory;
    protected $table = "t_karyawan";
    protected $primaryKey = 'id';
    protected $fillable = ['name','id_job'];
    public $timestamps = false;
}
