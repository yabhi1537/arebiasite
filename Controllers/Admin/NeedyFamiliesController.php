<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\NeedyFamiliesModel;

class NeedyFamiliesController extends Controller
{
     public function index(Request $request)
     {
        $donor_name = $request['donor_name'] ?? "";
        $donor_phone = $request['donor_phone'] ?? "";
        $donor_email = $request['donor_email'] ?? "";
       
        if($request->ajax()){
          $datas = NeedyFamiliesModel::Query();
          if($donor_name !="" ){
            $datas->where('donor_name', 'LIKE', "%$donor_name%")->get();
          }
          if($donor_phone !="" ){
            $datas->where('donor_phone', 'LIKE', "%$donor_phone%")->get();
          }
          if($donor_email !="" ){
            $datas->where('donor_email', 'LIKE', "%$donor_email%")->get();
          }
                $projectre = $datas->Paginate(5);
                 $input = '';
                if(!$projectre->isEmpty()){
                  foreach($projectre as $new){
                    $input .= '<tr>';
                    $input .= '<td> '. $new->donor_name .' </td>
                    <td>
                        '. $new->donor_phone .'
                    </td>
                            <td>
                            '. $new->donor_email .'
                        </td>
                        <td>
                        '. $new->family_count .'
                        </td>
                    <td>
                    '. $new->state .'
                        </td>
                        <td>
                        '. $new->city .'
                            </td>
                            <td>
                            '. $new->address .'
                                </td>
                        <td class="d-flex justify-content-center">
                        <a href="'. route('needyfamilies.show',$new->needy_id).'"
                            class=""><i class="bi bi-eye-fill f-21" ></i></a>
                
                        <span>
                            <form method="POST" action="'. route('needyfamilies.destroy',$new->needy_id).'">
                                '.csrf_field().'
                              '. method_field('delete') .' 
                              <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                              </form>
                        </span>
                    </td>';
                    $input .= '</tr>';
                  }
               
              } else {
                  $input .= ' <tr> <td colspan="4"> Note : Needy Families Is Empty ?.</td></tr>';
              }
              return $input;
          } 
  
        $datas = NeedyFamiliesModel::Query();
        if($donor_name !="" ){
          $datas->where('donor_name', 'LIKE', "%$donor_name%")->get();
        }
        if($donor_phone !="" ){
            $datas->where('donor_phone', 'LIKE', "%$donor_phone%")->get();
          }
          if($donor_email !="" ){
            $datas->where('donor_email', 'LIKE', "%$donor_email%")->get();
          }
                $projectre = $datas->Paginate(5);
                 $needyfamilies = $projectre = NeedyFamiliesModel::Paginate(5);

       return view('admin.needyfamilies.index',compact('needyfamilies'));

     }

   public function show($id)
   {
     $needyfamilies =  NeedyFamiliesModel::find($id);
     return view('admin.needyfamilies.show',compact('needyfamilies'));
   }
     
   public function destroy(Request $request,$id)
   {
     $data = NeedyFamiliesModel::find($id);
     $data->delete();
     return redirect()->route('needyfamilies.index')->with('message','Donor Deleted Successfully');

   }
    
}
