<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class dynamicApp extends Controller
{
    public function index( ) {
    	 $countries = DB::table("countries")->pluck("name","id");
        return view('description',compact('countries'));
    }

 public function php($id)
    {
    	
        $states = DB::table("states")->where("country_id",$id)->pluck("name","id");
        return json_encode($states);
    }


     public function phps($id)
    {
    	
        $cities = DB::table("cities")->where("state_id",$id)->pluck("name","id");
        return json_encode($cities);
    }

}
