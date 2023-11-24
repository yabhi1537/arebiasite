<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\project_type;

class ProjectTypeController extends Controller
{
    public function index(Request $request)
    {

      $types = $request['typeserch'] ?? "";

        if ($request->ajax()) {
          $projecty =project_type::Query();
          if($types !="" ){
            $projecty->where('type', 'LIKE', "%$types%")->get();
          }
          $projectype =$projecty->Paginate(10);
          return view('admin.projectype.data',compact('projectype'));
        
      }

      
      $projecty =project_type::Query();
      
            $projectype =$projecty->Paginate(10);
            $protyp =  project_type::all();

     return view('admin.projectype.index',compact('projectype','protyp'));

    }

   public function create()
   {
     return view('admin.projectype.create');
   }

   public function store(Request $request)
   {
    $valData =  $request->validate([
      'type' => 'required',
      'type_ar' => 'required',
      
  ]);
     $data = new project_type;

     $data->type = $request->input('type');
     $data->type_ar = $request->input('type_ar');
     $data->save();
     return redirect()->route('projectype.index')->with('message','Project Type Add Successfully');
   }

   public function show($id)
   {
     $protyp =  project_type::find($id);
     return view('admin.projectype.show',compact('protyp'));
   }

   public function edit($id)
   {
     $ntyp =  project_type::find($id);
     return view('admin.projectype.edit',compact('ntyp'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
      'type' => 'required',
      'type_ar' => 'required',
      
  ]);
     $data = project_type::find($id);

     $data->type = $request->input('type');
     $data->type_ar = $request->input('type_ar');
     $data->save();
     return redirect()->route('projectype.index')->with('message','Project Type Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = project_type::find($id);
     $data->delete();
     return redirect()->route('projectype.index')->with('message','Project Type Deleted Successfully');

   }
}
