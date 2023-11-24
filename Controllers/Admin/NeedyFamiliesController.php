<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\NeedyFamiliesModel;

class NeedyFamiliesController extends Controller
{
     public function index(Request $request)
     {
        $donor_name = $request['donor_name'] ?? "";
        $donor_phone = $request['donor_phone'] ?? "";
        $donor_email = $request['donor_email'] ?? "";
       
        if($request->ajax()){
          $datas = NeedyFamiliesModel::Query();
          if($donor_name !="" ){
            $datas->where('donor_name', 'LIKE', "%$donor_name%")
            ->orWhere('donor_phone', 'LIKE', "%$donor_name%")
            ->orWhere('donor_email', 'LIKE', "%$donor_name%")->get();
          }

                $needyfamilies = $datas->Paginate(10);
                return view('admin.needyfamilies.data',compact('needyfamilies'));
          } 
  
        $datas = NeedyFamiliesModel::Query();
       
       
           $projectre = $datas->Paginate(10);
           $needyfamilies = $projectre = NeedyFamiliesModel::Paginate(5);

       return view('admin.needyfamilies.index',compact('needyfamilies'));

     }

   public function show($id)
   {
     $needyfamilies =  NeedyFamiliesModel::find($id);
     return view('admin.needyfamilies.show',compact('needyfamilies'));
   }
     
   public function destroy(Request $request,$id)
   {
     $data = NeedyFamiliesModel::find($id);
     $data->delete();
     return redirect()->route('needyfamilies.index')->with('message','Donor Deleted Successfully');

   }
    
}
