<?php

namespace App\Console\Commands;




use App\Models\User;

use App\Services\MarketService;

use Illuminate\Console\Command;
 
use App\Services\SaveApiRequests;
use Illuminate\Support\Facades\Auth;

use App\Traits\AuthorizesMarketRequests;

use App\Services\MarketAuthenticationService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get logged UserInfo and save it in the Database';

    protected $marketService;
    protected $saveApiRequests;
    protected $marketAuthenticationService;

    use AuthenticatesUsers;
    
    protected $user;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    
    public function __construct(MarketAuthenticationService $marketAuthenticationService,MarketService $marketService,SaveApiRequests $saveApiRequests,User $user )
    {
        $this->marketService=$marketService;
        $this->saveApiRequests=$saveApiRequests;
        $this->marketAuthenticationService = $marketAuthenticationService;
       $this->user = $user;
        
        parent::__construct();
    }




    /**
     * Execute the console command.
     *
     * @return int
     */

      //get all saved accessToken in database and call get user information 
      //to run the cron job locally :php artisan log:cron 
    public function handle()
    {

        //if i want to get just one accessToken 

       // $access_token = User::pluck('access_token');

       //if i want to get the access token for the first regsitered user 
        /*
       $access_token= Auth::loginUsingId(1)->access_token;

       $this->marketService->resolveAccessTokenUnsplash=$access_token;
    
       $userData=$this->marketService->getUserInformation();
       dd($userData);

      */

        $accessTokenUsers = User::select('id')->get();
     
        foreach($accessTokenUsers  as $accessTokenUser)
        {

            $access_token= Auth::loginUsingId($accessTokenUser->id)->access_token;
            $this->marketService->resolveAccessTokenUnsplash=$access_token;
            $userData=$this->marketService->getUserInformation();
            //dd($userData);
          
        }

       $this->info("All Users that have been logged,are called through api automatically successfully");

    
    }
}
