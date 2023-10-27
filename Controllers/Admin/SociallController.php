<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\SociallModel;


class SociallController extends Controller 
{

    public function index(Request $request) 
    {
        if($request){
          $nameserch = $request->input('nameserch');

          if($request->ajax()){

            $sociale = SociallModel::query();
            if($nameserch !=''){
              $sociale->where('name','LIKE', "%$nameserch%")->get();
            }
         
          $social =$sociale->Paginate(5);
          $output = '';
            if(!$social->isEmpty()){
                foreach($social as $new){
                    $output .= '<tr>';
                    $output .= '<td>   '. $new->name .'
                    </td>
                    <td>
                        '. $new->links .'
                    </td>
                    <td class="text-center">';
                        if($new->status =='0'){
                        $output .= '<span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
                            onclick="changeStatus('. $new->id .',1)">Deactive</span>';

                        }else if($new->status =='1'){
                            $output .= '<span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                            onclick="changeStatus('. $new->id .',0 )">Active</span>';
                          }

                          $output .= '</td>

                    <td>
                        '. $new->created_at .'
                    </td>

                    <td>
                        <a href="'. route('social.edit',$new->id) .'"
                            class="fa fa-edit">Edit</a>
                    </td>
                    <td>
                        <span>
                            <form method="POST" action="'. route('social.destroy',$new->id) .'">
                                '.csrf_field() .'
                                '. method_field('delete') .'
                                <button type="submit" class="btn btn-outline-danger  ">delete</button>
                            </form>
                        </span>
                    </td>';
                    $output .= '<tr>';
                }
              
              } else {
                  $output .= ' <tr> <td colspan="4"> Note : Social Links  Is Empty ?.</td></tr>';
              }
              return $output;
          }

          $sociale = SociallModel::query();
          if($nameserch !=''){
            $sociale->where('name','LIKE', "%$nameserch%")->get();
          }

        }
        $social =$sociale->Paginate(5);
         $Allsocial = SociallModel::all();
        return view('admin.sociall.index',compact('social','Allsocial'));

    }
    public function create()
    {
        return view('admin.sociall.create');

    }

    public function store(Request $request)
    {
        $valData =  $request->validate([
            'name' => 'required',
            'links' => 'required',
            'status' => 'required',
            
        ]);
        $data = new SociallModel;
        $data->name = $request->input('name');
        $data->links = $request->input('links');
        $data->status = $request->input('status');
        $data->save();
        return redirect()->route('social.index')->with('message','Links Add Successfully');
    }

    public function edit($id)
    {
        $data = SociallModel::find($id);
        return view('admin.sociall.edit',compact('data'));


    }

    public function update(Request $request,$id)
    {
        $valData =  $request->validate([
            'name' => 'required',
            'links' => 'required',
            'status' => 'required',
            
        ]);
        $data = SociallModel::find($id);
        $data->name = $request->input('name');
        $data->links = $request->input('links');
        $data->status = $request->input('status');
        $data->save();
        return redirect()->route('social.index')->with('message','Links Updated Successfully');
    }



    public function destroy(Request $request,$id)
    {
      $data = SociallModel::find($id);
      $data->delete();
      return redirect()->route('social.index')->with('message','Links Deleted Successfully');
 
    }

    public function socialStatus(Request $request)
    {
    
        $user = SociallModel::find($request->id);
        $user->status = $request->status;
        $user->save();
    
         return response()->json(['success'=>' Status change successfully.']);
    
    }

}