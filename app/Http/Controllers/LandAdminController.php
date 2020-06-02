<?php

namespace App\Http\Controllers;

use App\AdminData;
use Illuminate\Http\Request;
use Session;
class LandAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        return view('backend/lands.admin/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { return view('backend/lands/admin/edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
      
       $data = new AdminData();
      $user = AdminData::where('id_admin', $request->id_admin)->first();
       if ($request->admin_id == $user->admin_id ) {
          Session::flash('message', 'Data Already Inserted'); 
 return redirect()->route('admin.profile.index',$data->id);
       }else{

    
       $data->name = $request->name;
       $data->adress = $request->adress;
       $data->id_admin = $request->id_admin;
       $data->phone = $request->phone;
       $data->about = $request->about;    
 if($request->hasFile('image')){
        $filename = $request->image->getClientOriginalName();
          $request->image->move(public_path('/images/'), $filename);
         // $file = new File();
       // $file->name = $filename;
    $data->image = $filename;

      $id = $data->id_admin;

      $data2 = AdminData::find($id);
       $data->save();
   
       }
  
       }
 
          return redirect()->route('admin.profile.index',$data->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ladmin  $ladmin
     * @return \Illuminate\Http\Response
     */
    public function show(Ladmin $ladmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ladmin  $ladmin
     * @return \Illuminate\Http\Response
     */
    public function edit(Ladmin $ladmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ladmin  $ladmin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ladmin $ladmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ladmin  $ladmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ladmin $ladmin)
    {
        //
    }
}
