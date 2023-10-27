<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\AchivementModel;

class AchivementController extends Controller
{
  
    public function index(Request $request)
    {
      $achivserch = $request['achivserch'] ?? "";
      $achivtitle = $request['achivtitle'] ?? "";

      if($request->ajax()){
        $achivti =AchivementModel::Query();
        if($achivserch !="" ){
          $achivti->where('achivement_type', 'LIKE', "%$achivserch%")->get();
        }
        if($achivtitle !="" ){
          $achivti->where('title', 'LIKE', "%$achivtitle%")->get();
        }
              $achivement =$achivti->Paginate(5);
                  $input = '';
              if(!$achivement->isEmpty()){
                foreach($achivement as $new){
                  $input .= '<tr>';
                  $input .= '<td>
                  <img src="'. asset('uploads/achivement/images/'.$new->images) .'"
                  style="height: 30px;width:30px;">
          </td>
          <td>
              '. $new->achivement_type .'
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
              <a href="'. route('achivement.show',$new->id).'"
                  class="fa fa-eye">View</a>
          </td>
          <td>
              <a href="'. route('achivement.edit',$new->id).'"
                  class="fa fa-edit">Edit</a>
          </td>
          <td>
              <span>
                  <form method="POST" action="'. route('achivement.destroy',$new->id).'">
                      '.csrf_field() .'
                      '. method_field('delete') .'
                      <button type="submit" class="btn btn-outline-danger  ">delete</button>
                  </form>
              </span>
          </td>';
          $input .= '</tr>';
        }
      
    } else {
        $input .= ' <tr> <td colspan="4"> Note : Achivments Is Empty ?.</td></tr>';
    }
    return $input;
}

      $achivti =AchivementModel::Query();
      if($achivserch !="" ){
        $achivti->where('achivement_type', 'LIKE', "%$achivserch%")->get();
      }
      if($achivtitle !="" ){
        $achivti->where('title', 'LIKE', "%$achivtitle%")->get();
      }
            $achivement =$achivti->Paginate(5);
            $achivem =  AchivementModel::Paginate(5);

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
       $file->move('uploads\achivement\images', $filename, 'public');            
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

   if($request->file('images'))
   {
       $file= $request->file('images');
       $filename= time()."_".$file->getClientOriginalName();
       $file->move('uploads\achivement\images', $filename, 'public');            
   } else{

     $filename = $request->input('image');

 }
     $data = AchivementModel::find($id);

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