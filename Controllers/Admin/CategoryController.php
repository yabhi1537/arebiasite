<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CategoryModel;
use App\Models\admin\project_type;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(Request $request)
    { 
    
      $cateser = $request['cateserch'] ?? "";
      $titlserc = $request['titlserch'] ?? "";

      if($request->ajax()){
        $cates =CategoryModel::Query();
        if($cateser !="" ){
          $cates->where('project_type', 'LIKE', "%$cateser%")->get();
        }
        if($titlserc !="" ){
          $cates->where('title', 'LIKE', "%$titlserc%")->get();
        }
        $categorys = $cates->with('ProjTypReletion')->Paginate(10);
        return view('admin.category.data',compact('categorys'));
       
      }

      $cates =CategoryModel::Query();
    
           $categorys = $cates->with('ProjTypReletion')->Paginate(10);
           $categoryser = CategoryModel::Paginate(5);
           $projectp = project_type::all();
        return view('admin.category.index',compact('categorys','categoryser','projectp'));
    }

    public function create()
    {
      $projectId = project_type::all();
      return view('admin.category.create',compact('projectId'));
    }

    public function store(Request $request)
    {
      $valData =  $request->validate([
        'project_type' => 'required',
        'title'        => 'required',
        
        'title_ar' => 'required',
        'description_ar' => 'required',
        'description'  => 'required',
        'image'        => 'required',
    ]);
    if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
           
            
             $file->move(public_path("uploads/category/image"), $filename);
        }
      $data = new CategoryModel;

  
      $data->project_type = $request->input('project_type');
      $data->title = $request->input('title');
      
      $data->description = $request->input('description');
      $data->title_ar = $request->input('title_ar');
      $data->description_ar = $request->input('description_ar');
      $data->image =  $filename;
      $data->save();
      return redirect()->route('category.index')->with('message','Category Add Successfully');
    }



    public function edit($id)
    {
      $projectId = project_type::all();
      $categores =  CategoryModel::find($id);
      return view('admin.category.edit',compact('categores','projectId'));
    }

    public function update(Request $request,$id)
    {
      $valData =  $request->validate([
        'project_type' => 'required',
        'title'        => 'required',
        'title_ar' => 'required',
        'description_ar' => 'required',
        'description'  => 'required',
    ]);
    
      $data = CategoryModel::find($id);

       
    if($request->file('image'))
    {
        $file= $request->file('image');
        $filename= time()."_".$file->getClientOriginalName();
      
        
        $file->move(public_path("uploads/category/image"), $filename);
        
        if (File::exists(public_path("uploads/category/image/$data->image"))) {
          File::delete(public_path("uploads/category/image/$data->image"));
      }       
    }else{

      $filename = $request->input('images');

  }

      $data->project_type = $request->input('project_type');
      $data->title = $request->input('title');
      
      $data->description = $request->input('description');
      $data->title_ar = $request->input('title_ar');
      $data->description_ar = $request->input('description_ar');
      $data->image =  $filename;
      $data->save();
      return redirect()->route('category.index')->with('message','Category Updated Successfully');
    }

    public function destroy(Request $request,$id)
    {
      $data = CategoryModel::find($id);
      $data->delete();
      return redirect()->route('category.index')->with('message','Category Deleted Successfully');

    }
     public function show($id)
     {
       
       $categores =  CategoryModel::find($id);
       $projectId = project_type::find($categores->project_type);
      return view('admin.category.show',compact('categores','projectId'));
     }

     public function categoryStatus(Request $request)
{

    $user = CategoryModel::find($request->id);
    $user->status = $request->status;
    $user->save();

     return response()->json(['success'=>' Status change successfully.']);

}


}
