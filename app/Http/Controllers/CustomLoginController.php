<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class CustomLoginController extends Controller
{
    // do login Auth
    public function loginUser(Request $request)
    {
    	$email	       = $request->email;
    	$password      = $request->password;
    	$rememberToken = $request->remember;

    	// now we use the Auth to Authenticate the users Credentials

		// Attempt Login for members
		if (Auth::guard('member')->attempt(['email' => $email, 'password' => $password], $rememberToken)) {
			$msg = array(
				'status'  => 'success',
				'message' => 'Login Successful'
			);
			return response()->json($msg);
		} else {
			$msg = array(
				'status'  => 'error',
				'message' => 'Login Fail !'
			);
			return response()->json($msg);
		}
    }
}
