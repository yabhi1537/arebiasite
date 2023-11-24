<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class AwqafController extends Controller
{

    public function index(Request $request)
    {
		 if($request){
			  $project_id =   $request['project_id'] ?? "";
			  $category_id =   $request['category_id'] ?? "";
			  $countryname =   $request['countryname'] ?? "";
			  $searchcost =   $request['searchcost'] ?? "";

			  if($request->ajax()){
					$query =  DB::table('tbl_projects')->where('project_type','=',10);	
					
					if($project_id !="" ){
	  
					  $query->where('project_id', '=', $project_id);
					}
					if ($category_id !="" ) {
					  $query->where('project_category', '=', $category_id);
					} 
					if ($countryname !="" ) {
					  $query->where('project_country', 'LIKE', "%$countryname%");
					}
					if ($searchcost !="" ) {
					  $query->where('project_price', '=', $searchcost);
					}
					$awqafprojects= $query->get();
					
					if(app()->getLocale() == 'en'){
						return View::make('en.pages.awqaf_data',compact('awqafprojects'));
						}else {
							
						return View::make('ar.pages.awqaf_data',compact('awqafprojects'));    
						}
			   }  
         }
		
		$awqafprojects =  DB::table('tbl_projects')->where('project_type','=',10)->get();	
		$countrys =  DB::table('country')->where('status','=',1)->get();
		$categorys =  DB::table('category')->where('status','=',1)->get();
		
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.awqaf',compact('awqafprojects','countrys','categorys'));
        }else {
			
        return View::make('ar.pages.awqaf',compact('awqafprojects','countrys','categorys'));    
	    }
    }
}
