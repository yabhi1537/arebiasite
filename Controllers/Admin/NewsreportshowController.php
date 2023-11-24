<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\NewsreportshowModel; 
use Illuminate\Support\Facades\File;

class NewsreportshowController extends Controller
{
    public function index()
    {
        $data = NewsreportshowModel::paginate(1);
        return view('admin.newsreportshow.index',compact('data'));
    }
    
    public function show($id)
    {
        $data = NewsreportshowModel::find($id);
        return view('admin.newsreportshow.show',compact('data'));
    }

    public function edit($id)
    {
        $newsreportshow = NewsreportshowModel::find($id);
        return view('admin.newsreportshow.edit',compact('newsreportshow'));
    }

    public function update(Request $request,$id)
    {

        $valData =  $request->validate([
            'title' => 'required',
            'description' => 'required',
            'title_ar' => 'required',
            'description_ar' => 'required',
            
        ]);
      
        $data = NewsreportshowModel::find($id);

        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
           
            $file->move(public_path("uploads/newsreporttitleimage"), $filename);

            if (File::exists(public_path("uploads/newsreporttitleimage/$data->image"))) {
                File::delete(public_path("uploads/newsreporttitleimage/$data->image"));
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

        return redirect()->route('newsreportshow.index')->with('message','News Report Header Updated Successfully');

    }

}
