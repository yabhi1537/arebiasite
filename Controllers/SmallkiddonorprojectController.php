<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class SmallkiddonorprojectController extends Controller
{

    public function index()
    {
		 $smallkidsprojects =  DB::table('tbl_projects')->where('project_type','=',11)->get();
		 $smallkiddonorheader =  DB::table('smallkiddonor_show')->get()->first();	
		 
		 
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.smallkiddonor',compact('smallkidsprojects','smallkiddonorheader'));
        }else {
			
        return View::make('ar.pages.smallkiddonor',compact('smallkidsprojects','smallkiddonorheader'));    
	    }
    }
}
