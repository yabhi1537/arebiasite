@extends('en.layouts.default')

@section('content')
<!-- =================== Side wrapper donation start=============== -->
  <section id="user_profile" class="user_profile ">
    <div class="sectionHeading my-5 d-flex">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-5 ">
                    <h5 class="">User Profile</h5>
                </div>
                <div class="col-7 ">
                    <button type="button" class="btn add_wallet_btn position-relative float-end" data-bs-toggle="modal" data-bs-target="#exampleModal10">
                      Add Wallet
                    </button>
                    <button type="button" class="btn position-relative wallet_btn float-end">
                        <i class="fa-solid fa-wallet"></i><span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">+{{ $userdata->wallet_balance }} </span>
                    </button>
                </div>
            </div>
        </div>
            <!-- Modal -->
                    <div class="modal fade" id="exampleModal10" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
					<form autocomplete="off" id="donationform" name="donationform" class="forms-sample" method="POST" action="{{ route('myfatoorah.addwallet_request',app()->getLocale())}}">	
					@csrf	
                          <div class="modal-header">
                           
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="section_BG">
                              <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Add Wallet</h1>
                               <div class="text-center">
                                 <img src="../assets/img/vm.png" alt="">
                               </div>
                            </div>
                            <div class="mb-3 mt-3">
                              <label class="form-label">Amount</label>
                              <input type="number" class="form-control" required id="walletamount" name="walletamount" >
                            </div>

                            <div class="row mt-3 donar_detailCheckbox">
                              <p class="panel_titleDetail mb-1" style="font-size: 16px; font-weight: 700; color: #6d6c6c;">Select payment method:</p>
                              <ul>
                                  <li>
                                    <input class="form-check-input" type="radio" name="paymentmethode_id" checked id="flexRadioDefault1" style="display: none;" value="1" >
                                    <label class="form-check-label" for="flexRadioDefault1"><img src="../assets/img/kn.png"/><span>KNET</span></label>
                                  </li>
                                  <li>
                                    <input class="form-check-input" type="radio" name="paymentmethode_id" id="flexRadioDefault2"  style="display: none;" value="2" >
                                    <label class="form-check-label" for="flexRadioDefault2"><img src="../assets/img/vm.png"/><span>VISA/MASTER</span></label>
                                  </li>
                              </ul>
                              
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center">
                            <div class="text-center">
                              <button type="submit" class="btn btn-green">Add Wallet</button>
                            </div>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
    </div>
    @if (Session::has('message'))
		 <div class="alert alert-success" role="alert">
			{{ Session::get('message') }}
		</div>
	@endif
	 @if(session('invoice_success'))
				<div class="alert alert-success">
				  {{ session('invoice_success') }}
				</div> 
			@endif
  
           @if(session('invoice_error'))
				<div class="alert alert-danger">
				{{ session('invoice_error') }}
				</div> 
			@endif
    <div class="container">
      <div class="row ">
          <div class="user_profile_List align-items-start">
            <div class="col-md-3 tabBox me-3">
              <div class="nav nav-pills user_profile_List_arange " id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-donationHistory-tab" data-bs-toggle="pill" data-bs-target="#v-pills-donationHistory" type="button" role="tab" aria-controls="v-pills-donationHistory" aria-selected="true">Donation History</button>
                <button class="nav-link" id="v-pills-recurringDonation-tab" data-bs-toggle="pill" data-bs-target="#v-pills-recurringDonation" type="button" role="tab" aria-controls="v-pills-recurringDonation" aria-selected="false">Recurring Donation</button>
                <button class="nav-link" id="v-pills-sharedLinks-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sharedLinks" type="button" role="tab" aria-controls="v-pills-sharedLinks" aria-selected="false">Shared Links</button>
                <button class="nav-link" id="v-pills-accountManagement-tab" data-bs-toggle="pill" data-bs-target="#v-pills-accountManagement" type="button" role="tab" aria-controls="v-pills-accountManagement" aria-selected="false">Account Management</button>
                <button class="nav-link" ><a href="{{ route('logout',app()->getLocale()) }}" >Sign Out</a></button>
              </div>
            </div>
            <div class="col-md-9 tabBox px-2 py-2">
             <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-donationHistory" role="tabpanel" aria-labelledby="v-pills-donationHistory-tab" tabindex="0">
                <!-- ================ -->
                <div class="table-responsive">
                 <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">P Type</th>
                        <th scope="col">P Name</th>
                        <th scope="col">Category</th>                     
                        <th scope="col">TransactionId</th>
                        <th scope="col">Pay Type</th>
                        <th scope="col">Donation</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created</th>
                      </tr>
                    </thead>
                    <tbody>
                              
                  @if(!$alluserdonation->isEmpty())
                    @php $i=1; @endphp
                    @foreach($alluserdonation as $tran)
                    <tr>
						<th scope="row">{{$i}}</th>
                        <td>
                            {{ $tran->p_type }}
                        </td>

                        <td>
                            {{ $tran->p_name }}
                        </td>
                        <td>
                            {{ $tran->category }}
                        </td>
                       
                        <td>
                            {{ $tran->transactionId }}
                        </td>
                        <td>
                            {{ $tran->pay_type }}
                        </td>
                         <td>
                            {{ number_format($tran->donate_amount,2) }} KD
                        </td>
                        <td>
                            {{ $tran->payment_status }}
                        </td>
                        <td>
                            {{ date('d-m-Y H:i:s', strtotime($tran->created_date)) }}
                        </td>
                      </tr>
                       @php $i++;@endphp
                      @endforeach
                    @else
                     <tr><td colspan="8"> Note : Transaction Is Empty ?.</td></tr>
                    @endif
                    </tbody>
                  </table>
                </div>
                <!-- ================ -->
                </div>
                <div class="tab-pane fade" id="v-pills-recurringDonation" role="tabpanel" aria-labelledby="v-pills-recurringDonation-tab" tabindex="0">
                    <!-- ================ -->
                <div class="table-responsive">
                     <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">P Type</th>
                        <th scope="col">P Name</th>
                        <th scope="col">Category</th>                     
                        <th scope="col">TransactionId</th>
                        <th scope="col">Donation</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created</th>
                      </tr>
                    </thead>
                    <tbody>
                              
                  @if(!$alluserrecurring_donation->isEmpty())
                    @php $i=1; @endphp
                    @foreach($alluserrecurring_donation as $tran)
                    <tr>
						<th scope="row">{{$i}}</th>
                        <td>
                            {{ $tran->p_type }}
                        </td>

                        <td>
                            {{ $tran->p_name }}
                        </td>
                        <td>
                            {{ $tran->category }}
                        </td>
                       
                        <td>
                            {{ $tran->transactionId }}
                        </td>
                         <td>
                            {{ number_format($tran->donate_amount,2) }} KD
                        </td>
                        <td>
                            {{ $tran->payment_status }}
                        </td>
                        <td>
                            {{ date('d-m-Y H:i:s', strtotime($tran->created_date)) }}
                        </td>
                      </tr>
                       @php $i++;@endphp
                      @endforeach
                    @else
                     <tr><td  colspan="8"> Note : Recurring Transaction Is Empty ?.</td></tr>
                    @endif
                    </tbody>
                  </table>
                   </div>
                   <!-- ================ -->
                </div>
                <div class="tab-pane fade" id="v-pills-sharedLinks" role="tabpanel" aria-labelledby="v-pills-sharedLinks-tab" tabindex="0">
                    <!-- ================ -->
                <div class="table-responsive">
                    <table class="table">
                       <thead>
                         <tr>
                           <th scope="col">S.No</th>
                           <th scope="col">Link</th>
                           <th scope="col">Visitors</th>
                           <th scope="col">Total Donations</th>                      
                         </tr>
                       </thead>
                       <tbody>
						  @if(!$markertlinks->isEmpty())
                    @php $i=1; @endphp
                    @foreach($markertlinks as $tran)   
                         <tr>
                           <th scope="row">1</th>
                           <td>{{ $tran->generatelink }}</td>
                           <td>{{ $tran->visitors }}</td>
                           <td>{{ $tran->donations }} kwd</td>
                          
                         </tr>
                        @php $i++;@endphp
                      @endforeach
                    @else
                     <tr><td  colspan="8"> Note : Shared link Is Empty ?.</td></tr>
                    @endif
                         
                       </tbody>
                     </table>
                   </div>
                   <!-- ================ -->
                </div>
                <div class="tab-pane fade px-3 py-3" id="v-pills-accountManagement" role="tabpanel" aria-labelledby="v-pills-accountManagement-tab" tabindex="0">
                 <!-- ===================  -->
                 <form autocomplete="off" action="{{ route('updateuser-profile',app()->getLocale()) }}" method="post">	
			       @csrf
                    <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" disabled class="form-control" id="email"  name="email" value="{{$userdata->email}}">
                    </div>
                     <div class="mb-3">
                      <label class="form-label">Full Name</label>
                      <input type="text" class="form-control" id="full_name" name="full_name" value="{{$userdata->full_name}}" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Phone</label>
                      <input type="text" class="form-control" id="phone" name="phone" value="{{$userdata->phone}}" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label d-block">Newsletter</label>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="newsletter" id="newsletter1" value="1" {{ $userdata->newsletter == '1'  ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio1">Yes</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="newsletter" id="newsletter2" value="0" {{ $userdata->newsletter == '0'  ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio2">No</label>
                      </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{$userdata->address}}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-green">Update</button>
                    </div>
                    </form>
                  
                    <h6 class="pb-2 pt-3">Change Password</h6>
                    <form autocomplete="off" action="{{ route('updateuser-password',app()->getLocale()) }}" method="post">	
			           @csrf
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="old_password" name="old_password">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-green">Change Password</button>
                        </div> 
                  </form>
                 <!-- ===================  -->
                </div>
                
             </div>
           </div>
          </div>
  
      </div>
    </div>
 </section>
  
 @stop

