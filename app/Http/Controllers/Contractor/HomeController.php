<?php

namespace App\Http\Controllers\Contractor;

use App\Http\Controllers\Controller;
use App\AdminData;
use App\Contractor;
use Illuminate\Http\Request;
use Session;
class HomeController extends Controller
{

    protected $redirectTo = '/contractor/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('contractor.auth:contractor');
    }

    /**
     * Show the Contractor dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('contractor.manage.index');
    } 


    public function profile() {

        return view('contractor.admin.index');
    }  

    public function create() {
        
        return view('contractor.admin.edit');
    }





    public function store(Request $request)
    {
    
      
       $data = new Contractor();
  
      $user = Contractor::find($request->id);
       $user->name = $request->name;
       $user->adress = $request->adress;
       $user->id_admin = $request->id_admin;
       $user->phone = $request->phone;
       $user->about = $request->about;    
 // if($request->hasFile('image')){
 //        $filename = $request->image->getClientOriginalName();
 //          $request->image->move(public_path('/images/'), $filename);
 //         // $file = new File();
 //       // $file->name = $filename;
 //    $data->image = $filename;

 //      $id = $data->id_admin;

 //      $data2 = AdminData::find($id);
 //       $data->save();
   
 //       }
  
       // }
 $user->save();
          return redirect()->route('admin.profile.index',$data->id);

    }





}