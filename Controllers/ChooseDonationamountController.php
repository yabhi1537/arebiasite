<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use DB;

class ChooseDonationamountController extends Controller
{

    public function index($local,$ID)
    {
		$loginuser = Auth::user();
		$code =$ID;
		$project_details =  DB::table('tbl_projects')->where('project_code','=',$code)->get()->first();
		
		$allsimilar_projects =  DB::table('tbl_projects')->where('project_type','=',$project_details->project_type)->where('project_code','!=',$code)->get();
		
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.chooseDonationamount', compact('project_details','loginuser','allsimilar_projects'));
        }else {
			
        return View::make('ar.pages.chooseDonationamount',compact('project_details','loginuser','allsimilar_projects'));    
	    }
    }
    function choosecharityDonation($local,$ID)
    {
		$loginuser = Auth::user();
		$code = $ID;
		$project_details =  DB::table('tbl_projects')->where('project_code','=',$code)->get()->first();
		
		$allsimilar_projects =  DB::table('tbl_projects')->where('project_type','=',$project_details->project_type)->where('project_code','!=',$code)->get();
		
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.chooseCharitydonationamount', compact('project_details','loginuser','allsimilar_projects'));
        }else {
			
        return View::make('ar.pages.chooseCharitydonationamount',compact('project_details','loginuser','allsimilar_projects'));    
	    }
		
		
	}
}
