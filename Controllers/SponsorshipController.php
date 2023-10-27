<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class SponsorshipController extends Controller
{

    public function index()
    {
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.sponsorship');
        }else {
			
        return View::make('ar.pages.sponsorship');    
	    }
    }
}
