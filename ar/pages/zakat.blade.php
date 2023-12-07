@extends('ar.layouts.default')

@section('content')


<!-- =================== Main =============== -->
  <section id="ChooseDonationamnt" class="projectsTabs mt-5">
    <div class="container">

      <div class="row">
        <div class="col-md-5">
          <img src="../../uploads/projectimage/{{ $project_details->image }}" class="card-img-top d-block w-100 h-300" alt="...">
        </div>
        <div class="col-md-7">
			<form autocomplete="off" id="donationform" name="donationform" class="forms-sample" method="POST" action="{{ route('myfatoorah.request',app()->getLocale())}}">
            @csrf
            <input type="hidden" name="project_id" id="project_id" value="{{$project_details->project_id}}">
          <div class="panel">
            <div class="card" style="width: auto ;">
                <div class="card-body">
                  <a  href="{{route('zakat_project',[app()->getLocale()] )}}">
                    <h5 class=" mt-1 CLR ">{{$project_details->project_name_ar}} </h5>
                    <p class="panel_titleDetail mt-2">{{$project_details->title_ar}}</p>
                  </a>
                 
                  <div class="row mt-4">
                    <div class="col-md-6">
                      <p class="panel_titleDetail mb-1">أدخل مبلغ التبرع:</p>
                      <div class="d-flex text-center ">
                        <div class="value-button decreaseBtn" id="decrease" onclick="decreaseValue('project_details',{{ number_format($project_details->project_price) }})" value="Decrease Value">-</div> 
                          <input type="number" class="number" id="project_details" name="donation_amount" value="{{ number_format($project_details->project_price) }}"/>
                        <div class="value-button increaseBtn" id="increase" onclick="increaseValue('project_details',{{ number_format($project_details->project_price) }})" value="Increase Value">+</div> 
                      </div>
                    </div>
                    
                    <div class="col-md-6 auto_amountBtn">
                      <p class="panel_titleDetail mb-1 ">حدد المبلغ المحدد مسبقًا</p>
                      <button class="btn predefinedamount">{{ number_format($project_details->project_price) }}</button>
                      <button class="btn predefinedamount">{{ number_format($project_details->project_price) + 50 }}</button>
                      <button class="btn predefinedamount">{{ number_format($project_details->project_price) + 100 }}</button>
                      <button class="btn predefinedamount">{{ number_format($project_details->project_price) + 150 }}</button>
                      <button class="btn predefinedamount">{{ number_format($project_details->project_price) + 200 }}</button>
                    </div>
                     
                  </div>
                   <div class="row mt-4">
                  <div class="col-12"><a href="{{route('zakat',app()->getLocale())}}" class="btn BTN-1 w-100">احسب زكاتك</a></div>  
                   </div>
                  <div class="row mt-4 donar_detailForm">
                      
					@if($loginuser) 
					  <div class="mb-3">	 
                        <input type="text" class="form-control" id="donor_name" name="donor_name" placeholder="اسم المتبرع" value="{{ $loginuser->full_name}}">
                      </div>
                      <div class="col-md-6">
                       <input type="text" class="form-control" id="donor_phone" name="donor_phone"  placeholder="هاتف المتبرع" value="{{ $loginuser->phone}}">
                      </div>
                      <div class="col-md-6">
                        <input type="email" class="form-control" id="donor_email" name="donor_email"  placeholder="البريد الإلكتروني للمانحين" value="{{ $loginuser->email}}">
                      </div>
                        @else
                      <div class="mb-3">	 
                        <input type="text" class="form-control" id="donor_name" name="donor_name" placeholder="اسم المتبرع" value="">
                      </div>
                      <div class="col-md-6">
                       <input type="text" class="form-control" id="donor_phone" name="donor_phone"  placeholder="هاتف المتبرع" value="">
                      </div>
                      <div class="col-md-6">
                        <input type="email" class="form-control" id="donor_email" name="donor_email"  placeholder="البريد الإلكتروني للمانحين" value="">
                      </div>         
                    @endif
                  </div>
                 
                  <div class="row mt-4 donar_detailCheckbox">
                    <p class="panel_titleDetail mb-1">اختار طريقة الدفع:</p>
                      <ul>
                       <li>
                          <input class="form-check-input" type="radio" id="flexRadioDefault1" name="paymentmethode_id" style="display: none;" value="1" checked />
                           <label class="form-check-label" for="flexRadioDefault1"><img src="../../assets/img/kn.png"/><span>كي نت</span></label>
                        </li>
                        <li>
                          <input class="form-check-input" type="radio" id="flexRadioDefault2" name="paymentmethode_id" value="2" style="display: none;" />
                         <label class="form-check-label" for="flexRadioDefault2"><img src="../../assets/img/vm.png"/><span>تأشيرة / ماجستير</span></label>
                        </li>
                      </ul>
                  </div>
                  
                  <div class="row mt-3">   
					
                    <div class="col-8"><button type="submit" class="btn w-100 BTN-1" > تبرع الآن</button></div>
                    <div class="col-4"><button type="button" onclick="addtocart('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($project_details->project_id)] )}}','project_details')" class="btn w-100 BTN-2"><i class="fa-solid fa-cart-shopping"></i></button></div>
                  </div> 

                </div>
            </div>
          </div>
          </form>
      </div>

      <div class="container mt-2">
        <div class="projectsTabs ">
          <!-- -----Tab start----- -->
          <div class="row">
            <ul class="nav nav-pills mb-3 justify-content-strat" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-Details-tab" data-bs-toggle="pill" data-bs-target="#pills-Details" type="button" role="tab" aria-controls="pills-Details" aria-selected="true">تفاصيل</button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <!-- ---- Tab-1 ----- -->
              <div class="tab-pane fade show active" id="pills-Details" role="tabpanel" aria-labelledby="pills-Details-tab" tabindex="0">
                <div class="row">
                      {!!$project_details->description_ar!!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        
    </div>
  </section>

 
<script type="text/javascript">
  
    function addtocart(route,id)
    {
		var project_price = $('#'+id).val();
        $.ajax({
            url: route,
            method: "get",
            data: {
                _token: '{{ csrf_token() }}', 
                project_price: project_price, 
            },
            success: function (response) {
               window.location.reload();
            }
        });
    }
	 $(".predefinedamount").click(function (e) {
			e.preventDefault();
			$(".predefinedamount").removeClass('active');
			$(this).addClass('active');
			var ele = $(this).text();
			
			$('#project_details').val(ele);
	  
		});

  
</script>
  
  
  @stop
