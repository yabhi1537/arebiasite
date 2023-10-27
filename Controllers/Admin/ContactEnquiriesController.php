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
        $emailserch = $request['emailserch'] ?? "";
        $phone = $request['phone'] ?? "";

        if($request->ajax()){
          $achivti =ContactEnquiriesModel::Query();

          if($nameserch !="" ){
            $achivti->where('name', 'LIKE', "%$nameserch%")->get();
          }
          if($emailserch !="" ){
              $achivti->where('email', 'LIKE', "%$emailserch%")->get();
            }
            if($phone !="" ){
              $achivti->where('phone', 'LIKE', "%$phone%")->get();
            }
        
                $contactquery =$achivti->Paginate(5);
                $output = '';
                if(!$contactquery->isEmpty()){
                  foreach($contactquery as $new){
                    $output .= '<tr>';
                    $output .= '<td>  <div>
                    <input type="checkbox" data-name="'.$new->name.'" data-email="'.$new->email.'"
                        name="checkboxlist[]" value="'.$new->id.'" class="one_checked checkbox form-check-input m-0"
                        style="position: relative;">
                </div>

            </td>
            <td>
                '. $new->name .'
            </td>
            <td>
                '. $new->phone .'
            </td>
            <td>
                '. $new->email .'
            </td>
            <td>
                '. $new->quiries .'
            </td>
            <td>
                '. $new->date .'
            </td>

            <td>
                <a href="'. route('contactquery.edit',$new->id).'" class="fa fa-edit">Edit</a>
            </td>';

            $output .= '<tr>';
          }
        
        } else {
            $output .= ' <tr> <td colspan="4"> Note : Contacts Is Empty ?.</td></tr>';
        }
        return $output;
    }

        $achivti =ContactEnquiriesModel::Query();

        if($nameserch !="" ){
          $achivti->where('name', 'LIKE', "%$nameserch%")->get();
        }
        if($emailserch !="" ){
            $achivti->where('email', 'LIKE', "%$emailserch%")->get();
          }
          if($phone !="" ){
            $achivti->where('phone', 'LIKE', "%$phone%")->get();
          }
      
              $contactquery =$achivti->Paginate(5);
              $Allabout =  ContactEnquiriesModel::Paginate(5);

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
  
  // public function mailsend(Request $request){
    // dd($request->all());
    // return $request['name'];
    //  $input = $request->all();
    // ContactEnquiriesModel::create($input); 
    // Mail::send('admin.email', [
    //         'name' => $request['name'],
    //         'email' => $request['email'],
    //         'description' => $request['description']
       
    //         ],
           
    //         function ($message) { 
    //                 $message->from('yabhi1537@gmail.com');
    //                 $message->to('yabhi1537@gmail.com', 'TECH COM')
    //                 ->subject('Your Website Contact Form one ');
    // });
    // return back()->with('success', 'Thanks for contacting me, I will get back to you soon!');
// }


}