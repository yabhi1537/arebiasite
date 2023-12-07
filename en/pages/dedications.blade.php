@extends('en.layouts.default')

@section('content')


<!-- ====================== Section Start ===================== -->

<section id="giftDedication" class="container mt-5"> 
  <div class="giftDedication">
<form class="gift-form" method="post" id="giftdonation-form" autocomplete="off" action="{{ route('myfatoorah.dedication_request',app()->getLocale())}}">
	  @csrf
	<div class="container">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-auto">
                                <div class="message-error validation-summary-valid" data-valmsg-summary="true"><ul><li style="display:none"></li>
</ul></div>
                            </div>
                        </div>
                    </div>
    <div class="">
        <div class="row">
            <div class="col-2 col-sm-1">
                <div class="gift_headbox-1 p-1">
                    <h5 class="m-0 text-center" style="font-size: 26px; font-weight: 700; color: #f2f2f2;">1</h5>
                </div>
            </div>
            <div class="col-10 col-sm-11 p-0">
                <div class="gift_headbox-2 p-2 px-3">
                    <h5 class="m-0" style="font-size: 20px; font-weight: 700; color: #1a6b48;">Choose the project</h5>
                </div>
            </div>
          @forelse ($dedicationprojects as $key => $dedicationproject) 
            <div class="col-md-3">
                <div class="panel mt-4">
                    <div class="card" style="width: auto ;">
                        <a href="#">
                        <img src="../uploads/projectimage/{{ $dedicationproject->image }}" class="card-img-top d-block w-100" alt="...">
                        </a>
                        <div class="card-body">
                            <h6 class=" mt-1 card-title" style="font-size: 15px;"> {{ $dedicationproject->project_name }}</h6>
                            <div class="row text-center mt-3">
                                <div class="d-flex">
                                    <input type="number" class="number" id="donation-amount-{{ $dedicationproject->project_id}}" value="0" onkeypress="return isNumberKeyWithDecimal(this, event);" onkeyup="removeOtherDonationValue(this, '{{ $dedicationproject->project_id}}');"/>
                                </div>
                            </div> 
                        </div>
                    </div>
              </div>
            </div>
            @empty
		   <p>No Projects</p>
		  @endforelse
        </div>

        <div class="row mt-4">
            <div class="col-2 col-sm-1">
                <div class="gift_headbox-1 p-1">
                    <h5 class="m-0 text-center" style="font-size: 26px; font-weight: 700; color: #f2f2f2;">2</h5>
                </div>
            </div>
            <div class="col-10 col-sm-11 p-0">
                <div class="gift_headbox-2 p-2 px-3">
                    <h5 class="m-0" style="font-size: 20px; font-weight: 700; color: #1a6b48;">Choose template</h5>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-5 col-sm-2 text-center mt-4">
                    <h1 class="BTN-1">Cards</h1>
                </div>
            </div>
            <div class="row mt-3 donar_detailCheckbox justify-content-center">
				@forelse ($giftcards as $key => $giftcard) 
                <div class="col-md-3 donar_detailCheckimgbox">
                     <input type="radio" class="form-check-input" id="template_{{$giftcard->id}}" name="radio-template" value="{{$giftcard->id}}" class=""  onchange="selectTemplate(this)" style="display: none;" />
                    <label class="form-check-label"   for="template_{{$giftcard->id}}"><img src="../uploads/giftcardimage/{{$giftcard->full_image}}"/></label>
                </div>
                 @empty
				   <p>No Cards</p>
				  @endforelse
                
            </div>  
        </div>
        <div class="row mt-4">
            <div class="col-2 col-sm-1">
                <div class="gift_headbox-1 p-1">
                    <h5 class="m-0 text-center" style="font-size: 26px; font-weight: 700; color: #f2f2f2;">3</h5>
                </div>
            </div>
            <div class="col-10 col-sm-11 p-0">
                <div class="gift_headbox-2 p-2 px-3">
                    <h5 class="m-0" style="font-size: 20px; font-weight: 700; color: #1a6b48;">Receiver info</h5>
                </div>
            </div>
            <div class=" p-3">
				<input type="hidden" data-val="true" data-val-required="Project ID required" id="project_id" name="project_id" value="" />
				<input type="hidden" data-val="true" data-val-number="The field GiftDonation.Fields.DonationAmount must be a number." data-val-required="&#x27;Donation Amount&#x27; must not be empty." id="DonationAmount" name="DonationAmount" value="0" />
				<input type="hidden" data-val="true" data-val-required="giftdonation.giftdonationtemplateid.required" id="GiftDonationTemplateId" name="GiftDonationTemplateId" value="" />
				<input type="hidden" data-val="true" data-val-required="The PaymentGatewayId field is required." id="PaymentGatewayId" name="PaymentGatewayId" value="1" />
				<input type="hidden" id="PaymentGatewayName" name="PaymentGatewayName" value="KNET" />
                <div class="row mt-3 donar_detailForm">
                  <div class="mb-4">
                    <label for="exampleFormControlInput1" class="form-label">Choose the donation type</label>
                    <select class="form-select required" name="donation_type" id="donation_type" aria-label="Default select example">
                      <option value="" selected>Patient clinic</option>
                      <option value="sister">To my sister</option>
                      <option value="brother">To my brother</option>
                      <option value="wife">To my wife</option>
                       <option value="husband">To my husband</option>
                       <option value="friend">To my friend</option>
                       <option value="father">To my father</option>
                       <option value="mother">to my mother</option>
                    </select>
                  </div>
                  
                  <div class="mb-4">
                    <label for="exampleFormControlInput1" class="form-label">Donation amount</label>
                      <div class="d-flex calC">
                          <div class="value-button decreaseBtn" id="decrease" onclick="decreaseValue('donation_amount',1)"  value="Decrease Value">-</div> 
                          <input type="number" class="number"  id="donation_amount" name="donation_amount"   value="1"/>
                          <div class="value-button increaseBtn" id="increase" onclick="increaseValue('donation_amount',1)" value="Increase Value">+</div> 
                      </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="mb-4">
                      <label class="form-label">The name of the one being gifted to him
                      </label>
                      <input type="text" class="form-control required" id="recipient_name" name="recipient_name"  >
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-4">
                      <label class="form-label">The phone number of the recipient </label>
                      <input type="text" class="form-control required" id="recipient_number" name="recipient_number"  placeholder="+965">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-4">
                      <label class="form-label">The Sender's name
                      </label>
                      <input type="text" class="form-control required" id="donor_name" name="donor_name">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-4">
                      <label class="form-label">Sender number</label>
                      <input type="text" class="form-control required" id="sender_number" name="sender_number" placeholder="+965">
                    </div>
                  </div>
                  <div class="mb-4">
                    <label class="form-label">The email address of the recipient</label>
                    <input type="mail" class="form-control email required" id="recipient_email" name="recipient_email">
                  </div>

                </div>
                <div class="row mt-3 donar_detailCheckbox">
                    <p class="panel_titleDetail mb-1" style="font-size: 16px; font-weight: 700; color: #6d6c6c;">Select payment method:</p>
                    <ul>
                        <li>
                             <input class="form-check-input" type="radio" id="flexRadioDefault1" name="paymentmethode_id" style="display: none;" value="1" checked />
                            <label for="flexRadioDefault1"><img src="../assets/img/kn.png"/><span>KNET</span></label>
                        </li>
                        <li>
                            <input class="form-check-input" type="radio" id="flexRadioDefault2" name="paymentmethode_id" value="2" style="display: none;" />
                            <label for="flexRadioDefault2"><img src="../assets/img/vm.png"/><span>VISA/MASTER</span></label>
                        </li>
                        @if($loginuser) 
                         <li>
                          <input class="form-check-input" type="radio" id="flexRadioDefault3" name="paymentmethode_id" value="3" style="display: none;" />
                         <label class="form-check-label" for="flexRadioDefault3" style="font-size: 19px;"><i class="fa-solid fa-wallet"></i><span>WALLET ({{$loginuser->wallet_balance}} KD)</span></label>
                        </li>
                       @endif
                    </ul>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <button type="button" onclick="previewGiftDonation();"  class="btn BTN-1 p-2 w-100 mt-3"> preview</button>
                  </div>
                  <div class="col-md-6">
                    <button type="button" onclick="submitGiftDonation();"  class="btn BTN-1 p-2 w-100 mt-3"> submit</button>
                  </div>
                </div>
                
              </div>
            
        </div>
    </div>
    </form>
  </div>
</section>
 
<!-- ====================== Projects Section End ===================== -->
<script>
 function isNumberKeyWithDecimal(txt, evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46) {
            //Check if the text already contains the . character
            if (txt.value.indexOf('.') === -1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;
        }

        return true;
    }
   function removeOtherDonationValue(victim, id) {
        var enteredAmount = parseFloat($(victim).val());

        $("input[id^=donation-amount]:not(#" + victim.id + ")").val(0);
        $("#ProjectId").val(0);
        $("#DonationAmount").val(0);
        $("#donation_amount").val(0);
        //Assign donation amount and project Id
        if (enteredAmount != null && enteredAmount != "" && !isNaN(enteredAmount)) {
            $("#DonationAmount").val(enteredAmount);
            $("#donation_amount").val(enteredAmount);
            $("#project_id").val(id);
        }
    }
    function validatePreviewGiftDonation()
    {
        var formValidator, $form = $("#giftdonation-form");
        var isValid = false;

        if ($form.valid()) {
            if (!formValidator) {
                formValidator = $form.validate({}); // Get existing jquery validate object
            }

            var errorList = [];
            // get existing summary errors from jQuery validate
            $.each(formValidator.errorList, function (index, errorListItem) {
                errorList.push(errorListItem.message);
            });

            var projectId = parseInt($("#project_id").val());
            var donationAmount = parseFloat($("#DonationAmount").val());
            var giftDonationTemplateId = parseInt($("#GiftDonationTemplateId").val());
            //var phone = $("#txtPhone").val();

            // add our own errors
            if (projectId == null || projectId == "" || isNaN(projectId)) {
                errorList.push("Please select a project");
            }

            if (donationAmount == null || donationAmount == "" || isNaN(donationAmount)) {
                errorList.push("Please enter the project amount");
            }

            if (giftDonationTemplateId == null || giftDonationTemplateId == "" || isNaN(giftDonationTemplateId)) {
                errorList.push("Please choose the card");
            }

            // find summary div
            var $summary = $form.find("[data-valmsg-summary=true]");

            // find the unordered list
            var $ul = $summary.find("ul");

            // Clear existing errors from DOM by removing all element from the list
            $ul.empty();

            // No errors, do nothing
            if (0 === errorList.length) {
                return isValid = true;
            }

            // Add all errors to the list
            $.each(errorList, function (index, message) {
                $("<li />").html(message).appendTo($ul);
            });

            // Add the appropriate class to the summary div
            $summary.removeClass("validation-summary-valid").addClass("validation-summary-errors");
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }

        return isValid;
    }

    function selectTemplate(victim) {
        if ($(victim).prop("checked")) {
            $("#GiftDonationTemplateId").val($(victim).val());
        }
    }

    //Select payment gateway
    function selectPaymentGateway(victim) {
        if ($(victim).prop("checked")) {
            $("#PaymentGatewayId").val($(victim).val());
            $("#PaymentGatewayName").val($(victim).attr("nameAttr"));
        }
    }

    function previewGiftDonation() {
        if (!validatePreviewGiftDonation()) {
            return;
        }

        "https://docs.google.com/viewer?url=" + window.location.origin + window.open("/{{app()->getLocale()}}/giftDonation_preview?" + $("#giftdonation-form").serialize() + "&ForPreview=" + true, "_blank", "width=800,height=600");
    }
    function submitGiftDonation() {
          if (!validatePreviewGiftDonation()) {
            return;
        }
        $("#giftdonation-form").submit();
    }
</script>
@stop
