<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ProjectRequestModel;

class ProjectRequestController extends Controller
{
    public function index(Request $request)
    {
        $donor_name = $request['donor_name'] ?? "";
        $project_name = $request['project_name'] ?? "";
        $phone_number = $request['phone_number'] ?? "";
       
        if($request->ajax()){
          $datas =ProjectRequestModel::Query();
          if($donor_name !="" ){
            $datas->where('donor_name', 'LIKE', "%$donor_name%")->get();
          }
          if($project_name !="" ){
            $datas->where('project_name', 'LIKE', "%$project_name%")->get();
          }
          if($phone_number !="" ){
            $datas->where('phone_number', 'LIKE', "%$phone_number%")->get();
          }
                $projectre =$datas->Paginate(5);
                 $input = '';
                if(!$projectre->isEmpty()){
                  foreach($projectre as $new){
                    $input .= '<tr>';
                    $input .= '<td> '. $new->donor_name .' </td>
                    <td>
                        '. $new->project_name .'
                    </td>
                            <td>
                            '. $new->phone_number .'
                        </td>
                        <td>
                        '. $new->to_amount .'
                        </td>
                    <td>
                    '. $new->from_amount .'
                        </td>
                        <td class="d-flex justify-content-center">
                        <a href="'. route('projectrequest.show',$new->request_id).'"
                            class=""><i class="bi bi-eye-fill f-21" ></i></a>
                
                        <span>
                            <form method="POST" action="'. route('projectrequest.destroy',$new->request_id).'">
                                '.csrf_field().'
                              '. method_field('delete') .' 
                              <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                              </form>
                        </span>
                    </td>';
                    $input .= '</tr>';
                  }
               
              } else {
                  $input .= ' <tr> <td colspan="4"> Note : Project Request Is Empty ?.</td></tr>';
              }
              return $input;
          } 
  
        $datas = ProjectRequestModel::Query();
        if($donor_name !="" ){
          $datas->where('donor_name', 'LIKE', "%$donor_name%")->get();
        }
        if($project_name !="" ){
            $datas->where('project_name', 'LIKE', "%$project_name%")->get();
          }
          if($phone_number !="" ){
            $datas->where('phone_number', 'LIKE', "%$phone_number%")->get();
          }
                $projectre =$datas->Paginate(5);
              $projectrequest = $projectre= ProjectRequestModel::Paginate(5);

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