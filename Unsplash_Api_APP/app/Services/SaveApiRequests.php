<?php

namespace App\Services;

use App\Models\PhotoInfo;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;
use App\Traits\AuthorizesMarketRequests;
 
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserStatistik;
use App\Models\PhotoStatistik;


class SaveApiRequests
{
  use ConsumesExternalServices,AuthorizesMarketRequests,InteractsWithMarketResponses;

    public function registerOrUpdateUserInfo($userData)
    {
       
        return UserInfo::updateOrCreate(
            [
                'service_id' => $userData->id,
            ],
            [
                'last_Page_Call'=>$userData->updated_at,
                'user_name' => $userData->username,
                'first_name'=>$userData->first_name,
                'last_name'=>$userData->last_name,
                'profile_link'=>$userData->links->html,
                'profile_Image'=>$userData->profile_image->large,
                'total_likes'=>$userData->total_likes
                
                //'token_expires_at' => $tokenData->token_expires_at,
            ]
        );
    }


    public function registerOrUpdateUserStatistik($userData)
    {
       
        return UserStatistik::updateOrCreate(
            [
                'service_id' => $userData->id,
            ],
            [
                'downloads'=>$userData->downloads->total,
                'views'=>$userData->views->total
            ]
        );
    }



    public function registerOrUpdatePhotoInfo($photoData)
    {
      
        return PhotoInfo::updateOrCreate(
            [
                'service_id' => $photoData->id,
            ],
            [
                'description'=> $photoData->description,
                'profile_Image' => $photoData->urls->small_s3,
                'photo_link'=>$photoData->links->html,
                'total_likes'=> $photoData->likes
            ]
        );
    }

    public function registerOrUpdatePhotoStatistik($photoData)
    {
       
        return PhotoStatistik::updateOrCreate(
            [
                'service_id' => $photoData->id,
            ],
            [
                'downloads'=>$photoData->downloads->total,
                'views'=>$photoData->views->total
            ]
        );
    }

  
}