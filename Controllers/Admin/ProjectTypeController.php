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
          $projectype =$projecty->Paginate(5);
          
          $output = '';
          if (!$projectype->isEmpty()) {
              foreach ($projectype as $new) {
                $output .= '<tr>';
                  $output .= '<td>'.$new->id.'
              </td>
              <td>
                  '.$new->type.'
              </td>
              <td>
              '.$new->type_ar.'
            </td>
            <td class="d-flex justify-content-center">

                  <a href="'.route('projectype.show',$new->id).'"
                      class=""><i class="bi bi-eye-fill f-21" ></i></a>
         
                  <a href="'.route('projectype.edit',$new->id).'"
                      class=""><i class="bi bi-pencil-square f-21"></i></a>
          
                  <span>
                      <form method="POST" action="'.route('projectype.destroy',$new->id).'">
                          '.csrf_field().'
                          '.method_field("DELETE").'
                         
                          <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                      </form>
                  </span>
              </td>';
              $output .= '</tr>';
              }
              
          } else {
              $output .= ' <tr> <td colspan="4"> Note : Project Type Is Empty ?.</td></tr>';
          }
          return $output;
      }

      
      $projecty =project_type::Query();
      if($types !="" ){
        $projecty->where('type', 'LIKE', "%$types%")->get();
      }
            $projectype =$projecty->Paginate(5);
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
     return redirect()->route('projectype.index')->with('message','News Type Add Successfully');
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
     return redirect()->route('projectype.index')->with('message','News Type Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = project_type::find($id);
     $data->delete();
     return redirect()->route('projectype.index')->with('message','News Type Deleted Successfully');

   }
}