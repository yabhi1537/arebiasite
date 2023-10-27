<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CountryModel;
 

class CountryController extends Controller
{
    
    public function index(Request $request)
    {
        $title_ar = $request['title_ar'] ?? "";
        $title = $request['title'] ?? "";
        $country = $request['country'] ?? "";
  
        if($request->ajax()){
          $datas =CountryModel::Query();
          if($title_ar !="" ){
            $datas->where('title_ar', 'LIKE', "%$title_ar%")->get();
          }
          if($title !="" ){
            $datas->where('title', 'LIKE', "%$title%")->get();
          }
          if($country !="" ){
            $datas->where('country', 'LIKE', "%$country%")->get();
          }
                $country =$datas->Paginate(5);
                 $input = '';
                if(!$country->isEmpty()){
                  foreach($country as $new){
                    $input .= '<tr>';
                    $input .= '<td> '. $new->title .' </td>
                    <td>
                    '. $new->country .'
                    </td>
                    <td>
                        <a href="'. route('country.show',$new->id).'"
                            class="fa fa-eye">View</a>
                    </td>
                    <td>
                        <a href="'. route('country.edit',$new->id).'" class="fa fa-edit">Edit</a>
                    </td>
                    <td>
                        <span>
                            <form method="POST" action="'. route('country.destroy',$new->id).'">
                                '.csrf_field().'
                              '. method_field('delete') .' 
                                <button type="submit" class="btn btn-outline-danger  ">delete</button>
                            </form>
                        </span>
                    </td>';
                    $input .= '</tr>';
                  }
               
              } else {
                  $input .= ' <tr> <td colspan="4"> Note : country Is Empty ?.</td></tr>';
              }
              return $input;
          } 
  
  
        $datas =CountryModel::Query();
        if($title_ar !="" ){
          $datas->where('title_ar', 'LIKE', "%$title_ar%")->get();
        }
        if($title !="" ){
          $datas->where('title', 'LIKE', "%$title%")->get();
        }
        if($country !="" ){
          $datas->where('country', 'LIKE', "%$country%")->get();
        }
     
              $country =$datas->Paginate(5);
              $count =  CountryModel::Paginate(5);
 
       return view('admin.country.index',compact('country','count'));
    }

   public function create()
   {
     return view('admin.country.create');
   }

   public function store(Request $request)
   {
    $valData =  $request->validate([
        'title'     => 'required',
        'country'  => 'required',
        'country_ar'     => 'required',
        'title_ar'  => 'required',
        'short_name'  => 'required',
        'latitude'     => 'required',
        'longitude'  => 'required',
    ]);

     $data = new CountryModel;

     $data->title = $request->input('title');
     $data->title_ar = $request->input('title_ar');
     $data->country = $request->input('country');
     $data->country_ar = $request->input('country_ar');
     $data->short_name = $request->input('short_name');
     $data->latitude = $request->input('latitude');
     $data->longitude = $request->input('longitude');
     $data->save();
     return redirect()->route('country.index')->with('message','Country Add Successfully');
   }

   public function show($id)
   {
     $country =  CountryModel::find($id);
     return view('admin.country.show',compact('country'));
   }
 
   public function edit($id)
   {
     $country =  CountryModel::find($id);
     return view('admin.country.edit',compact('country'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'title'     => 'required',
        'country'  => 'required',
        'country_ar'     => 'required',
        'short_name'  => 'required',
        'title_ar'  => 'required',
        'latitude'     => 'required',
        'longitude'  => 'required',
    ]);

     $data = CountryModel::find($id);

     $data->title = $request->input('title');
     $data->title_ar = $request->input('title_ar');
     $data->country = $request->input('country');
     $data->country_ar = $request->input('country_ar');
     $data->short_name = $request->input('short_name');
     $data->latitude = $request->input('latitude');
     $data->longitude = $request->input('longitude');
     $data->save();
     return redirect()->route('country.index')->with('message','Country Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = CountryModel::find($id);
     $data->delete();
     return redirect()->route('country.index')->with('message','Country Deleted Successfully');

   }

   public function CountryStatus(Request $request)
{
    $user = CountryModel::find($request->id);
    $user->status = $request->status;
    $user->save();

     return response()->json(['success'=>' Status Change Successfully.']);

}
}