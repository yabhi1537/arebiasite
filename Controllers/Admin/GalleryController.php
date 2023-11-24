<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\GalleryModel;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
      $type = $request['type'] ?? "";

      if($request->ajax()){
        $datas =GalleryModel::Query();
        if($type !="" ){
          $datas->where('type', 'LIKE', "%$type%")->get();
        }
              $gallery =$datas->Paginate(10);
              return view('admin.gallery.data',compact('gallery'));
           
        } 

      $datas = GalleryModel::Query();
     
            $gallery =  GalleryModel::Paginate(10);

       return view('admin.gallery.index',compact('gallery'));

    }

   public function create()
   {
     return view('admin.gallery.create');
   }

   public function store(Request $request)
   {
    $valData =  $request->validate([
        'title'     => 'required',
        'title_ar'     => 'required',
        'type'    => 'required',
        'video_image'  => 'required|mimes:jpeg,png,jpg,pdf',
  
    ]);
    if($request->type == '1' ||  $request->type == '3')
    {
     
        if($request->file('video_image'))
        {
         
            $file= $request->file('video_image');
            $filename= time()."_".$file->getClientOriginalName();
          
            $file->move(public_path("uploads/gallery/video_image"), $filename);
        } 
    }
    else{

        $filename= $request->input('video_image');
    }

     $data = new GalleryModel;

     $data->title = $request->input('title');
     $data->title_ar = $request->input('title_ar');
     $data->type = $request->input('type');
     $data->video_image = $filename;
     $data->save();
     return redirect()->route('gallery.index')->with('message','Gallery Add Successfully');
   }

   public function show($id)
   {
     $gallery =  GalleryModel::find($id);
     return view('admin.gallery.show',compact('gallery'));
   }
 
   public function edit($id)
   {
     $gallery =  GalleryModel::find($id);
     return view('admin.gallery.edit',compact('gallery'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
         'title'     => 'required',
         'title_ar'     => 'required',
         'type'    => 'required',
        
  
    ]);

   

     $data = GalleryModel::find($id);

     if($request->type == '1' ||  $request->type == '3')
     {
         if($request->file('video_image'))
         {
             $file= $request->file('video_image');
             $filename= time()."_".$file->getClientOriginalName();
             
             $file->move(public_path("uploads/gallery/video_image"), $filename);
             if (File::exists(public_path("uploads/gallery/video_image/$data->video_image"))) {
               File::delete(public_path("uploads/gallery/video_image/$data->video_image"));
           }          
         } else{
        
            $filename = $request->input('video_images');
         }
     }
     else{
     
         $filename = $request->input('video_imaged');
         $filename = $request->input('video_image');
     }

          $data->title = $request->input('title');
          $data->title_ar = $request->input('title_ar');
          $data->type = $request->input('type');
          $data->video_image = $filename;
          $data->save();
          return redirect()->route('gallery.index')->with('message','Gallery Updated Successfully');
        }

   public function destroy(Request $request,$id)
   {
      $data = GalleryModel::find($id);
      $data->delete();
      return redirect()->route('gallery.index')->with('message','Gallery Deleted Successfully');

   }

}
