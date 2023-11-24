<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\admin\SendMailModel;
use Illuminate\Support\Facades\Validator;


class EmailController extends Controller
{
    public function index()
    {
        $emaildata = SendMailModel::all();
        $emailmes='';
        return view('admin.mail.email',compact('emaildata','emailmes'));
    }

    // public function sendmail(Request $request)
    // {

    //     $input = $request->all();
    //    # Contact::create($input);

    //    $attachments = [];

    //    foreach ($this->ticketAttachment as $filePath) {
    //        $attachments[] = Attachment::fromStorage($filePath);
    //    }

    //     $messages = [
    //         'g-recaptcha-response.required' => 'You must check the reCAPTCHA.',
    //         'g-recaptcha-response.captcha' => 'Captcha error! try again later or contact site admin.',
    //     ];
 
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'subject' => 'required',
    //         'g-recaptcha-response' => 'required|captcha'
    //     ], $messages);
 
    //     if ($validator->fails()) {
    //         return back()
    //                     ->withErrors($validator)
    //                     ->withInput();
    //     }


    //     Mail::send('admin.email', [
    //             'name' => $request['name'],
    //             'email' => $request['email'],
    //             'subject' => $request['subject'],
    //             'description' => $request['description'],
    //             'attachment' => $request['attachment']
    //             ],
               
    //             function ($message) { 
    //                     $message->from('yabhi1537@gmail.com');
    //                     $message->to('yabhi1537@gmail.com', 'BM Tower')
    //                     ->subject('Your Website Contact Form one ');
    //     });
    //     return back()->with('success', 'Thanks for contacting me, I will get back to you soon!');
    // }

    public function sendmail(Request $request)
    {
       
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'min:2|required',
            'description' => 'required',
            'attachment.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);
        $message = new SendMailModel();
        $message->name = $data['name'];
        $message->email = $data['email'];
        $message->subject = $data['subject'];
        $message->description = $data['description']; 

        if($request->hasfile('attachment')) {
            foreach($request->file('attachment') as $file)
            {
                $name = $file->getClientOriginalName();
                $file->move(public_path().'/uploads/emailattachment/', $name);  
                $path[] = $name;  
                $message->attachment = json_encode($path);
                
            }
        }
        $message->save();
        $emailData = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'description' => $data['description'],
            'attachment' => $path,
        );
        view('admin.email',compact('emailData'));
        // view()->share(compact('emailData')); 
        $files = $request->attachment;

        Mail::send('admin.email', function ($message) use ($data, $file,$files, $path) {
            $message->to($data['email']);
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->subject($data['subject']);
            foreach ($files as $f){
                $message->attach(
                    $f->getRealPath(),array(
                        'as'=>$f->getClientOriginalName(),
                        'mime'=>$f->getMimeType(),
                    )
                );
            }
        });
        return redirect()->back();
    }

    public function emailmessage(Request $request)
    {
         if($request->ajax()){
        $massId = $request->emailId;
         $datamss = SendMailModel::where('id', $massId)->get();
          $descr = $datamss[0]['description'];
          $subjec = $datamss[0]['subject'];
          $name = $datamss[0]['name'];
          $attachment = $datamss[0]['attachment'];
           $createdat = $datamss[0]['created_at'];
           return response()->json(['descr' => $descr, 'subjec' => $subjec,
            'name' => $name, 'attachment' => $attachment, 'createdat' => $createdat]);

        //  return view('admin.mail.email',compact('emailmes'));
         }
 }
    
} 