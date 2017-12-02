<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;

class CustomSignupController extends Controller
{
    //
    public function addUser(Request $request)
    {
        // now we get our form data from Request
    	$email 		= $request->email; // request coming from ajax
    	$password 	= $request->password; // request comming from ajax
        $status     = "inactive"; // this can be use to check if user account is activated

        // note Laravel uses an encryption system called bcrypt
        // this has been the secure foundation for login queries 
        // so here we are to encrypt as Laravel will accept when doing Auth
        $hash_password = bcrypt($password);

    	// do other process
        $users = new Member();
        $users->email    = $email;
        $users->password = $hash_password;
        $users->status   = $status;
        $users->save();

    	// return a msg dumb msg with client email
    	$msg = $email." has been registered successfuly";
    	echo $msg; // or return data on json.
    }
}
