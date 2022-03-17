<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\MarketService;

use App\Services\SaveApiRequests;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    protected $saveApiRequests;
    public function __construct(MarketService $marketService,SaveApiRequests $saveApiRequests )
    {
        $this->middleware('auth');
        parent::__construct($marketService, $saveApiRequests);
    }

    public function searchUser()
    {
        return view('searchUser');
    }


   //GET /me.
   //show given userInfo like Name, Username, Image, Profile etc 

    public function ShowgivenUserInfo(Request $request)
    {
        //theeastlondonphotographer
        $userName=$request->name;
        try{
        $UserInfo=$this->marketService->getgivenUserInformation($userName);

        }catch(Exception $exception){
            return back()->withErrors(['message' => "Couldn't find User with the given Username"]);
        }

        $SaveUserInfo=$this->saveApiRequests->registerOrUpdateUserInfo($UserInfo);
    
        return view('userInfo')->with(
            ['UserInfo'=>$UserInfo
            ]
        );
    }

    
     //GET /users/:username/statistics
     //show given User statistics like Number of Views,Number of  Downloads

  public function ShowgivenUserStatistics($userName)
    {

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
  

     
}
