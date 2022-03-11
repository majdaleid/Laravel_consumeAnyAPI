<?php

namespace App\Traits;

use App\Services\MarketAuthenticationService;

trait AuthorizesMarketRequests
{
    
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $accessToken = $this->resolveAccessTokenUnsplash();

        $headers['Authorization'] = $accessToken;
    }

   //reolve method to inject the service market authenticationsService

  public function resolveAccessTokenUnsplash()
  {
    $authenticationService = resolve(MarketAuthenticationService::class);
    return $authenticationService->getClientCredentialsToken();

   // return 'Bearer vFooLTxwZT5r0o582MW-fWHg-Em-AkPsHQKwnNLAmU8';
  }

}