<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\admin\GovernanceModel;

class GovernanceController extends Controller
{
    public function index(Request $request)
    { 
           $governance = GovernanceModel::Paginate(5);
        return view('admin.governance.index',compact('governance'));
    }

    public function edit($id)
    {
      $governance =  GovernanceModel::find($id);
      return view('admin.governance.edit',compact('governance'));
    }

    public function update(Request $request,$id)
    {
      $valData =  $request->validate([
        'governance_manual' => 'nullable|mimes:pdf',
        'articles_of_association'        => 'nullable|mimes:pdf',
        'financial_reports'       => 'nullable|mimes:pdf',
        'donation_policy' => 'nullable|mimes:pdf',
        'administrative_reports' => 'nullable|mimes:pdf',
        'internal_regulations'  => 'nullable|mimes:pdf',
        'plans'  => 'nullable|mimes:pdf',
        
    ]);
    
      $data = GovernanceModel::find($id);
       
    if($request->file('governance_manual'))
    {
        $file= $request->file('governance_manual');
        $filename= time()."_".$file->getClientOriginalName();
        $file->move( public_path('uploads\governance'), $filename); 
        
        if (File::exists(public_path("uploads\governance/$data->governance_manual"))) {
          File::delete(public_path("uploads\governance/$data->governance_manual"));
      }       
    }else{

      $filename = $request->input('governance_manuals');

  }


  if($request->file('articles_of_association'))
  {
      $file= $request->file('articles_of_association');
      $filenames= time()."_".$file->getClientOriginalName();
      $file->move( public_path('uploads\governance'), $filenames); 
      
      if (File::exists(public_path("uploads\governance/$data->articles_of_association"))) {
        File::delete(public_path("uploads\governance/$data->articles_of_association"));
    }       
  }else{

    $filenames = $request->input('articles_of_associations');

}

if($request->file('financial_reports'))
  {
      $file= $request->file('financial_reports');
      $filenam= time()."_".$file->getClientOriginalName();
      $file->move( public_path('uploads\governance'), $filenam); 
      
      if (File::exists(public_path("uploads\governance/$data->financial_reports"))) {
        File::delete(public_path("uploads\governance/$data->financial_reports"));
    }       
  }else{

    $filenam = $request->input('financial_reportss');

}

if($request->file('donation_policy'))
  {
      $file= $request->file('donation_policy');
      $files= time()."_".$file->getClientOriginalName();
      $file->move( public_path('uploads\governance'), $files); 
      
      if (File::exists(public_path("uploads\governance/$data->donation_policy"))) {
        File::delete(public_path("uploads\governance/$data->donation_policy"));
    }       
  }else{

    $files = $request->input('donation_policys');

}

if($request->file('administrative_reports'))
  {
      $file= $request->file('administrative_reports');
      $filesnam= time()."_".$file->getClientOriginalName();
      $file->move( public_path('uploads\governance'), $filesnam); 
      
      if (File::exists(public_path("uploads\governance/$data->administrative_reports"))) {
        File::delete(public_path("uploads\governance/$data->administrative_reports"));
    }       
  }else{
    $filesnam = $request->input('administrative_reportss');
}

if($request->file('internal_regulations'))
  {
      $file= $request->file('internal_regulations');
      $namfiles= time()."_".$file->getClientOriginalName();
      $file->move( public_path('uploads\governance'), $namfiles); 
      
      if (File::exists(public_path("uploads\governance/$data->internal_regulations"))) {
        File::delete(public_path("uploads\governance/$data->internal_regulations"));
    }       
  }else{
    $namfiles = $request->input('internal_regulationss');
}

if($request->file('plans'))
  {
      $file= $request->file('plans');
      $namfile= time()."_".$file->getClientOriginalName();
      $file->move( public_path('uploads\governance'), $namfile); 
      
      if (File::exists(public_path("uploads\governance/$data->plans"))) {
        File::delete(public_path("uploads\governance/$data->plans"));
    }       
  }else{
    $namfile = $request->input('planss');
}
      $data->governance_manual =  $filename;
      $data->articles_of_association =  $filenames;
      $data->financial_reports =  $filenam;
      $data->donation_policy =  $files;
      $data->administrative_reports =  $filesnam;
      $data->internal_regulations =  $namfiles;
      $data->plans =  $namfile;
      $data->save();

      return redirect()->route('governance.index')->with('message','Governance Updated Successfully');
    }

    public function destroy(Request $request,$id)
    {
      $data = GovernanceModel::find($id);
      $data->delete();
      return redirect()->route('governance.index')->with('message','Dovernance Deleted Successfully');

    }
         public function show($id)
     {
       $govern =  GovernanceModel::find($id);
      return view('admin.governance.show',compact('govern'));
     }

}