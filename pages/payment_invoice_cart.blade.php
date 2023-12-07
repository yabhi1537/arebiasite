@extends('ar.layouts.default')

@section('content')
<style>
.user-profile{width: 82%;
    margin-left: 184px;
    margin-top:50px;
   }
</style>
      <!-- partial -->
      
		   @if(session('invoice_success'))
				<div class="alert alert-success">
				  {{ session('invoice_success') }}
				</div> 
			@endif
  
           @if(session('errors'))
				<div class="alert alert-danger">
				  {{session('errors')->first('invoice_error')}}
				</div> 
			@endif
  
          <div class="row user-profile" >
            <div class="col-lg-12 side-left  align-items-stretch">
              <div class="row">
                <div class="col-12 grid-margin stretch-card">
                  <div class="card">
             
                <div class="card">
                <div class="card-body">
                  <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">تفاصيل الفاتورة</h4>
                    <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-expanded="true">معرف فاتورة الدفع: {{$transaction->invoice_id}}</a>
                       
                      </li>
                     <li class="nav-item">
                         <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-expanded="true"> رقم المعاملة : {{$transaction->transactionId}}</a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security">المبلغ المتبرع به : {{ $total_donate}} د.ك </a>
                      </li>
                    </ul>
                  </div>
                  <div class="wrapper">
                    <hr>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info">
              <div class="form-group row ">
                <label for="exampleInputEmail2" class="col-sm-5 col-form-label">اسم الزبون</label>
                <div class="col-sm-7">
                  {{$transaction->user_name}}
                </div>
              </div>
              <div class="form-group row ">
                <label for="exampleInputEmail2" class="col-sm-5 col-form-label">البريد الإلكتروني للعميل</label>
                <div class="col-sm-7">
                  {{$transaction->user_email}}
                </div>
              </div>
              <div class="form-group row ">
                <label for="exampleInputEmail2" class="col-sm-5 col-form-label">هاتف العميل</label>
                <div class="col-sm-7">
                  {{$transaction->user_phone}}
                </div>
              </div>   
              <div class="form-group row">
				<label for="exampleInputPassword2" class="col-sm-5 col-form-label">إجمالي رسوم الخدمة</label>
				<div class="col-sm-7">
				 {{$transaction->TotalServiceCharge}} د.ك 
				</div>
			  </div>
			  <div class="form-group row">
				<label for="exampleInputPassword2" class="col-sm-5 col-form-label">إجمالي مبلغ ضريبة القيمة المضافة</label>
				<div class="col-sm-7">
				 {{$transaction->VatAmount}} د.ك 
				</div>
			  </div>
			  <div class="form-group row">
				<label for="exampleInputPassword2" class="col-sm-5 col-form-label">رقم المعاملة</label>
				<div class="col-sm-7">
				 {{$transaction->transactionId}} 
				</div>
			  </div>
			  <div class="form-group row">
				<label for="exampleInputPassword2" class="col-sm-5 col-form-label">حالة عملية</label>
				<div class="col-sm-7">
				 {{$transaction->transactionStatus}}
				</div>
			  </div>
			  <div class="form-group row">
				<label for="exampleInputPassword2" class="col-sm-5 col-form-label">حالة السداد</label>
				<div class="col-sm-7">
				 {{$transaction->payment_status}}
				</div>
			  </div>
			  <div class="form-group row">
				<label for="exampleInputPassword2" class="col-sm-5 col-form-label">تاريخ الدفع</label>
				<div class="col-sm-7">
				 {{$transaction->created_date}}
				</div>
			  </div>
                @foreach($transactionall as $id => $details)
                 <div class="row" style="border: 1px solid #ddcfcf;margin: 15px;">
					  <div class="form-group row ">
						<label for="exampleInputEmail2" class="col-sm-5 col-form-label">اسم المشروع</label>
						<div class="col-sm-7">
						  {{$details->p_name}}
						</div>
					  </div>
					   <div class="form-group row ">
						<label for="exampleInputEmail2" class="col-sm-5 col-form-label">رمز المشروع</label>
						<div class="col-sm-7">
						  {{$details->p_code}}
						</div>
					  </div>
					  <div class="form-group row">
						<label for="exampleInputPassword2" class="col-sm-5 col-form-label">نوع المشروع</label>
						<div class="col-sm-7">
						  {{$details->p_type}}
						</div>
					  </div>
					  
					  <div class="form-group row">
						<label for="exampleInputPassword2" class="col-sm-5 col-form-label">فئة المشروع</label>
						<div class="col-sm-7">
						 {{$details->category}}
						</div>
					  </div>
					   <div class="form-group row">
						<label for="exampleInputPassword2" class="col-sm-5 col-form-label">المبلغ المتبرع به</label>
						<div class="col-sm-7">
						 {{$details->donate_amount}} د.ك 
						</div>
					  </div>
					  
				 </div>
               @endforeach
               
                 
            
                      </div><!-- tab content ends -->
                     
                    </div>
                  </div>
                </div>
              </div>
                  </div>
                </div>
               
              </div>
            </div>
            <!-- ==================================================mobail======================================== -->
                  <div class="col-3" style="margin-left: 401px;
    margin-top: 10px;"><a href="{{ route('home',app()->getLocale())}}" class="btn w-100 BTN-1"> خلف</a></div>
      </div>
      
        

  @stop
