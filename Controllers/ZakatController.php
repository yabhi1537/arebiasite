<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use DB;
class ZakatController extends Controller
{

    public function index()
    {
		$session_id = \Session::getId();
		$allzakatsessiondata =  DB::table('tbl_zakatcalculator')->where('session_id','=',$session_id)->get();
		
		if(app()->getLocale() == 'en'){
			
        return View::make('en.pages.zakat_calculater', compact('allzakatsessiondata'));
        }else {
        return View::make('ar.pages.zakat_calculater', compact('allzakatsessiondata'));    
	    }
    }
    public function zakat_project()
    {
		$loginuser = Auth::user();
		$project_details =  DB::table('tbl_projects')->where('project_type','=',9)->get()->first();
		
		if(app()->getLocale() == 'en'){

        return View::make('en.pages.zakat', compact('project_details','loginuser'));
        }else {
			
        return View::make('ar.pages.zakat',compact('project_details','loginuser'));    
	    }
		
    }
    public function  zakat_calculate(Request $request)
    {
		$session_id = \Session::getId();
		
	    $bool = filter_var($request->IsGold , FILTER_VALIDATE_BOOLEAN);
	    
		if($bool === true  )
		{
			$proid = $request->ZakatTypeId;
			$text =$request->text;
			$value = number_format($request->Value1,2);
			$zakatTypeId =$request->ZakatTypeId;
			$secondTypeId ='';
		}
		else{
		$proid = $request->ZakatTypeId.''.$request->OptionId;
		$text =$request->text;
		$value = number_format((($request->Value1 * 2.5) / 100),2);
		$zakatTypeId =$request->ZakatTypeId;
		$secondTypeId =$request->OptionId;
	    }
		
		$totalcount = DB::table('tbl_zakatcalculator')
			->where('proid', '=', $proid)->where('session_id', '=', $session_id)
			->count();
		if($totalcount  > 0)
		{
			 /*update same id  zakat  data*/
			$alldata = DB::table('tbl_zakatcalculator')
            ->where('proid', $proid)->where('session_id', '=', $session_id)
            ->update(['value' =>$value]);
	    }
	    else{
			 /*insert zakat  data*/
			$values = array('session_id' => $session_id,'proid' =>$proid,'text' => $text,'value' =>$value,'zakatTypeId'=>$zakatTypeId,'secondTypeId'=>$secondTypeId);
			DB::table('tbl_zakatcalculator')->insert($values);
			
			}
        
        /*get total danatione amount data*/
        $totaldonation = DB::table('tbl_zakatcalculator')
			->where('session_id', '=', $session_id)
			->sum('value');
		
		/*send new data add */
		$data =$proid ;
		$result =$value;
		$resultStr =$value.' KD';
		$AllTotal = $totaldonation;
		$TotalZakat =$totaldonation.' KD';
		
	    return response()->json(['data'=>$data,'result'=>$result,'resultStr'=>$resultStr,'TotalZakat'=>$TotalZakat,'AllTotal'=>$AllTotal]);
	   
	}
	public function  zakat_value_delete(Request $request)
    {
		$session_id = \Session::getId();
		$id =$request->id;
		
		DB::table('tbl_zakatcalculator')->where('proid', $id)->where('session_id', $session_id)->delete();
		
		/*get total danatione amount data*/
        $totaldonation = DB::table('tbl_zakatcalculator')
			->where('session_id', '=', $session_id)
			->sum('value');
			
		$AllTotal = $totaldonation;
		$TotalZakat =$totaldonation.' KD';
			
	   return response()->json(['data'=>true,'Total'=>$AllTotal,'TotalZakat'=>$TotalZakat]);
	}
}
