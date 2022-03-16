<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PhotoStatistik;

class PhotoInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id','description','profile_Image','photo_link','total_likes'
     ];


     public function photoStatistik()
     {
         return $this->belongsTo('App\Models\PhotoStatistik');
     }
}

 