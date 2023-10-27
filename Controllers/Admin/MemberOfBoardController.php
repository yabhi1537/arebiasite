<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\MemberOfBoardModel;

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
              $memberboard =$datas->Paginate(5);
              $output = '';
                if(!$memberboard->isEmpty()){
                foreach($memberboard as $new){
                  $output .= '<tr>';
                  $output .= '<td>
                  <img src="'. asset('uploads/memberboard/image/'.$new->image) .'"
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
              <a href="'. route('memberboard.show',$new->id).'"
                  class="fa fa-eye">View</a>
          </td>
          <td>
              <a href="'. route('memberboard.edit',$new->id).'"
                  class="fa fa-edit">Edit</a>
          </td>
          <td>
              <span>
                  <form method="POST" action="'. route('memberboard.destroy',$new->id).'">
                      '.csrf_field('delete') .'
                      '. method_field('delete') .'
                      <button type="submit" class="btn btn-outline-danger  ">delete</button>
                  </form>
              </span>
          </td>';
          $output .= '<tr>';
        }
      
      } else {
          $output .= ' <tr> <td colspan="4"> Note : Members Is Empty ?.</td></tr>';
      }
      return $output;
  }
      $datas =MemberOfBoardModel::Query();
      if($nameserch !="" ){
        $datas->where('name', 'LIKE', "%$nameserch%")->get();
      }
      if($desicserch !="" ){
        $datas->where('designation', 'LIKE', "%$desicserch%")->get();
      }
            $memberboard =$datas->Paginate(5);
            $allmemard =  MemberOfBoardModel::Paginate(5);

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
       $file->move('uploads\memberboard\image', $filename, 'public');            
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

   if($request->file('image'))
   {
       $file= $request->file('image');
       $filename= time()."_".$file->getClientOriginalName();
       $file->move('uploads\memberboard\image', $filename, 'public');            
   } else{

     $filename = $request->input('images');

 }
     $data = MemberOfBoardModel::find($id);

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