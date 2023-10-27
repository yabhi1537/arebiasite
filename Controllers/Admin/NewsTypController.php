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
                  $newstype =$newtyp->Paginate(5);
                  $output = '';
                  if(!$newstype->isEmpty()){
                
                    foreach($newstype as $new)	{
                      $output .= '<tr>';
                      $output .= '<td>'.$new->newstypeid .'</td>
                                  <td> '.$new->type.' </td>
                                  <td>'.$new->created_at.'</td>
                                  <td class="d-flex justify-content-center">                        
                                  <a href="'.route('newstype.show',$new->newstypeid).'" class=""><i class="bi bi-eye-fill f-21" ></i></a>
                     
                         <a href="'. route('newstype.edit',$new->newstypeid).'" class=""><i class="bi bi-pencil-square f-21"></i></a>
              
                   <span><form method="POST" action="'. route('newstype.destroy',$new->newstypeid).'">
                   '.csrf_field().'
                   '.method_field("DELETE").'			    	
                   <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>                                </form>
                   </form> </span>
                     </td>';
                     $output .= '</tr>';
                    }
                 
                } else {
                    $output .= ' <tr> <td colspan="4"> Note : Project Type Is Empty ?.</td></tr>';
                }
                return $output;
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