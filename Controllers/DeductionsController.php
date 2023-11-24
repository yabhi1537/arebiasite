<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class DeductionsController extends Controller
{

    public function index()
    {
		 $charitydeductionprojects =  DB::table('tbl_projects')->where('project_type','=',7)->get();
		 $deductionsheader =  DB::table('deduction_show')->get()->first();	 
		 
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.deductions',compact('charitydeductionprojects','deductionsheader'));
        }else {
			
        return View::make('ar.pages.deductions',compact('charitydeductionprojects','deductionsheader'));    
	    }
    }
}
