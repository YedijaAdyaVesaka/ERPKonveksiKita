<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartementModel extends Model
{
    use HasFactory;
    protected $table = "t_departement";
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
    public $timestamps = false;
}
