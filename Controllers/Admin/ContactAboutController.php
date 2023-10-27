<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ContactAboutModel;

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
            //   $Allabout =  ContactAboutModel::Paginate(5);

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
        
    ]);
    if($request->file('image'))
    {
        $file= $request->file('image');
        $filename= time()."_".$file->getClientOriginalName();
        $file->move('uploads\contacabout\image', $filename, 'public');            
    } else{

        $filename = $request->input('images');
    }
 
 
      $data = ContactAboutModel::find($id);
 
      $data->title = $request->input('title');
      $data->description = $request->input('description');
      $data->image =  $filename;
      $data->save();
      return redirect()->route('contacabout.index')->with('message','Contact Updated Successfully');
   }

    
}
