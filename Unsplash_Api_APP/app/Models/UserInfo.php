<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $fillable = [
       'service_id','last_Page_Call','user_name','first_name','last_name','profile_link','profile_Image','profile_Image','total_likes'
    ];
}


/*
 'service_id' => $userData->id,
            ],
            [
                'lastPageCall'=>$userData->updated_at,
                'user_name' => $userData->username,
                'email'=>$userData->email,
                'first_name'=>$userData->first_name,
                'last_name'=>$userData->last_name,
                'profile_link'=>$userData->links->html,
                'profile_Image'=>$userData->profile_image->large,
                'total_likes'=>$userData->total_likes
*/