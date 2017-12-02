<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CustomHomeController extends Controller
{
	protected $redirect = '/login/user';
    //
    public function __construct()
    {
    	$this->middleware("auth:member")->except('logoutUser');
    }

    public function index()
    {
    	return "HomePage";
    }

    public function logoutUser()
    {
    	Auth::guard('member')->logout();
    	return redirect('/');
    }
}
