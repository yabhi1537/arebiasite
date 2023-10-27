<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class DedicationsController extends Controller
{

    public function index()
    {
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.dedications');
        }else {
			
        return View::make('ar.pages.dedications');    
	    }
    }
}
