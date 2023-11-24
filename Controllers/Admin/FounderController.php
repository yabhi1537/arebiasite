<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\FounderModel;
use Illuminate\Support\Facades\File;

class FounderController extends Controller
{

    public function index(Request $request)
    {

      $nameserch = $request['nameserch'] ?? "";
      $desicserch = $request['desicserch'] ?? "";

      if($request->ajax()){
          $datas = FounderModel::Query();

          if($nameserch !=""){
            $datas->where('name','LIKE', "%$nameserch%")->get();
          }
          if($desicserch !="" ){
            $datas->where('designation', '=', "$desicserch")->get();
          }
          $founder =$datas->Paginate(10);
          return view('admin.founder.data',compact('founder'));
         
  }
       
      $datas =FounderModel::Query();
      
            $founder =$datas->Paginate(10);
            $allfounder =  FounderModel::Paginate(10);

       return view('admin.founder.index',compact('founder','allfounder'));

    }

   public function create()
   {
     return view('admin.founder.create');
   }

   public function store(Request $request)
   {
     $valData =  $request->validate([
       'name' => 'required',
       'designation' => 'required',
       'name_ar' => 'required',
       'designation_ar' => 'required',
    // 'title' => 'required',
       'image' => 'required',
       
   ]);
   if($request->file('image'))
   {
       $file= $request->file('image');
       $filename= time()."_".$file->getClientOriginalName();
      
         $file->move(public_path("uploads/founder/image"), $filename);
   } 

     $data = new FounderModel;

     $data->name = $request->input('name');
     $data->designation = $request->input('designation');
     $data->name_ar = $request->input('name_ar');
     $data->designation_ar = $request->input('designation_ar');
      //  $data->title = $request->input('title');
     $data->image =  $filename;
     $data->save();
     return redirect()->route('founder.index')->with('message','Founder Add Successfully');
   }

   public function show($id)
   {
     $founder =  FounderModel::find($id);
     return view('admin.founder.show',compact('founder'));
   }

   public function edit($id)
   {
     $founder =  FounderModel::find($id);
     return view('admin.founder.edit',compact('founder'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'name' => 'required',
        'designation' => 'required',
        'name_ar' => 'required',
        'designation_ar' => 'required',
        
         //    'title' => 'required',
        
    ]);

  
     $data = FounderModel::find($id);

     if($request->file('image'))
     {
         $file= $request->file('image');
         $filename= time()."_".$file->getClientOriginalName();
        
         $file->move(public_path("uploads/founder/image"), $filename);
  
         if (File::exists(public_path("uploads/founder/image/$data->image"))) {
          File::delete(public_path("uploads/founder/image/$data->image"));
      }            
     } else{
  
       $filename = $request->input('images');
  
   }

     $data->name = $request->input('name');
     $data->designation = $request->input('designation');
     $data->name_ar = $request->input('name_ar');
     $data->designation_ar = $request->input('designation_ar');
      //  $data->title = $request->input('title');
     $data->image =  $filename;
     $data->save();
     return redirect()->route('founder.index')->with('message','Founder Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = FounderModel::find($id);
     $data->delete();
     return redirect()->route('founder.index')->with('message','Founder Deleted Successfully');

   }
    
}
