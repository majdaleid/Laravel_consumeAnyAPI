<?php

namespace App\Services;


use App\Traits\ConsumesExternalServices;
use App\Traits\InteractsWithMarketResponses;
use App\Models\User;

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

    public function getClientCredentialsToken()
    {
        //if $token return a value it will return $token value and will not continue executing the code
        //if $token=false will not return anything and continue executing the code 

        $user = auth()->user();

     if ($token = $this->existingValidToken())  {
        //dd("there is an access token and no need to a new one");
            return $token;
      }
           if (auth()->user()){
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
  //        $tokenData->token_expires_at = now()->addSeconds($tokenData->expires_in - 5);
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
        //  'redirect_uri' => 'urn:ietf:wg:oauth:2.0:oob',
          'redirect_uri' => 'http://127.0.0.1:8000/authorization',
          'response_type' => 'code',
          'scope' => 'public read_user write_user read_photos write_photos write_likes write_followers read_collections write_collections',
        //  'scope' => 'purchase-product manage-products manage-account read-general',
      ]);

     // return "{$this->baseUri}/oauth/authorize?{$query}";
      return "{$newBaseUri}/oauth/authorize?{$query}";
  }

   //get code after authenticating the user
  public function getCodeToken($code)
  {
    $formParams = [
      'grant_type' =>'authorization_code',
      'client_id' =>'1cRhk9nGMVmdv4qHwS3S5ZrjC55dhtsbjoimeFNvf6w',
        'client_secret' =>'nPsxQc63tXN76uhO1wvgfqTnEd2K8dfz-X71ha2_X18',
        'redirect_uri' => 'http://127.0.0.1:8000/authorization',
        'code' => $code,
    ];

      $tokenData = $this->makeRequest('POST', 'oauth/token', [], $formParams);
       // dd($tokenData);
      //you have to uncomment the storevalidtoken and there is not expired api date
      $this->storeValidToken($tokenData, 'authorization_code');

      return $tokenData;
  }

  //obtain access token based on user credentials

    
}