<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\AboutModel;

class AboutController extends Controller
{
    public function index(Request $request)
    {
        $titles = $request['titleserch'] ?? "";

        if($request->ajax()){
          $achivti =AboutModel::Query();
          if($titles !="" ){
            $achivti->where('title', 'LIKE', "%$titles%")->get();
          }
                $about =$achivti->Paginate(5);
                 $input = '';
                if(!$about->isEmpty()){
                  foreach($about as $new){
                  $input .= '<tr>';
                  $input .= '<td> <img src="'. asset('uploads/about/image/'.$new->image) .'"
                  style="height: 30px;width:30px;">
          </td>
          <td>
              '. $new->title .'
          </td>
          <td>
              '. $new->description .'
          </td>
          <td>
              '. $new->created_at .'
          </td>
          <td>
              <a href="'. route('about.edit',$new->id) .'"
                  class="fa fa-edit">Edit</a>
          </td>
          $input .= <tr>';
        }
      
      } else {
          $input .= ' <tr> <td colspan="4"> Note : About Is Empty ?.</td></tr>';
      }
      return $input;
  }
  
        $achivti =AboutModel::Query();
        if($titles !="" ){
          $achivti->where('title', 'LIKE', "%$titles%")->get();
        }
      
              $about =$achivti->Paginate(5);
              $Allabout =  AboutModel::Paginate(5);

        return view('admin.about.index',compact('about','Allabout'));
    }
    public function create()
    {
      return view('admin.about.create');
    }

    public function store(Request $request)
   {
     $valData =  $request->validate([
       'title' => 'required',
       'description' => 'required',
       'image' => 'required',
       
   ]);
   if($request->file('image'))
   {
       $file= $request->file('image');
       $filename= time()."_".$file->getClientOriginalName();
       $file->move('uploads\about\image', $filename, 'public');            
   } 


     $data = new AboutModel;

     $data->title = $request->input('title');
     $data->description = $request->input('description');
     $data->image =  $filename;
     $data->save();
     return redirect()->route('about.index')->with('message','About Add Successfully');
   }

   public function edit($id)
   {
     $abotEdit =  AboutModel::find($id);
     return view('admin.about.edit',compact('abotEdit'));
   }
   
   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'title' => 'required',
        'description' => 'required',
        'titles' => 'required',
        'vision' => 'required',
        'mission' => 'required',
        'obj_title' => 'required',
        'obj_description' => 'required',
        
    ]);
    if($request->file('image'))
    {
        $file= $request->file('image');
        $filename= time()."_".$file->getClientOriginalName();
        $file->move('uploads\about\image', $filename, 'public');            
    } else{

        $filename = $request->input('images');
    }
    
    if($request->file('photo'))
    {
        $file= $request->file('photo');
        $filenames= time()."_".$file->getClientOriginalName();
        $file->move('uploads\visionmission\photo', $filenames, 'public');            
    } else{

        $filenames = $request->input('photos');
    }
 
      $data = AboutModel::find($id);
 
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
}