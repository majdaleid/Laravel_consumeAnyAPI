<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\MarketService;
//use GuzzleHttp\Psr7\Request;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MarketAuthenticationService $marketAuthenticationService,MarketService $marketService)
    {
        $this->middleware('guest')->except('logout');
        $this->marketAuthenticationService = $marketAuthenticationService;
        parent::__construct($marketService);
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

         // dd($tokenData);
            $userData=$this->marketService->getUserInformation();
        
         // dd($userData);

           $user=$this->registerOrUpdateUser($userData,$tokenData);
          
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



   //save the userInfo into database
    public function registerOrUpdateUser($userData,$tokenData)
    {
       

    
        return User::updateOrCreate(
            [
                'service_id' => $userData->id,
                'last_call'=>$userData->updated_at,
                'email'=>$userData->email,
            ],
            [
                'grant_type' => $tokenData->grant_type,
                'access_token' => $tokenData->access_token,
                'refresh_token' => $tokenData->refresh_token,
                //'token_expires_at' => $tokenData->token_expires_at,
            ]
        );
    }


    public function loginUser(User $user,$remember =true)
    {
      Auth::login($user,$remember);
      session()->regenerate();
    }




 
    


}
