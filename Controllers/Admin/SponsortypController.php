<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\SponsortypModel;

class SponsortypController extends Controller
{
    
    public function index(Request $request)
    {
        $types = $request['typeserch'] ?? ""; 
          if($request->ajax()){
            $newtyp =SponsortypModel::Query();
            if($types !="" ){
              $newtyp->where('sponser_type', 'LIKE', "%$types%")->get();
            }
            $data =$newtyp->Paginate(10);
            return view('admin.sponsortype.data',compact('data'));
        } 

        $newtyp = SponsortypModel::Query();
        
              $data =$newtyp->Paginate(10);
              $sponser =  SponsortypModel::all();

        return view('admin.sponsortype.index',compact('data','sponser'));
    }

    public function create()
    {
        return view('admin.sponsortype.create');
    }

    public function store(Request $request)
    {
      
        $valData =  $request->validate([
            'sponser_type'    => 'required',
            'sponser_type_ar'    => 'required',
     
            'image'          => 'required',
        ]);

        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            
            
             $file->move(public_path("uploads/sponsortype/image"), $filename);
        }
        $data = new SponsortypModel;
        $data->sponser_type = $request->input('sponser_type');
        $data->sponser_type_ar = $request->input('sponser_type_ar');
        
        $data->image = $filename;
        $data->save();
         
        return redirect()->route('sponsortype.index')->with('message','sponsortype Add Successfully...');
    }

    public function edit($id)
    {
        $data = SponsortypModel::find($id);
        return view('admin.sponsortype.edit',compact('data'));
    }

    public function Show($id)
    {
        $data = SponsortypModel::find($id);
        return view('admin.sponsortype.show',compact('data'));
    }



    public function update(Request $request,$id)
    {
        $valData =  $request->validate([
            'sponser_type'    => 'required',
            'sponser_type_ar'    => 'required',
           
        ]);

        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/sponsortype/image"), $filename);         
        }else{

            $filename = $request->input('images');
        }
        $data = SponsortypModel::find($id);
        $data->sponser_type = $request->input('sponser_type');
        $data->sponser_type_ar = $request->input('sponser_type_ar');
       
        $data->image = $filename;
        $data->save();
         
        return redirect()->route('sponsortype.index')->with('message','sponsortype Updated Successfully...');
    }



    public function destroy(Request $request,$id)
    {
      $data = SponsortypModel::find($id);
      $data->delete();
      return redirect()->route('sponsortype.index')->with('message','sponsortype Deleted Successfully');
 
    }

    public function sponserTypStatus(Request $request)
    {
    
        $user = SponsortypModel::find($request->id);
        $user->status = $request->status;
        $user->save();
    
         return response()->json(['message'=>' Status change successfully.']);
    
    }


}
