<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalServices
{
    
     //Send a request to any service
    
    public function makeRequest($method, $requestUrl, $queryParams = [], $formParams = [], $headers = [])
    {

        
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);
          







        //if the request doesnt need an authorization request 
        if(method_exists($this,'resolveAuthorization'))
       {
            $this->resolveAuthorization($queryParams, $formParams, $headers);
       }
       
    

        $response = $client->request($method, $requestUrl, [
            'query' => $queryParams,
            'form_params' =>$formParams,
            'headers' => $headers,
        ]);
           
        $response = $response->getBody()->getContents();


         //if the request doesnt return json data for example html or xml etc etc
        if (method_exists($this, 'decodeResponse')) {
            $response = $this->decodeResponse($response);
        }

        if (method_exists($this, 'checkIfErrorResponse')) {
            $this->checkIfErrorResponse($response);
        }

        return $response;
    }
}