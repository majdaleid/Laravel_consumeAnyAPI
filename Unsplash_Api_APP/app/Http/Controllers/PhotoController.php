<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarketService;
use App\Services\SaveApiRequests;

class PhotoController extends Controller
{
    public function __construct(MarketService $marketService,SaveApiRequests $saveApiRequests )
    {
        $this->middleware('auth')->except(['ShowPhotos']);
        parent::__construct($marketService, $saveApiRequests);
    }

    
   //show given PhotoInfo like PhotoLink, Photo Likes, Photo , etc 
   
    public function ShowPhotos()
    {
         $photos=$this->marketService->getPhotos();

         foreach($photos as $PhotoInfo)
         {
            $savePhotoInfo=$this->saveApiRequests->registerOrUpdatePhotoInfo($PhotoInfo);
         }
      
         return view('photos')->with(
        ['photos'=>$photos
        ]
    );
    }


    //GET /photos/:id/statistics  
    //show given Photo Statistics like Number of Views,Number of Downloads 

    public function ShowgivenPhotoStatistics($id)
    {
        $PhotoStatistik=$this->marketService->ShowPhotoStatistics($id);
        $savePhotoStatistik=$this->saveApiRequests->registerOrUpdatePhotoStatistik($PhotoStatistik);
        dd($PhotoStatistik);
        return view('UserSearch')->with(
            ['PhotoStatistic'=>$PhotoStatistik
            ]
        );
    }


}
