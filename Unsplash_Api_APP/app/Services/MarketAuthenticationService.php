<?php

namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;

class MarketAuthenticationService
{
    use ConsumesExternalServices,InteractsWithMarketResponses;

      protected $baseUri;
      protected $clientId;
      protected $clientSecret;
      
    public function __construct()
    {

        $this->baseUri = config('services.market.base_uri');
        $this->clientId = config('services.market.client_id');
        $this->clientSecret = config('services.market.client_secret');
       
    }



    // after login through the api ,will check if there is saved accesstoken 
    //if accessToken expired ,will generate refresh Token
    public function getClientCredentialsToken()
    {
        //if $token return a value it will return $token value and will not continue executing the code
        //if $token=false will not return anything and continue executing the code 

        $user = auth()->user();

     if ($token = $this->existingValidToken())  {
         
      // dd("there is saved access token");
            return $token;
      }

      if (!Auth::user())
      {
          return route('login');
      }
      //hier active again
//dd("huhuhuhuhu1");
           if (auth()->user()){
               //
               dd("return refresh token");
      return $this->refreshAuthenticatedUserToken($user);
           }



      /*  if ($token = false)  {
           dd("will not execute the condition");
        }
        if($token = true)
        {
            dd("will execute the condition");
        }*/

       // dd("there is no  access token and you  need  a new one because the session is not valid any more");
    }

    //get refresh token 
 public function refreshAuthenticatedUserToken($user)
    {
        $clientId = $this->clientId;
        $clientSecret = $this->clientSecret;

        $formParams = [
            'grant_type' => 'refresh_token',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $user->refresh_token,
        ];

        $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);

        $this->storeValidToken($tokenData, $user->grant_type);

        $user->fill([
            'access_token' => $tokenData->access_token,
            'refresh_token' => $tokenData->refresh_token,
        ]);

        $user->save();

        return $tokenData->access_token;
    }




    /**
     * Stores a valid token with some attributes
     * @return void
     */
    public function storeValidToken($tokenData, $grantType)
    {
  //        
        $tokenData->access_token = "{$tokenData->token_type} {$tokenData->access_token}";
        $tokenData->grant_type = $grantType;
        
        session()->put(['current_token' => $tokenData]);
       
    }

    //verify if there is any valid token on session
    public function existingValidToken()
    {
       
        if (session()->has('current_token')) {
            $tokenData = session()->get('current_token');
            
          //  if (now()->lt($tokenData->token_expires_at)) {
                return $tokenData->access_token;
          //  }
        }
   
        return false;
    }

  //after login with the user
  public function resolveAuthorizationUrl()
  {
      $newBaseUri="http://unsplash.com";
      $query = http_build_query([
          'client_id' => $this->clientId,
          'redirect_uri' => 'http://127.0.0.1:8000/authorization',
          'response_type' => 'code',
          'scope' => 'public read_user write_user read_photos write_photos write_likes write_followers read_collections write_collections',
      ]);

      return "{$newBaseUri}/oauth/authorize?{$query}";
  }

   //get code after authenticating the user
  public function getCodeToken($code)
  {
   
    $formParams = [
        'grant_type' =>'authorization_code',
        'client_id' =>$this->clientId,
          'client_secret' => $this->clientSecret,
          'redirect_uri' => 'http://127.0.0.1:8000/authorization',
          'code' => $code,
      ];


      $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);
      
      $this->storeValidToken($tokenData, 'authorization_code');

      return $tokenData;
  }

    
}