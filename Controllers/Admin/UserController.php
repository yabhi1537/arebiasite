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

      if($request->ajax()){
        $user=UserModel::Query();
        if($username !="" ){
         
          $user->where('full_name', 'LIKE', "%$username%")
          ->orWhere('email', '=', "$username")
         ->orWhere('phone', '=', "$username")->get();
        }
              $userss =$user->Paginate(10);
              return view('admin.user.data',['userss'=>$userss]);
  }  


      $user=UserModel::Query();
  
     
            $userss =$user->Paginate(10);
             $userserch =  UserModel::Paginate(10);
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
        
    ]);
     $data = UserModel::find($id);

     $data->full_name = $request->input('full_name');
     $data->phone = $request->input('phone');
     $data->newsletter = $request->input('newsletter');
    
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
