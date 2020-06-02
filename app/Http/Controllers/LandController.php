<?php

namespace App\Http\Controllers;
use File;
use App\Land;
use Illuminate\Http\Request;
use Session;
use Image;
use Imagick;
use DB;

use Storage;
class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //   public function __construct()
    // {
    //   $this->middleware(['auth','verified']);
    // }
    public function index()
    {
         
        return view('backend.lands.manage.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $countries = DB::table("countries")->pluck("name","id");
        return view('backend.lands.manage.create',compact('countries'));
           }

           
 public function php($id)
    {

         $states = DB::table("states")->where("country_id",$id)->pluck("name","id");
         // return response(['message' => 'OKkkkkkkkk']);
       return json_encode($states);
    }


     public function phps($id)
    {
        
        $cities = DB::table("cities")->where("state_id",$id)->pluck("name","id");
        return json_encode($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


 $country = DB::table("countries")->where("id", $request->country)->pluck("name");
 $state = DB::table("states")->where("id", $request->state)->pluck("name");
 $city = DB::table("cities")->where("id", $request->city)->pluck("name");
       $land = new Land();
        $land->type = $request->type;
        $land->country = $country;
        $land->state = $state;
        $land->city = $city;
        $land->title = $request->title;
        $land->desc = $request->desc;
        $land->price = $request->price;
        $land->area = $request->area;
        $land->unit = $request->unit;
        
 if($request->hasFile('image')){
        $filename = $request->image->getClientOriginalName();
          $request->image->move(public_path('/images/'), $filename);
         // $file = new File();
       // $file->name = $filename;
     $land->image = $filename;
        $land->save();
  
       }
 
          return redirect()->route('admin.land.show',$land->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Land  $land
     * @return \Illuminate\Http\Response
     */
     public function shows()
    {
         $lands = Land::all();
         dd($lands);
    }  
    public function show($id)
    {
         $lands = Land::all();
         return view('backend.lands.manage.show',compact('lands'));
    }  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = DB::table("countries")->pluck("name","id");
          $land = Land::find($id);
        return view('backend.lands.manage.edit',compact('land','countries'));
            }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

           $land = Land::find($id);
           $lands = Land::all();
// $validatedData = $request->validate([
//             'type' => 'required|max:255',
//             'city' => 'required|max:255',
//             'location' => 'required|numeric',
//             'title' => 'required|max:255',
//             'desc' => 'required|max:255',
//             'price' => 'required|max:255',
//             'area' => 'required|max:255',
//             'unit' => 'required|max:255',
//             'image' => 'required',
//         ]);
//         Land::whereId($id)->update($validatedData);
            $country = DB::table("countries")->where("id", $request->country)->pluck("name");
            $state = DB::table("states")->where("id", $request->state)->pluck("name");
             $city = DB::table("cities")->where("id", $request->city)->pluck("name");
        $land->type = $request->get('type');
        $land->country = $country;
        $land->state = $state;
        $land->city = $city;
        $land->title = $request->get('title');
        $land->desc = $request->get('desc');
        $land->price = $request->get('price');
        $land->area = $request->get('area');
        $land->unit = $request->get('unit');  

             if($request->hasFile('image')){

         $oldfilename=$land->image;
         File::delete($oldfilename);

         //Update
         // Storage::delete($oldfilename);

$filename = $request->image->getClientOriginalName();
           $request->image->move(public_path('/images/'), $filename);
      $file = new File();
     $file->name = $filename;
        $land->image = $file->name;
    $land->save();
    Session::flash('message', 'Successfully updated Data'); 
    return view('backend.lands.manage.show',compact('lands'));
       }
        Session::flash('message', 'Error while updating'); 
       return view('backend.lands.manage.show',compact('lands'));
    }

    /**return('failure');
     * Remove the specified resource from storage.
     *
     * @param  \App\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                   $lands = Land::all();
                   
         $show = Land::findOrFail($id);
        $show->delete();

       return view('backend.lands.manage.show',compact('lands'));
    }
}
