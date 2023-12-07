<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(){
  
    $totalproject =DB::table("tbl_projects")
    ->select([DB::raw('extract(year FROM created_date) AS year'),DB::raw('count(`project_id`)  AS totalproject')])
     ->distinct()
    ->groupBy([DB::raw('extract(year FROM created_date)')])
    ->get();

	$totalprojects =DB::table("tbl_projects")
    ->select([DB::raw('count(`project_id`)  AS totalproject')])->count();
    
     $totaldonation =DB::table("transaction")
    ->select([DB::raw('MONTHNAME(created_date) AS month'),DB::raw('sum(`donate_amount`)  AS totaldonation')])
     ->whereYear('created_date', date('Y'))
     ->distinct()
    ->groupBy([DB::raw('MONTHNAME(created_date)')])
    ->orderby('created_date')
    ->get();
    
     $totalusers = DB::table('tbl_users')->where('user_type','=','1')->count();
     $totalmarketer = DB::table('tbl_users')->where('user_type','=','2')->count();
	 $totalmarketers = DB::table('tbl_users')->where('user_type','=','2')->get();

     $totalnewprojects =DB::table("tbl_projects")
    ->select([DB::raw('MONTHNAME(created_date) AS month'),DB::raw('count(`project_id`)  AS totalproject')])
    ->whereYear('created_date', date('Y'))
    ->where('status','=','0')
     ->distinct()
    ->groupBy([DB::raw('MONTHNAME(created_date)')])
    ->orderby('created_date')
    ->get();

	$totalnewproject =DB::table("tbl_projects")
    ->select([DB::raw('count(`project_id`)  AS totalproject')])
    ->where('status','=','0')
    ->count();

	$totalnewprojectshow =DB::table("tbl_projects")
    ->where('status','=','0')
	->orderby('created_date','DESC')
	->take(5)
    ->get();
    
     $totalcompleteprojects =DB::table("tbl_projects")
    ->select([DB::raw('MONTHNAME(created_date) AS month'),DB::raw('count(`project_id`)  AS totalproject')])
    ->whereYear('created_date', date('Y'))
    ->where('status','=','1')
     ->distinct()
    ->groupBy([DB::raw('MONTHNAME(created_date)')])
    ->orderby('created_date')
    ->get();

	$totalcompleteproject =DB::table("tbl_projects")
    ->select([DB::raw('count(`project_id`)  AS totalproject')])
    ->where('status','=','1')
    ->count();

    $todolist = DB::table('todo')->get();

    $transac =DB::table("transaction")
    ->orderby('created_date','DESC')
    ->take(5)
    ->get();

		return view('admin.home.dashboard',compact('transac','totalnewprojectshow','todolist','totalmarketers','totalnewproject','totalcompleteproject',
		'totalprojects','totalproject','totaldonation','totalusers','totalmarketer','totalnewprojects','totalcompleteprojects'));
}
}
