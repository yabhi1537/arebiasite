<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\admin\CategoryModel;
use App\Models\admin\ContinentModel;
use App\Models\admin\CountryModel; 
use App\Models\admin\project_type;
use App\Models\admin\tbl_projects;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    
    public function index(Request $request) 
    { 
        // dd($request->all());
        $continents =   $request['continent'] ?? "";
        $catese =   $request['catesearch'] ?? "";
        $typesear =   $request['typesearch'] ?? "";
        $name =   $request['pname'] ?? "";
        $country =   $request['country'] ?? "";
       
       if($request->ajax()){

        $projects=tbl_projects::Query(); 
        if($continents !="" ){
          $projects->where('project_continents', 'LIKE', "%$continents%")->get();
        }
        if ($catese !="" ) {
          $projects->with('ProjTyp','ProjCat')->where('project_category', 'LIKE', "%$catese%")->get();
        } 
        if ($typesear !="" ) {
            $projects->with('ProjTyp','ProjCat')->where('project_type', 'LIKE', "%$typesear%")->get();
          } 
        if ($name !="" ) {
            $projects->where('project_name', 'LIKE', "%$name%")->get();
        }
        if ($country !="" ) {
            $projects->where('project_country', 'LIKE', "%$country%")->get();
        }
     
          $project =$projects->with('ProjTyp','ProjCat')->Paginate(3);
          $output ='';
    if(!$project->isEmpty()){
            $output .= '<tr>';
            foreach($project as $new){
                $output .= '<td> <img src="'.asset('uploads/projectimage/'.$new->image).'"
                style="height: 30px;width:30px;"></td>

        <td>'. $new->project_name .'</td>
        <td>'. $new->ProjTyp->type .'</td>
        <td>'. $new->ProjCat->title  .'</td>
        <td>'. $new->project_continents .'</td>
        <td>'. $new->project_country .'</td>
        <td>'. $new->project_price .'</td>

        <td class="text-center">';
            if($new->donationtype_status =='0'){
                $output .= '<span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
                onclick="changeStatus('. $new->project_id .',1)"> Deactive </span>';

            } else if($new->donationtype_status =='1'){
            $output .= '<span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                onclick="changeStatus('. $new->project_id .',0 )">Active</span>';
            }

            $output .= '</td>
            <td class="d-flex justify-content-center">
            <a href="'. route('project.show',$new->project_id) .'"
                class=""><i
                class="bi bi-eye-fill f-21"></i></a>
      
            <a href="'. route('project.edit',$new->project_id) .'"
                class=""><i class="bi bi-pencil-square f-21"></i></a>
    
            <span>
                <form method="POST" action="'. route('project.destroy',$new->project_id) .'">
                    '.csrf_field().'
                  
                    '. method_field('delete') .'
                    
                    <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                </form>
            </span>
        </td>';
        $output .= '</tr>';
        }
            } else {
                $output .= ' <tr> <td colspan="4"> Note : Projects  Is Empty ?.</td></tr>';
            }
            return $output;
    }
  
        $projects=tbl_projects::Query();
        if($continents !="" ){
          $projects->where('project_continents', 'LIKE', "%$continents%")->get();
        }
        if ($catese !="" ) {
          $projects->with('ProjTyp','ProjCat')->where('project_category', 'LIKE', "%$catese%")->get();
        } 
        if ($typesear !="" ) {
            $projects->with('ProjTyp','ProjCat')->where('project_type', 'LIKE', "%$typesear%")->get();
          } 
        if ($name !="" ) {
            $projects->where('project_name', 'LIKE', "%$name%")->get();
        }     
        if ($country !="" ) {
            $projects->where('project_country', 'LIKE', "%$country%")->get();
        }
     
          $project =$projects->with('ProjTyp','ProjCat')->Paginate(3);
          $proserch = tbl_projects::Paginate(3);
       

        return view('admin.projects.index',compact('project','proserch'));
    }

    public function create()
    {
        $Ptype      =   project_type::all();
        $PCategor   =   CategoryModel::all();
        $Pcountry   =   CountryModel::all();
        $Pcontinent =   ContinentModel::all();
        return view('admin.projects.create',compact('Ptype','PCategor','Pcontinent','Pcountry'));
    }

    public function store(Request $request)
    {
        //  dd($request->all());
        $valData =  $request->validate([
            'project_name_ar' => 'required',
            'title' => 'required',
            'title_ar' => 'required',
            'description_ar' => 'required',

            'project_type' => 'required',
            'project_category' => 'required',
            'project_continents' => 'required',
            'project_country' => 'required',
            'project_name' => 'required',
            'project_price' => 'required',
            'target_amount' => 'required',
            'qnty' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'year' => 'required',
            'description' => 'required',
            'main_project' => 'required',
            'target' => 'required',
            'featured' => 'required',
            'short_url' => 'required',
            'image' => 'required|image|mimes: jpeg,png,jpg,gif|max:2048',
        ]);

         $data = new tbl_projects();

         if($request->file('image'))
         {
             $file= $request->file('image');
             $filename= time()."_".$file->getClientOriginalName();
             // dd($filename);
  
             $file->move('uploads\projectimage', $filename, 'public');            
         }
         $randomString = Str::random(30);
       
         $data->project_name_ar = $request->input('project_name_ar');
         $data->title = $request->input('title');
         $data->title_ar = $request->input('title_ar');
         $data->description_ar = $request->input('description_ar');


         $data->project_type = $request->input('project_type');
         $data->project_category = $request->input('project_category');
         $data->project_continents = $request->input('project_continents');
         $data->project_country = $request->input('project_country');
         $data->project_code = $randomString;
         $data->project_name = $request->input('project_name');
         $data->project_price = $request->input('project_price');
         $data->target_amount = $request->input('target_amount');
         $data->qnty = $request->input('qnty');
         $data->from_date = $request->input('from_date');
         $data->to_date = $request->input('to_date');
         $data->year = $request->input('year');
         $data->description = $request->input('description');
         $data->main_project = $request->input('main_project');
         $data->target = $request->input('target');
         $data->featured = $request->input('featured');
         $data->short_url = $request->input('short_url');
         $data->image = $filename;
         $data->save();

         return redirect()->route('project.index')->with('message','Project Add Successfully');
       
    }

    
    public function show(string $id)
    {
        $projeId = tbl_projects::with('ProjTyp','ProjCat')->where('project_id', '=', $id)->first();
    
        return view('admin.projects.show',compact('projeId'));
    }

    public function edit(string $id)
    {
        $projeId = tbl_projects::with('ProjTyp','ProjCat')->where('project_id', '=', $id)->first();
        $protype =  project_type::all();
        $Categorytype =  CategoryModel::all();
        $Continen =  ContinentModel::all();
        $country =  CountryModel::all();
        // dd($newstype);

        return view('admin.projects.edit',compact('projeId','protype','Categorytype','Continen','country'));
    }

    public function update(Request $request,string $id)
    {
       
        $valData =  $request->validate([
            'project_name_ar' => 'required',
            'title' => 'required',
            'title_ar' => 'required',
            'description_ar' => 'required',
            'project_type' => 'required',
            'project_category' => 'required',
            'project_continents' => 'required',
            'project_country' => 'required',
            'project_name' => 'required',
            'project_price' => 'required',
            'target_amount' => 'required',
            'qnty' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'year' => 'required',
            'description' => 'required',
            'main_project' => 'required',
            'target' => 'required',
            'featured' => 'required',
            'short_url' => 'required',
            
        ]);
        $data = tbl_projects::where('project_id',$id)->first(); 
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move('uploads\projectimage', $filename, 'public');            
      
        } else{

            $filename = $request->input('images');
        }
      
        $randomString = Str::random(30);

        $data->project_name_ar = $request->input('project_name_ar');
        $data->title = $request->input('title');
        $data->title_ar = $request->input('title_ar');
        $data->description_ar = $request->input('description_ar');

        $data->project_type = $request->input('project_type');
        $data->project_category = $request->input('project_category');
        $data->project_continents = $request->input('project_continents');
        $data->project_country = $request->input('project_country');
        $data->project_code = $randomString;
        $data->project_name = $request->input('project_name');
        $data->project_price = $request->input('project_price');
        $data->target_amount = $request->input('target_amount');
        $data->qnty = $request->input('qnty');
        $data->from_date = $request->input('from_date');
        $data->to_date = $request->input('to_date');
        $data->year = $request->input('year');
        $data->description = $request->input('description');
        $data->main_project = $request->input('main_project');
        $data->target = $request->input('target');
        $data->featured = $request->input('featured');
        $data->short_url = $request->input('short_url');
        $data->image = $filename;
        $data->save();

        return redirect()->route('project.index')->with('message','Project Updated Successfully');
         
    }

    public function destroy(Request $requst, string $id)
    {
        DB::table('tbl_projects')->where('project_id', $id)->delete();
        // $news = news::all();

          return redirect()->route('project.index')->with('message','Project Deleted Successfully');
    }

    public function donationtypeStatus(Request $request)
{

    $user = tbl_projects::find($request->id);
    $user->donationtype_status = $request->donationtype_status;
    $user->save();

     return response()->json(['success'=>' Status change successfully.']);

}



}