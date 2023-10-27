<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\GalleryModel;

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
              $galleries =$datas->Paginate(5);
               $input = '';
              if(!$galleries->isEmpty()){
                foreach($galleries as $new){
                  $input .= '<tr>';
                  $input .= '<td> '. $new->title .' </td>
                  <td>
                      '. $new->type .'
                  </td>
                  <td>
                  '. $new->video_image .'
              </td>
                  <td>
                      <a href="'. route('gallery.show',$new->id).'"
                          class="fa fa-eye">View</a>
                  </td>
                  <td>
                      <a href="'. route('gallery.edit',$new->id).'" class="fa fa-edit">Edit</a>
                  </td>
                  <td>
                      <span>
                          <form method="POST" action="'. route('gallery.destroy',$new->id).'">
                              '.csrf_field().'
                            '. method_field('delete') .' 
                              <button type="submit" class="btn btn-outline-danger  ">delete</button>
                          </form>
                      </span>
                  </td>';
                  $input .= '</tr>';
                }
             
            } else {
                $input .= ' <tr> <td colspan="4"> Note : gallery Is Empty ?.</td></tr>';
            }
            return $input;
        } 

      $datas = GalleryModel::Query();
      if($type !="" ){
        $datas->where('type', 'LIKE', "%$type%")->get();
      }
   
            $gallery =  GalleryModel::Paginate(5);

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
        'video_image'  => 'required',
  
    ]);
    if($request->type == '1')
    {
     
        if($request->file('video_image'))
        {
         
            $file= $request->file('video_image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move('uploads\gallery\video_image', $filename, 'public');            
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
    if($request->type == '1')
    {
        if($request->file('video_image'))
        {


            $file= $request->file('video_image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move('uploads\gallery\video_image', $filename, 'public');            
        } else{
       
           $filename = $request->input('video_images');
        }
    }
    else{
    
        $filename = $request->input('video_imaged');
        $filename = $request->input('video_image');
    }

     $data = GalleryModel::find($id);

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