<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Land;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth','verified']);
       $this->middleware(['auth', 'verified']);    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function showLand()
    {  $lands = Land::all();
        return view('frontend.land.all',compact('lands'));
    } 

     public function showSingle($id)

    {  
        $land= Land::Find($id);
     
       return view('frontend.land.single',compact('land'));
    }
}
