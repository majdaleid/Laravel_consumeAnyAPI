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
        $PhotoStatistic=$this->marketService->ShowPhotoStatistics($id);
        dd($PhotoStatistic);
        return view('UserSearch')->with(
            ['PhotoStatistic'=>$PhotoStatistic
            ]
        );
    }




    //get photo likes
   //GET /photos/:id

    public function ShowgivenPhotoLikes($request)
    {
         // dd($request);
        $userName=$request->name;
        $UserInfo=$this->marketService->getgivenUserInformation($userName);

        return view('UserSearch')->with(
            ['UserInfo'=>$UserInfo
            ]
        );
    }

}
