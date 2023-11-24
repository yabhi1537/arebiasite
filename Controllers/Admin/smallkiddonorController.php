<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\smallkiddonorModel;


class smallkiddonorController extends Controller
{
    public function index()
    {
        $data = smallkiddonorModel::paginate(1);
        return view('admin.smallkiddonor.index',compact('data'));
    }
    
    public function show($id)
    {
        $data = smallkiddonorModel::find($id);
        return view('admin.smallkiddonor.show',compact('data'));
    }

    public function edit($id)
    {
        $smallkiddonor = smallkiddonorModel::find($id);
        return view('admin.smallkiddonor.edit',compact('smallkiddonor'));
    }

    public function update(Request $request,$id)
    {

        $valData =  $request->validate([
            'title' => 'required',
            'description' => 'required',
            'title_ar' => 'required',
            'description_ar' => 'required',
            
        ]);
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
           
            $file->move(public_path("uploads/smallkidtitleimage"), $filename);

        }else{
            $filename = $request->input('images');

        }
        $data = smallkiddonorModel::find($id);
        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->title_ar = $request->input('title_ar');
        $data->description_ar = $request->input('description_ar');
        $data->image = $filename;

        $data->save();

        return redirect()->route('smallkiddonor.index')->with('message','Smallkiddonor Header Updated Successfully');

    }


}
