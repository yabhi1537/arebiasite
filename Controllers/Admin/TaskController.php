<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\TaskModel;

class TaskController extends Controller
{
   
    public function index(Request $request)
    {
      $taskserch = $request['taskserch'] ?? "";
      $nameserch = $request['nameserch'] ?? "";
      $status = $request['status'] ?? "";
      $datesearch = $request['created_at'] ?? "";

      if($request->ajax()){
        $datas =TaskModel::Query();
        if($taskserch !="" ){
          $datas->where('task_for', 'LIKE', "%$taskserch%")->get();
        }
        if($nameserch !="" ){
          $datas->where('task', 'LIKE', "%$nameserch%")->get();
        }
        if($status !="" ){
          $datas->where('status', 'LIKE', "%$status%")->get();
        }
        if($datesearch !="" ){
          $datas->where('created_at', 'LIKE', "%$datesearch%")->get();
        }
              $task =$datas->Paginate(5);
               $input = '';
              if(!$task->isEmpty()){
                foreach($task as $new){
                  $input .= '<tr>';
                  $input .= '<td> '. $new->task_for .' </td>
                  <td>
                      '. $new->task .'
                  </td>
                  <td>
                  '. $new->description .'
              </td>
              <td>
                  '. $new->created_at .'
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
                      <a href="'. route('task.show',$new->id).'"
                          class="fa fa-eye">View</a>
                  </td>
                  <td>
                      <a href="'. route('task.edit',$new->id).'" class="fa fa-edit">Edit</a>
                  </td>
                  <td>
                      <span>
                          <form method="POST" action="'. route('task.destroy',$new->id).'">
                              '.csrf_field().'
                            '. method_field('delete') .' 
                              <button type="submit" class="btn btn-outline-danger  ">delete</button>
                          </form>
                      </span>
                  </td>';
                  $input .= '</tr>';
                }
             
            } else {
                $input .= ' <tr> <td colspan="4"> Note : Task Is Empty ?.</td></tr>';
            }
            return $input;
        } 


      $datas =TaskModel::Query();
      if($taskserch !="" ){
        $datas->where('task_for', 'LIKE', "%$taskserch%")->get();
      }
      if($nameserch !="" ){
        $datas->where('task', 'LIKE', "%$nameserch%")->get();
      }
      if($status !="" ){
        $datas->where('status', 'LIKE', "%$status%")->get();
      }
      if($datesearch !="" ){
        $datas->where('created_at', 'LIKE', "%$datesearch%")->get();
      }
            $task =$datas->Paginate(5);
            $alltask =  TaskModel::Paginate(5);

       return view('admin.task.index',compact('task','alltask'));

    }

   public function create()
   {
     return view('admin.task.create');
   }

   public function store(Request $request)
   {
    $valData =  $request->validate([
        'task_for'     => 'required',
        'task'         => 'required',
        'task_ar'         => 'required',
        'description_ar'         => 'required',
        'description'  => 'required',
        'status'       => 'required',
    ]);

     $data = new TaskModel;

     $data->task_for = $request->input('task_for');
     $data->task = $request->input('task');
     $data->description = $request->input('description');
     $data->task_ar = $request->input('task_ar');
     $data->description_ar = $request->input('description_ar');
     $data->status = $request->input('status');
     $data->save();
     return redirect()->route('task.index')->with('message','Task Add Successfully');
   }

   public function show($id)
   {
     $task =  TaskModel::find($id);
     return view('admin.task.show',compact('task'));
   }
 
   public function edit($id)
   {
     $task =  TaskModel::find($id);
     return view('admin.task.edit',compact('task'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'task_for'     => 'required',
        'task'         => 'required',
        'task_ar'         => 'required',
        'description_ar'         => 'required',
        'description'  => 'required',
        'status'       => 'required',
    ]);

     $data = TaskModel::find($id);

     $data->task_for = $request->input('task_for');
     $data->task = $request->input('task');
     $data->description = $request->input('description');
     $data->task_ar = $request->input('task_ar');
     $data->description_ar = $request->input('description_ar');
     $data->status = $request->input('status');
     $data->save();
     return redirect()->route('task.index')->with('message','Task Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = TaskModel::find($id);
     $data->delete();
     return redirect()->route('task.index')->with('message','Task Deleted Successfully');

   }

   public function TaskStatus(Request $request)
{

    $user = TaskModel::find($request->id);
    $user->status = $request->status;
    $user->save();

     return response()->json(['success'=>' Status change successfully.']);

}
}