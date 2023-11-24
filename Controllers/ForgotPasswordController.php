<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
		  if(app()->getLocale() == 'ar'){

          return View('ar.pages.forgetPassword');
        }else {
			
        return View('en.pages.forgetPassword');    
	    }
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:tbl_users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
       if(app()->getLocale() == 'ar'){
          Mail::send('ar.pages.email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
          }else {
			 Mail::send('en.pages.email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });  
			 }
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($local,$token) { 
		  if(app()->getLocale() == 'ar'){ 
             return view('ar.pages.forgetPasswordLink', ['token' => $token]);
            }else {   
			return view('en.pages.forgetPasswordLink', ['token' => $token]);
			 }	
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:tbl_users',
              'password' => 'required|min:8|confirmed',
              'password_confirmation' => 'required'
          ]);
          
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
           
           
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return  redirect()->route('login',app()->getLocale())->with('message', 'Your password has been changed!');
      }
}
