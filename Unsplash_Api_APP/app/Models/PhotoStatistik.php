<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhotoInfo;
class PhotoStatistik extends Model
{
    use HasFactory;


    //public $timestamps = false;
    
    protected $fillable = [
        'service_id','downloads','views'
     ];



     public function photoinfo()
     {
        return $this->hasOne(PhotoInfo::class,'service_id','service_id');
     
     }
     
}
