<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\DonationPolicyModel; 

class DonationPolicyController extends Controller
{
    public function index(Request $request)
    {

       $donationpolicy =  DonationPolicyModel::Paginate(5);
       return view('admin.donationpolicy.index',compact('donationpolicy'));
    }

   public function create()
   {
     return view('admin.donationpolicy.create');
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

     $data = new DonationPolicyModel;

     $data->type = $request->input('type');
     $data->question = $request->input('question');
     $data->answer = $request->input('answer');
     $data->question_ar = $request->input('question_ar');
     $data->answer_ar = $request->input('answer_ar');
     $data->save();
     return redirect()->route('donationpolicy.index')->with('message','Donation Policy Add Successfully');
   }

   public function show($id)
   {
     $donationpolicy =  DonationPolicyModel::find($id);
     return view('admin.donationpolicy.show',compact('donationpolicy'));
   }

   public function edit($id)
   {
     $donationpolicy =  DonationPolicyModel::find($id);
     return view('admin.donationpolicy.edit',compact('donationpolicy'));
   }

   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'title' => 'required',
        'description' => 'required',
        'title_ar' => 'required',
        'description_ar' => 'required',
        
    ]);

   $data = DonationPolicyModel::find($id);
   $data->title = $request->input('title');
   $data->description = $request->input('description');
   $data->title_ar = $request->input('title_ar');
   $data->description_ar = $request->input('description_ar');
   $data->save();
     return redirect()->route('donationpolicy.index')->with('message','Donation Policy Updated Successfully');
   }

   public function destroy(Request $request,$id)
   {
     $data = DonationPolicyModel::find($id);
     $data->delete();
     return redirect()->route('donationpolicy.index')->with('message','Donation Policy Deleted Successfully');

   }
}
