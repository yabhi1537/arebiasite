<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\ContactEnquiriesModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactEnquiriesController extends Controller
{
    public function index(Request $request)
    {
        $nameserch = $request['nameserch'] ?? "";
        if($request->ajax()){
          $achivti =ContactEnquiriesModel::Query();

          if($nameserch !="" ){
            $achivti->where('name', 'LIKE', "%$nameserch%")
            ->orWhere('email', 'LIKE', "%$nameserch%")
            ->orWhere('phone', 'LIKE', "%$nameserch%")->get();
          }
                $contactquery =$achivti->Paginate(10);
           return view('admin.contactquery.data',compact('contactquery'));
               
    }

        $achivti =ContactEnquiriesModel::Query();

    
 
              $contactquery =$achivti->Paginate(10);
              $Allabout =  ContactEnquiriesModel::Paginate(10);

        return view('admin.contactquery.index',compact('contactquery','Allabout'));
    }
   

//     public function store(Request $request)
//    {
//      $valData =  $request->validate([
//        'title' => 'required',
//        'description' => 'required',
//        'image' => 'required',
       
//    ]);
//    if($request->file('image'))
//    {
//        $file= $request->file('image');
//        $filename= time()."_".$file->getClientOriginalName();
//        $file->move('uploads\contactquery\image', $filename, 'public');            
//    } 


//      $data = new ContactEnquiriesModel;

//      $data->title = $request->input('title');
//      $data->description = $request->input('description');
//      $data->image =  $filename;
//      $data->save();
//      return redirect()->route('contactquery.index')->with('message','contactquery Add Successfully');
//    }

   public function edit($id)
   {
     $contactquery =  ContactEnquiriesModel::find($id);
     return view('admin.contactquery.edit',compact('contactquery'));
   }
   
   public function update(Request $request,$id)
   {
    $valData =  $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'email' => 'required',
        'quiries' => 'required',
        
    ]);
 
      $data = ContactEnquiriesModel::find($id);
 
      $data->name = $request->input('name');
      $data->phone = $request->input('phone');
      $data->email = $request->input('email');
      $data->quiries = $request->input('quiries');
      $data->save();
      return redirect()->route('contactquery.index')->with('message','Contact Query Updated Successfully');
   }

  //  emal Send?
  
   public function mailsend(Request $request){
     
      $name=explode(',',$request['name']);
      $email=explode(',',$request['email']);
      
     for($i=0;$i<count($name);$i++)
     {
		         $emailval=$email[$i];
				 Mail::send('admin.email', [
						 'name' => $name[$i],
						 'email' => $email[$i],
						 'description' => $request['description']
				   
						 ],
					   
						 function ($message) use($emailval) { 
							
								 $message->to($emailval)
								 ->subject('Replay contact inquiery ');
				 });
	  }
     return back()->with('message', 'contact mail sent successfully!');
 }


}
