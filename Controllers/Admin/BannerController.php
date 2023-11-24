<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\BannerModel;
use Illuminate\Support\Facades\File;
use Session;
use Illuminate\Support\Facades\Response;


class BannerController extends Controller 
{
     
    public function index(Request $request)
    {
        $baneserch = $request['banserch'] ?? "";
        $status = $request['status'] ?? "";


        if($request->ajax()){
            $baneser =BannerModel::Query();
            if($baneserch !="" ){
              $baneser->where('title', 'LIKE', "%$baneserch%")->get();
            }
            if($status !="" ){
                $baneser->where('status', 'LIKE', "%$status%")->get();
              }
                  $banner =$baneser->get();
                  return view('admin.banner.data',compact('banner'));
    }   

        $baneser =BannerModel::Query();
        if($baneserch !="" ){
          $baneser->where('title', 'LIKE', "%$baneserch%")->get();
        }
        if($status !="" ){
            $baneser->where('status', 'LIKE', "%$status%")->get();
          }
              $banner =$baneser->get();
              $bann = BannerModel::all();

        return view('admin.banner.index',compact('banner','bann'));
        }

        public function create()
        {
            return view('admin.banner.create');
        }

        public function store(Request $request)
        {
        $valData =  $request->validate([
            'title_ar' => 'required',
            'description_ar' => 'required',
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
            'bannerImg' => 'required|image|mimes: jpeg,png,jpg,gif|max:2048',
            
        ]);
        if($request->file('bannerImg'))
        {
            $file= $request->file('bannerImg');
            $filename= time()."_".$file->getClientOriginalName();
           
             $file->move(public_path("uploads/BannerImg"), $filename);
                   
        }
        $data = new BannerModel;
        $data->title = $request->input('title');
        // $data->status = $request->input('status');
        $data->description = $request->input('description');
        $data->title_ar = $request->input('title_ar');
        $data->description_ar = $request->input('description_ar');
        $data->link = $request->input('link');
        $data->	bannerImg = $filename;

        $data->save();
        return redirect()->route('banner.index')->with('message','Banner Store Successfully');
    }

    public function show($id)
    {
        $data = BannerModel::find($id);
        return view('admin.banner.show',compact('data'));
    }

    public function edit($id)
    {
        $data = BannerModel::find($id);
        return view('admin.banner.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {

        $valData =  $request->validate([
            'title_ar' => 'required',
            'description_ar' => 'required',
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
            
        ]);
      
        $data = BannerModel::find($id);
        if($request->file('bannerImg'))
        {
            $file= $request->file('bannerImg');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/BannerImg"), $filename);
            
            if (File::exists(public_path("uploads/BannerImg/$data->bannerImg"))) {
                File::delete(public_path("uploads/BannerImg/$data->bannerImg"));
            }       

        }else{
            $filename = $request->input('image');
        }
        $data->title = $request->input('title');
        // $data->status = $request->input('status');
        $data->description = $request->input('description');
        $data->title_ar = $request->input('title_ar');
        $data->description_ar = $request->input('description_ar');
        $data->link = $request->input('link');
        $data->	bannerImg = $filename;

        $data->save();

        return redirect()->route('banner.index')->with('message','Banner Updated Successfully');

    }

    public function destroy(Request $request,$id)
    {
        $data = BannerModel::find($id);
        $data ->delete();
        return redirect()->route('banner.index')->with('message','Banner Deleted Successfully');
    }

    public function bannerStatus(Request $request)
{

    $user = BannerModel::find($request->id);
    $user->status = $request->status;
    $user->save();

     return response()->json(['success'=>' Status change successfully.']);

}

public function bannerreposition(Request $request)
{
       $geeks =$request->geeks;
                
            if($geeks)
            {
            for($i=0;$i<count($geeks);$i++)
            {
            $item = BannerModel::find($geeks[$i]);
            $item->position = $i;
            $item->save();
            }
            return response()->json(['success'=>true]);
            }
            else
            {
            return Response::json(array('success' => false));
            }

}


}