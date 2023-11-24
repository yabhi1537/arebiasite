<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\news_type;

class NewsTypController extends Controller 
{
       public function index(Request $request)
       {  
           $types = $request['typeserch'] ?? ""; 

           if($request->ajax()){
            $newtyp =news_type::Query();
            if($types !="" ){
              $newtyp->where('type', 'LIKE', "%$types%")->get();
            }
                  $newstype = $newtyp->Paginate(5);
                  return view('admin.newstype.data',compact('newstype'));
            }

           $newtyp =news_type::Query();
           if($types !="" ){
             $newtyp->where('type', 'LIKE', "%$types%")->get();
           }
                 $newstype =$newtyp->Paginate(5);
                 $newsty =  news_type::all();

        return view('admin.newstype.index',compact('newstype','newsty'));

       }

      public function create()
      {
        return view('admin.newstype.create');
      }

      public function store(Request $request)
      {
        $valData =  $request->validate([
          'type' => 'required',
          'type_ar' => 'required',
          
      ]);
        $data = new news_type;

        $data->type = $request->input('type');
        $data->type_ar = $request->input('type_ar');
        $data->save();
        return redirect()->route('newsType.index')->with('message','News Type Add Successfully');
      }

      public function show($id)
      {
        $ntyp =  news_type::find($id);
        return view('admin.newstype.show',compact('ntyp'));
      }

      public function edit($id)
      {
        $ntyp =  news_type::find($id);
        return view('admin.newstype.edit',compact('ntyp'));
      }

      public function update(Request $request,$id)
      {
        $valData =  $request->validate([
          'type' => 'required',
          'type_ar' => 'required',
          
      ]);
        $data = news_type::find($id);

        $data->type = $request->input('type');
        $data->type_ar = $request->input('type_ar');
        $data->save();
        return redirect()->route('newsType.index')->with('message','News Type Updated Successfully');
      }

      public function destroy(Request $request,$id)
      {
        $data = news_type::find($id);
        $data->delete();
        return redirect()->route('newsType.index')->with('message','News Type Deleted Successfully');

      }

}