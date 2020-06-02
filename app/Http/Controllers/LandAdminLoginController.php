<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
class LandAdminLoginController extends Controller
{
     use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/land';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
  public function showLandLoginForm()
    {
        return view('backend.lands.login');
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }

     protected function authenticated(Request $request, $user)
    {
       return view('backend.lands.admin.index');
    }
    //   public function redirectToProvider()
    // {
    //     return Socialite::driver('github')->redirect();
    // }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    // public function handleProviderCallback()
    // {
    //     $githubUser = Socialite::driver('github')->admin();

    //       $admin = Admin::where('provider_id', $githubUser->getId())->first();

    //     if (!$admin) {
    //         // add user to database
    //         $admin = User::create([
    //             'email' => $githubUser->getEmail(),
    //             'name' => $githubUser->getNickname(),
    //             'provider_id' => $githubUser->getId(),
                
    //         ]);
    //     }
    //    // login the user
    //     Auth::login($admin, true);
    //     return redirect('/');
    // }
    //  public function redirectToProviderg()
    // {
    //     return Socialite::driver('google')->redirect();
    // }

    // /**
    //  * Obtain the user information from GitHub.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function handleProviderCallbackg()
    // {
    //     $googleuser = Socialite::driver('google')->stateless()->admin();

    //      $admin = Admin::where('provider_id', $googleuser->getId())->first();

    //     if (!$user) {
    //         // add user to database
    //         $admin = Admin::create([
    //             'email' => $googleuser->getEmail(),
    //             'name' => $googleuser->getName(),
    //             'provider_id' => $googleuser->getId(),
                
    //         ]);
    //     }
       // login the user

}

