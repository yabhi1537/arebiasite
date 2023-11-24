<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\MemberOfBoardModel;
use Illuminate\Support\Facades\File;

class MemberOfBoardController extends Controller
{
    
    public function index(Request $request)
    {
      $nameserch = $request['nameserch'] ?? "";
      $desicserch = $request['desicserch'] ?? "";


      if($request->ajax()){

        $datas =MemberOfBoardModel::Query();
        if($nameserch !="" ){
          $datas->where('name', 'LIKE', "%$nameserch%")->get();
        }
        if($desicserch !="" ){
          $datas->where('designation', 'LIKE', "%$desicserch%")->get();
        }
              $memberboard =$datas->Paginate(10);
              return view('admin.memberboard.data',compact('memberboard'));
     }
      $datas =MemberOfBoardModel::Query();
     
            $memberboard =$datas->Paginate(5);
            $allmemard =  MemberOfBoardModel::Paginate(10);

       return view('admin.memberboard.index',compact('memberboard','allmemard'));

    }

   public function create()
   {
     return view('admin.memberboard.create');
   }

   public function store(Request $request)
   {
     $valData =  $request->validate([
       'name' => 'required',
       'designation' => 'required',
       'name_ar' => 'required',
       'designation_ar' => 'required',
        //    'title' => 'required',
       'image' => 'required',
       
   ]);
   if($request->file('image'))
   {
       $file= $request->file('image');
       $filename= time()."_".$file->getClientOriginalName();
      
       $file->move(public_path("uploads/memberboard/image"), $filename);
   } 

     $data = new MemberOfBoardModel;

     $data->name = $request->input('name');
     $data->designation = $request->input('designation');
     $data->name_ar = $request->input('name_ar');
     $data->designation_ar = $request->input('designation_ar');
      //  $data->title = $request->input('title');
     $data->image =  $filename;
     $data->save();
     return redirect()->route('memberboard.index')->with('message','Member&board Add Successfully');
   }

   public function show($id)
   {
     $memberboard =  MemberOfBoardModel::find($id);
     return view('admin.memberboard.show',compact('memberboard'));
   }
 
   public function edit($id)
   {
     $memberboard =  MemberOfBoardModel::find($id);
     return view('admin.memberboard.edit',compact('memberboard'));
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

     $data = MemberOfBoardModel::find($id);

   if($request->file('image'))
   {
       $file= $request->file('image');
       $filename= time()."_".$file->getClientOriginalName();
       $file->move(public_path("uploads/memberboard/image"), $filename);

       if (File::exists(public_path("uploads/memberboard/image/$data->image"))) {
        File::delete(public_path("uploads/memberboard/image/$data->image"));
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
     return redirect()->route('memberboard.index')->with('message','Member&board Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = MemberOfBoardModel::find($id);
     $data->delete();
     return redirect()->route('memberboard.index')->with('message','Member&board Deleted Successfully');

   }
    
}
