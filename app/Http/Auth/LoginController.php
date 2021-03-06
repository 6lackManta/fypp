<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
  public function showLandLoginForm()
    {
        return view('backend.lands.login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

      public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $githubUser = Socialite::driver('github')->user();

          $user = User::where('provider_id', $githubUser->getId())->first();

        if (!$user) {
            // add user to database
            $user = User::create([
                'email' => $githubUser->getEmail(),
                'name' => $githubUser->getNickname(),
                'provider_id' => $githubUser->getId(),
                
            ]);
        }
       // login the user
        Auth::login($user, true);
        return redirect('/');
    }
     public function redirectToProviderg()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallbackg()
    {
        $googleuser = Socialite::driver('google')->stateless()->user();

         $user = User::where('provider_id', $googleuser->getId())->first();

        if (!$user) {
            // add user to database
            $user = User::create([
                'email' => $googleuser->getEmail(),
                'name' => $googleuser->getName(),
                'provider_id' => $googleuser->getId(),
                
            ]);
        }
       // login the user
        Auth::login($user, true);
        return redirect('/');
    }

    
}
