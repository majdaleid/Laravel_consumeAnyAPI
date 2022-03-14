<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use App\Services\SaveApiRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $marketService;
    protected $saveApiRequests;

    public function __construct(MarketService $marketService,SaveApiRequests $saveApiRequests)
    {
     $this->marketService=$marketService;
     $this->saveApiRequests=$saveApiRequests;
    }
}
