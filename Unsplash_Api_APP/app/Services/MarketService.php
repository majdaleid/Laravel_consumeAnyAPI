<?php

namespace App\Services;


use App\Traits\ConsumesExternalServices;
use App\Traits\AuthorizesMarketRequests;
use App\Traits\InteractsWithMarketResponses;

class MarketService
{
    use ConsumesExternalServices,AuthorizesMarketRequests,InteractsWithMarketResponses;

      protected $baseUri;

      protected $clientId;
    
      protected $base_uri_public_request;
   

    public function __construct()
    {
        $this->clientId = config('services.market.client_id');
        //$this->baseUri='https://api.unsplash.com/';
        $this->baseUri=config('services.market.base_uri_public_request');
    }
   

    public function getPhotos()
    {
       
        // return $this->makeRequest('GET', 'photos','client_id=hfWznsCyN5P3hHvhGDlXRY353itMYvkqTviQNVppB7g');
         return $this->makeRequest('GET', 'photos','page=10&client_id='.$this->clientId);
         
    }


    public  function getProduct($id)
    {
        return $this->makeRequest('GET', "products/{$id}");
    }


    public function getUserInformation()
    {
        return $this->makeRequest('GET', '/me');
        
    }

    public function getgivenUserInformation($user)
    {
      return $this->makeRequest('GET',"/users/{$user}");
    }

    public function ShowUserStatistics($user)
    {
        return $this->makeRequest('GET',"/users/{$user}/statistics");
      
    }

    public function getgivenPhotoInformation($id)
    {
      return $this->makeRequest('GET',"/photos/{$id}");
    }

    public function ShowPhotoStatistics($id)
    {
        return $this->makeRequest('GET',"/photos/{$id}/statistics");
    }

}