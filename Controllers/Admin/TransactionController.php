<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\TransactionExport;
use Illuminate\Http\Request;
use App\Models\admin\TransactionModel;
use App\Models\admin\project_type;
use App\Models\admin\CategoryModel;
use App\Models\admin\tbl_projects;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;

use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if($request){
            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            $p_type = $request->input('p_type');
            $category = $request->input('category');
             $p_name = $request->input('p_name');
             $transactionId = $request->input('transactionId');
             $payment_status = $request->input('payment_status');

   if($request->ajax()){

               $query = TransactionModel::query();

                 if($from_date !='')
                 {
                 $query->whereDate('created_date', '>=',$from_date);
                 $query->whereDate('created_date', '<=', $to_date);
                 }

               if($p_type !='')
               {
                  $query->where('P_type', 'LIKE' , "%$p_type%");
               }
               if($category !='')
               {
                  $query->where('category', 'LIKE' , "%$category%");
               }
               if($p_name !='')
               {
                  $query->where('p_name', 'LIKE' , "%$p_name%");
               }
               if($transactionId !='')
               {
                  $query->where('transactionId', 'LIKE' , "%$transactionId%");
               }
               if($payment_status !='')
               {
                  $query->where('payment_status', 'LIKE' , "%$payment_status%");
               }
         
            $data = $query->Paginate(10);
              return view('admin.transaction.data',compact('data'));
             }  

              $query = TransactionModel::query();
          }
         
         $data = $query->Paginate(10);
         $projectyp = project_type::all();
         $categories = CategoryModel::all();
         $projects = tbl_projects::all();
        return view('admin.transaction.index',compact('data','projectyp','categories','projects'));
    }
    
    public function destroy(Request $request,$id)
    {
      $data = TransactionModel::find($id);
      $data->delete();
      return redirect()->route('transaction.index')->with('message','Transaction Deleted Successfully');
 
    }
    
    public function Show($id)
    {
        $data = TransactionModel::find($id);
        return view('admin.transaction.show',compact('data'));
    }

    public function generatePDF(Request $request,$id)
    {
		
		if($request){
            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            $p_type = $request->input('p_type');
            $category = $request->input('category');
             $p_name = $request->input('p_name');
             $transactionId = $request->input('transactionId');
             $payment_status = $request->input('payment_status');

   if($request->ajax()){

               $query = TransactionModel::query();

                 if($from_date !='')
                 {
                 $query->whereDate('created_date', '>=',$from_date);
                 $query->whereDate('created_date', '<=', $to_date);
                 }

               if($p_type !='')
               {
                  $query->where('P_type', 'LIKE' , "%$p_type%");
               }
               if($category !='')
               {
                  $query->where('category', 'LIKE' , "%$category%");
               }
               if($p_name !='')
               {
                  $query->where('p_name', 'LIKE' , "%$p_name%");
               }
               if($transactionId !='')
               {
                  $query->where('transactionId', 'LIKE' , "%$transactionId%");
               }
               if($payment_status !='')
               {
                  $query->where('payment_status', 'LIKE' , "%$payment_status%");
               }
         
              $transaction = $query->Paginate(0);
              
				 $data = [
						'title' => 'Welcome to '.url('').'',
						'date' => date('m/d/Y'),
						'data' => $transaction
					]; 
					
				$pdf = PDF::loadView('admin.transaction.data_pdf', $data);
				
				$fileName =  'uploads/report_pdf/'.time().'.'. 'pdf' ;
				$pdf->save(public_path() . '/' . $fileName);

				 $pdf = public_path($fileName);
				return response()->download($pdf);
            
             }  

          }
         
        
    }

    public function fileExport(Request $request,$id,$id2) 
    {
		if($request){
            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            $p_type = $request->input('p_type');
            $category = $request->input('category');
             $p_name = $request->input('p_name');
             $transactionId = $request->input('transactionId');
             $payment_status = $request->input('payment_status');

   if($request->ajax()){

               $query = TransactionModel::query();

                 if($from_date !='')
                 {
                 $query->whereDate('created_date', '>=',$from_date);
                 $query->whereDate('created_date', '<=', $to_date);
                 }

               if($p_type !='')
               {
                  $query->where('P_type', 'LIKE' , "%$p_type%");
               }
               if($category !='')
               {
                  $query->where('category', 'LIKE' , "%$category%");
               }
               if($p_name !='')
               {
                  $query->where('p_name', 'LIKE' , "%$p_name%");
               }
               if($transactionId !='')
               {
                  $query->where('transactionId', 'LIKE' , "%$transactionId%");
               }
               if($payment_status !='')
               {
                  $query->where('payment_status', 'LIKE' , "%$payment_status%");
               }
         
                $transaction = $query->Paginate(0);
              
				return Excel::download(new TransactionExport($transaction), 'users-collection.xlsx');
            
             }  

          }
       
    }
    
    public function completetransaction(Request $request)
    {

        if($request){
         $p_type = $request->input('p_type');
         $category = $request->input('category');
          $p_name = $request->input('p_name');
          $transactionId = $request->input('transactionId');
          $payment_status = $request->input('payment_status');
          $from_date = $request->get('from_date');
          $to_date = $request->get('to_date');

 if($request->ajax()){
            $query = TransactionModel::query();
            if($from_date !='')
            {
            $query->whereDate('created_date', '>=',$from_date);
            $query->whereDate('created_date', '<=', $to_date);
            }
            if($p_type !='')
            {
               $query->where('P_type', 'LIKE' , "%$p_type%");
            }
            if($category !='')
            {
               $query->where('category', 'LIKE' , "%$category%");
            }
            if($p_name !='')
            {
               $query->where('p_name', 'LIKE' , "%$p_name%");
            }
            if($transactionId !='')
            {
               $query->where('transactionId', 'LIKE' , "%$transactionId%");
            }
            if($payment_status !='')
            {
               $query->where('payment_status', 'LIKE' , "%$payment_status%");
            }
       
         $data = $query->where('payment_status', 'Paid')->Paginate(10);
   
         return view('admin.completetransaction.data',compact('data'));
       
          }  

         $query = TransactionModel::query();
         
     }

      $data = $query->where('payment_status', 'Paid')->Paginate(10);
      $projectyp = project_type::all();
      $categories = CategoryModel::all();
      $projects = tbl_projects::all();
     return view('admin.completetransaction.index',compact('data','projectyp','categories','projects'));
    }

    public function transactiondestroy(Request $request,$id)
    {
      $data = TransactionModel::find($id);
      $data->delete();
      return redirect()->route('completetransaction')->with('message','Complete Transaction Deleted Successfully');
 
    }
    
    public function transactionshow($id)
    {
        $data = TransactionModel::find($id);
        return view('admin.completetransaction.show',compact('data'));
    }

    public function completetransactionPDF(Request $request,$id)
    {
		
		if($request){
            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            $p_type = $request->input('p_type');
            $category = $request->input('category');
             $p_name = $request->input('p_name');
             $transactionId = $request->input('transactionId');

   if($request->ajax()){

               $query = TransactionModel::query();

                 if($from_date !='')
                 {
                 $query->whereDate('created_date', '>=',$from_date);
                 $query->whereDate('created_date', '<=', $to_date);
                 }

               if($p_type !='')
               {
                  $query->where('P_type', 'LIKE' , "%$p_type%");
               }
               if($category !='')
               {
                  $query->where('category', 'LIKE' , "%$category%");
               }
               if($p_name !='')
               {
                  $query->where('p_name', 'LIKE' , "%$p_name%");
               }
               if($transactionId !='')
               {
                  $query->where('transactionId', 'LIKE' , "%$transactionId%");
               }
         
              $transaction = $query->where('payment_status', 'Paid')->Paginate(0);
              
				 $data = [
						'title' => 'Welcome to '.url('').'',
						'date' => date('m/d/Y'),
						'data' => $transaction
					]; 
					
				$pdf = PDF::loadView('admin.completetransaction.data_pdf', $data);
				
				$fileName =  'uploads/report_pdf/'.time().'.'. 'pdf' ;
				$pdf->save(public_path() . '/' . $fileName);

				 $pdf = public_path($fileName);
				return response()->download($pdf);
            
             }  

          }
        
    }
    
    public function completetransactionExport(Request $request,$id,$id2) 
    {
		if($request){
            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            $p_type = $request->input('p_type');
            $category = $request->input('category');
             $p_name = $request->input('p_name');
             $transactionId = $request->input('transactionId');

   if($request->ajax()){

               $query = TransactionModel::query();

                 if($from_date !='')
                 {
                 $query->whereDate('created_date', '>=',$from_date);
                 $query->whereDate('created_date', '<=', $to_date);
                 }

               if($p_type !='')
               {
                  $query->where('P_type', 'LIKE' , "%$p_type%");
               }
               if($category !='')
               {
                  $query->where('category', 'LIKE' , "%$category%");
               }
               if($p_name !='')
               {
                  $query->where('p_name', 'LIKE' , "%$p_name%");
               }
               if($transactionId !='')
               {
                  $query->where('transactionId', 'LIKE' , "%$transactionId%");
               }
               $transaction = $query->where('payment_status', 'Paid')->Paginate(0);
              
				return Excel::download(new TransactionExport($transaction), 'users-collection.xlsx');
            
             }  

          }
       
    }


    
    public function failedtransaction(Request $request)
    {
        if($request){
         $p_type = $request->input('p_type');
         $category = $request->input('category');
          $p_name = $request->input('p_name');
          $transactionId = $request->input('transactionId');
          $from_date = $request->get('from_date');
          $to_date = $request->get('to_date');

 if($request->ajax()){
            $query = TransactionModel::query();
            if($from_date !='')
            {
            $query->whereDate('created_date', '>=',$from_date);
            $query->whereDate('created_date', '<=', $to_date);
            }
            if($p_type !='')
            {
               $query->where('P_type', 'LIKE' , "%$p_type%");
            }
            if($category !='')
            {
               $query->where('category', 'LIKE' , "%$category%");
            }
            if($p_name !='')
            {
               $query->where('p_name', 'LIKE' , "%$p_name%");
            }
            if($transactionId !='')
            {
               $query->where('transactionId', 'LIKE' , "%$transactionId%");
            }
      
       
         $data = $query->where('payment_status', 'Failed')->Paginate(10);
   
         return view('admin.failedtransaction.data',compact('data'));
       
          }  

         $query = TransactionModel::query();
         
        
     }

      $data = $query->where('payment_status', 'Failed')->Paginate(10);
      $projectyp = project_type::all();
      $categories = CategoryModel::all();
      $projects = tbl_projects::all();
     return view('admin.failedtransaction.index',compact('data','projectyp','categories','projects'));
    }
    
    public function destroye(Request $request,$id)
    {
      $data = TransactionModel::find($id);
      $data->delete();
      return redirect()->route('failedtransaction')->with('message','Failed Transaction Deleted Successfully');
 
    }
    
    public function Shows($id)
    {
        $data = TransactionModel::find($id);
        return view('admin.failedtransaction.show',compact('data'));
    }

    
    public function failedtransactionPDF(Request $request,$id)
    {
		
		if($request){
            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            $p_type = $request->input('p_type');
            $category = $request->input('category');
             $p_name = $request->input('p_name');
             $transactionId = $request->input('transactionId');

   if($request->ajax()){

               $query = TransactionModel::query();

                 if($from_date !='')
                 {
                 $query->whereDate('created_date', '>=',$from_date);
                 $query->whereDate('created_date', '<=', $to_date);
                 }

               if($p_type !='')
               {
                  $query->where('P_type', 'LIKE' , "%$p_type%");
               }
               if($category !='')
               {
                  $query->where('category', 'LIKE' , "%$category%");
               }
               if($p_name !='')
               {
                  $query->where('p_name', 'LIKE' , "%$p_name%");
               }
               if($transactionId !='')
               {
                  $query->where('transactionId', 'LIKE' , "%$transactionId%");
               }
         
              $transaction = $query->where('payment_status', 'Failed')->Paginate(0);
              
				 $data = [
						'title' => 'Welcome to '.url('').'',
						'date' => date('m/d/Y'),
						'data' => $transaction
					]; 
					
				$pdf = PDF::loadView('admin.failedtransaction.data_pdf', $data);
				
				$fileName =  'uploads/report_pdf/'.time().'.'. 'pdf' ;
				$pdf->save(public_path() . '/' . $fileName);

				 $pdf = public_path($fileName);
				return response()->download($pdf);
            
             }  

          }
        
    }
    
    public function failedtransactionExport(Request $request,$id,$id2) 
    {
		if($request){
            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            $p_type = $request->input('p_type');
            $category = $request->input('category');
             $p_name = $request->input('p_name');
             $transactionId = $request->input('transactionId');

   if($request->ajax()){

               $query = TransactionModel::query();

                 if($from_date !='')
                 {
                 $query->whereDate('created_date', '>=',$from_date);
                 $query->whereDate('created_date', '<=', $to_date);
                 }

               if($p_type !='')
               {
                  $query->where('P_type', 'LIKE' , "%$p_type%");
               }
               if($category !='')
               {
                  $query->where('category', 'LIKE' , "%$category%");
               }
               if($p_name !='')
               {
                  $query->where('p_name', 'LIKE' , "%$p_name%");
               }
               if($transactionId !='')
               {
                  $query->where('transactionId', 'LIKE' , "%$transactionId%");
               }
               $transaction = $query->where('payment_status', 'Failed')->Paginate(0);
              
				return Excel::download(new TransactionExport($transaction), 'users-collection.xlsx');
            
             }  

          }
       
    }

    public function pendingtransaction(Request $request)
    {
        if($request){
         $p_type = $request->input('p_type');
         $category = $request->input('category');
          $p_name = $request->input('p_name');
          $transactionId = $request->input('transactionId');
           $from_date = $request->get('from_date');
          $to_date = $request->get('to_date');

 if($request->ajax()){
            $query = TransactionModel::query();
            if($from_date !='')
            {
            $query->whereDate('created_date', '>=',$from_date);
            $query->whereDate('created_date', '<=', $to_date);
            }
            if($p_type !='')
            {
               $query->where('P_type', 'LIKE' , "%$p_type%");
            }
            if($category !='')
            {
               $query->where('category', 'LIKE' , "%$category%");
            }
            if($p_name !='')
            {
               $query->where('p_name', 'LIKE' , "%$p_name%");
            }
            if($transactionId !='')
            {
               $query->where('transactionId', 'LIKE' , "%$transactionId%");
            }
      
       
         $data = $query->where('payment_status', 'Pending')->Paginate(10);
   
         return view('admin.pendingtransaction.data',compact('data'));
       
          }  

         $query = TransactionModel::query();
         
        
     }

      $data = $query->where('payment_status', 'Pending')->Paginate(10);
      $projectyp = project_type::all();
      $categories = CategoryModel::all();
      $projects = tbl_projects::all();
     return view('admin.pendingtransaction.index',compact('data','projectyp','categories','projects'));
    }
    
    public function pendingdestroy(Request $request,$id)
    {
      $data = TransactionModel::find($id);
      $data->delete();
      return redirect()->route('pendingtransaction')->with('message','Pending Transaction Deleted Successfully');
 
    }
    
    public function pendingshow($id)
    {
        $data = TransactionModel::find($id);
        return view('admin.pendingtransaction.show',compact('data'));
    }

    
    public function pendingtransactionPDF(Request $request,$id)
    {
		
		if($request){
            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            $p_type = $request->input('p_type');
            $category = $request->input('category');
             $p_name = $request->input('p_name');
             $transactionId = $request->input('transactionId');

   if($request->ajax()){

               $query = TransactionModel::query();

                 if($from_date !='')
                 {
                 $query->whereDate('created_date', '>=',$from_date);
                 $query->whereDate('created_date', '<=', $to_date);
                 }

               if($p_type !='')
               {
                  $query->where('P_type', 'LIKE' , "%$p_type%");
               }
               if($category !='')
               {
                  $query->where('category', 'LIKE' , "%$category%");
               }
               if($p_name !='')
               {
                  $query->where('p_name', 'LIKE' , "%$p_name%");
               }
               if($transactionId !='')
               {
                  $query->where('transactionId', 'LIKE' , "%$transactionId%");
               }
         
              $transaction = $query->where('payment_status', 'Pending')->Paginate(0);
              
				 $data = [
						'title' => 'Welcome to '.url('').'',
						'date' => date('m/d/Y'),
						'data' => $transaction
					]; 
					
				$pdf = PDF::loadView('admin.failedtransaction.data_pdf', $data);
				
				$fileName =  'uploads/report_pdf/'.time().'.'. 'pdf' ;
				$pdf->save(public_path() . '/' . $fileName);

				 $pdf = public_path($fileName);
				return response()->download($pdf);
            
             }  

          }
        
    }
    
    public function pendingtransactionExport(Request $request,$id,$id2) 
    {
		if($request){
            $from_date = $request->get('from_date');
            $to_date = $request->get('to_date');
            $p_type = $request->input('p_type');
            $category = $request->input('category');
             $p_name = $request->input('p_name');
             $transactionId = $request->input('transactionId');

   if($request->ajax()){

               $query = TransactionModel::query();

                 if($from_date !='')
                 {
                 $query->whereDate('created_date', '>=',$from_date);
                 $query->whereDate('created_date', '<=', $to_date);
                 }

               if($p_type !='')
               {
                  $query->where('P_type', 'LIKE' , "%$p_type%");
               }
               if($category !='')
               {
                  $query->where('category', 'LIKE' , "%$category%");
               }
               if($p_name !='')
               {
                  $query->where('p_name', 'LIKE' , "%$p_name%");
               }
               if($transactionId !='')
               {
                  $query->where('transactionId', 'LIKE' , "%$transactionId%");
               }
               $transaction = $query->where('payment_status', 'Pending')->Paginate(0);
              
				return Excel::download(new TransactionExport($transaction), 'users-collection.xlsx');
            
             }  

          }
    }

}