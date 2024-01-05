<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobModel extends Model
{
    use HasFactory;
    protected $table = "t_jobpos";
    protected $primaryKey = 'id';
    protected $fillable = ['position', 'depart'];
    public $timestamps = false;
}
