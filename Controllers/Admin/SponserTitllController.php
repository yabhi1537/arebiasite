<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\SponserModel;

class SponserTitllController extends Controller
{
   
    public function index(Request $request)
    {
        $namesearch = $request['namesearch'] ?? "";

        if($request->ajax()){
            $baneser =SponserModel::Query();
            if($namesearch !="" ){
              $baneser->where('title', 'LIKE', "%$namesearch%")->get();
            }
                  $data =$baneser->Paginate(5);
                  return view('admin.sponsortitle.data',compact('data'));
               
            }
        $baneser =SponserModel::Query();
        if($namesearch !="" ){
          $baneser->where('title', 'LIKE', "%$namesearch%")->get();
        }
              $data =$baneser->Paginate(5);
              $sponsortitle = SponserModel::all();

        return view('admin.sponsortitle.index',compact('sponsortitle','data'));
        }

        public function create()
        {
            return view('admin.sponsortitle.create');
        }

        public function store(Request $request)
        {
        $valData =  $request->validate([
            'title' => 'required',
            'description' => 'required',
            'title_ar' => 'required',
            'description_ar' => 'required',
            'image' => 'required|image|mimes: jpeg,png,jpg,gif|max:2048',
            
        ]);
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            
            $file->move(public_path("uploads/sponsortitleimage"), $filename);
        }
        $data = new SponserModel;
        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->title_ar = $request->input('title_ar');
        $data->description_ar = $request->input('description_ar');
        $data->	image = $filename;

        $data->save();
        return redirect()->route('sponsortitle.index')->with('message','Sponsortitle Store Successfully');
    }

    public function show($id)
    {
        $data = SponserModel::find($id);
        return view('admin.sponsortitle.show',compact('data'));
    }

    public function edit($id)
    {
        $sponsortitle = SponserModel::find($id);
        return view('admin.sponsortitle.edit',compact('sponsortitle'));
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
            
            $file->move(public_path("uploads/sponsortitleimage"), $filename);

        }else{
            $filename = $request->input('images');

        }
        $data = SponserModel::find($id);
        $data->title = $request->input('title');
        $data->description = $request->input('description');
        $data->title_ar = $request->input('title_ar');
        $data->description_ar = $request->input('description_ar');
        $data->image = $filename;

        $data->save();

        return redirect()->route('sponsortitle.index')->with('message','Sponsor Header Updated Successfully');

    }

    public function destroy(Request $request,$id)
    {
        $data = SponserModel::find($id);
        $data ->delete();
        return redirect()->route('sponsortitle.index')->with('message','Sponsortitle Deleted Successfully');
    }


}
