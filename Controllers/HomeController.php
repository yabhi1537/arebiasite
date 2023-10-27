<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class HomeController extends Controller
{

    public function index()
    {
		if(app()->getLocale() == 'en'){
			
	     $banners = DB::table('banner')->where('status','=',1)->get();	
	     $newses = DB::table('news')->where('published','=',1)->get();	
			
         return View::make('en.pages.index', compact('banners','newses'));
        }else {
			
        return View::make('ar.pages.index');    
	    }
    }
}
