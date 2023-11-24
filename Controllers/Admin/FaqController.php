<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\FaqModel;

class FaqController extends Controller
{
  public function index(Request $request)
  {
    if($request){
    $typesearch = $request['typesearch'] ?? "";
    $question = $request['question'] ?? "";
   
    if($request->ajax()){
        $datas = FaqModel::Query();

        if($typesearch !=""){
          $datas->where('type','LIKE', "%$typesearch%")->get();
        }
        if($question !="" ){
          $datas->where('question', 'LIKE', "%$question%")
          ->orWhere('answer', 'LIKE', "%$question%")->get();
        }
        $faq =$datas->get();
        return view('admin.faq.data',compact('faq'));

       
     }
     $datas =FaqModel::Query();
    }
   
     $faq =$datas->get();
     
     return view('admin.faq.index',compact('faq'));
  }

   public function create()
   {
     return view('admin.faq.create');
   }

   public function store(Request $request)
   {
     $valData =  $request->validate([
       'type' => 'required',
       'question' => 'required',
       'answer' => 'required',
       'question_ar' => 'required',
        'answer_ar' => 'required',
   ]);

     $data = new FaqModel;

     $data->type = $request->input('type');
     $data->question = $request->input('question');
     $data->answer = $request->input('answer');
     $data->question_ar = $request->input('question_ar');
     $data->answer_ar = $request->input('answer_ar');
     $data->save();
     return redirect()->route('faq.index')->with('message','Faq Add Successfully');
   }

   public function show($id)
   {
     $faq =  FaqModel::find($id);
     return view('admin.faq.show',compact('faq'));
   }

   public function edit($id)
   {
     $faq =  FaqModel::find($id);
     return view('admin.faq.edit',compact('faq'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'type' => 'required',
        'question' => 'required',
        'answer' => 'required',
        'question_ar' => 'required',
        'answer_ar' => 'required',
        
    ]);

  
   $data = FaqModel::find($id);
   $data->type = $request->input('type');
   $data->question = $request->input('question');
   $data->answer = $request->input('answer');
   $data->question_ar = $request->input('question_ar');
   $data->answer_ar = $request->input('answer_ar');
   $data->save();
     return redirect()->route('faq.index')->with('message','Faq Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = FaqModel::find($id);
     $data->delete();
     return redirect()->route('faq.index')->with('message','Faq Deleted Successfully');

   }
}