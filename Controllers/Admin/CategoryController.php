<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CategoryModel;
use App\Models\admin\project_type;

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
        $categorys =$cates->Paginate(5);

        $output = '';
        if(!$categorys->isEmpty()){
            
          foreach($categorys as $categor){
            $output .= '<tr>';
            $output .= '<td> <img src="'. asset('uploads/category/image/'.$categor->image) .'"
            style="height: 30px;width:30px;"></td>

           <td> '. $categor->project_type.' </td>
           <td>'. $categor->title  .' </td>
           <td>'. $categor->description .'</td>
    <td class="text-center">';
        if($categor->status =='0'){
        $output .= '<span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
            onclick="changeStatus('. $categor->id.',1)">Deactive</span>';

          } else if($categor->status =='1'){
        $output .= '<span id="bookForm" class="btn btn-success btn-rounded btn-sm"
            onclick="changeStatus('. $categor->id .',0 )">Active</span>';
          }

          $output .= '</td>
    
          <td class="d-flex justify-content-center">
        <a href="'. route('category.show', $categor->id).'"
            class=""><i class="bi bi-eye-fill f-21" ></i></a>

        <a href="'. route('category.edit', $categor->id).'"
            class=""><i class="bi bi-pencil-square f-21"></i></a>

        <span>
            <form method="POST" action="'. route('category.destroy',$categor->id) .'">
              '.csrf_field().'
              '. method_field('delete') .'
              <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
            </form>
        </span>
    </td>';
    $output .= '</tr>';
  }
 
} else {
    $output .= ' <tr> <td colspan="4"> Note : Category  Is Empty ?.</td></tr>';
}
return $output;
}

      $cates =CategoryModel::Query();
      if($cateser !="" ){
        $cates->where('project_type', 'LIKE', "%$cateser%")->get();
      }
      if($titlserc !="" ){
        $cates->where('title', 'LIKE', "%$titlserc%")->get();
      }
           $categorys = $cates->Paginate(5);
           $categoryser = CategoryModel::Paginate(5);
        return view('admin.category.index',compact('categorys','categoryser'));
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
        'status'       => 'required',
        'title_ar' => 'required',
        'description_ar' => 'required',
        'description'  => 'required',
        'image'        => 'required',
    ]);
    if($request->file('image'))
        {
            $file= $request->file('image');
            $filename= time()."_".$file->getClientOriginalName();
            $file->move('uploads\category\image', $filename, 'public');            
        }
      $data = new CategoryModel;

  
      $data->project_type = $request->input('project_type');
      $data->title = $request->input('title');
      $data->status = $request->input('status');
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
        'status'       => 'required',
        'title_ar' => 'required',
        'description_ar' => 'required',
        'description'  => 'required',
    ]);
    
    if($request->file('image'))
    {
        $file= $request->file('image');
        $filename= time()."_".$file->getClientOriginalName();
        $file->move('uploads\category\image', $filename, 'public');            
    }else{

      $filename = $request->input('images');

  }
      $data = CategoryModel::find($id);

      $data->project_type = $request->input('project_type');
      $data->title = $request->input('title');
      $data->status = $request->input('status');
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
       $projectId = project_type::all();
       $categores =  CategoryModel::find($id);
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