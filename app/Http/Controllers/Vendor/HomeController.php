<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    protected $redirectTo = '/vendor/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('vendor.auth:vendor');
    }

    /**
     * Show the Vendor dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('vendor.home');
    }

}