<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\UserModel;

class UserController extends Controller
{
    public function index(Request $request)
    {
      
      $username =   $request['username'] ?? "";
      $useremai =   $request['useremail'] ?? "";
      $userphon =   $request['userphone'] ?? "";

      if($request->ajax()){
        $user=UserModel::Query();
        if($username !="" ){
         
          $user->where('full_name', 'LIKE', "%$username%")->get();
        }
        if ($useremai !="" ) {
        
          $user->where('email', '=', "$useremai")->get();
        }
        if ($userphon !="" ) {
        
          $user->where('phone', '=', "$userphon")->get();
        }
  
              $userss =$user->Paginate(5);
                 $input = '';
              if(!$userss->isEmpty()){
             
                foreach($userss as $usr){
                  $input .= '<tr>';
                $input .= '<td>
                '. $usr->user_id .'
            </td>
            <td>
                '. $usr->	full_name .'
            </td>
            <td>
                '. $usr->	email .'
            </td>
            <td>
                '. $usr->	phone .'
            </td>
            <td>
            '. $usr->	created_at .'
          </td>
            <td>';
                if ($usr->newsletter == 1){
                $input .= '<span style="color: green;">Yes</span>';
                 } else{
                $input .= '<span style="color: red;">No</span>';
                }
                $input .= '</td>
            <td class="text-center">';
                if($usr->status =='0'){
                $input .= '<span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
                    onclick="changeStatus('. $usr->user_id .',1)">Deactive</span>';

                }else{
                if($usr->status =='1')
                $input .= '<span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                    onclick="changeStatus('. $usr->user_id .',0 )">Active</span>';
                }

                $input .= '</td>
          
            <td>
                <a href="'. route('user.show',$usr->user_id).'"
                    class="fa fa-eye">View</a>
            </td>
            <td>
                <a href="'. route('user.edit',$usr->user_id).'"
                    class="fa fa-edit">Edit</a>
            </td>
            <td>
                <span>
                    <form method="POST" action="'. route('user.destroy',$usr->user_id).'">
                        '. csrf_field().'
                       '. method_field('delete') .'
                        <button type="submit" class="btn btn-outline-danger  ">delete</button>
                    </form>
                </span>
            </td>';
            $input .= '</tr>';
          }
       
      } else {
          $input .= ' <tr> <td colspan="4"> Note : Users Is Empty ?.</td></tr>';
      }
      return $input;
  }  


      $user=UserModel::Query();
      if($username !="" ){
       
        $user->where('full_name', 'LIKE', "%$username%")->get();
      }
      if ($useremai !="" ) {
      
        $user->where('email', '=', "$useremai")->get();
      }
      if ($userphon !="" ) {
      
        $user->where('phone', '=', "$userphon")->get();
      }
            $userss =$user->Paginate(5);
             $userserch =  UserModel::Paginate(5);
        return view('admin.user.index',['userss'=>$userss,'userserch'=>$userserch]);

    }

//    public function create()
//    {
//      return view('admin.user.create');
//    }

//    public function store(Request $request)
//    {
//      $data = new UserModel;

//      $data->type = $request->input('type');
//      $data->save();
//      return redirect()->route('user.index')->with('message','User Add Successfully');
//    }

   public function show($id)
   {
     $user =  UserModel::find($id);
     return view('admin.user.show',compact('user'));
   }

   public function edit($id)
   {
     $userEdit =  UserModel::find($id);
     return view('admin.user.edit',compact('userEdit'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'full_name' => 'required',
        'phone' => 'required',
        'newsletter' => 'required',
        'status' => 'required',
    ]);
     $data = UserModel::find($id);

     $data->full_name = $request->input('full_name');
     $data->phone = $request->input('phone');
     $data->newsletter = $request->input('newsletter');
     $data->status = $request->input('status');
     $data->save();
     return redirect()->route('user.index')->with('message','User Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = UserModel::find($id);
     $data->delete();
     return redirect()->route('user.index')->with('message','User Deleted Successfully');

   }

   public function userStatus(Request $request)
{

    $user = UserModel::find($request->id);
    $user->status = $request->status;
    $user->save();

     return response()->json(['success'=>' Status change successfully.']);

}
}