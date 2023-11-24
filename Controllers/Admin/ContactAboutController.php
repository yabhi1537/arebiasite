<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ContactAboutModel;
use Illuminate\Support\Facades\File;

class ContactAboutController extends Controller
{
    public function index()
    {
        $titles = $request['titleserch'] ?? "";
        $achivti =ContactAboutModel::Query();
        if($titles !="" ){
          $achivti->where('title', 'LIKE', "%$titles%")->get();
        }
              $contacabout =$achivti->Paginate(5);

        return view('admin.contacabout.index',compact('contacabout'));
    }

    public function edit($id)
    {
      $contacabout =  ContactAboutModel::find($id);
      return view('admin.contacabout.edit',compact('contacabout'));
    }

    
   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'title' => 'required',
        'description' => 'required',
        'title_ar' => 'required',
        'description_ar' => 'required',
        
    ]);
      $data = ContactAboutModel::find($id);
      if($request->file('image'))
    {
        $file= $request->file('image');
        $filename= time()."_".$file->getClientOriginalName();
        $file->move('uploads\contacabout\image', $filename, 'public'); 
        
        if (File::exists(public_path("uploads/contacabout/image/$data->image"))) {
          File::delete(public_path("uploads/contacabout/image/$data->image"));
      }       
    } else{
        $filename = $request->input('images');
    }
 
      $data->title = $request->input('title');
      $data->description = $request->input('description');
      $data->title_ar = $request->input('title_ar');
      $data->description_ar = $request->input('description_ar');
      $data->image =  $filename;
      $data->save();
      return redirect()->route('contacabout.index')->with('message','Contact Header Updated Successfully');
   }
   public function show($id)
    {
      $contacabout =  ContactAboutModel::find($id);
      return view('admin.contacabout.show',compact('contacabout'));
    }
    
}
