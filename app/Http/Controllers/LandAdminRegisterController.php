<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Mail;
class LandAdminRegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin/land';

    public function __construct()
    {
        $this->middleware('guest:admin');
    }

 public function showLandRegistrationForm()
    {
        return view('backend.lands.register');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
public function register(Request $request) {

    return('asd');
      // $input = $request->all();
      // dd($input);
      // $validator = $this->validator($input);

      // if ($validator->passes()){
      //   $admin = $this->create($input)->toArray();
      //   $admin['link'] = str_random(30);

      //   DB::table('admins_activations')->insert(['id_user'=>$admin['id'],'token'=>$admin['link']]);

      //   Mail::send('emails.activation', $admin, function($message) use ($admin){
      //     $message->to($admin['email']);
      //     $message->subject('www.hc-kr.com - Activation Code');
      //   });
      //   return redirect()->to('email/verify')->with('success',"We sent activation code. Please check your mail.");
      // }
      // return back()->with('errors',$validator->errors());
    }


    
}