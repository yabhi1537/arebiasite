<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class DedicationsController extends Controller
{

    public function index()
    {
		$dedicationprojects =  DB::table('tbl_projects')->where('project_type','=',13)->get();
		$giftcards =  DB::table('tbl_giftcard')->where('status','=',1)->get();
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.dedications', compact('dedicationprojects','giftcards'));
        }else {
			
        return View::make('ar.pages.dedications', compact('dedicationprojects','giftcards'));    
	    }
    }
    public function giftDonation_preview(Request $request)
    {
		$GiftDonationTemplateId = $request->GiftDonationTemplateId;
		$recipient_name = $request->recipient_name;
		$sender_name = $request->donor_name;
		
		$giftcards =  DB::table('tbl_giftcard')->where('id','=',$GiftDonationTemplateId)->get()->first();
		$image=$giftcards->image;
		
		
		return View::make('en.pages.email.giftpreview', compact('recipient_name','sender_name','image'));
		
		
	}
}
