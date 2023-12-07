@extends('en.layouts.default')

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
                    <h4 class="card-title mb-0">Invioce Details</h4>
                    <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-expanded="true">Payment Invioce Id : {{$transaction->invoice_id}}</a>
                       
                      </li>
                     <li class="nav-item">
                         <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-expanded="true"> Transaction Id : {{$transaction->transactionId}}</a>
                      </li>
                       <li class="nav-item">
                        <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security"> Donated Amount : {{$transaction->donate_amount}} KD</a>
                      </li>
                    </ul>
                  </div>
                  <div class="wrapper">
                    <hr>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info">
              <div class="form-group row ">
                <label for="exampleInputEmail2" class="col-sm-5 col-form-label">Customer Name</label>
                <div class="col-sm-7">
                  {{$transaction->user_name}}
                </div>
              </div>
              <div class="form-group row ">
                <label for="exampleInputEmail2" class="col-sm-5 col-form-label">Customer Email</label>
                <div class="col-sm-7">
                  {{$transaction->user_email}}
                </div>
              </div>
              <div class="form-group row ">
                <label for="exampleInputEmail2" class="col-sm-5 col-form-label">Customer Phone</label>
                <div class="col-sm-7">
                  {{$transaction->user_phone}}
                </div>
              </div>   
              <div class="form-group row ">
                <label for="exampleInputEmail2" class="col-sm-5 col-form-label">Project Name</label>
                <div class="col-sm-7">
                  {{$transaction->p_name}}
                </div>
              </div>
               <div class="form-group row ">
                <label for="exampleInputEmail2" class="col-sm-5 col-form-label">Project Code</label>
                <div class="col-sm-7">
                  {{$transaction->p_code}}
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-5 col-form-label">Project Type</label>
                <div class="col-sm-7">
                  {{$transaction->p_type}}
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-5 col-form-label">Project Category</label>
                <div class="col-sm-7">
                 {{$transaction->category}}
                </div>
              </div>
               <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-5 col-form-label">Donated Amount</label>
                <div class="col-sm-7">
                 {{$transaction->donate_amount}} KD
                </div>
              </div>
               <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-5 col-form-label">Total ServiceCharge</label>
                <div class="col-sm-7">
                 {{$transaction->TotalServiceCharge}} KD
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-5 col-form-label">Total VatAmount</label>
                <div class="col-sm-7">
                 {{$transaction->VatAmount}} KD
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-5 col-form-label">Transaction Id</label>
                <div class="col-sm-7">
                 {{$transaction->transactionId}} 
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-5 col-form-label">Transaction Status</label>
                <div class="col-sm-7">
                 {{$transaction->transactionStatus}}
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-5 col-form-label">Payment Status</label>
                <div class="col-sm-7">
                 {{$transaction->payment_status}}
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputPassword2" class="col-sm-5 col-form-label">Payment DateTime</label>
                <div class="col-sm-7">
                 {{$transaction->created_date}}
                </div>
              </div>
            
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
    margin-top: 10px;"><a href="{{ route('home',app()->getLocale())}}" class="btn w-100 BTN-1"> Back</a></div>
      </div>
      
        

  @stop
