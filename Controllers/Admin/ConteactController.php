<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ConteactModel;
use Illuminate\Support\Facades\File;

class ConteactController extends Controller
{
    public function index(Request $request)
    {
          if($request){
            $contect = $request->input('email');
            $phone = $request->input('phone');
            $city = $request->input('city');
            $country = $request->input('country');
            
            $datas = ConteactModel::query();

            if($contect !=''){
                $datas->where('email', 'LIKE', "%$contect%");
            }
            if($phone !=''){
                $datas->where('phone', 'LIKE', "%$phone%");
            }
            if($city !=''){
                $datas->where('city', 'LIKE', "%$city%");
            }
            if($country !=''){
                $datas->where('country', 'LIKE', "%$country%");
            }

          }
          $data = $datas->paginate(5);
          $Alldata = ConteactModel::all();

       return view('admin.contactdetails.index',compact('data','Alldata'));
    }

    public function create()
    {
        return view('admin.contactdetails.create');
    }

    // public function store(Request $request)
    // {
    //     $valData =  $request->validate([

    //         'address_ar' => 'required',
    //         'city_ar' => 'required',
    //         'country_ar' => 'required',
    //         'email' => 'required',
    //         'phone' => 'required',
    //         'address' => 'required',
    //         'city' => 'required',
    //         'country' => 'required',
    //         'pincode' => 'required',
    //         'logo' => 'required',

    //     ]);  

    //     if($request->file('logo'))
    //     {
    //         $file= $request->file('logo');
    //         $filename= time()."_".$file->getClientOriginalName();
 
    //         $file->move('uploads\contact\logo', $filename, 'public');            
    //     }
          
    //     $data = new ConteactModel;
    //     $data->address_ar = $request->input('address_ar');
    //     $data->city_ar = $request->input('city_ar');
    //     $data->country_ar = $request->input('country_ar');
    //     $data->email = $request->input('email');
    //     $data->phone = $request->input('phone');
    //     $data->address = $request->input('address');
    //     $data->city = $request->input('city');
    //     $data->country = $request->input('country');
    //     $data->pincode = $request->input('pincode');
    //     $data->logo = $filename;
    //     $data->save();
    //     return redirect()->route('contect.index')->with('message','Contect Add Successfully');
    // }

    public function show($id)
    {
        $data = ConteactModel::find($id);
        return view('admin.contactdetails.show',compact('data'));

    }

    public function edit($id)
    {
        $data = ConteactModel::find($id);
        return view('admin.contactdetails.edit',compact('data'));

    }

    public function update(Request $request,$id)
    {
        // dd($request->all());
        $valData =  $request->validate([
            'address_ar' => 'required',
            'city_ar' => 'required',
            'country_ar' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'pincode' => 'required',
            'description' => 'required',
            'description_ar' => 'required',
        ]);
       
        $data = ConteactModel::find($id);

        if($request->file('logo'))
        {
            $file= $request->file('logo');
            $filename= time()."_".$file->getClientOriginalName();
 
            
            $file->move(public_path("uploads/contact/logo"), $filename);
            
            if (File::exists(public_path("uploads/contact/logo/$data->logo"))) {
                File::delete(public_path("uploads/contact/logo/$data->logo"));
            }   
        }else{
            $filename = $request->input('logos');

        }
          
        $data->address_ar = $request->input('address_ar');
        $data->city_ar = $request->input('city_ar');
        $data->country_ar = $request->input('country_ar');
        $data->email = $request->input('email');
        $data->phone = $request->input('phone');
        $data->address = $request->input('address');
        $data->city = $request->input('city');
        $data->country = $request->input('country');
        $data->pincode = $request->input('pincode');
        $data->description = $request->input('description');
        $data->description_ar = $request->input('description_ar');
        $data->logo = $filename;
        $data->save();
        return redirect()->route('contect.index')->with('message','Contect Updated Successfully');
    }

    public function destroy(Request $request,$id)
    {
      $data = ConteactModel::find($id);
      $data->delete();
      return redirect()->route('contect.index')->with('message','Contect Deleted Successfully');
 
    }
}