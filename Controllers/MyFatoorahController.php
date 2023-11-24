<?php

namespace App\Http\Controllers;

use MyFatoorah\Library\PaymentMyfatoorahApiV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use Illuminate\Support\Facades\Auth;
use Mail; 
class MyFatoorahController extends Controller {


    public $mfObj;

//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * create MyFatoorah object
     */
    public function __construct() {
        $this->mfObj = new PaymentMyfatoorahApiV2(config('myfatoorah.api_key'), config('myfatoorah.country_iso'), config('myfatoorah.test_mode'));
        
        // $alldata = $this->mfObj->getrecurringpayment();
         
         //echo '<pre>';
         //print_r( $alldata); die;
    }

//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Create MyFatoorah invoice
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request) {
		
		$orderid = random_int(100000, 999999);
		$project_id =$request->project_id;
		$donation_amount =$request->donation_amount;
		$donor_name =$request->donor_name;
		$donor_phone =$request->donor_phone;
		$donor_email =$request->donor_email;
		$paymentMethodId =$request->paymentmethode_id;

        try {
		
            $data   = $this->mfObj->getInvoiceURL($this->getPayLoadData($orderid,$project_id,$donation_amount,$donor_name,$donor_phone,$donor_email), $paymentMethodId);
       
        } catch (\Exception $e) {
            return response()->json(['IsSuccess' => 'false', 'Message' => $e->getMessage()]);
        }
        
        $inviceurl = $data['invoiceURL'];
        return redirect($inviceurl);
    }
//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * 
     * @param int|string $orderId
     * @return array
     */
    private function getPayLoadData($orderid=null,$project_id,$donation_amount,$donor_name=null,$donor_phone=null,$donor_email=null) {
        $callbackURL = route('myfatoorah.callback',app()->getLocale());
        
        return [
            'UserDefinedField'       => $project_id,
            'CustomerName'       => $donor_name,
            'InvoiceValue'       => $donation_amount,
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => $donor_email,
            'CallBackUrl'        => $callbackURL,
            'ErrorUrl'           => $callbackURL,
            'CustomerMobile'     => $donor_phone,
            'Language'           => 'en',
            'CustomerReference'  => $orderid,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];
    }

//-----------------------------------------------------------------------------------------------------------------------------------------

    /**
     * Get MyFatoorah payment information
     * 
     * @return \Illuminate\Http\Response
     */
    public function callback() {
        try {
            $paymentId = request('paymentId');
            $data      = $this->mfObj->getPaymentStatus($paymentId, 'PaymentId');
            if ($data->InvoiceStatus == 'Paid') {
			
			  $user = Auth::user();
			  $user_id = Auth::id();
			
			$project_id = $data->UserDefinedField;
			
            /* get data from project table */
			$project_details = DB::table('tbl_projects')
            ->join('project_type', 'tbl_projects.project_type', '=', 'project_type.id')
            ->join('category', 'tbl_projects.project_category', '=', 'category.id')
            ->select('tbl_projects.*', 'project_type.type', 'category.title')
            ->where('tbl_projects.project_id','=',$project_id)
            ->get()->first();
            
			/* insert data from transaction table */	
			$insert_id = DB::table('transaction')->insert([
			        'session_id'=> $data->CustomerReference ,
			        'user_id' => $user_id ,
			        'user_name' => $data->CustomerName,
			        'user_email' => $data->CustomerEmail,
			        'user_phone' => $data->CustomerMobile,			  
					'p_type' => $project_details->type,
					'category' => $project_details->title,
					'p_name' => $project_details->project_name,
					'p_code' => $project_details->project_code,
					'p_id' => $project_details->project_id,
					'invoice_id' => $data->InvoiceId,
					'transactionId' => $data->InvoiceTransactions[0]->TransactionId ,
					'paymentId' => $data->InvoiceTransactions[0]->PaymentId ,
					'refId' => $data->InvoiceTransactions[0]->ReferenceId ,
					'pay_type' => $data->InvoiceTransactions[0]->PaymentGateway ,
					'donate_amount' =>$data->InvoiceTransactions[0]->TransationValue ,
					'TotalServiceCharge' =>$data->InvoiceTransactions[0]->TotalServiceCharge,
					'VatAmount' =>$data->InvoiceTransactions[0]->VatAmount ,
					'transactionStatus' =>$data->InvoiceTransactions[0]->TransactionStatus ,
					'qtyval' => 1,
					'payment_status' => $data->InvoiceStatus,
						
				]);
				
				$insertId = DB::getPdo()->lastInsertId();  
				
				/* update doneted amount in project table */
				$total_doneted = $project_details->donated + $data->InvoiceTransactions[0]->TransationValue;
				$affected = DB::table('tbl_projects')
              ->where('project_id', $project_id)
              ->update(['donated' => $total_doneted]);
				
              return redirect(app()->getLocale().'/knet/knet_success/'.encrypt($insertId))->with(['invoice_success' => 'Invoice is paid.']);
                 
            } else if ($data->InvoiceStatus == 'Failed') {  
				
				$project_id = $data->UserDefinedField;
				
				$user = Auth::user();
			    $user_id = Auth::id();
            
            /* get data from project table */
			$project_details = DB::table('tbl_projects')
            ->join('project_type', 'tbl_projects.project_type', '=', 'project_type.id')
            ->join('category', 'tbl_projects.project_category', '=', 'category.id')
            ->select('tbl_projects.*', 'project_type.type', 'category.title')
            ->where('tbl_projects.project_id','=',$project_id)
            ->get()->first();
            
			/* insert data from transaction table */	
			$insert_id = DB::table('transaction')->insert([
			        'session_id'=> $data->CustomerReference ,
			        'user_id' => $user_id ,
			        'user_name' => $data->CustomerName,
			        'user_email' => $data->CustomerEmail,
			        'user_phone' => $data->CustomerMobile,
					'p_type' => $project_details->type,
					'category' => $project_details->title,
					'p_name' => $project_details->project_name,
					'p_code' => $project_details->project_code,
					'p_id' => $project_details->project_id,
					'invoice_id' => $data->InvoiceId,
					'transactionId' => $data->InvoiceTransactions[0]->TransactionId ,
					'paymentId' => $data->InvoiceTransactions[0]->PaymentId ,
					'refId' => $data->InvoiceTransactions[0]->ReferenceId ,
					'pay_type' => $data->InvoiceTransactions[0]->PaymentGateway ,
					'donate_amount' =>$data->InvoiceTransactions[0]->TransationValue ,
					'TotalServiceCharge' =>$data->InvoiceTransactions[0]->TotalServiceCharge,
					'VatAmount' =>$data->InvoiceTransactions[0]->VatAmount ,
					'transactionStatus' =>$data->InvoiceTransactions[0]->TransactionStatus ,
					'qtyval' => 1,
					'payment_status' => $data->InvoiceStatus,
						
				]);
				
				$insertId = DB::getPdo()->lastInsertId();
				
					/* update residual amount in project table */
				$total_residual = $project_details->residual + $data->InvoiceTransactions[0]->TransationValue;
				$affected = DB::table('tbl_projects')
              ->where('project_id', $project_id)
              ->update(['residual' => $total_residual]);
				
				return redirect(app()->getLocale().'/knet/knet_error/'.encrypt($insertId))->withErrors(['invoice_error' =>'Invoice is not paid due to ' . $data->InvoiceError]);
              
            } else if ($data->InvoiceStatus == 'Expired') {
				
				return redirect(app()->getLocale().'/knet/knet_expired',)->withErrors(['invoice_error' =>'Invoice is expired.']);
            }
            
        } catch (\Exception $e) {
            $response = ['IsSuccess' => 'false', 'Message' => $e->getMessage()];
        }
        return response()->json($response);
    }
    public function knet_success($local,$ID)
    {
	   $id = decrypt($ID);
	   $transaction = DB::table('transaction')->where('id','=',$id)->get()->first();	
	    
	   return View::make('en.pages.payment_invoice', compact('transaction'));
	  
	}
	public function knet_error($local,$ID)
    {
	    $id = decrypt($ID);
	   $transaction = DB::table('transaction')->where('id','=',$id)->get()->first();	
	  
	   return View::make('en.pages.payment_invoice', compact('transaction'));
	}
	public function knet_expired()
    {
		
		
	}
	/*payment for cart data */
	
	public function cartpayment(Request $request) {
		
		$allcartdata = session()->get('cart');
		//$allsession_id = array_column($allcartdata, 'session_id');
		
		$orderid = random_int(100000, 999999);
		$session_id =$orderid;
		$totalcart_donation = array_sum(array_column($allcartdata, 'price'));
		$donation_amount =$totalcart_donation;
		$donor_name =$request->donor_name;
		$donor_phone =$request->donor_phone;
		$donor_email =$request->donor_email;
		$paymentMethodId =$request->paymentmethode_id;
		
        try {
		
            $data   = $this->mfObj->getInvoiceURL($this->getPayLoadData_cart($orderid,$session_id,$donation_amount,$donor_name,$donor_phone,$donor_email), $paymentMethodId);
       
        } catch (\Exception $e) {
            return response()->json(['IsSuccess' => 'false', 'Message' => $e->getMessage()]);
        }
        
        $inviceurl = $data['invoiceURL'];
        return redirect($inviceurl);
    }
    private function getPayLoadData_cart($orderid=null,$session_id,$donation_amount,$donor_name=null,$donor_phone=null,$donor_email=null) {
        $callbackURL = route('myfatoorah.callback_cart',app()->getLocale());
        
        return [
            'UserDefinedField'       => $session_id,
            'CustomerName'       => $donor_name,
            'InvoiceValue'       => $donation_amount,
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => $donor_email,
            'CallBackUrl'        => $callbackURL,
            'ErrorUrl'           => $callbackURL,
            'CustomerMobile'     => $donor_phone,
            'Language'           => 'en',
            'CustomerReference'  => $orderid,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];
    }
     public function callback_cart() {
        try {
            $paymentId = request('paymentId');
            $data      = $this->mfObj->getPaymentStatus($paymentId, 'PaymentId');
            
            if ($data->InvoiceStatus == 'Paid') {
			  $user = Auth::user();
			  $user_id = Auth::id();
			  $session_id = $data->UserDefinedField;
			  $allcartdata = session()->get('cart');
			
			if(session('cart'))
			{
              foreach(session('cart') as $id => $details)
              {
					
					$project_id = $id;
					
					/* get data from project table */
					$project_details = DB::table('tbl_projects')
					->join('project_type', 'tbl_projects.project_type', '=', 'project_type.id')
					->join('category', 'tbl_projects.project_category', '=', 'category.id')
					->select('tbl_projects.*', 'project_type.type', 'category.title')
					->where('tbl_projects.project_id','=',$project_id)
					->get()->first();
					
					/* insert data from transaction table */	
					$insert_id = DB::table('transaction')->insert([

					        'session_id' => $session_id ,
							'user_id' => $user_id ,
							'user_name' => $data->CustomerName,
							'user_email' => $data->CustomerEmail,
							'user_phone' => $data->CustomerMobile,			  
							'p_type' => $project_details->type,
							'category' => $project_details->title,
							'p_name' => $project_details->project_name,
							'p_code' => $project_details->project_code,
							'p_id' => $project_details->project_id,
							'invoice_id' => $data->InvoiceId,
							'transactionId' => $data->InvoiceTransactions[0]->TransactionId ,
							'paymentId' => $data->InvoiceTransactions[0]->PaymentId ,
							'refId' => $data->InvoiceTransactions[0]->ReferenceId ,
							'pay_type' => $data->InvoiceTransactions[0]->PaymentGateway ,
							'donate_amount' => $details['price'] ,
							'TotalServiceCharge' =>$data->InvoiceTransactions[0]->TotalServiceCharge,
							'VatAmount' =>$data->InvoiceTransactions[0]->VatAmount ,
							'transactionStatus' =>$data->InvoiceTransactions[0]->TransactionStatus ,
							'qtyval' => $details['quantity'],
							'payment_status' => $data->InvoiceStatus,
								
						]);
						
						$insertId = DB::getPdo()->lastInsertId();  
						
						/* update doneted amount in project table */
						$total_doneted = $project_details->donated + $details['price'];
						$affected = DB::table('tbl_projects')
					  ->where('project_id', $project_id)
					  ->update(['donated' => $total_doneted]);
		           }
		      }
				
              return redirect(app()->getLocale().'/knet/knet_cart_success/'.$session_id)->with(['invoice_success' => 'Invoice is paid.']);
                 
            } else if ($data->InvoiceStatus == 'Failed') {  
				
				
			 $user = Auth::user();
			 $user_id = Auth::id();
			 $allcartdata = session()->get('cart');
			 $session_id = $data->UserDefinedField;
			
			if(session('cart'))
			{
              foreach(session('cart') as $id => $details)
              {
					
					 $project_id = $id;
					
					/* get data from project table */
					$project_details = DB::table('tbl_projects')
					->join('project_type', 'tbl_projects.project_type', '=', 'project_type.id')
					->join('category', 'tbl_projects.project_category', '=', 'category.id')
					->select('tbl_projects.*', 'project_type.type', 'category.title')
					->where('tbl_projects.project_id','=',$project_id)
					->get()->first();
					
					/* insert data from transaction table */	
					$insert_id = DB::table('transaction')->insert([

					        'session_id' => $session_id ,
							'user_id' => $user_id ,
							'user_name' => $data->CustomerName,
							'user_email' => $data->CustomerEmail,
							'user_phone' => $data->CustomerMobile,			  
							'p_type' => $project_details->type,
							'category' => $project_details->title,
							'p_name' => $project_details->project_name,
							'p_code' => $project_details->project_code,
							'p_id' => $project_details->project_id,
							'invoice_id' => $data->InvoiceId,
							'transactionId' => $data->InvoiceTransactions[0]->TransactionId ,
							'paymentId' => $data->InvoiceTransactions[0]->PaymentId ,
							'refId' => $data->InvoiceTransactions[0]->ReferenceId ,
							'pay_type' => $data->InvoiceTransactions[0]->PaymentGateway ,
							'donate_amount' => $details['price'] ,
							'TotalServiceCharge' =>$data->InvoiceTransactions[0]->TotalServiceCharge,
							'VatAmount' =>$data->InvoiceTransactions[0]->VatAmount ,
							'transactionStatus' =>$data->InvoiceTransactions[0]->TransactionStatus ,
							'qtyval' => $details['quantity'],
							'payment_status' => $data->InvoiceStatus,
								
						]);
						
						$insertId = DB::getPdo()->lastInsertId();  
						
						/* update doneted amount in project table */
						$total_doneted = $project_details->donated + $details['price'];
						$affected = DB::table('tbl_projects')
					  ->where('project_id', $project_id)
					  ->update(['donated' => $total_doneted]);
		           }
		       }
				
				return redirect(app()->getLocale().'/knet/knet_cart_error/'.$session_id)->withErrors(['invoice_error' =>'Invoice is not paid due to ' . $data->InvoiceError]);
              
            } else if ($data->InvoiceStatus == 'Expired') {
				
				return redirect(app()->getLocale().'/knet/knet_cart_expired',)->withErrors(['invoice_error' =>'Invoice is expired.']);
            }
            
        } catch (\Exception $e) {
            $response = ['IsSuccess' => 'false', 'Message' => $e->getMessage()];
        }
        return response()->json($response);
    }
    public function knet_cart_success(Request $request,$local,$ID)
    {
		$cart = session()->get('cart');
		if(isset($cart)) {
			unset($cart);
			session()->forget('cart');
		}
		
	   $id = $ID;
	   $transactionall = DB::table('transaction')->where('session_id','=',$id)->get();	
	   $transaction  = DB::table('transaction')->where('session_id','=',$id)->get()->first();
	   
	   $total_donate = DB::table('transaction')->where('session_id','=',$id)->sum('transaction.donate_amount');	
	   
	    
	   return View::make('en.pages.payment_invoice_cart', compact('transaction','transactionall','total_donate'));
	  
	}
	public function knet_cart_error(Request $request,$local,$ID)
    {
		
	   $id =$ID;
	   $transactionall = DB::table('transaction')->where('session_id','=',$id)->get();	
	   $transaction  = DB::table('transaction')->where('session_id','=',$id)->get()->first();	
	   $total_donate = DB::table('transaction')->where('session_id','=',$id)->sum('transaction.donate_amount');	
	  
	   return View::make('en.pages.payment_invoice_cart', compact('transaction','transactionall','total_donate'));
	}
	public function knet_cart_expired()
    {
		
		
	}
	
	/* for recurring payment */
	public function emmbedded_session()
	{
		$orderid = random_int(100000, 999999);
		$alldata = $this->mfObj->getEmbeddedSession($orderid);
		$session_id =$alldata->SessionId;
		$CountryCode =$alldata->CountryCode;
		
		return View::make('en.pages.cardviewreccuring', compact('session_id','CountryCode'));
	}
	public function recurring_request(Request $request) {
		
		$orderid = random_int(100000, 999999);
		$project_id =$request->project_id;
		$donation_amount =$request->donation_amount;
		$donor_name =$request->donor_name;
		$donor_phone =$request->donor_phone;
		$donor_email =$request->donor_email;
		$paymentMethodId =$request->paymentmethode_id;
		$intervalDays =$request->intervalDays;
		$sessionId =$request->sessionId;
		
		
		$cardInfo = [
			'PaymentType' => 'card',
			'Bypass3DS'   => false,
			'Card'        => [
				'Number'        => $request->cardnumber,
				'ExpiryMonth'    => $request->expiry_month,
				'ExpiryYear'     => $request->expiry_year,
				'SecurityCode'   => $request->cvc_code,
				'CardHolderName' => $request->card_owner
			]
		];
	
	             
	
	
        try {
		
       $data   = $this->mfObj->directPayment($this->getPayLoadData_recurring($orderid,$project_id,$donation_amount,$donor_name,$donor_phone,$donor_email,$intervalDays), $paymentMethodId,$cardInfo,$orderid);
       
        } catch (\Exception $e) {
            return response()->json(['IsSuccess' => 'false', 'Message' => $e->getMessage()]);
        }
        
        
        $inviceurl = $data['invoiceURL'];
        
       
        return redirect($inviceurl);
    }
    private function getPayLoadData_recurring($orderid=null,$project_id,$donation_amount,$donor_name=null,$donor_phone=null,$donor_email=null,$intervalDays) {
        $callbackURL = route('myfatoorah.callback_recurring',app()->getLocale());
        
        return [
            'UserDefinedField'       => $project_id,
            'CustomerName'       => $donor_name,
            'InvoiceValue'       => $donation_amount,
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => $donor_email,
            'CallBackUrl'        => $callbackURL,
            'ErrorUrl'           => $callbackURL,
            'CustomerMobile'     => $donor_phone,
            'Language'           => 'en',
            'CustomerReference'  => $orderid,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION,
				'RecurringModel'  => [
				'RecurringType' => 'Custom',
				'IntervalDays'  => $intervalDays,
				'Iteration'     => 1
			],
        ];
    }
    public function callback_recurring() {
        try {
            $paymentId = request('paymentId');
            $data      = $this->mfObj->getPaymentStatus($paymentId, 'PaymentId');
            
         
            if ($data->InvoiceStatus == 'Paid') {
			
			  $user = Auth::user();
			  $user_id = Auth::id();
			
			$project_id = $data->UserDefinedField;
			
            /* get data from project table */
			$project_details = DB::table('tbl_projects')
            ->join('project_type', 'tbl_projects.project_type', '=', 'project_type.id')
            ->join('category', 'tbl_projects.project_category', '=', 'category.id')
            ->select('tbl_projects.*', 'project_type.type', 'category.title')
            ->where('tbl_projects.project_id','=',$project_id)
            ->get()->first();
            
			/* insert data from transaction table */	
			$insert_id = DB::table('transaction')->insert([
			        'session_id'=> $data->CustomerReference ,
			        'user_id' => $user_id ,
			        'user_name' => $data->CustomerName,
			        'user_email' => $data->CustomerEmail,
			        'user_phone' => $data->CustomerMobile,			  
					'p_type' => $project_details->type,
					'category' => $project_details->title,
					'p_name' => $project_details->project_name,
					'p_code' => $project_details->project_code,
					'p_id' => $project_details->project_id,
					'invoice_id' => $data->InvoiceId,
					'transactionId' => $data->InvoiceTransactions[0]->TransactionId ,
					'paymentId' => $data->InvoiceTransactions[0]->PaymentId ,
					'refId' => $data->InvoiceTransactions[0]->ReferenceId ,
					'pay_type' => $data->InvoiceTransactions[0]->PaymentGateway ,
					'donate_amount' =>$data->InvoiceTransactions[0]->TransationValue ,
					'TotalServiceCharge' =>$data->InvoiceTransactions[0]->TotalServiceCharge,
					'VatAmount' =>$data->InvoiceTransactions[0]->VatAmount ,
					'transactionStatus' =>$data->InvoiceTransactions[0]->TransactionStatus ,
					'qtyval' => 1,
					'payment_status' => $data->InvoiceStatus,
						
				]);
				
				$insertId = DB::getPdo()->lastInsertId();  
				
				/* update doneted amount in project table */
				$total_doneted = $project_details->donated + $data->InvoiceTransactions[0]->TransationValue;
				$affected = DB::table('tbl_projects')
              ->where('project_id', $project_id)
              ->update(['donated' => $total_doneted]);
				
              return redirect(app()->getLocale().'/knet/knet_success/'.encrypt($insertId))->with(['invoice_success' => 'Invoice is paid.']);
                 
            } else if ($data->InvoiceStatus == 'Failed') {  
				
				$project_id = $data->UserDefinedField;
				
				$user = Auth::user();
			    $user_id = Auth::id();
            
            /* get data from project table */
			$project_details = DB::table('tbl_projects')
            ->join('project_type', 'tbl_projects.project_type', '=', 'project_type.id')
            ->join('category', 'tbl_projects.project_category', '=', 'category.id')
            ->select('tbl_projects.*', 'project_type.type', 'category.title')
            ->where('tbl_projects.project_id','=',$project_id)
            ->get()->first();
            
			/* insert data from transaction table */	
			$insert_id = DB::table('transaction')->insert([
			        'session_id'=> $data->CustomerReference ,
			        'user_id' => $user_id ,
			        'user_name' => $data->CustomerName,
			        'user_email' => $data->CustomerEmail,
			        'user_phone' => $data->CustomerMobile,
					'p_type' => $project_details->type,
					'category' => $project_details->title,
					'p_name' => $project_details->project_name,
					'p_code' => $project_details->project_code,
					'p_id' => $project_details->project_id,
					'invoice_id' => $data->InvoiceId,
					'transactionId' => $data->InvoiceTransactions[0]->TransactionId ,
					'paymentId' => $data->InvoiceTransactions[0]->PaymentId ,
					'refId' => $data->InvoiceTransactions[0]->ReferenceId ,
					'pay_type' => $data->InvoiceTransactions[0]->PaymentGateway ,
					'donate_amount' =>$data->InvoiceTransactions[0]->TransationValue ,
					'TotalServiceCharge' =>$data->InvoiceTransactions[0]->TotalServiceCharge,
					'VatAmount' =>$data->InvoiceTransactions[0]->VatAmount ,
					'transactionStatus' =>$data->InvoiceTransactions[0]->TransactionStatus ,
					'qtyval' => 1,
					'payment_status' => $data->InvoiceStatus,
						
				]);
				
				$insertId = DB::getPdo()->lastInsertId();
				
					/* update residual amount in project table */
				$total_residual = $project_details->residual + $data->InvoiceTransactions[0]->TransationValue;
				$affected = DB::table('tbl_projects')
              ->where('project_id', $project_id)
              ->update(['residual' => $total_residual]);
				
				return redirect(app()->getLocale().'/knet/knet_error/'.encrypt($insertId))->withErrors(['invoice_error' =>'Invoice is not paid due to ' . $data->InvoiceError]);
              
            } else if ($data->InvoiceStatus == 'Expired') {
				
				return redirect(app()->getLocale().'/knet/knet_expired',)->withErrors(['invoice_error' =>'Invoice is expired.']);
            }
            
        } catch (\Exception $e) {
            $response = ['IsSuccess' => 'false', 'Message' => $e->getMessage()];
        }
        return response()->json($response);
    }

	
	
	/*fast donation */
	public function fastdonation_request(Request $request) {
		
		$orderid = random_int(100000, 999999);
		$project_id =$request->fastdonation_project_id;
		$donation_amount =$request->fastdonation_amount;
		$donor_name ='';
		$donor_phone ='';
		$donor_email ='';
		$paymentMethodId =$request->fastdonation_paymentmethode_id;

        try {
            $data   = $this->mfObj->getInvoiceURL($this->getPayLoadData_fastdonate($orderid,$project_id,$donation_amount,$donor_name,$donor_phone,$donor_email), $paymentMethodId);
       
        } catch (\Exception $e) {
            return response()->json(['IsSuccess' => 'false', 'Message' => $e->getMessage()]);
        }
        
        $inviceurl = $data['invoiceURL'];
        return redirect($inviceurl);
    }
    private function getPayLoadData_fastdonate($orderid=null,$project_id,$donation_amount,$donor_name=null,$donor_phone=null,$donor_email=null) {
        $callbackURL = route('myfatoorah.callback',app()->getLocale());
        
        return [
            'UserDefinedField'       => $project_id,
            'CustomerName'       => $donor_name,
            'InvoiceValue'       => $donation_amount,
            'DisplayCurrencyIso' => 'KWD',
            //'CustomerEmail'      => $donor_email,
            'CallBackUrl'        => $callbackURL,
            'ErrorUrl'           => $callbackURL,
            'CustomerMobile'     => $donor_phone,
            'Language'           => 'en',
            'CustomerReference'  => $orderid,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];
    }
    
    public function dedication_request(Request $request) {
		
		$orderid = random_int(100000, 999999);
		$project_id =$request->project_id;
		$donation_amount =$request->donation_amount;
		$sender_name = $request->donor_name;
		$donor_name =$request->recipient_name;
		$donor_phone =$request->recipient_number;
		$donor_email =$request->recipient_email;
		$paymentMethodId =$request->paymentmethode_id;
		$GiftDonationTemplateId =$request->GiftDonationTemplateId;

        try {
		
            $data   = $this->mfObj->getInvoiceURL($this->getPayLoadData_dedication($orderid,$project_id,$donation_amount,$donor_name,$donor_phone,$donor_email,$sender_name,$GiftDonationTemplateId), $paymentMethodId);
       
        } catch (\Exception $e) {
            return response()->json(['IsSuccess' => 'false', 'Message' => $e->getMessage()]);
        }
        
        $inviceurl = $data['invoiceURL'];
        return redirect($inviceurl);
    }
     private function getPayLoadData_dedication($orderid=null,$project_id,$donation_amount,$donor_name=null,$donor_phone=null,$donor_email=null,$sender_name,$GiftDonationTemplateId) {
        $callbackURL = route('myfatoorah.dedication_callback',app()->getLocale());
        
        return [
            'UserDefinedField'       => $project_id.'--'.$sender_name.'--'.$GiftDonationTemplateId,
            'CustomerName'       => $donor_name,
            'InvoiceValue'       => $donation_amount,
            'DisplayCurrencyIso' => 'KWD',
            'CustomerEmail'      => $donor_email,
            'CallBackUrl'        => $callbackURL,
            'ErrorUrl'           => $callbackURL,
            'CustomerMobile'     => $donor_phone,
            'Language'           => 'en',
            'CustomerReference'  => $orderid,
            'SourceInfo'         => 'Laravel ' . app()::VERSION . ' - MyFatoorah Package ' . MYFATOORAH_LARAVEL_PACKAGE_VERSION
        ];
    }
     public function dedication_callback() {
        try {
            $paymentId = request('paymentId');
            $data      = $this->mfObj->getPaymentStatus($paymentId, 'PaymentId');
            if ($data->InvoiceStatus == 'Paid') {
			
			  $user = Auth::user();
			  $user_id = Auth::id();
			  
			$UserDefinedField =   explode('--',$data->UserDefinedField);
			
			$project_id = $UserDefinedField[0];
			$sender_name = $UserDefinedField[1];
			$GiftDonationTemplateId = $UserDefinedField[2];
			
            /* get data from project table */
			$project_details = DB::table('tbl_projects')
            ->join('project_type', 'tbl_projects.project_type', '=', 'project_type.id')
            ->join('category', 'tbl_projects.project_category', '=', 'category.id')
            ->select('tbl_projects.*', 'project_type.type', 'category.title')
            ->where('tbl_projects.project_id','=',$project_id)
            ->get()->first();
            
			/* insert data from transaction table */	
			$insert_id = DB::table('transaction')->insert([
			        'session_id'=> $data->CustomerReference ,
			        'user_id' => $user_id ,
			        'user_name' => $data->CustomerName,
			        'user_email' => $data->CustomerEmail,
			        'user_phone' => $data->CustomerMobile,			  
					'p_type' => $project_details->type,
					'category' => $project_details->title,
					'p_name' => $project_details->project_name,
					'p_code' => $project_details->project_code,
					'p_id' => $project_details->project_id,
					'invoice_id' => $data->InvoiceId,
					'transactionId' => $data->InvoiceTransactions[0]->TransactionId ,
					'paymentId' => $data->InvoiceTransactions[0]->PaymentId ,
					'refId' => $data->InvoiceTransactions[0]->ReferenceId ,
					'pay_type' => $data->InvoiceTransactions[0]->PaymentGateway ,
					'donate_amount' =>$data->InvoiceTransactions[0]->TransationValue ,
					'TotalServiceCharge' =>$data->InvoiceTransactions[0]->TotalServiceCharge,
					'VatAmount' =>$data->InvoiceTransactions[0]->VatAmount ,
					'transactionStatus' =>$data->InvoiceTransactions[0]->TransactionStatus ,
					'qtyval' => 1,
					'payment_status' => $data->InvoiceStatus,
						
				]);
				
				$insertId = DB::getPdo()->lastInsertId();  
				
				/* update doneted amount in project table */
				$total_doneted = $project_details->donated + $data->InvoiceTransactions[0]->TransationValue;
				$affected = DB::table('tbl_projects')
              ->where('project_id', $project_id)
              ->update(['donated' => $total_doneted]);
              
              /* send giftcard to dedication*/
              $giftcards =  DB::table('tbl_giftcard')->where('id','=',$GiftDonationTemplateId)->get()->first();
		      $image=$giftcards->image;
		      $recipient_name =$data->CustomerName;
		      $sender_name = $sender_name;
		      $recipient_email = $data->CustomerEmail;
		      
		     
              
              if(app()->getLocale() == 'ar'){ 
				   Mail::send('ar.pages.email.giftpreview', ['recipient_name' =>$recipient_name,'sender_name'=>$sender_name,'image'=>$image], function($message) use($recipient_email){
					  $message->to($recipient_email);
					  $message->subject('Giftcard');
				  });
		      }
		      else{
				  Mail::send('en.pages.email.giftpreview', ['recipient_name' => $recipient_name,'sender_name'=>$sender_name,'image'=>$image], function($message) use($recipient_email){
					  $message->to($recipient_email);
					  $message->subject('Giftcard');
				  }); 
				  
				  }
                
				
              return redirect(app()->getLocale().'/knet/dedication_success/'.encrypt($insertId))->with(['invoice_success' => 'Invoice is paid.']);
                 
            } else if ($data->InvoiceStatus == 'Failed') {  
				
				$project_id = $data->UserDefinedField;
				
				$user = Auth::user();
			    $user_id = Auth::id();
            
            /* get data from project table */
			$project_details = DB::table('tbl_projects')
            ->join('project_type', 'tbl_projects.project_type', '=', 'project_type.id')
            ->join('category', 'tbl_projects.project_category', '=', 'category.id')
            ->select('tbl_projects.*', 'project_type.type', 'category.title')
            ->where('tbl_projects.project_id','=',$project_id)
            ->get()->first();
            
			/* insert data from transaction table */	
			$insert_id = DB::table('transaction')->insert([
			        'session_id'=> $data->CustomerReference ,
			        'user_id' => $user_id ,
			        'user_name' => $data->CustomerName,
			        'user_email' => $data->CustomerEmail,
			        'user_phone' => $data->CustomerMobile,
					'p_type' => $project_details->type,
					'category' => $project_details->title,
					'p_name' => $project_details->project_name,
					'p_code' => $project_details->project_code,
					'p_id' => $project_details->project_id,
					'invoice_id' => $data->InvoiceId,
					'transactionId' => $data->InvoiceTransactions[0]->TransactionId ,
					'paymentId' => $data->InvoiceTransactions[0]->PaymentId ,
					'refId' => $data->InvoiceTransactions[0]->ReferenceId ,
					'pay_type' => $data->InvoiceTransactions[0]->PaymentGateway ,
					'donate_amount' =>$data->InvoiceTransactions[0]->TransationValue ,
					'TotalServiceCharge' =>$data->InvoiceTransactions[0]->TotalServiceCharge,
					'VatAmount' =>$data->InvoiceTransactions[0]->VatAmount ,
					'transactionStatus' =>$data->InvoiceTransactions[0]->TransactionStatus ,
					'qtyval' => 1,
					'payment_status' => $data->InvoiceStatus,
						
				]);
				
				$insertId = DB::getPdo()->lastInsertId();
				
					/* update residual amount in project table */
				$total_residual = $project_details->residual + $data->InvoiceTransactions[0]->TransationValue;
				$affected = DB::table('tbl_projects')
              ->where('project_id', $project_id)
              ->update(['residual' => $total_residual]);
				
				return redirect(app()->getLocale().'/knet/dedication_error/'.encrypt($insertId))->withErrors(['invoice_error' =>'Invoice is not paid due to ' . $data->InvoiceError]);
              
            } else if ($data->InvoiceStatus == 'Expired') {
				
				return redirect(app()->getLocale().'/knet/dedication_expired',)->withErrors(['invoice_error' =>'Invoice is expired.']);
            }
            
        } catch (\Exception $e) {
            $response = ['IsSuccess' => 'false', 'Message' => $e->getMessage()];
        }
        return response()->json($response);
    }
    public function dedication_success($local,$ID)
    {
	   $id = decrypt($ID);
	   $transaction = DB::table('transaction')->where('id','=',$id)->get()->first();	
	    
	   return View::make('en.pages.payment_invoice', compact('transaction'));
	  
	}
	public function dedication_error($local,$ID)
    {
	    $id = decrypt($ID);
	   $transaction = DB::table('transaction')->where('id','=',$id)->get()->first();	
	  
	   return View::make('en.pages.payment_invoice', compact('transaction'));
	}
	public function dedication_expired()
    {
		
		
	}


//-----------------------------------------------------------------------------------------------------------------------------------------
}
