<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoStatistik extends Model
{
    use HasFactory;


    //public $timestamps = false;
    
    protected $fillable = [
        'service_id','downloads','views'
     ];
}
