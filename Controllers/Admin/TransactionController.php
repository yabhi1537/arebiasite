<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\TransactionModel;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        if($request){

            $p_type = $request->input('p_type');
            $category = $request->input('category');
             $p_name = $request->input('p_name');
             $transactionId = $request->input('transactionId');
             $payment_status = $request->input('payment_status');

             if($request->ajax()){

               $query = TransactionModel::query();
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
          
            $data = $query->Paginate(5);
            $input = '';
            if(!$data->isEmpty()){
            
            foreach($data as $tran){
               $input .= '<tr>';
               $input .= '<td>  '. $tran->p_type .'
               </td>

               <td>
                   '. $tran->p_name .'
               </td>
               <td>
                   '. $tran->category .'
               </td>
               <td>
                   '. $tran->p_code .'
               </td>
               <td>
                   '. $tran->transactionId .'
               </td>
               <td>
                   '. $tran->payment_status .'
               </td>
               <td>
               <a href="'. route('transaction.show',$tran->id).'" class="fa fa-edit">View</a>
               </td>
               <td>
                   <span>
                       <form method="POST" action="'. route('transaction.destroy',$tran->id) .'">
                           '. csrf_field() .'
                           '. method_field('delete') .'
                           <button type="submit" class="btn btn-outline-danger  ">delete</button>
                       </form>
                   </span>
               </td>';
               $input .= '</tr>';
            }
        } else {
            $input .= ' <tr> <td colspan="4"> Note : Transaction Is Empty ?.</td></tr>';
        }
        return $input;
    }  









            $query = TransactionModel::query();
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
        }

         $data = $query->Paginate(5);
         $alldate = TransactionModel::all();
        return view('admin.transaction.index',compact('data','alldate'));
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


}