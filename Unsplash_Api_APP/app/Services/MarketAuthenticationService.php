<?php

namespace App\Services;


use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;
use App\Modeles\User;

class MarketAuthenticationService
{
    use ConsumesExternalServices,InteractsWithMarketResponses;

      protected $baseUri;
      protected $clientId;
      protected $clientSecret;
      protected $passwordClientId;
      protected $passwordClientSecret;    

   

    public function __construct()
    {
        $this->baseUri = config('services.market.base_uri');
        $this->clientId = config('services.market.client_id');
        $this->clientSecret = config('services.market.client_secret');
        $this->passwordClientId = config('services.market.password_client_id');
        $this->passwordClientSecret = config('services.market.password_client_secret');
    }
 
    public function getClientCredentialsToken()
    {
        //if $token return a value it will return $token value and will not continue executing the code
        //if $token=false will not return anything and continue executing the code 




        if ($token = $this->existingValidToken())  {
            return $token;
        }


      /*  if ($token = false)  {
           dd("will not execute the condition");
        }
        if($token = true)
        {
            dd("will execute the condition");
        }*/

        
        $formParams = [
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];

        $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);

        $this->storeValidToken($tokenData, 'client_credentials');

        return $tokenData->access_token;
    }

     // return "{$tokenData->token_type} {$tokenData->access_token}";
    //}


    /**
     * Stores a valid token with some attributes
     * @return void
     */
    public function storeValidToken($tokenData, $grantType)
    {
        $tokenData->token_expires_at = now()->addSeconds($tokenData->expires_in - 5);
        $tokenData->access_token = "{$tokenData->token_type} {$tokenData->access_token}";
        $tokenData->grant_type = $grantType;
        
        session()->put(['current_token' => $tokenData]);
        //will print the tokendata just in case the accesstoken ist unvalid or its expired otherwise it will not print it
        //dd($tokenData);
    }

    //verify if there is any valid token on session
    public function existingValidToken()
    {
        if (session()->has('current_token')) {
            $tokenData = session()->get('current_token');

            if (now()->lt($tokenData->token_expires_at)) {
                return $tokenData->access_token;
            }
        }

        return false;
    }

  //after login with the user
  public function resolveAuthorizationUrl()
  {
      $query = http_build_query([
          'client_id' => $this->clientId,
          'redirect_uri' => 'http://127.0.0.1:8000/authorization',
          'response_type' => 'code',
          'scope' => 'purchase-product manage-products manage-account read-general',
      ]);

      return "{$this->baseUri}/oauth/authorize?{$query}";
  }

   //get code after authenticating the user
  public function getCodeToken($code)
  {
      
      $formParams = [
          'grant_type' => 'authorization_code',
          'client_id' => $this->clientId,
          'client_secret' => $this->clientSecret,
          'redirect_uri'=>'http://127.0.0.1:8000/authorization',
          'code'=>$code,
      ];

      $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);

      $this->storeValidToken($tokenData, 'authorization_code');

      return $tokenData;
  }

  //obtain access token based on user credentials


  
  public function getPasswordToken($username,$password)
  {
      
      $formParams = [
          'grant_type' => 'password',
          'client_id' => $this->passwordClientId,
          'client_secret' => $this->passwordClientSecret,
          'username'=>$username,
          'password'=>$password,
          'scope' => 'purchase-product manage-products manage-account read-general',
      ];

      $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);

      $this->storeValidToken($tokenData, 'password');

      return $tokenData;
  }







 public function getAuthenticatedUserToken()
 {


     $user=auth()->user();
     if(now()->lt($user->token_expires_at))
     {
        return $user->access_token;
     }

     return  $this->refreshAuthenticatedUserToken($user);
   
 }

 









 //get refresh token after expired 
 public function refreshAuthenticatedUserToken($user)
 {
     $clientId = $this->clientId;
     $clientSecret = $this->clientSecret;

     if ($user->grant_type === 'password') {
         $clientId = $this->passwordClientId;
         $clientSecret = $this->passwordClientSecret;
     }

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
         'token_expires_at' => $tokenData->token_expires_at,
     ]);

     $user->save();

     return $tokenData->access_token;
 }

   
    
}