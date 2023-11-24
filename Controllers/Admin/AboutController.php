<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\AboutModel;
use Illuminate\Support\Facades\File; 

class AboutController extends Controller
{
    public function index(Request $request)
    {
       $Allabout =  AboutModel::Paginate(5);
        return view('admin.about.index',compact('Allabout'));
    }
    
  //   public function create()
  //   {
  //     return view('admin.about.create');
  //   }

  //   public function store(Request $request)
  //  {
  //    $valData =  $request->validate([
  //      'title' => 'required',
  //      'description' => 'required',
  //      'image' => 'required',
       
  //  ]);
  //  if($request->file('image'))
  //  {
  //      $file= $request->file('image');
  //      $filename= time()."_".$file->getClientOriginalName();
  //      $file->move('uploads\about\image', $filename, 'public');            
  //  } 


  //    $data = new AboutModel;

  //    $data->title = $request->input('title');
  //    $data->description = $request->input('description');
  //    $data->image =  $filename;
  //    $data->save();
  //    return redirect()->route('about.index')->with('message','About Add Successfully');
  //  }

   public function edit($id)
   {
     $abotEdit =  AboutModel::find($id);
     return view('admin.about.edit',compact('abotEdit'));
   }
   
   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'title_ar' => 'required',
        'description_ar' => 'required',
        'titles_ar' => 'required',
        'vision_ar' => 'required',
        'mission_ar' => 'required',
        'obj_title_ar' => 'required',
        'obj_description_ar' => 'required',
        'title' => 'required',
        'description' => 'required',
        'titles' => 'required',
        'vision' => 'required',
        'mission' => 'required',
        'obj_title' => 'required',
        'obj_description' => 'required',
        
    ]);
    
    
 
      $data = AboutModel::find($id);
      
    if($request->file('image'))
    {
        $file= $request->file('image');
        $filename= time()."_".$file->getClientOriginalName();
       
        $file->move(public_path("uploads/about/image"), $filename);

        if (File::exists(public_path("uploads/about/image/$data->image"))) {
          File::delete(public_path("uploads/about/image/$data->image"));
      }
    } else{

        $filename = $request->input('images');
    }
    if($request->file('photo'))
    {
        $file= $request->file('photo');
        $filenames= time()."_".$file->getClientOriginalName();
        
        $file->move(public_path("uploads/visionmission/photo"), $filename);
        
        if (File::exists(public_path("uploads/visionmission/photo/$data->photo"))) {
          File::delete(public_path("uploads/visionmission/photo/$data->photo"));
      }
    } else{
        $filenames = $request->input('photos');
    }
      $data->title_ar = $request->input('title_ar');
      $data->description_ar = $request->input('description_ar');
      $data->titles_ar = $request->input('titles_ar');
      $data->vision_ar = $request->input('vision_ar');
      $data->mission_ar = $request->input('mission_ar');
      $data->obj_title_ar = $request->input('obj_title_ar');
      $data->obj_description_ar = $request->input('obj_description_ar');
      $data->title = $request->input('title');
      $data->description = $request->input('description');
      $data->titles = $request->input('titles');
      $data->vision = $request->input('vision');
      $data->mission = $request->input('mission');
      $data->obj_title = $request->input('obj_title');
      $data->obj_description = $request->input('obj_description');
      $data->image =  $filename;
      $data->photo =  $filenames;
      $data->save();
      return redirect()->route('about.index')->with('message','About Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = AboutModel::find($id);
     $data->delete();
     return redirect()->route('about.index')->with('message','About Deleted Successfully');

   }
   public function show($id)
   {
     $abotshow =  AboutModel::find($id);
     return view('admin.about.show',compact('abotshow'));
   }
}
