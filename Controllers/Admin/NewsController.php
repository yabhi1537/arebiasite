<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Session;
use App\Models\admin\news;
use App\Models\admin\news_type;
use App\Models\admin\project_type;

class NewsController extends Controller
{
    public function index(Request $request)
     {
        if($request){
			  $catese =   $request['catesearch'] ?? "";
			  $typesear =   $request['typesearch'] ?? "";
			  $titlese =   $request['titleser'] ?? "";
			  $datesear =   $request['datesearch'] ?? "";

				  if($request->ajax()){

					$news=news::Query();
					if($typesear !="" ){
		  
					  $news->with('newTyp')->where('newstypeid', 'LIKE', "%$typesear%")->get();
					}
					if ($titlese !="" ) {
					  $news->with('newTyp')->where('title', 'LIKE', "%$titlese%")->get();
					  $news->with('newTyp')->orwhere('title_ar', 'LIKE', "%$titlese%")->get();
					} 
					if ($datesear !="" ) {
					  $news->with('newTyp')->where('publish_date', 'LIKE', "%$datesear%")->get();
					}

					$news11 = $news->with('newTyp')->Paginate(10);
					return view('admin.news.data',compact('news11'));
				  
			  }  
         }
            $news=news::Query();
            $news11 =$news->with('newTyp')->Paginate(10);
            $newsty = news_type::Paginate(5);
            
        return view('admin.news.index',['news11' => $news11,'newsty'=>$newsty]);
     }
     public function create()
     {

        $newstype =  news_type::all();
        return view('admin/news.create',compact('newstype'));
     }

     public function store(Request $request)
     {
           $valData =  $request->validate([
             'title' => 'required',
             'city' => 'required',
             'time' => 'required',
             'description_ar' => 'required',
             'title_ar' => 'required',
             'publish_date' => 'required',
             'description' => 'required',
             'bannerimage' => 'required|image|mimes: jpeg,png,jpg,gif|max:2048',
              'newstype' => 'required',
         ]);
      
         if($request->file('bannerimage'))
         {
             $file= $request->file('bannerimage');
             $filename= time()."_".$file->getClientOriginalName();
             $file->move(public_path("uploads/news"), $filename);
             
         }
 
         $newsmodel = new news();
         $newsmodel->title_ar = $valData['title_ar'];
         $newsmodel->city = $valData['city'];
         $newsmodel->time = $valData['time'];
         $newsmodel->description_ar = $valData['description_ar'];
         $newsmodel->title = $valData['title'];
         $newsmodel->description = $valData['description'];
         $newsmodel->publish_date = $valData['publish_date'];
         $newsmodel->newstypeid = $valData['newstype'];
         $newsmodel->bannerimage = $filename;
         $newsmodel->save();
         
         Session::flash('message', 'News Created Successfully'); 
          return redirect()->route('news.index');
     }
     public function edit(string $id)
     {  
         $tnews = news::with('newTyp')->where('newsid', '=', $id)->first();
         $newstype =  news_type::all();

        return view('admin/news.edit',compact('tnews','newstype'));
      }
      public function update(Request $request, string $id)
      {
       
              $valData = $request->validate([
              'description_ar' => 'required',
              'city' => 'required',
              'time' => 'required',
              'title_ar' => 'required',
              'title' => 'required',
              'publish_date' => 'required',
              'description' => 'required',
               'newstype' => 'required',
              ]);
  
              $newsmodel = news::find($id);
              if($request->file('bannerimage'))
              {
                  $file= $request->file('bannerimage');
                  $filename= time()."_".$file->getClientOriginalName();
                 
                  $file->move(public_path("uploads/news"), $filename);

                  if (File::exists(public_path("uploads/news/$newsmodel->bannerImage"))) {
                    File::delete(public_path("uploads/news/$newsmodel->bannerImage"));
                }
              } else{
                $filename = $request->input('image');
            }
              $newsmodel->title_ar = $valData['title_ar'];
              $newsmodel->description_ar = $valData['description_ar'];
              $newsmodel->city = $valData['city'];
              $newsmodel->time = $valData['time'];
              $newsmodel->title = $valData['title'];
              $newsmodel->description = $valData['description'];
              $newsmodel->publish_date = $valData['publish_date'];
              $newsmodel->newstypeid = $valData['newstype'];
              $newsmodel->bannerimage = $filename;
              $newsmodel->save();
              
  
              return redirect()->route('news.index')->with('message','News updated  Successfully');
  
      }
      public function show(string $id)
	  {
			$tnews = news::where('newsid', '=', $id)->first();
			$newstype =  news_type::all();

			return view('admin/news.show',compact('tnews','newstype'));

	  }
      public function destroy(Request $request, string $id)
      {
          DB::table('news')->where('newsid', $id)->delete();
           $news = news::all();
  
           return redirect()->route('news.index')->with('message','News Deleted Successfully');
          
      }
}
