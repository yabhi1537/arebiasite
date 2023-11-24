<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\AchievementshowModel;
use Illuminate\Support\Facades\File;

class AchievementshowController extends Controller
{
    public function index()
    {
        $data = AchievementshowModel::paginate(1);
        return view('admin.achievementshow.index',compact('data'));
    }
    
    public function show($id)
    {
        $data = AchievementshowModel::find($id);
        return view('admin.achievementshow.show',compact('data'));
    }

    public function edit($id)
    {
        $achievementshow = AchievementshowModel::find($id);
        return view('admin.achievementshow.edit',compact('achievementshow'));
    }

    public function update(Request $request,$id)
    {

        $valData =  $request->validate([
            'title' => 'required',
            'description' => 'required',
            'title_ar' => 'required',
            'description_ar' => 'required',
            
        ]);
     
        $data = AchievementshowModel::find($id);

        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move('uploads\achievementsttitleimage', $filename, 'public');  
            
            if (File::exists(public_path("uploads/achievementsttitleimage/$data->image"))) {
                File::delete(public_path("uploads/achievementsttitleimage/$data->image"));
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

        return redirect()->route('achievementshow.index')->with('message','achievement Header Updated Successfully');

    }

}
