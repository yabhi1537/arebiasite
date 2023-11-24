<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
class ProjectfrontController extends Controller
{

    public function index(Request $request)
    {
		
		if($request){
			  $project_id =   $request['project_id'] ?? "";
			  $category_id =   $request['category_id'] ?? "";
			  $countryname =   $request['countryname'] ?? "";
			  $searchcost =   $request['searchcost'] ?? "";
			  $typeid =   $request['typeid'] ?? "";
			  $status =   $request['status'] ?? "";
			  $datapagename =   $request['datapagename'] ?? "";

			  if($request->ajax()){
				    if($status == 2)
				    {
					  $query =  DB::table('tbl_projects')->where('project_type','=',$typeid);	
					}
					else{
						$query =  DB::table('tbl_projects')->where('status','=',$status);
						}
					
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
					
					
					if($typeid == 0 && $status == 1)
					{
						$completeprojects= $query->get();
						if(app()->getLocale() == 'en'){
							return View::make('en.pages.data.completeproject_data',compact('completeprojects'));
							}else {
								
							return View::make('ar.pages.data.completeproject_data',compact('completeprojects'));    
							}
				    }
				    else if($typeid == 1)
					{
						$seasonalprojects= $query->get();
						if(app()->getLocale() == 'en'){
							return View::make('en.pages.data.seasonalproject_data',compact('seasonalprojects'));
							}else {
								
							return View::make('ar.pages.data.seasonalproject_data',compact('seasonalprojects'));    
							}
				    }
				    else if($typeid == 2)
					{
						$permanentprojects= $query->get();
						if(app()->getLocale() == 'en'){
							return View::make('en.pages.data.permanentproject_data',compact('permanentprojects'));
							}else {
								
							return View::make('ar.pages.data.permanentproject_data',compact('permanentprojects'));    
							}
				    }
				    else if($typeid == 0 && $status == 0)
					{
						$currentprojects= $query->get();
						if(app()->getLocale() == 'en'){
							return View::make('en.pages.data.currentproject_data',compact('currentprojects'));
							}else {
								
							return View::make('ar.pages.data.currentproject_data',compact('currentprojects'));    
							}
				    }
				    else if($typeid == 4 )
					{
						$constructionprojects= $query->get();
						if(app()->getLocale() == 'en'){
							return View::make('en.pages.data.constructionproject_data',compact('constructionprojects'));
							}else {
								
							return View::make('ar.pages.data.constructionproject_data',compact('constructionprojects'));    
							}
				    }
				    else if($typeid == 5 )
					{
						$developmentalsocialprojects= $query->get();
						if(app()->getLocale() == 'en'){
							return View::make('en.pages.data.developmentalsocialproject_data',compact('developmentalsocialprojects'));
							}else {
								
							return View::make('ar.pages.data.developmentalsocialproject_data',compact('developmentalsocialprojects'));    
							}
				    }
				    else if($typeid == 6 )
					{
						$sacrificeprojects= $query->get();
						if(app()->getLocale() == 'en'){
							return View::make('en.pages.data.sacrificeproject_data',compact('sacrificeprojects'));
							}else {
								
							return View::make('ar.pages.data.sacrificeproject_data',compact('sacrificeprojects'));    
							}
				    }
				    else if($typeid == 7 )
					{
						$charitydeductionprojects= $query->get();
						if(app()->getLocale() == 'en'){
							return View::make('en.pages.data.charitydeductionproject_data',compact('charitydeductionprojects'));
							}else {
								
							return View::make('ar.pages.data.charitydeductionproject_data',compact('charitydeductionprojects'));    
							}
				    }
			   }  
         }
		
	    $completeprojects =  DB::table('tbl_projects')->where('status','=',1)->get();	
	    $seasonalprojects =  DB::table('tbl_projects')->where('project_type','=',1)->get();
	    $permanentprojects =  DB::table('tbl_projects')->where('project_type','=',2)->get();
	    $currentprojects =   DB::table('tbl_projects')->where('status','=',0)->get();
	    $constructionprojects =  DB::table('tbl_projects')->where('project_type','=',4)->get();
	    $developmentalsocialprojects =  DB::table('tbl_projects')->where('project_type','=',5)->get();
	    $sacrificeprojects =  DB::table('tbl_projects')->where('project_type','=',6)->get();
	    $charitydeductionprojects =  DB::table('tbl_projects')->where('project_type','=',7)->get();
	    
	    
	    $countrys =  DB::table('country')->where('status','=',1)->get();
		$categorys =  DB::table('category')->where('status','=',1)->get();
	   
		if(app()->getLocale() == 'en'){
        
        return View::make('en.pages.projects', compact('completeprojects','seasonalprojects','permanentprojects','currentprojects','constructionprojects','developmentalsocialprojects','sacrificeprojects','charitydeductionprojects','countrys','categorys'));
        }else {
			
        return View::make('ar.pages.projects',compact('completeprojects','seasonalprojects','permanentprojects','currentprojects','constructionprojects','developmentalsocialprojects','sacrificeprojects','charitydeductionprojects','countrys','categorys'));    
	    }
    }
}
