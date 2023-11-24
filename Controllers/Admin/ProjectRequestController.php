<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ProjectRequestModel;
use App\Models\admin\tbl_projects;

class ProjectRequestController extends Controller
{
    public function index(Request $request)
    {
        $donor_name = $request['donor_name'] ?? "";
        $project_name = $request['project_name'] ?? "";
       
        if($request->ajax()){
          $datas =ProjectRequestModel::Query();
          if($donor_name !="" ){
            $datas->where('donor_name', 'LIKE', "%$donor_name%")
            ->orWhere('phone_number', 'LIKE', "%$donor_name%")->get();
          }
          if($project_name !="" ){
            $datas->where('project_name', 'LIKE', "%$project_name%")->get();
          }
                $projectrequest =$datas->Paginate(10);
                return view('admin.projectrequest.data',compact('projectrequest'));
          } 
  
        $datas = ProjectRequestModel::Query();
     
        $projectrequest =$datas->Paginate(10);

        return view('admin.projectrequest.index',compact('projectrequest'));
    }

    public function show($id)
    {
      $projectrequest =  ProjectRequestModel::find($id);
      return view('admin.projectrequest.show',compact('projectrequest'));
    }
      
    public function destroy(Request $request,$id)
    {
      $data = ProjectRequestModel::find($id);
      $data->delete();
      return redirect()->route('projectrequest.index')->with('message','Project Request Deleted Successfully');
 
    }
   
}
