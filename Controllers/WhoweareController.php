<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;

class WhoweareController extends Controller
{

    public function aboutus()
    {
		 $aboutusdata = DB::table('about_us')->get()->first();
		 $founders = DB::table('founder_of_associativ')->get();
		 $memberofboards = DB::table('member_of_board')->get();
		 $achivements = DB::table('achivement')->get();
		 
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.aboutus', compact('aboutusdata','founders','memberofboards','achivements'));
        }else {
			
        return View::make('ar.pages.aboutus', compact('aboutusdata','founders','memberofboards','achivements'));    
	    }
    }
    public function news()
    {
		$projectreportnewss = DB::table('news')->where('newstypeid','=',1)->where('published','=',1)->get(); 
		$generalnewss = DB::table('news')->where('newstypeid','=',2)->where('published','=',1)->get();
		$newsreportheader =  DB::table('newsreport_show')->get()->first();	
		 
		if(app()->getLocale() == 'en'){
 
        return View::make('en.pages.news-reports', compact('projectreportnewss','generalnewss','newsreportheader'));
        }else {
			
        return View::make('ar.pages.news-reports', compact('projectreportnewss','generalnewss','newsreportheader'));    
	    }
    }
    public function achievements()
    {
		$achivements = DB::table('achivement')->get();
		$achievementsheader =  DB::table('achievements_show')->get()->first();	
		
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.achievements',compact('achivements','achievementsheader'));
        }else {
			
        return View::make('ar.pages.achievements',compact('achivements','achievementsheader'));    
	    }
    }
    public function media_gallery()
    {
		$media_images = DB::table('media_gallery')->where('type','=',1)->get(); 
		$media_videos = DB::table('media_gallery')->where('type','=',2)->get();
		$media_pdfs = DB::table('media_gallery')->where('type','=',3)->get();
		
		if(app()->getLocale() == 'en'){
 
        return View::make('en.pages.media-gallery', compact('media_images','media_videos','media_pdfs'));
        }else {
			
        return View::make('ar.pages.media-gallery', compact('media_images','media_videos','media_pdfs'));    
	    }
    }
    public function newsdetails($local,$ID)
    {
		$id = decrypt($ID);
		$news_details =  DB::table('news')->where('newsid','=',$id)->get()->first();
		
		$newss=  DB::table('news')->where('newsid','!=',$id)->orderBy('newsid', 'desc')
->limit(3)->get();
		
		
		if(app()->getLocale() == 'en'){
 
        return View::make('en.pages.news-details', compact('news_details','newss'));
        }else {
			
        return View::make('ar.pages.news-details', compact('news_details','newss'));    
	    }
    }
    public function governance()
    {
		 $governancedata = DB::table('governance')->get()->first();
		 
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.governance', compact('governancedata'));
        }else {
			
        return View::make('ar.pages.governance', compact('governancedata'));    
	    }
    }
    public function faq()
    {
		 $faqprojects = DB::table('tab_faq')->where('type','=','Projects')->get(); 
		 $faqguarantees = DB::table('tab_faq')->where('type','=','Guarantees')->get(); 
		 $faqdedications = DB::table('tab_faq')->where('type','=','Dedications')->get(); 
		 $faqdeductions = DB::table('tab_faq')->where('type','=','Deductions')->get(); 
		 
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.FAQ', compact('faqprojects','faqguarantees','faqdedications','faqdeductions'));
        }else {
			
        return View::make('ar.pages.FAQ', compact('faqprojects','faqguarantees','faqdedications','faqdeductions'));    
	    }
    }
    
}
