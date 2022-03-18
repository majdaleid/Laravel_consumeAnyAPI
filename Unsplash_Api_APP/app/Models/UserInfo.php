<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;


  //  public $timestamps = false;

    protected $fillable = [
       'service_id','last_Page_Call','user_name','first_name','last_name','profile_link','profile_Image','profile_Image','total_likes'
    ];
}

