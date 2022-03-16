<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
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

            $userData=$this->marketService->getUserInformation();
        
           $user=$this->registerOrUpdateUser($userData,$tokenData);
      
           $userInfo=$this->saveApiRequests->registerOrUpdateUserInfo($userData);
       
           $userStatistiks=$this->marketService->ShowUserStatistics($userInfo->user_name);
        
           $saveUserStatistiks=$this->saveApiRequests->registerOrUpdateUserStatistik($userStatistiks);
           
       
          $this->loginUser($user);

         return  redirect()->route('home') ;
        }
        return redirect()->route('login')->withErrors(['you cancelled the authorization process']);


    }

   //save the userInfo into database service_id,accessToken-refresh_token
    public function registerOrUpdateUser($userData,$tokenData)
    {
       
        return User::updateOrCreate(
            [
                'service_id' => $userData->id,
            ],
            [
               
                'access_token' => $tokenData->access_token,
                'refresh_token' => $tokenData->refresh_token,
               
            ]
        );
    }


    public function loginUser(User $user,$remember =true)
    {
      Auth::login($user,$remember);
      session()->regenerate();
    }


}
