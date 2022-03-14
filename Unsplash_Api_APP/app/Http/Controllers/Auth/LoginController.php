<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
//use GuzzleHttp\Psr7\Request;
use App\Models\UserStatistik;
use App\Services\MarketService;
use App\Services\SaveApiRequests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Services\MarketAuthenticationService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;



    protected $marketAuthenticationService;

    protected $saveApiRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarketAuthenticationService $marketAuthenticationService,MarketService $marketService,SaveApiRequests $saveApiRequests )
    {
        $this->middleware('guest')->except('logout');
        $this->marketAuthenticationService = $marketAuthenticationService;
        parent::__construct($marketService,$saveApiRequests);
    }


    public function showLoginForm()
    {
        $authorizationUrl = $this->marketAuthenticationService->resolveAuthorizationUrl();

        return view('auth.login')
            ->with(['authorizationUrl' => $authorizationUrl]);
    }

    //resolve the user authorization ,return the http response
    //get the code and get the user info
    public function authorization(Request $request)
    {
        if($request->has('code')){
            $tokenData=$this->marketAuthenticationService->getCodeToken($request->code);


            //add remember tokenn
         // dd($tokenData); 
            $userData=$this->marketService->getUserInformation();
          // remember email
         // dd($userData);

           $user=$this->registerOrUpdateUser($userData,$tokenData);
       //  dd($user);
           //new

          
           $userInfo=$this->saveApiRequests->registerOrUpdateUserInfo($userData);
         //  $userInfo=$this->registerOrUpdateUserInfo($userData);

        
           $userStatistiks=$this->marketService->ShowUserStatistics($userInfo->user_name);
        

         //  $saveUserStatistiks=$this->registerOrUpdateUserStatistik($userStatistiks);
           $saveUserStatistiks=$this->saveApiRequests->registerOrUpdateUserStatistik($userStatistiks);
           
       // dd("all data saved after successfully log in");
         //dd($user);
        /* $user->service_id=2;
         $user->last_call="sdsad";
         $user->email="huhuhu";
         $user->grant_type="jijo";
         $user->access_token="asdsdsad";
         $user->refresh_token="asdsad";
        */
 
          $this->loginUser($user);


           //dd($user);
            return  redirect()->route('home') ;
        }
        return redirect()->route('login')->withErrors(['you cancelled the authorization process']);

// dd($request);
    }



   //save the userInfo into database service_id,accessToken-refresh_token
    public function registerOrUpdateUser($userData,$tokenData)
    {
       

    
        return User::updateOrCreate(
            [
                'service_id' => $userData->id,
            ],
            [
               // 'last_call'=>$userData->updated_at,
                //'email'=>$userData->email,
                //'grant_type' => $tokenData->grant_type,
                'access_token' => $tokenData->access_token,
                'refresh_token' => $tokenData->refresh_token,
                //'token_expires_at' => $tokenData->token_expires_at,
            ]
        );
    }

/*
    public function registerOrUpdateUserInfo($userData)
    {
       
        return UserInfo::updateOrCreate(
            [
                'service_id' => $userData->id,
            ],
            [
                'last_Page_Call'=>$userData->updated_at,
                'user_name' => $userData->username,
                'email'=>$userData->email,
                'first_name'=>$userData->first_name,
                'last_name'=>$userData->last_name,
                'profile_link'=>$userData->links->html,
                'profile_Image'=>$userData->profile_image->large,
                'total_likes'=>$userData->total_likes
                
                //'token_expires_at' => $tokenData->token_expires_at,
            ]
        );
    }


    public function registerOrUpdateUserStatistik($userData)
    {
       
        return UserStatistik::updateOrCreate(
            [
                'service_id' => $userData->id,
            ],
            [
                'downloads'=>$userData->downloads->total,
                'views'=>$userData->views->total
            ]
        );
    }

    */
    public function loginUser(User $user,$remember =true)
    {
      Auth::login($user,$remember);
      session()->regenerate();
    }


  

 
    


}
