<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class HomeController extends Controller
{

    public function index()
    {
			
	     $banners = DB::table('banner')->where('status','=',1)->orderby('position','asc')->get();	
	     $newses =  DB::table('news')->where('published','=',1)->get();	
	     $newprojects =  DB::table('tbl_projects')->where('status','=',0)->where('project_type','!=',9)->get();
	     $needsupportprojects =  DB::table('tbl_projects')->where('project_type','=',8)->get();	
	     $completeprojects =  DB::table('tbl_projects')->where('status','=',1)->get();		
	     $zakatproject =  DB::table('tbl_projects')->where('project_type','=',9)->get()->first();	
	     
	     $totalprojects = DB::table('tbl_projects')->count();
	     $totalusers = DB::table('tbl_users')->count();
	     $totaldonation = DB::table('transaction')->where('payment_status','=','Paid')->sum('donate_amount');
	     $totalmarketer = DB::table('marketer')->count();
	     
	     
	    
		if(app()->getLocale() == 'en'){
         return View::make('en.pages.index', compact('banners','newses','newprojects','needsupportprojects','completeprojects','zakatproject','totalprojects','totalusers','totaldonation','totalmarketer'));
        }else {
        return View::make('ar.pages.index', compact('banners','newses','newprojects','needsupportprojects','completeprojects','zakatproject','totalprojects','totalusers','totaldonation','totalmarketer'));    
	    }
    }
    public function contactus()
    {
	   $contactusheader =  DB::table('contact_show')->get()->first();	    
	   
		if(app()->getLocale() == 'en'){
         return View::make('en.pages.contactUs',compact('contactusheader'));
        }else {
        return View::make('ar.pages.contactUs',compact('contactusheader'));    
	    }	
		
	}
	public function contactuspost(Request $request)
    {
		 
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'phonenumber' => 'required',
            'querie' => 'required',
        ], [
            'fullname.required' => 'The  name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'phonenumber.required' => 'The phone number field is required.',
            'querie.required' => 'The inquiries field is required.',
           
        ]);

        // Create a new user record
         /*insert zakat  data*/
	     $values = array('name' =>$request->fullname,'phone' =>$request->phonenumber,'email' =>$request->email,'quiries' =>$request->querie);
		 DB::table('contact_enquriy')->insert($values);
      
        return redirect()->back()->with(['flash_notice' => 'Your inquirie details added successfully.']); 
    }
}
