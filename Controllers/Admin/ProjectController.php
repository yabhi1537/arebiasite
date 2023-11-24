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
use App\Models\admin\MarketerModel;
use App\Models\admin\marketerlinksModel;
use Illuminate\Support\Facades\File;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

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
            $projects->with('ProjTyp','ProjCat')->where('project_type', '=', $typesear)->get();
          } 
        if ($name !="" ) {
            $projects->where('project_name', 'LIKE', "%$name%")->get();
        }
        if ($country !="" ) {
            $projects->where('project_country', 'LIKE', "%$country%")->get();
        }
     
          $project =$projects->with('ProjTyp','ProjCat')->Paginate(10);

          return view('admin.projects.data',compact('project'));
         
    }
          $projects=tbl_projects::Query();
          $project =$projects->with('ProjTyp','ProjCat')->Paginate(10);
          $proserch = tbl_projects::all();
          $data['Ptype']  =   project_type::all();
          $data['PCategor']   =   CategoryModel::all();
          $data['Pcountry']  =   CountryModel::all();
          $data['Pcontinent'] =   ContinentModel::all();
          $marketers = MarketerModel::all();



        return view('admin.projects.index',
        compact('project','proserch','data','marketers'));
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
            'image' => 'required|image|mimes: jpeg,png,jpg,gif|max:2048',
        ]);

         $data = new tbl_projects();

         if($request->file('image'))
         {
             $file= $request->file('image');
             $filename= time()."_".$file->getClientOriginalName();
             // dd($filename);
             
              $file->move(public_path("uploads/projectimage"), $filename);
         }
         $randomString = Str::random(30);
         $shorturl = URL('/'.$randomString.'');
       
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
         $data->short_url = $shorturl;
         $data->image = $filename;
         $data->save();

         return redirect()->route('project.index')->with('message','Project Add Successfully');
       
    }
    
    public function show(string $id)
    {
        $projeId = tbl_projects::with('ProjTyp','ProjCat')->where('project_id', '=', $id)->first();
        $marketers = MarketerModel::all();
        $projectcode = $projeId->project_code;
        $link = marketerlinksModel::where('project_code', $projectcode)->get();
        return view('admin.projects.show',compact('projeId','marketers','link'));
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
        ]);
        $data = tbl_projects::where('project_id',$id)->first(); 
        if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
           
             $file->move(public_path("uploads/projectimage"), $filename);

            if (File::exists(public_path("uploads/projectimage/$data->image"))) {
                File::delete(public_path("uploads/projectimage/$data->image"));
            }            
        } else{

            $filename = $request->input('images');
        }
      
        $data->project_name_ar = $request->input('project_name_ar');
        $data->title = $request->input('title');
        $data->title_ar = $request->input('title_ar');
        $data->description_ar = $request->input('description_ar');

        $data->project_type = $request->input('project_type');
        $data->project_category = $request->input('project_category');
        $data->project_continents = $request->input('project_continents');
        $data->project_country = $request->input('project_country');
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
     
        $data->image = $filename;
        $data->save();

        return redirect()->route('project.index')->with('message','Project Updated Successfully');
         
    }

    public function destroy(Request $requst, string $id)
    {
        DB::table('tbl_projects')->where('project_id', $id)->delete();

          return redirect()->route('project.index')->with('message','Project Deleted Successfully');
    }

    public function donationtypeStatus(Request $request)
{
    $user = tbl_projects::find($request->id);
    $user->donationtype_status = $request->donationtype_status;
    $user->save();

     return response()->json(['success'=>' Status change successfully.']);

}

public function projpubliStatus(Request $request)
{

    $user = tbl_projects::find($request->id);
    $user->publish_status = $request->publish_status;
    $user->save();

     return response()->json(['success'=>' Status change successfully.']);

}

public function generatelinkstore(Request $request)
{
    $valData =  $request->validate([
        'language' => 'required',
        'marketer' => 'required',
        'time' => 'required',
        'date' => 'required',
        'generatelink' => 'required',
        'project_code' => 'required',
    ]);
     $count = marketerlinksModel::where('project_code', $request->project_code)->where('marketer', $request->marketer)->count();

if($count == 0){
    $data = new marketerlinksModel;

    $data->language = $request->input('language');
    $data->marketer = $request->input('marketer');
    $data->time = $request->input('time');
    $data->date = $request->input('date');
    $data->project_code = $request->input('project_code');
    $data->generatelink = $request->input('generatelink');
    $data->save();
    return redirect()->route('project.index')->with('message','Generate Link Successfully');
}else{
    return redirect()->route('project.index')->with('error','Link already Generated'); 
}

}





}