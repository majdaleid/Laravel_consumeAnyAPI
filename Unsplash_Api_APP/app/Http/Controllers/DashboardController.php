<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UserInfo;
use App\Models\UserStatistik;

use App\Models\PhotoInfo;
use App\Models\PhotoStatistik;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function DashboardIndex()
    {
         // dd($request);

      $ToptenUserDownloads=UserStatistik::orderBy('downloads','DESC')->limit(10)->get();

      $ToptenUserViews=UserStatistik::orderBy('views','DESC')->limit(10)->get();

     $ToptenUserLikes=UserInfo::orderBy('total_likes','DESC')->limit(10)->get();

     $ToptenPhotoDownloads=PhotoStatistik::orderBy('downloads','DESC')->limit(10)->get();
     
     $ToptenPhotoViews=PhotoStatistik::orderBy('views','DESC')->limit(10)->get();

     $ToptenPhotoLikes=PhotoInfo::orderBy('total_likes','DESC')->limit(10)->get();


     
        return view('dashboard')->with(
            ['ToptenPhotoLikes'=>$ToptenPhotoLikes,
            'ToptenPhotoViews'=>$ToptenPhotoViews,
            'ToptenPhotoDownloads'=>$ToptenPhotoDownloads,
           'ToptenUserDownloads'=>$ToptenUserDownloads,
           'ToptenUserViews'=>$ToptenUserViews,
           'ToptenUserLikes'=>$ToptenUserLikes
            ]
        );
    }
}
