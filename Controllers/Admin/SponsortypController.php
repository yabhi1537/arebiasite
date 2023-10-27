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
            $data =$newtyp->Paginate(5);

            $input = '';
            if(!$data->isEmpty()){
                
               foreach($data as $new){
                $input .= '<tr>';
                $input .= '<td><img src="'. asset('uploads/sponsortype/image/'.$new->image) .'"
                style="height: 30px;width:30px;"></td>
        <td>
            '. $new->sponser_type .'
        </td>
        <td class="text-center">';
            if($new->status =='0'){
            $input .= '<span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
                onclick="changeStatus('. $new->type_id .',1)">Deactive</span>';

            }else if($new->status =='1'){
                $input .= ' <span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                onclick="changeStatus('. $new->type_id .',0 )">Active</span>';
            }

            $input .= '</td>
     
        <td>
            <a href="'. route('sponsortype.show',$new->type_id) .'"
                class="fa fa-eye">Show</a>
        </td>
        <td>
            <a href="'. route('sponsortype.edit',$new->type_id) .'"
                class="fa fa-edit">Edit</a>
        </td>
        <td>
            <span>
                <form method="POST" action="'. route('sponsortype.destroy',$new->	type_id) .'">
                    '.csrf_field().'
                    '. method_field('delete') .'
                    <button type="submit" class="btn btn-outline-danger  ">delete</button>
                </form>
            </span>
        </td>
    </tr>';
    $input .= '</tr>';
        }
        
        } else {
        $input .= ' <tr> <td colspan="4"> Note : Sponsor Type Is Empty ?.</td></tr>';
        }
        return $input;
        } 
        $newtyp =SponsortypModel::Query();
        if($types !="" ){
          $newtyp->where('sponser_type', 'LIKE', "%$types%")->get();
        }
              $data =$newtyp->Paginate(5);
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
            'status'          => 'required',
            'image'          => 'required',
        ]);

        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move('uploads\sponsortype\image', $filename, 'public');            
        }
        $data = new SponsortypModel;
        $data->sponser_type = $request->input('sponser_type');
        $data->sponser_type_ar = $request->input('sponser_type_ar');
        $data->status = $request->input('status');
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
            'status'          => 'required',
        ]);

        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move('uploads\sponsortype\image', $filename, 'public');            
        }else{

            $filename = $request->input('images');
        }
        $data = SponsortypModel::find($id);
        $data->sponser_type = $request->input('sponser_type');
        $data->sponser_type_ar = $request->input('sponser_type_ar');
        $data->status = $request->input('status');
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