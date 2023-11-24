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
  
              $continet =$datas->Paginate(10);
              return view('admin.continet.data',compact('continet'));
        } 


      $datas =ContinentModel::Query();
   
   
            $continet =$datas->Paginate(10);
            $connet =  ContinentModel::Paginate(10);

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
