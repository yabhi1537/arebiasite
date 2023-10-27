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
             $agesearch =   $request['agesearch'] ?? "";
             $citysea =   $request['citysearch'] ?? "";
             $sponty =   $request['spontypsearch'] ?? "";

        if($request->ajax()){

               $alldata = SponsorModel::Query();
            if($namesearch !="" ){
  
              $alldata->where('name', 'LIKE', "%$namesearch%")->get();
            }
            if ($agesearch !="" ) {
              $alldata->where('age', 'LIKE', "%$agesearch%")->get();
            } 
            if ($citysea !="" ) {
              $alldata->with('sponsorTyp')->where('country', 'LIKE', "%$citysea%")->get();
            }
            if ($sponty !="" ) {
                $alldata->with('sponsorTyp')->where('type_id', 'LIKE', "%$sponty%")->get();
              }
            
              $data = $alldata->with('sponsorTyp')->Paginate(5);
                  $input = '';
              if(!$data->isEmpty()){
                foreach($data as $new){
                    $input .= '<tr>';
                    $input .= '<td> <img src="'. asset('uploads/sponsor/image/'.$new->image) .'"
                    style="height: 30px;width:30px;"></td>
            <td> '. $new->name .' </td>
            <td> '. $new->sponsorTyp->sponser_type .' </td>
            <td> '. $new->age .' </td>
            <td> '. $new->country .' </td>
            <td> '. $new->type .' </td>
            <td>';
                if( $new->gender == 1){
                    $input .=  'MaiL';
                } else{
                $input .=  'Femail';
                 }
                 $input .= '</td>';
                 $input .= ' <td class="text-center">';
                 if($new->status =='0'){
                $input .= ' <span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
                    onclick="changeStatus('. $new->id .',1)">Deactive</span>';

                }else if($new->status =='1'){
               $input .= '<span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                    onclick="changeStatus('. $new->id .',0 )">Active</span>';
                }
                $input .= '</td>
           
                <td class="d-flex justify-content-center">
                <a href="'. route('sponsor.show',$new->id) .'"
                    class=""><i class="bi bi-eye-fill f-21"></i></a>
          
                <a href="'. route('sponsor.edit',$new->id) .'"
                    class=""> <i class="bi bi-pencil-square f-21"></i></a>
        
                <span>
                    <form method="POST" action="'. route('sponsor.destroy',$new->id) .'">
                        '.csrf_field().'
                        '. method_field('delete') .'
                        <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                        </form>
                </span>
            </td>';
            $input .= '</tr>';
                }
               
            } else {
                $input .= ' <tr> <td colspan="4"> Note : Category Is Empty ?.</td></tr>';
            }
            return $input;
        }  
            $alldata = SponsorModel::Query();
            if($namesearch !="" ){
  
              $alldata->where('name', 'LIKE', "%$namesearch%")->get();
            }
            if ($agesearch !="" ) {
              $alldata->where('age', 'LIKE', "%$agesearch%")->get();
            } 
            if ($citysea !="" ) {
              $alldata->with('sponsorTyp')->where('country', 'LIKE', "%$citysea%")->get();
            }
            if ($sponty !="" ) {
                $alldata->with('sponsorTyp')->where('type_id', 'LIKE', "%$sponty%")->get();
              }
              $data = $alldata->with('sponsorTyp')->Paginate(5);
              $spotyp = SponsorModel::Paginate(5);
              return view('admin.sponsor.index',compact('data','spotyp'));
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
            'project_types'    => 'required',
            'name_ar' => 'required',
            'type_id' => 'required',
            'gender'  => 'required',
            // 'project_price' => 'required',
            'age'     => 'required',
            'country'    => 'required',
            'image'   => 'required',
            'status'  => 'required',
        ]);
        if($request->file('image'))
        { 
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move('uploads\sponsor\image', $filename, 'public');            
        }
        $data = new SponsorModel;
        $data->name = $request->input('name');
        $data->project_types = $request->input('project_types');
        $data->name_ar = $request->input('name_ar');
        $data->type_id = $request->input('type_id');
        $data->gender = $request->input('gender');
        // $data->project_price = $request->input('project_price');
        $data->age = $request->input('age');
        $data->country = $request->input('country');
        $data->status = $request->input('status');
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
            'project_types'    => 'required',
            'name_ar' => 'required',
            'type_id' => 'required',
            'gender'  => 'required',
            'age'     => 'required',
            'country'    => 'required',
            'status'  => 'required',
        ]);
       
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move('uploads\sponsor\image', $filename, 'public');            
        } else{

            $filename = $request->input('images');
        }
        $data = SponsorModel::find($id);
        $data->name = $request->input('name');
        $data->project_types = $request->input('project_types');
        $data->name_ar = $request->input('name_ar');
        $data->type_id = $request->input('type_id');
        $data->gender = $request->input('gender');
        // $data->project_price = $request->input('project_price');
        $data->age = $request->input('age');
        $data->country = $request->input('country');
        $data->status = $request->input('status');
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