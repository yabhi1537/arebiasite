<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\MarketerModel;


class MarketerController extends Controller
{
   
    public function index(Request $request)
    {
      $nameserch = $request['nameserch'] ?? "";
      $emailserch = $request['emailserch'] ?? "";
      $countryserch = $request['countryserch'] ?? "";
      $datesearch = $request['datesearch'] ?? "";

       if($request->ajax()){
        $datas =MarketerModel::Query();
        if($nameserch !="" ){
          $datas->where('name', 'LIKE', "%$nameserch%")->get();
        }
        if($emailserch !="" ){
          $datas->where('email', 'LIKE', "%$emailserch%")->get();
        }
        if($countryserch !="" ){
          $datas->where('country', 'LIKE', "%$countryserch%")->get();
        }
        if($datesearch !="" ){
          $datas->where('join_date', 'LIKE', "%$datesearch%")->get();
        }
              $marketer =$datas->Paginate(5);
             $input = '';
              if(!$marketer->isEmpty()){
             
                foreach($marketer as $new){
                  $input .= '<tr>';
                  $input .= '<td>  '. $new->name .'
                  </td>
                  <td>
                      '. $new->email .'
                  </td>
                  <td>
                      '. $new->country .'
                  </td>
                  <td>
                      '. $new->join_date .'
                  </td>
                  <td>
                      <a href="'. route('marketer.show',$new->id).'"
                          class="fa fa-eye">View</a>
                  </td>
                  <td>
                      <a href="'. route('marketer.edit',$new->id).'"
                          class="fa fa-edit">Edit</a>
                  </td>
                  <td>
                      <span>
                          <form method="POST" action="'. route('marketer.destroy',$new->id).'">
                              '.csrf_field().'
                             '. method_field('delete') .'
                              <button type="submit" class="btn btn-outline-danger  ">delete</button>
                          </form>
                      </span>
                  </td>';
                  $input .= '</tr>';
                }
              
            } else {
                $input .= ' <tr> <td colspan="4"> Note : Marketers Is Empty ?.</td></tr>';
            }
            return $input;
        } 

      $datas =MarketerModel::Query();
      if($nameserch !="" ){
        $datas->where('name', 'LIKE', "%$nameserch%")->get();
      }
      if($emailserch !="" ){
        $datas->where('email', 'LIKE', "%$emailserch%")->get();
      }
      if($countryserch !="" ){
        $datas->where('country', 'LIKE', "%$countryserch%")->get();
      }
      if($datesearch !="" ){
        $datas->where('join_date', 'LIKE', "%$datesearch%")->get();
      }
            $marketer =$datas->Paginate(5);
            $allmerket =  MarketerModel::Paginate(5);

       return view('admin.marketer.index',compact('marketer','allmerket'));

    }

   public function create()
   {
     return view('admin.marketer.create');
   }

   public function store(Request $request)
   {
    $valData =  $request->validate([
        'name' => 'required',
        'email' => 'required',
        'country' => 'required',
        'join_date' => 'required',
    ]);

     $data = new MarketerModel;

     $data->name = $request->input('name');
     $data->email = $request->input('email');
     $data->country = $request->input('country');
     $data->join_date = $request->input('join_date');
     $data->save();
     return redirect()->route('marketer.index')->with('message','Marketer Add Successfully');
   }

   public function show($id)
   {
     $marketer =  MarketerModel::find($id);
     return view('admin.marketer.show',compact('marketer'));
   }
 
   public function edit($id)
   {
     $marketer =  MarketerModel::find($id);
     return view('admin.marketer.edit',compact('marketer'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'name' => 'required',
        'email' => 'required',
        'country' => 'required',
        'join_date' => 'required',
        
    ]);

     $data = MarketerModel::find($id);

     $data->name = $request->input('name');
     $data->email = $request->input('email');
     $data->country = $request->input('country');
     $data->join_date = $request->input('join_date');
     $data->save();
     return redirect()->route('marketer.index')->with('message','Marketer Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = MarketerModel::find($id);
     $data->delete();
     return redirect()->route('marketer.index')->with('message','Marketer Deleted Successfully');

   }
}