<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class FrontendAuthController extends Controller
{
    public function loginGet(Request $request)
    {
        if(app()->getLocale() == 'en'){
        return View::make('en.pages.login');
        }else{
        return View::make('ar.pages.login');    
	    }
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'The password field is required.',
        ]);
        
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
		    $remember = $request->has('remember') ? true : false; 
		    if(!empty($remember ))
		    {
				Auth::loginUsingId(Auth::user()->user_id, $remember = true);
			}
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['flash_notice' => 'These credentials do not match our records.']);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush(); // Clear all session data
        Session::regenerate(); // Regenerate the session ID
        return redirect()->route('login',app()->getLocale());
    }

    public function registerGet()
    {
        if(app()->getLocale() == 'en'){
        return View::make('en.pages.register');
        }else{
        return View::make('ar.pages.register');    
	    }
    }

    public function registerPost(Request $request)
    {
		 
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:tbl_users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'full_name.required' => 'The full name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        // Create a new user record
        
        if($request->input('newsletter'))
        {
			$newsletter =1;
		}
		else{
			$newsletter =0;
			}
        
        $user = new User();
        $user->full_name = $request->input('full_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->phone = $request->input('phone');
        $user->newsletter = $newsletter;
        $user->save();
        
       
        // Log in the newly registered user
        //Auth::login($user);

        // Redirect the user to the home page or any other desired page
        return redirect()->route('login',app()->getLocale());
    }
}
