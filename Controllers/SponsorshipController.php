<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class SponsorshipController extends Controller
{

    public function index()
    {
		$sponserships =   DB::table('sponsorship')
		    ->join('sponsorship_type', 'sponsorship.type_id', '=', 'sponsorship_type.type_id')
            ->where('sponsorship.status','=',1)
            ->select('sponsorship.*', 'sponsorship_type.sponser_type', 'sponsorship_type.sponser_type_ar')
            ->get();
            
        $sponsershipsheader =  DB::table('sponsor_show')->get()->first();	    
		
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.sponsorship',compact('sponserships','sponsershipsheader'));
        }else {
			
        return View::make('ar.pages.sponsorship',compact('sponserships','sponsershipsheader'));    
	    }
    }
}
