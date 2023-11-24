<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use Illuminate\Support\Facades\Storage;
class RequestyourprojectController extends Controller
{

    public function index()
    {
		$allprojects =  DB::table('tbl_projects')->get();
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.requestyourproject', compact('allprojects'));
        }else {
			
        return View::make('ar.pages.requestyourproject', compact('allprojects'));    
	    }
    }
    public function saveproject_request(Request $request)
	{
		$request->validate([
            'donor_name' => 'required',
            'project_name' => 'required|string',
            'project_id' => 'required',
            'id_number' => 'required',
            'from_amount' => 'required',
            'to_amount' => 'required',
            'phone_number' => 'required',
            'projectimage' => 'required',
            'segnatureimage' => 'required',
            
        ], [
            'donor_name.required' => 'The donor name field is required.',
            'project_name.required' => 'The project name field is required.',
            'project_id.required' => 'The project id field is required.',
            'id_number.required' => 'The  id field is required.',
            'from_amount.required' => 'The from amount field is required.',
            'to_amount.required' => 'The to amount field is required.',
            'phone_number.required' => 'The phone number field is required.',
            'projectimage.required' => 'The project image field is required.',
            'segnatureimage.required' => 'The signature  field is required.',
        ]);

		if($request->file('projectimage'))
		{
		 
			$file= $request->file('projectimage');
			$filename= time()."_".$file->getClientOriginalName();
			$file->move('uploads\project_request', $filename, 'public');            
		} 

		$insert_id = DB::table('tbl_project_request')->insert([
			        'donor_name'=> $request->donor_name ,
			        'project_name'=> $request->project_name ,
			        'project_id'=> $request->project_id ,
			        'id_number'=> $request->id_number ,
			        'from_amount'=> $request->from_amount ,
			        'to_amount'=> $request->to_amount ,
			        'phone_number'=> $request->phone_number ,
			        'notes'=> $request->notes ,
			        'projectimage'=> $filename ,
			        'segnatureimage'=> $this->base64ToImage($request->segnatureimage) ,
	
		  ]);
		 return redirect()->back()->with(['flash_notice' => 'Your project request added successfully.']); 
	 }
	 private function base64ToImage($base64String)
	 {
		$image = explode('base64,',$base64String);
		$image = end($image);
		$image = str_replace(' ', '+', $image);
		$file = "uploads/signature/" . uniqid() . '.png';

		Storage::disk('public')->put($file,base64_decode($image));
		
		return $file;
	}
}
