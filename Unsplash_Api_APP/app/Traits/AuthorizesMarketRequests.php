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
    public function resolveAccessToken()
    {
       $authenticationService = resolve(MarketAuthenticationService::class);

       if(auth()->user()){

        return $authenticationService->getAuthenticatedUserToken();
       }
        return $authenticationService->getClientCredentialsToken();
        //return 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiNzk1MDRhMTk2YTE3ZjVkZDY5MjNjMGE2MmQyYTUyNjM5OTlkMDEyMzg3N2QyYTg5ZTQwZmNmMGE5OGFlM2Q5ZjI2MTlhZTY2Y2NkNjc4MjEiLCJpYXQiOiIxNjQ2MzU4OTg4LjA1NjIzNiIsIm5iZiI6IjE2NDYzNTg5ODguMDU2MjQwIiwiZXhwIjoiMTY3Nzg5NDk4OC4wNDk3NjkiLCJzdWIiOiIxMTI4Iiwic2NvcGVzIjpbInB1cmNoYXNlLXByb2R1Y3QiLCJtYW5hZ2UtcHJvZHVjdHMiLCJtYW5hZ2UtYWNjb3VudCIsInJlYWQtZ2VuZXJhbCJdfQ.LNcAghjujf4Pg8i3vOGuZg20W9Ln6Xun_ra0upLVQampHr_JdLB40nweO-sS6dkHsJFdAx6eZKgwRG8QB8eEfG6DhtO1HQiabRDzeqqqosv61iwAYoZNSjzq4sRwt-96PRkYRZPlbUDWM9MxTaU6rP1WTaP9pFkP7OuedLI0AsQajE_iL0v_YmVNwT2xi660hhjSPOlxrJFadQbUgKO46zoTMM0jIu6VE6SfOA61wjjzUTUlueWu4KmDreqz4kZdRqmZPYXnAXJ2Eqvb0ZbRaApMi1SySyCxA_b02Arap2tMkggSQDvwdftNe9BJcQ_IJhpRfoa2QGu4Vla2eSVwQ8R4RzRwrkefhcD1bJiFzrWXFeV4l58QtcMIZrzjOjDUVisQC3YwDj8E00-dcNHhT66vxGhOnRda2DgnG5qNPwG3blKkH93zLFyu6Cc8bkEdHBlwp-gloTHl8ZffoBJPwXbJe6fTS7hMqDjRZxh3im_6QaGTNSvTzqkpkWK-93MelZS4y1UuDKrPUojT4lArkYPJMm_q5JaGOfSCJkf6rIgOAneO26EdvT8oN2p_7lqeLsh437bT0OhxsWTFQmW2LwollLRNBHNH7P35u5xHuOYRmeRlx8QYsNZ2b9pA8h5WJZGFovzp9st-GsnjrtXXU2xSYIgbUl2EuOVW1_b9Kno';
    }

  public function resolveAccessTokenUnsplash()
  
  {


  }

}