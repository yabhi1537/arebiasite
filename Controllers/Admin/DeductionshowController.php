<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\DeductionshowModel; 
use Illuminate\Support\Facades\File;

class DeductionshowController extends Controller
{
    public function index()
    {
        $data = DeductionshowModel::paginate(5);
        return view('admin.deductionshow.index',compact('data'));
    }
    
    public function show($id)
    {
        $data = DeductionshowModel::find($id);
        return view('admin.deductionshow.show',compact('data'));
    }

    public function edit($id)
    {
        $deductionshow = DeductionshowModel::find($id);
        return view('admin.deductionshow.edit',compact('deductionshow'));
    }

    public function update(Request $request,$id)
    {

        $valData =  $request->validate([
            'title' => 'required',
            'description' => 'required',
            'title_ar' => 'required',
            'description_ar' => 'required',
            
        ]);
       
        $data = DeductionshowModel::find($id);
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            
             $file->move(public_path("uploads/deductiontitleimage"), $filename);
            
            if (File::exists(public_path("uploads/deductiontitleimage/$data->image"))) {
                File::delete(public_path("uploads/deductiontitleimage/$data->image"));
            }      

        }else{
            $filename = $request->input('images');

        }
        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->title_ar = $request->input('title_ar');
        $data->description_ar = $request->input('description_ar');
        $data->image = $filename;

        $data->save();

        return redirect()->route('deductionshow.index')->with('message','Deduction Header Updated Successfully');

    }

}
