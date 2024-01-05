<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorModel extends Model
{
    use HasFactory;
    protected $table = 't_vendor';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_vendor', 'telpon', 'alamat', 'status', 'company'
    ];
    public $timestamps = false;
}
