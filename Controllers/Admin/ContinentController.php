<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ContinentModel;
 
class ContinentController extends Controller
{
   
    public function index(Request $request)
    {
      $title_ar = $request['title_ar'] ?? "";
      $title = $request['title'] ?? "";
      $status = $request['status'] ?? "";

      if($request->ajax()){
        $datas =ContinentModel::Query();
        if($title_ar !="" ){
          $datas->where('title_ar', 'LIKE', "%$title_ar%")->get();
        }
        if($title !="" ){
          $datas->where('title', 'LIKE', "%$title%")->get();
        }
        if($status !="" ){
          $datas->where('status', 'LIKE', "%$status%")->get();
        }
  
              $continet =$datas->Paginate(5);
               $input = '';
              if(!$continet->isEmpty()){
                foreach($continet as $new){
                  $input .= '<tr>';
                  $input .= '<td> '. $new->title_ar .' </td>
                  <td>
                      '. $new->title .'
                  </td>
                  <td class="text-center">';
                      if($new->status =='0'){
                      $input .= ' <span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
                          onclick="changeStatus('. $new->id .',1)">Deactive</span>';

                       } else if($new->status =='1'){
                      $input .= ' <span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                          onclick="changeStatus('. $new->id .',0 )">Active</span>';
                       }
                       $input .= ' </td>
                  <td>
                      <a href="'. route('continet.show',$new->id).'"
                          class="fa fa-eye">View</a>
                  </td>
                  <td>
                      <a href="'. route('continet.edit',$new->id).'" class="fa fa-edit">Edit</a>
                  </td>
                  <td>
                      <span>
                          <form method="POST" action="'. route('continet.destroy',$new->id).'">
                              '.csrf_field().'
                            '. method_field('delete') .' 
                              <button type="submit" class="btn btn-outline-danger  ">delete</button>
                          </form>
                      </span>
                  </td>';
                  $input .= '</tr>';
                }
             
            } else {
                $input .= ' <tr> <td colspan="4"> Note : Continet Is Empty ?.</td></tr>';
            }
            return $input;
        } 


      $datas =ContinentModel::Query();
      if($title_ar !="" ){
        $datas->where('title_ar', 'LIKE', "%$title_ar%")->get();
      }
      if($title !="" ){
        $datas->where('title', 'LIKE', "%$title%")->get();
      }
      if($status !="" ){
        $datas->where('status', 'LIKE', "%$status%")->get();
      }
   
            $continet =$datas->Paginate(5);
            $connet =  ContinentModel::Paginate(5);

       return view('admin.continet.index',compact('continet','connet'));

    }

   public function create()
   {
     return view('admin.continet.create');
   }

   public function store(Request $request)
   {
    $valData =  $request->validate([
        'title'     => 'required',
        'title_ar'         => 'required',
  
    ]);

     $data = new ContinentModel;

     $data->title = $request->input('title');
     $data->title_ar = $request->input('title_ar');
     $data->save();
     return redirect()->route('continet.index')->with('message','Continet Add Successfully');
   }

   public function show($id)
   {
     $continet =  ContinentModel::find($id);
     return view('admin.continet.show',compact('continet'));
   }
 
   public function edit($id)
   {
     $continet =  ContinentModel::find($id);
     return view('admin.continet.edit',compact('continet'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'title'     => 'required',
        'title_ar'   => 'required',
  
    ]);

     $data = ContinentModel::find($id);

     $data->title = $request->input('title');
     $data->	title_ar = $request->input('title_ar');
     $data->save();
     return redirect()->route('continet.index')->with('message','Continet Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = ContinentModel::find($id);
     $data->delete();
     return redirect()->route('continet.index')->with('message','Continet Deleted Successfully');

   }

   public function ContinentStatus(Request $request)
{

    $user = ContinentModel::find($request->id);
    $user->status = $request->status;
    $user->save();

     return response()->json(['success'=>' Status change successfully.']);

}
}