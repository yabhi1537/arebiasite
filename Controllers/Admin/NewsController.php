<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            } 
            if ($datesear !="" ) {
              $news->with('newTyp')->where('publish_date', 'LIKE', "%$datesear%")->get();
            }
            $news11 = $news->with('newTyp')->Paginate(5);
            
              $input = '';
            if(!$news11->isEmpty()){
              foreach($news11 as $new){
                $input .= '<tr>';
                $input .= '<td> <img src="'. asset('uploads/news/'.$new->bannerImage) .'" style="height: 30px;width:30px;">
                </td>
                <td>
                    '. $new->title .'
                </td>
                <td>
                    '. $new->newTyp->type .'
                </td>
                <td>'.$new->description.' </td>
                <td>'.$new->publish_date.' </td>
                <td>'.$new->created_at.' </td>

                <td class="d-flex justify-content-center">
                    <a href="'. route('news.show', $new->newsid) .'"
                        class=""><i class="bi bi-eye-fill f-21" ></i></a>
              
                    <a href="'. route('news.edit', $new->newsid) .'"
                        class=""><i class="bi bi-pencil-square f-21"></i></a>
             
                    <span>
                        <form method="POST" action="'. route('news.destroy',$new->newsid) .'">
                           '. csrf_field() .' 
                           '. method_field('delete') .' 
                           <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                        </form>
                    </span>
                </td>';
                $input .= '</tr>';
              }
          } else {
              $input .= ' <tr> <td colspan="4"> Note : News Is Empty ?.</td></tr>';
          }
         
          return $input;
      }  


          $news=news::Query();
          if($typesear !="" ){

            $news->with('newTyp')->where('newstypeid', 'LIKE', "%$typesear%")->get();
          }
          if ($titlese !="" ) {
            $news->with('newTyp')->where('title', 'LIKE', "%$titlese%")->get();
          } 
          if ($datesear !="" ) {
            $news->with('newTyp')->where('publish_date', 'LIKE', "%$datesear%")->get();
          }
         }

            $news11 =$news->with('newTyp')->Paginate(5);
            $newsty = news_type::Paginate(5);
            
        return view('admin/news.index',['news11' => $news11,'newsty'=>$newsty]);
     }

      
 public function create()
     {

        $newstype =  news_type::all();
        // dd($newstype);
        return view('admin/news.create',compact('newstype'));
     }

     public function store(Request $request)
     {
$valData =  $request->validate([
             'title' => 'required',
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
  
             $file->move('uploads\news', $filename, 'public');            
         }
 
         $newsmodel = new news();
         $newsmodel->title_ar = $valData['title_ar'];
         $newsmodel->description_ar = $valData['description_ar'];
         $newsmodel->title = $valData['title'];
         $newsmodel->description = $valData['description'];
         $newsmodel->publish_date = $valData['publish_date'];
         $newsmodel->newstypeid = $valData['newstype'];
         $newsmodel->bannerimage = $filename;
         $newsmodel->save();
         
         Session::flash('message', 'News Created Successfully'); 
          return redirect()->route('news.index');
 
        //  return view('admin.news.index', compact('news'))->with('message','News Record Created Successfully');
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
              'title_ar' => 'required',
              'title' => 'required',
              'publish_date' => 'required',
              'description' => 'required',
               'newstype' => 'required',
              ]);
  
             
              if($request->file('bannerimage'))
              {
                  $file= $request->file('bannerimage');
                  $filename= time()."_".$file->getClientOriginalName();
                  $file->move('uploads\news', $filename, 'public');            
              } else{
                $filename = $request->input('image');
    
            }
  
              $newsmodel = news::find($id);
              $newsmodel->title_ar = $valData['title_ar'];
              $newsmodel->description_ar = $valData['description_ar'];
              $newsmodel->title = $valData['title'];
              $newsmodel->description = $valData['description'];
              $newsmodel->publish_date = $valData['publish_date'];
              $newsmodel->newstypeid = $valData['newstype'];
              $newsmodel->bannerimage = $filename;
              $newsmodel->save();
              
  
              return redirect()->route('news.index')->with('message','News updated  Successfully');
  
              //    return view('news.index', compact('news'))->with('success','News Record Created Successfully');
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
        //    return view('admin/news.index', compact('news'))->with('success','News Delete Successfully'); 
          
      }


}