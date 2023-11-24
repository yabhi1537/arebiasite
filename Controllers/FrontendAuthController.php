<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Services\RememberMeExpiration;
use Illuminate\Support\Facades\Cookie;
class FrontendAuthController extends Controller
{
	use RememberMeExpiration;
    public function loginGet(Request $request)
    {
		//dd(decrypt(Cookie::get('reeeee')));
		$alldata='';
		if(Cookie::get('reeeee'))
		{
		  $allcokketdata = decrypt(Cookie::get('reeeee'));
		  $alldata = explode('|',$allcokketdata);
		}
		//dd($alldata);
        if(app()->getLocale() == 'en'){
        return View::make('en.pages.login',compact('alldata'));
        }else{
        return View::make('ar.pages.login',compact('alldata'));   
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
			
			$user =Auth::user();
		    $remember = $request->has('remember') ? true : false; 
		    
		    if(!empty(Cookie::get('reeeee') ))
		    {
				$allcokketdata = decrypt(Cookie::get('reeeee'));
				$alldata = explode('|',$allcokketdata);
				Auth::loginUsingId($alldata[0], $remember = true);
				
			}
			
			
			 if($request->has('remember'))
			 {
			  $this->setRememberMeExpiration($user,$request->input('password'));
			 }else{
			   $this->deleteRememberMeExpiration($user,$request->input('password'));
		      }
			
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['flash_notice' => 'These credentials do not match our records.']);
        }
    }
    public function loginPost_cart(Request $request)
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
		    $user =Auth::user();
		    $remember = $request->has('remember') ? true : false; 
		    
		    if(!empty(Cookie::get('reeeee') ))
		    {
				$allcokketdata = decrypt(Cookie::get('reeeee'));
				$alldata = explode('|',$allcokketdata);
				Auth::loginUsingId($alldata[0], $remember = true);
				
			}
			
			 if($request->has('remember'))
			 {
			  $this->setRememberMeExpiration($user,$request->input('password'));
			 }else{
			   $this->deleteRememberMeExpiration($user,$request->input('password'));
		      }
			/* for cart old session id */
			
            return redirect()->back()->with(['tab_id' => 'pills-PreviousDonor-tab','tab_content_id' => 'pills-PreviousDonor']);
            
        } else {
            return redirect()->back()->with(['tab_id' => 'pills-PreviousDonor-tab','tab_content_id' => 'pills-PreviousDonor','flash_notice' => 'These credentials do not match our records.']); 
        }
    }

    public function logout()
    {
        Auth::logout();
        //Session::flush(); // Clear all session data
        //Session::regenerate(); // Regenerate the session ID
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
    
    public function registerPost_cart(Request $request)
    {
		 
        $request->validate([
            'full_name_register' => 'required|string|max:255',
            'email_register' => 'required|email|unique:tbl_users,email',
            'password_register' => 'required|min:8|confirmed',
        ], [
            'full_name_register.required' => 'The full name field is required.',
            'email_register.required' => 'The email field is required.',
            'email_register.email' => 'Please enter a valid email address.',
            'email_register.unique' => 'This email address is already registered.',
            'password_register.required' => 'The password field is required.',
            'password_register.min' => 'The password must be at least 8 characters.',
            'password_register.confirmed' => 'The password confirmation does not match.',
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
        $user->full_name = $request->input('full_name_register');
        $user->email = $request->input('email_register');
        $user->password = Hash::make($request->input('password_register'));
        $user->phone = $request->input('phone_register');
        //$user->newsletter = $newsletter;
        $user->save();
        
         $credentials = [
        'username' => $request['email_register'],
        'password' => $request['password_register'],
       ];
      
	     return redirect()->back()->with(['tab_id' => 'pills-PreviousDonor-tab','tab_content_id' => 'pills-PreviousDonor']);
			
		
        // Log in the newly registered user
        //Auth::login($user);

        // Redirect the user to the home page or any other desired page
       
    }
}
