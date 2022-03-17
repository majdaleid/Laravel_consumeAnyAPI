<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Services\MarketService;
use App\Services\SaveApiRequests;
use App\Services\MarketAuthenticationService;

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
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(MarketAuthenticationService $marketAuthenticationService,MarketService $marketService,SaveApiRequests $saveApiRequests )
    {
        $this->marketService=$marketService;
        $this->saveApiRequests=$saveApiRequests;
        $this->marketAuthenticationService = $marketAuthenticationService;
        
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $userData=$this->marketService->getUserInformation();
       // $userData=$this->marketService->getPhotos();
     //   $userInfo=$this->saveApiRequests->registerOrUpdateUserInfo($userData);
       // return 0;
       //  dd("huhuh");
       //$this->info("UserInfo has been Updated successfully");
    }
}
