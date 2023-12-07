<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\TodoModel;

class TodoController extends Controller 
{
    public function store(Request $request){
            $todo = new TodoModel;
            $todo->todo_name=$request->todo_name;
            $todo->save();
            return redirect()->back();
    }

    public function destroy(Request $request,$id)
    {
      $data = TodoModel::find($id);
      $data->delete();
      return redirect()->back();
 
    }

    public function changeStatusTodo(Request $request)
    {
           
            $reqId = $request->id;
            // $reqstatus = $request->status;
            $todo = TodoModel::where('id', $reqId)->get()->first();
            if($request->status == 1){
                $todo->status = 0; 
            }
            elseif($request->status == 0){
                $todo->status = 1; 
            }
            $todo->save();
   
          return response()->json(['success'=>' Status change successfully.']);
    
    }
    


}
