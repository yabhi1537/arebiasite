<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\admin\Admin;

use Session;
 
class ProfileController extends Controller
{
    public function index()
    {
        $adminId = Auth::guard('admin')->user();
        $data = Admin::all();
        return view('admin.adminprofile.profile',compact('adminId','data'));
    }

    public function update(Request $request)
    {
        $valData =  $request->validate([
            'full_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'link' => 'required',
        ]);

        $id= $request->input('admiId');
        $profile = Admin::find($id);
        $profile->full_name = $request->input('full_name');
        $profile->email = $request->input('email');
        $profile->phone = $request->input('phone');
        $profile->address = $request->input('address');
        $profile->link = $request->input('link');
        $profile->save();
        return redirect()->route('profile.index')->with('message','Profile Updated Successfully');

       }

       public function imgupdate(Request $request)
       {
        $valData =  $request->validate([
        // 'profile' => 'required|image|mimes: jpeg,png,jpg,gif|max:2048',
        ]);

     

        $id = $request->input('adminId');
        $profile = Admin::find($id);
        if($request->file('profile'))
        {
            $file= $request->file('profile');
            $filename= time()."_".$file->getClientOriginalName();
            
             $file->move(public_path("uploads/admin/profile"), $filename);
            
            if (File::exists(public_path("uploads/admin/profile/$profile->profile"))) {
                File::delete(public_path("uploads/admin/profile/$profile->profile"));
            }     
        } else{
            $filename = $request->input('images');

        }
        $profile->profile =  $filename;
        $profile->save();
        return redirect()->route('profile.index')->with('message','Profile Updated Successfully');

       }

       public function passupdate(Request $request)
       {

        $id = $request->input('admiId');  
        $admin = Admin::findOrFail($id);
       
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'min:8|different:password',
        ]);
        
        if (Hash::check($request->old_password, $admin->password)) { 
           $admin->fill([
            'password' => Hash::make($request->new_password)
            ])->save();
        
           return redirect()->route('profile.index')->with('message','Password Updated Successfully');
        } else {
            return redirect()->route('profile.index')->with('message','Return error with current passowrd is not match.');
        }

       }

}
