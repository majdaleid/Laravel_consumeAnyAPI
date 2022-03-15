<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;
use App\Services\SaveApiRequests;

class WelcomeController extends Controller
{
    public function __construct(MarketService $marketService,SaveApiRequests $saveApiRequests )
    {
        
        parent::__construct($marketService, $saveApiRequests);
    }

    public function ShowWelcomePage()
    {
         $photos=$this->marketService->getPhotos();
       //  dd($photos);
         foreach($photos as $PhotoInfo)
         {
            $savePhotoInfo=$this->saveApiRequests->registerOrUpdatePhotoInfo($PhotoInfo);
         }
      //  $photoInfo=$this->marketService->getgivenPhotoInformation($photos->id);
                //dd($photos);
    return view('welcome2')->with(
        ['photos'=>$photos
        ]
    );
    }
}
