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


   
    public function getProducts()
    {
        return $this->makeRequest('GET', 'products');
       // return $this->makeRequest('GET', 'photos','client_id=hfWznsCyN5P3hHvhGDlXRY353itMYvkqTviQNVppB7g');
    }

 
    public  function getProduct($id)
    {
        return $this->makeRequest('GET', "products/{$id}");
    }

   
    public function publishProduct($sellerId, $productData)
    {
        return $this->makeRequest(
            'POST',
            "sellers/{$sellerId}/products",
            [],
            $productData,
            [],
            $hasFile = true
        );
    }

   
    public function setProductCategory($productId, $categoryId)
    {
        return $this->makeRequest(
            'PUT',
            "products/{$productId}/categories/{$categoryId}"
        );
    }

   

    
   
    
    public function getCategories()
    {
        return $this->makeRequest('GET', 'categories');
    }

   
    public function getCategoryProducts($id)
    {
        return $this->makeRequest('GET', "categories/{$id}/products");
    }

   
    public function getPurchases($buyerId)
    {
        return $this->makeRequest('GET', "buyers/{$buyerId}/products");
    }

   
    public function getPublications($sellerId)
    {
        return $this->makeRequest('GET', "sellers/{$sellerId}/products");
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