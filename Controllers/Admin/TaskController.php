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
          $datas->where('task_for', '=', "$taskserch")->get();
        }
        if($nameserch !="" ){
          $datas->where('task', 'LIKE', "%$nameserch%")->get();
        }
        if($status !="" ){
          $datas->where('status', 'LIKE', "%$status%")->get();
        }
        if($datesearch !="" ){
          $datas->whereDate('created_at', '=', $datesearch)->get();
        }
              $task =$datas->Paginate(10);
         return view('admin.task.data',compact('task'));
              
        } 

      $datas =TaskModel::Query();
    
            $task =$datas->Paginate(10);
            $alltask =  TaskModel::Paginate(10);

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
        
    ]);

     $data = new TaskModel;

     $data->task_for = $request->input('task_for');
     $data->task = $request->input('task');
     $data->description = $request->input('description');
     $data->task_ar = $request->input('task_ar');
     $data->description_ar = $request->input('description_ar');
    
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
       
    ]);

     $data = TaskModel::find($id);

     $data->task_for = $request->input('task_for');
     $data->task = $request->input('task');
     $data->description = $request->input('description');
     $data->task_ar = $request->input('task_ar');
     $data->description_ar = $request->input('description_ar');
    
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
