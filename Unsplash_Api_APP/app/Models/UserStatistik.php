<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 use App\Models\UserInfo;
class UserStatistik extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'service_id','downloads','views'
     ];


     public function userinfo()
     {
        return $this->hasOne(UserInfo::class,'service_id','service_id');
     
     }
     


}