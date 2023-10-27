<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\FounderModel;

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
            $datas->where('designation', 'LIKE', "%$desicserch%")->get();
          }
          $founder =$datas->Paginate(5);
                 $output ='';
          if(!$founder->isEmpty()){
          foreach($founder as $new){
            $output .='<tr>';
            $output .='<td> <img src="'. asset('uploads/founder/image/'.$new->image) .'"
            style="height: 30px;width:30px;">
    </td>
    <td>
        '. $new->name .'
    </td>
    <td>
        '. $new->designation .'
    </td>
    <td>
        '. $new->created_at .'
    </td>
    <td>
        <a href="'. route('founder.show',$new->id).'"
            class="fa fa-eye">View</a>
    </td>
    <td>
        <a href="'. route('founder.edit',$new->id).'"
            class="fa fa-edit">Edit</a>
    </td>
    <td>
        <span>
            <form method="POST" action="'. route('founder.destroy',$new->id).'">
            '.csrf_field('delete') .'
               '. method_field('delete') .' 
                <button type="submit" class="btn btn-outline-danger  ">delete</button>
            </form>
        </span>
      </td>';
    $output .='<tr>';
  }
  } else {
      $output .= ' <tr> <td colspan="4"> Note : Achivments Is Empty ?.</td></tr>';
  }
  return $output;
  }
       
      $datas =FounderModel::Query();
      if($nameserch !="" ){
        $datas->where('name', 'LIKE', "%$nameserch%")->get();
      }
      if($desicserch !="" ){
        $datas->where('designation', 'LIKE', "%$desicserch%")->get();
      }
            $founder =$datas->Paginate(5);
            $allfounder =  FounderModel::Paginate(5);

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
       $file->move('uploads\founder\image', $filename, 'public');            
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

   if($request->file('image'))
   {
       $file= $request->file('image');
       $filename= time()."_".$file->getClientOriginalName();
       $file->move('uploads\founder\image', $filename, 'public');            
   } else{

     $filename = $request->input('images');

 }
     $data = FounderModel::find($id);

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