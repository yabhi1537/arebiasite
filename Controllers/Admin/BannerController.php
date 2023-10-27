<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\BannerModel;
use Session;

class BannerController extends Controller 
{
    
    public function index(Request $request)
    {
        $baneserch = $request['banserch'] ?? "";


        if($request->ajax()){
            $baneser =BannerModel::Query();
            if($baneserch !="" ){
              $baneser->where('title', 'LIKE', "%$baneserch%")->get();
            }
                  $banner =$baneser->Paginate(5);
                  $input = '';
                  if(!$banner->isEmpty()){
                    foreach($banner as $new){
                        $input .= '<tr>';
                        $input .= '<td> <img src="'. asset('uploads/BannerImg/'.$new->bannerImg) .'"
                        style="height: 30px;width:30px;"></td>
                <td>
                    '. $new->title .'
                </td>
                <td>
                '. $new->description .'
            </td>
                <td class="text-center">';
                    if($new->status =='0'){
                    $input .= ' <span id="bookForm" class="btn btn-danger btn-rounded btn-sm "
                        onclick="changeStatus('. $new->id .',1)">Deactive</span>';

                    }elseif($new->status =='1'){
                    $input .= '<span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                        onclick="changeStatus('. $new->id .',0 )">Active</span>';
                    }

                    $input .= '</td>
            
           
         
                <td>
                    <a href="'. route('banner.show', $new->id) .'"
                        class="fa fa-eye">View</a>
                </td>
                <td>
                    <a href="'. route('banner.edit', $new->id) .'"
                        class="fa fa-edit">Edit</a>
                </td>
                <td>
                    <span>
                        <form method="POST" action="'. route('banner.destroy', $new->id) .'">
                            '.csrf_field().'
                           
                         '. method_field('delete') .' 
                            <button type="submit" class="btn btn-outline-danger  ">delete</button>
                        </form>
                    </span>
                </td>';
                $input .= '</tr>';
            }
        } else {
            $input .= ' <tr> <td colspan="4"> Note : Banners Is Empty ?.</td></tr>';
        }
        return $input;
    }  

        $baneser =BannerModel::Query();
        if($baneserch !="" ){
          $baneser->where('title', 'LIKE', "%$baneserch%")->get();
        }
              $banner =$baneser->Paginate(5);
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
            $file->move('uploads\BannerImg', $filename, 'public');            
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
        if($request->file('bannerImg'))
        {
            $file= $request->file('bannerImg');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move('uploads\BannerImg', $filename, 'public');   

        }else{
            $filename = $request->input('image');

        }
        $data = BannerModel::find($id);
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
}