@forelse ($charitydeductionprojects as $key => $charitydeductionproject) 
                <div class="col-md-4 ">
		        <input type="hidden" name="project_id_{{$key}}" id="project_id_{{$key}}" value="{{$charitydeductionproject->project_id}}">
                <!-- -------- Panel Start-------->
                <div class="panel mt-3">
                    <div class="card" style="width: auto ;">
                    <a href="{{route('choosecharityDonation',[app()->getLocale(),$charitydeductionproject->project_code ] )}}">
                       <img src="../uploads/projectimage/{{ $charitydeductionproject->image }}" class="card-img-top d-block w-100 " alt="...">
                    </a>
                        <div class="card-body">
                        <a href="{{route('choosecharityDonation',[app()->getLocale(), $charitydeductionproject->project_code ] )}}">
                            <h6 class=" mt-1 card-title"> {{ $charitydeductionproject->project_name }} </h6>
                        </a>
                            
                            <h6 class="CLR text-center mt-3">Project Type :</h6>
                            <div class="row">
                            <div class="col-md-12">
                                <select class="form-select f-14" name="sponsorshipfor_{{$key}}" name="sponsorshipfor_{{$key}}" aria-label="Default select example">
                                    <option selected>Orphans sponsorship</option>
                                    <option value="1">Well drilling</option>
                                    <option value="2">General donation</option>
                                    <option value="3">Episodes of the Holy Quran</option>
                                    <option value="4">Building mosques</option>
                                    <option value="5">Righteousness and goodness</option>
                                    <option value="6">invitation to non-Muslims</option>
                                </select>
                            </div>
                            </div>
    
                            <div class="row mt-3 wiseBtn">   
                            <h6 class="CLR text-center mt-1"> Your account will be debited for :</h6>
                                  <div class="col-3 p-0"><button type="button" id="6_month_{{$key}}" data-interval_{{$key}}="180" class="btn w-100 BTN-2 active rounded-0 intervaldays_{{$key}}" onclick="showmontedata({{$key}},'6_month_{{$key}}')">6 MONTHS</button></div>
								   <div class="col-3 p-0"><button type="button" id="3_month_{{$key}}" data-interval_{{$key}}="90"  class="btn w-100 BTN-2 rounded-0 intervaldays_{{$key}}" onclick="showmontedata({{$key}},'3_month_{{$key}}')">3 MONTHS</button></div>
								   <div class="col-3 p-0"><button type="button" id="2_month_{{$key}}" data-interval_{{$key}}="60" class="btn w-100 BTN-2 rounded-0 intervaldays_{{$key}}" onclick="showmontedata({{$key}},'2_month_{{$key}}')">2 MONTHS</button></div>
								   <div class="col-3 p-0"><button type="button" id="month_{{$key}}" data-interval_{{$key}}="30" class="btn w-100 BTN-2 rounded-0 intervaldays_{{$key}}" onclick="showmontedata({{$key}},'month_{{$key}}')">MONTH</button></div>
										</div>
										
							 <input type="hidden" name="intervalDays_{{$key}}" id="intervalDays_{{$key}}" value="180">
                            
                          <div class="row text-center mt-3">
                            <div class="d-flex">
                                <div class="value-button decreaseBtn" id="decrease" onclick="decreaseValue('charitydeductionproject_number_{{$key}}',{{ number_format($charitydeductionproject->project_price) }})" value="Decrease Value">-</div> 
                                  <input type="number" class="number" id="charitydeductionproject_number_{{$key}}" value="{{ number_format($charitydeductionproject->project_price) }}"/>
                                <div class="value-button increaseBtn" id="increase" onclick="increaseValue('charitydeductionproject_number_{{$key}}',{{ number_format($charitydeductionproject->project_price) }})" value="Increase Value">+</div> 
                            </div>
                        </div>
                
                            <div class="row mt-3">   
                            <div class="col-12"><button type="button" class="btn w-100 BTN-1" onclick="opencardmodal({{$key}})"                                                          >DONATE NOW <i class="fa-solid fa-money-bill-wave"></i></button></div>
                            </div>
                        
                        </div>
                    </div>
                </div>
                <!-- -------- Panel End---------->
                </div>
                  @empty
				   <p>No Projects</p>
				  @endforelse
					

<!-- Modal -->
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
			  <form id="deductionform" name="deductionform" class="forms-sample" method="POST" action="{{ route('myfatoorah.recurring_request',app()->getLocale())}}">
            @csrf	
            <div class="modal-content">
			
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="text-center heaD">
                  <h5 class="">Payment data</h5>
                  <img src="../assets/img/vm.png">
                </div>
                <div class="Payment_form">
                  <div class="row mt-4 ">
                    <label class="form-label text-center">card number</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                      <input type="number" class="form-control login_email" required maxlength="16"  name="cardnumber" id="cardnumber"  placeholder="Enter the card number">
                    </div>
                  </div>
                  <div class="row mt-1 ">
                    <label class="form-label text-center">Expiry date</label>
                    <div class="col-md-6">
                      <input type="number" class="form-control login_email" required maxlength="2"  name="expiry_year" id="expiry_year"  placeholder="the year">
                    </div>
                    <div class="col-md-6">
                      <input type="number" class="form-control login_email" required maxlength="2" name="expiry_month" id="expiry_month"   placeholder="the month">
                    </div>
                  </div>
                  <div class="row mt-1 ">
                    <label class="form-label text-center">CVC CODE</label>
                    <div class="col-md-12">
                      <input type="number" class="form-control login_email" required maxlength="3" name="cvc_code" id="cvc_code"  placeholder="CVC">
                    </div>
                  </div>
                  <div class="row mt-1 ">
                    <label class="form-label text-center">Card owner</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control login_email" required name="card_owner" id="card_owner"   placeholder="Card Owner Name">
                    </div>
                  </div>
                   <div class="row mt-1 ">
                    <label class="form-label text-center">Donor name</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control login_email"  name="donor_name" id="donor_name"   placeholder="Donor name">
                    </div>
                  </div>
                  <div class="row mt-1 ">
                    <label class="form-label text-center">Email</label>
                    <div class="col-md-12">
                      <input type="email" class="form-control login_email" id="donor_email" name="donor_email"   placeholder="Email">
                    </div>
                  </div>
                  <div class="row mt-1 ">
                    <label class="form-label text-center">Phone number</label>
                    <div class="col-md-12">
                      <input type="text" class="form-control login_email"  id="donor_phone" name="donor_phone"   placeholder="Phone Number">
                      
                       <input type="hidden" class="form-control login_email"  id="intervalDays" name="intervalDays"   placeholder="Email Or Phone Number">
                       <input type="hidden" class="form-control login_email"  id="sponsorshipfor" name="sponsorshipfor"   placeholder="Email Or Phone Number">
                       <input type="hidden" class="form-control login_email"  id="donation_amount" name="donation_amount"   placeholder="Email Or Phone Number">
                       <input type="hidden" name="project_id" id="project_id" >
                        <input type="hidden" id="myCheckbox1" name="paymentmethode_id" value="20"  />
                    </div>
                  </div>

                </div>
                
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn BTN-1 w-100">Donate Now</button>
              </div>
           
            </div>
             </form>
          </div>
        </div>

<!-- ====================== Projects Section End ===================== -->

<script type="text/javascript">
 
   function showmontedata(key,id)
   {
			$(".intervaldays_"+key).removeClass('active');
			
			
			$("#"+id).addClass('active');
			var ele = $("#"+id).data('interval_'+key);
			
			$('#intervalDays_'+key).val(ele);
	  
   }
   function opencardmodal(key)
   {
	   var sponsorshipfor = $('#sponsorshipfor_'+key).val();
	   var intervalDays = $('#intervalDays_'+key).val();
	   var donation_amount = $('#charitydeductionproject_number_'+key).val();
	   var project_id = $('#project_id_'+key).val();
	   
	   $('#sponsorshipfor').val(sponsorshipfor);
	   $('#intervalDays').val(intervalDays);
	   $('#donation_amount').val(donation_amount);
	   $('#project_id').val(project_id);
	   
	   $('#exampleModal3').modal('show');
	   
	   
   }
  
</script>
