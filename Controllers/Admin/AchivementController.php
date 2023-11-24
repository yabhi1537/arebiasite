<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\AchivementModel;
use Illuminate\Support\Facades\File; 


class AchivementController extends Controller
{
  
    public function index(Request $request)
    {
      $achivserch = $request['achivserch'] ?? "";
      $achivtitle = $request['achivtitle'] ?? "";

      if($request->ajax()){
        $achivti =AchivementModel::Query();
        // if($achivserch !="" ){
        //   $achivti->where('achivement_type', 'LIKE', "%$achivserch%")->get();
        // }
        if($achivtitle !="" ){
          $achivti->where('title', 'LIKE', "%$achivtitle%")
          ->orWhere('achivement_type', 'LIKE', "%$achivtitle%")->get();
        }
              $achivement =$achivti->Paginate(10);
              return view('admin.achivement.data',compact('achivement'));
              
}

      $achivti =AchivementModel::Query();
      
            $achivement =$achivti->Paginate(10);
            $achivem =  AchivementModel::Paginate(10);

       return view('admin.achivement.index',compact('achivement','achivem'));

    }

   public function create()
   {
     return view('admin.achivement.create');
   }

   public function store(Request $request)
   {
     $valData =  $request->validate([
       'achivement_type' => 'required',
       'title' => 'required',
       'description' => 'required',
       'title_ar' => 'required',
       'description_ar' => 'required',
       'images' => 'required',
       
   ]);
   if($request->file('images'))
   {
       $file= $request->file('images');
       $filename= time()."_".$file->getClientOriginalName();
       
       $file->move(public_path("uploads/achivement/images"), $filename);
   } 


     $data = new AchivementModel;

     $data->achivement_type = $request->input('achivement_type');
     $data->title = $request->input('title');
     $data->description = $request->input('description');
     $data->title_ar = $request->input('title_ar');
     $data->description_ar = $request->input('description_ar');
     $data->images =  $filename;
     $data->save();
     return redirect()->route('achivement.index')->with('message','Achivement Add Successfully');
   }

   public function show($id)
   {
     $ntyp =  AchivementModel::find($id);
     return view('admin.achivement.show',compact('ntyp'));
   }

   public function edit($id)
   {
     $achivement =  AchivementModel::find($id);
     return view('admin.achivement.edit',compact('achivement'));
   }

   public function update(Request $request,$id)
   {
     $valData =  $request->validate([
       'achivement_type' => 'required',
       'title' => 'required',
       'description' => 'required',
       'title_ar' => 'required',
       'description_ar' => 'required',
       
   ]);

     $data = AchivementModel::find($id);

     
   if($request->file('images'))
   {
       $file= $request->file('images');
       $filename= time()."_".$file->getClientOriginalName();
      
       $file->move(public_path("uploads/achivement/images"), $filename);

       if (File::exists(public_path("uploads/achivement/images/$data->images"))) {
        File::delete(public_path("uploads/achivement/images/$data->images"));   
       }         
   } else{

     $filename = $request->input('image');
 }

     $data->achivement_type = $request->input('achivement_type');
     $data->title = $request->input('title');
     $data->description = $request->input('description');
     $data->title_ar = $request->input('title_ar');
     $data->description_ar = $request->input('description_ar');
     $data->images =  $filename;
     $data->save();
     return redirect()->route('achivement.index')->with('message','Achivement Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = AchivementModel::find($id);
     $data->delete();
     return redirect()->route('achivement.index')->with('message','Achivement Deleted Successfully');

   }
}
