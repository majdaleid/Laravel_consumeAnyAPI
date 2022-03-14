<?php

namespace App\Services;


use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;
use App\Traits\AuthorizesMarketRequests;
 
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserStatistik;

 




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
               // 'email'=>$userData->email,
                'email'=>'user2@hotmail.com',
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


     

 
 





   
    
}