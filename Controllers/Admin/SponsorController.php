<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\SponsorModel;
use App\Models\admin\SponsortypModel;
use App\Models\admin\CountryModel;
use App\Models\admin\project_type;
use Illuminate\Support\Facades\DB;
use Optix\Media\HasMedia;

class SponsorController extends Controller
{

    public function index(Request $request)
    {
         
            $namesearch =   $request['namesearch'] ?? "";
            //  $agesearch =   $request['agesearch'] ?? "";
             $citysea =   $request['citysearch'] ?? "";
             $sponty =   $request['spontypsearch'] ?? "";

        if($request->ajax()){

               $alldata = SponsorModel::Query();
            if($namesearch !="" ){
  
              $alldata->where('name', 'LIKE', "%$namesearch%")
                       ->orWhere('age', 'LIKE', "%$namesearch%")->get();
            }
     
            if ($citysea !="" ) {
              $alldata->with('sponsorTyp')->where('country', 'LIKE', "%$citysea%")->get();
            }
            if ($sponty !="" ) {
                $alldata->with('sponsorTyp')->where('type_id', 'LIKE', "%$sponty%")->get();
              }
            
              $data = $alldata->with('sponsorTyp')->Paginate(10);
              return view('admin.sponsor.data',compact('data'));
           
        }  
              $alldata = SponsorModel::Query();
              $data = $alldata->with('sponsorTyp')->Paginate(10);
              $spotyp = SponsorModel::Paginate(5);
              $spontyp = SponsortypModel::all();
              $country = CountryModel::all();
              return view('admin.sponsor.index',compact('data','spotyp','spontyp','country'));
    }

    public function create()
    {
        $sponsortyp = SponsortypModel::all();
        $country = CountryModel::all();
        $projectyp = project_type::all();
        return view('admin.sponsor.create',compact('sponsortyp' ,'country','projectyp'));
    }

    public function store(Request $request)
    {
       
      
        $valData =  $request->validate([

            'name'    => 'required',
            
            'name_ar' => 'required',
            'type_id' => 'required',
            'gender'  => 'required',
            // 'project_price' => 'required',
            'age'     => 'required',
            'country'    => 'required',
            'image'   => 'required',
           
        ]);
        if($request->file('image'))
        { 
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            
            $file->move(public_path("uploads/sponsor/image"), $filename);
        }
        $data = new SponsorModel;
        $data->name = $request->input('name');
       
        $data->name_ar = $request->input('name_ar');
        $data->type_id = $request->input('type_id');
        $data->gender = $request->input('gender');
        // $data->project_price = $request->input('project_price');
        $data->age = $request->input('age');
        $data->country = $request->input('country');
      
        $data->image = $filename;
        $data->save();
         
        return redirect()->route('sponsor.index')->with('message','Sponsor Add Successfully...');
    }

    public function edit($id)
    {
        $sponsortyp = SponsortypModel::all();
        $countryy = CountryModel::all();
        $projectyp = project_type::all();

        $data = SponsorModel::find($id);
        return view('admin.sponsor.edit',compact('data','sponsortyp','countryy','projectyp'));
    }

    public function Show($id)
    {
        $data = SponsorModel::find($id);
        return view('admin.sponsor.show',compact('data'));
    }

    public function update(Request $request , $id)
    { 
        $valData =  $request->validate([
            'name'    => 'required',
           
            'name_ar' => 'required',
            'type_id' => 'required',
            'gender'  => 'required',
            'age'     => 'required',
            'country'    => 'required',
           
        ]);
       
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move(public_path("uploads/sponsor/image"), $filename);    
        } else{

            $filename = $request->input('images');
        }
        $data = SponsorModel::find($id);
        $data->name = $request->input('name');
        
        $data->name_ar = $request->input('name_ar');
        $data->type_id = $request->input('type_id');
        $data->gender = $request->input('gender');
        // $data->project_price = $request->input('project_price');
        $data->age = $request->input('age');
        $data->country = $request->input('country');
        
        $data->image = $filename;
        $data->save();
         
        return redirect()->route('sponsor.index')->with('message','Sponsor Updeted Successfully...');

    }

    public function destroy(Request $request,$id)
    {
      $data = SponsorModel::find($id);
      $data->delete();
      return redirect()->route('sponsor.index')->with('message','Sponsor Deleted Successfully');
 
    }


public function sponserStatus(Request $request)
{

    $user = SponsorModel::find($request->id);
    $user->status = $request->status;
    $user->save();

     return response()->json(['success'=>' Status change successfully.']);

}



}
