<?php

namespace App\Http\Controllers;

use App\Services\MarketService;
use App\Services\SaveApiRequests;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $saveApiRequests;
    public function __construct(MarketService $marketService,SaveApiRequests $saveApiRequests )
    {
        $this->middleware('auth')->except(['showProduct']);
        parent::__construct($marketService, $saveApiRequests);
    }

    public function ShowProduct($title,$id)
    {

        $product=$this->marketService->getProduct($id);
   
       //dd($product);
        return view('show')->with(
            [
                'product'=>$product
            ]
        );
    }


   //GET /me.
   //link to profile {{$UserInfo->links->html}}
   //link to image {{$UserInfo->profile_image->large}}
   //link to name {{$UserInfo->name}
   //link to $UserInfo->username
    public function ShowgivenUserInfo(Request $request)
    {
        //theeastlondonphotographer
         // dd($request);
        $userName=$request->name;
        $UserInfo=$this->marketService->getgivenUserInformation($userName);
        $SaveUserInfo=$this->saveApiRequests->registerOrUpdateUserInfo($UserInfo);
        //dd($UserInfo);
        return view('UserSearch')->with(
            ['UserInfo'=>$UserInfo
            ]
        );
    }

    //User statistics
    //number of total downloads
    //GET /users/:username/statistics
    //total number of views
  public function ShowgivenUserStatistics($userName)
    {
        //username=theeastlondonphotographer;
       
        $UserStatistic=$this->marketService->ShowUserStatistics($userName);
        $saveUserStatistiks=$this->saveApiRequests->registerOrUpdateUserStatistik($UserStatistic);
        dd($UserStatistic);
        return view('UserSearch')->with(
            [
                'downloads'=>$UserStatistic->downloads->total,
                'views'=>$UserStatistic->views->total
            ]
        );
    }
  

        //dont need it 
        //user likes
        //GET /users/:username/likes
         
        public function ShowgivenUserLikes(Request $request)
        {
             // dd($request);
            $userName=$request->name;
            $UserInfo=$this->marketService->getgivenUserInformation($userName);
    
            return view('UserSearch')->with(
                ['UserInfo'=>$UserInfo
                ]
            );
        }


    //photo Statistics
    //total number of views
    //total number of downloads
    //GET /photos/:id/statistics

    public function ShowgivenPhotoStatistics($id)
    {
         // dd($request);
       // $userName=$request->name;
        $PhotoStatistik=$this->marketService->ShowPhotoStatistics($id);
        $savePhotoStatistik=$this->saveApiRequests->registerOrUpdatePhotoStatistik($PhotoStatistik);
        dd($PhotoStatistik);
        return view('UserSearch')->with(
            ['PhotoStatistic'=>$PhotoStatistik
            ]
        );
    }




    //get photo likes
   //GET /photos/:id

    public function ShowgivenPhotoLikes($id)
    {
         // dd($request);
       // $userName=$request->name;
        $PhotoInfo=$this->marketService->getgivenPhotoInformation($id);
        dd($PhotoInfo);
        $savePhotoInfo=$this->saveApiRequests->registerOrUpdatePhotoStatistik($PhotoInfo);
        dd($PhotoInfo);
        return view('UserSearch')->with(
            ['UserInfo'=>$PhotoInfo
            ]
        );
    }

}
