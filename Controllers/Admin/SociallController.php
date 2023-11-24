<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\SociallModel;


class SociallController extends Controller 
{

    public function index(Request $request) 
    {
        if($request){
          $nameserch = $request->input('nameserch');

          if($request->ajax()){

            $sociale = SociallModel::query();
            if($nameserch !=''){
              $sociale->where('name','LIKE', "%$nameserch%")->get();
            }
         
          $social =$sociale->Paginate(10);
          return view('admin.sociall.data',compact('social'));
          }

          $sociale = SociallModel::query();
         
        }
        $social =$sociale->Paginate(10);
         $Allsocial = SociallModel::all();
        return view('admin.sociall.index',compact('social','Allsocial'));

    }
    public function create()
    {
        return view('admin.sociall.create');

    }

    public function store(Request $request)
    {
        $valData =  $request->validate([
            'name' => 'required',
            'links' => 'required',
            'status' => 'required',
            
        ]);
        $data = new SociallModel;
        $data->name = $request->input('name');
        $data->links = $request->input('links');
        $data->status = $request->input('status');
        $data->save();
        return redirect()->route('social.index')->with('message','Links Add Successfully');
    }

    public function edit($id)
    {
        $data = SociallModel::find($id);
        return view('admin.sociall.edit',compact('data'));


    }

    public function update(Request $request,$id)
    {
        $valData =  $request->validate([
            'name' => 'required',
            'links' => 'required',
            'status' => 'required',
            
        ]);
        $data = SociallModel::find($id);
        $data->name = $request->input('name');
        $data->links = $request->input('links');
        $data->status = $request->input('status');
        $data->save();
        return redirect()->route('social.index')->with('message','Links Updated Successfully');
    }



    public function destroy(Request $request,$id)
    {
      $data = SociallModel::find($id);
      $data->delete();
      return redirect()->route('social.index')->with('message','Links Deleted Successfully');
 
    }

    public function socialStatus(Request $request)
    {
    
        $user = SociallModel::find($request->id);
        $user->status = $request->status;
        $user->save();
    
         return response()->json(['success'=>' Status change successfully.']);
    
    }

}
