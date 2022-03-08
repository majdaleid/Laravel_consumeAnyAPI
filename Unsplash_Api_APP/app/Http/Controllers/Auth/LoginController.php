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

          dd($tokenData);
            $userData=$this->marketService->getUserInformation();
        
          dd($userData);

           $user=$this->registerOrUpdateUser($userData,$tokenData);
            
            $this->loginUser($user);
           // dd($user);
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

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
         try{
            $tokenData = $this->marketAuthenticationService->getPasswordToken($request->email, $request->password);

            $userData = $this->marketService->getUserInformation();

            $user = $this->registerOrUpdateUser($userData, $tokenData);

            $this->loginUser($user, $request->has('remember'));
            return  redirect()->route('home') ;

            }catch(\Exception $e){
                  // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
            }
       
             
        

      
       
    }

    


}
