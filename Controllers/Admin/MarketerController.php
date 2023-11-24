<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\MarketerModel;
use App\Models\admin\CountryModel;
use App\Models\admin\marketerlinksModel;


class MarketerController extends Controller
{
   
    public function index(Request $request)
    {
      $nameserch = $request['nameserch'] ?? "";
      $emailserch = $request['emailserch'] ?? "";
      $countryserch = $request['countryserch'] ?? "";
      $datesearch = $request['datesearch'] ?? "";

       if($request->ajax()){
        $datas =MarketerModel::Query();
        if($nameserch !="" ){
          $datas->where('name', 'LIKE', "%$nameserch%")
          ->orWhere('email', 'LIKE', "%$nameserch%")->get();
        }
        if($countryserch !="" ){
          $datas->where('country', 'LIKE', "%$countryserch%")->get();
        }
        if($datesearch !="" ){
          $datas->where('join_date', 'LIKE', "%$datesearch%")->get();
        }
              $marketer =$datas->Paginate(10);
              return view('admin.marketer.data',compact('marketer'));
         
        } 

      $datas =MarketerModel::Query();
     
            $marketer =$datas->Paginate(10);
            $allmerket =  MarketerModel::Paginate(10);
            $countries =  CountryModel::all();

       return view('admin.marketer.index',compact('marketer','allmerket','countries'));

    }

   public function create()
   {
	  $countries =  CountryModel::all();  
     return view('admin.marketer.create',compact('countries'));
   }

   public function store(Request $request)
   {
    $valData =  $request->validate([
        'name' => 'required',
        'email' => 'required',
        'country' => 'required',
        'join_date' => 'required',
    ]);

     $data = new MarketerModel;

     $data->name = $request->input('name');
     $data->email = $request->input('email');
     $data->country = $request->input('country');
     $data->join_date = $request->input('join_date');
     $data->save();
     return redirect()->route('marketer.index')->with('message','Marketer Add Successfully');
   }

   public function show($id)
   { 
     $marketer =  MarketerModel::find($id);
     $link = marketerlinksModel::where('marketer', $id)->get();
     return view('admin.marketer.show',compact('marketer','link'));
   }
 
   public function edit($id)
   {
	 $countries =  CountryModel::all();    
     $marketer =  MarketerModel::find($id);
     return view('admin.marketer.edit',compact('marketer','countries'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'name' => 'required',
        'email' => 'required',
        'country' => 'required',
        'join_date' => 'required',
        
    ]);

     $data = MarketerModel::find($id);

     $data->name = $request->input('name');
     $data->email = $request->input('email');
     $data->country = $request->input('country');
     $data->join_date = $request->input('join_date');
     $data->save();
     return redirect()->route('marketer.index')->with('message','Marketer Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = MarketerModel::find($id);
     $data->delete();
     return redirect()->route('marketer.index')->with('message','Marketer Deleted Successfully');

   }
}