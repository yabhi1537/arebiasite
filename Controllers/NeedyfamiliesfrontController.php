<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;

class NeedyfamiliesfrontController extends Controller
{

    public function index()
    {
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.supportforneedyfamilies');
        }else {
			
        return View::make('ar.pages.supportforneedyfamilies');    
	    }
    }
    public function saveneedy_families(Request $request)
	{
		$request->validate([
            'donor_name' => 'required',
            'donor_phone' => 'required|string',
            'donor_email' => 'required|email',
            'family_count' => 'required',
            'first_attachment' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            
        ], [
            'donor_name.required' => 'The donor name field is required.',
            'donor_phone.required' => 'The donor phone field is required.',
            'donor_email.required' => 'The email field is required.',
            'donor_email.email' => 'Please enter a valid email address.',
            'family_count.required' => 'The  family count field is required.',
            'first_attachment.required' => 'The first attachment field is required.',
            'state.required' => 'The state field is required.',
            'city.required' => 'The city field is required.',
            'address.required' => 'The address field is required.',
           
        ]);

		if($request->file('first_attachment'))
		{
		 
			$file= $request->file('first_attachment');
			$filename= time()."_".$file->getClientOriginalName();
			$file->move('uploads\needy_families', $filename, 'public');            
		} 
		else{
			$filename='';
			}
			
		if($request->file('second_attachment'))
		{
		 
			$file= $request->file('second_attachment');
			$filenamesecond= time()."_".$file->getClientOriginalName();
			$file->move('uploads\needy_families', $filename, 'public');            
		} 
		else{
			$filenamesecond='';
			}

		$insert_id = DB::table('tbl_needy_families')->insert([
			        'donor_name'=> $request->donor_name ,
			        'donor_phone'=> $request->donor_phone ,
			        'donor_email'=> $request->donor_email ,
			        'family_count'=> $request->family_count ,
			        'first_attachment'=> $filename ,
			        'second_attachment'=> $filenamesecond ,
			        'state'=> $request->state ,
			        'city'=> $request->city ,
			        'address'=> $request->address ,
			        
	
		  ]);
		 return redirect()->back()->with(['flash_notice' => 'Your request added successfully.']); 
	 }
	
}
