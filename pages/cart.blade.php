@extends('ar.layouts.default')

@section('content')

<!-- ====================== Section Start ===================== -->

<section id="cart" class="container mt-5">
	 @if(session('invoice_error'))
				<div class="alert alert-danger">
				  {{session('invoice_error')}}
				</div> 
			@endif
  <div class="cart">
      <table class="table table-responsive table-borderless">
        <thead>
          <tr>
            <th class="text-center tProject">المشروع (المشاريع)</th>
            <th class="text-center tCountry">دولة</th>
            <th class="text-center tAmount">كمية</th>
            <th class="text-center tRemove">يزيل</th>
          </tr>
        </thead>
        <tbody>
	    @php $total = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
          <tr rowId="{{ $id }}">
            <td>{{ $details['name'] }}</td>
            <td>{{ $details['country'] }}</td>
            <td>{{ $details['price']  }} د.ك</td>
            <td><a class="delete-product"><i class="fa-solid fa-trash"></i></a></td>
          </tr>
          
        </tbody>
           @php $total =$total + $details['price']  @endphp
          @endforeach
        @else
          <tr><td colspan="4">البطاقه خاليه!</td></tr>
        @endif
        <tfoot>
          <tr>
            <td colspan="2" class="tTotal"><span>المجموع</span></td> 
            <td colspan="2" class="tTotalam"><span>{{ $total }} د.ك</span></td>
          </tr>
        </tfoot>
      </table>

      <div class="">
        <button type="button" class="btn BTN-1 btn-sm clear-cart">عربة واضحة</button>
        <a  class="btn BTN-2 btn-sm" href="{{route('projects',app()->getLocale()) }}">مواصلة التبرع</a>
      </div>

      <div class="">
          <div class="donationTab mt-5">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-Philanthropist-tab" data-bs-toggle="pill" data-bs-target="#pills-Philanthropist" type="button" role="tab" aria-controls="pills-Philanthropist" aria-selected="true">محب الخير</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-PreviousDonor-tab" data-bs-toggle="pill" data-bs-target="#pills-PreviousDonor" type="button" role="tab" aria-controls="pills-PreviousDonor" aria-selected="false">المتبرع السابق</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-NewDonor-tab" data-bs-toggle="pill" data-bs-target="#pills-NewDonor" type="button" role="tab" aria-controls="pills-NewDonor" aria-selected="false">متبرع جديد</button>
              </li>
            </ul>
          </div>
          <div class="tab-content" id="pills-tabContent">
            <!-- ========== tab-1 ========== -->
             <div class="tab-pane fade show active" id="pills-Philanthropist" role="tabpanel" aria-labelledby="pills-Philanthropist-tab" tabindex="0">
				 <form id="unknonuserform" name="unknonuserform" class="forms-sample" method="POST" action="{{ route('myfatoorah.cartpayment',app()->getLocale())}}">
            @csrf
                  <div class="row p-3">
                    <h5 class="mt-4" style="font-size: 16px; font-weight: 700; color: #6c757d;">مستخدم غير معروف</h5>
                    <div class="col-md-6">
                        <div class="row mt-3 donar_detailForm">
                          <div class="mb-3">
                            <p class="panel_titleDetail mb-1">بريد إلكتروني</p>
                            <input type="email" class="form-control" id="donor_email" name="donor_email" >
                          </div>
                        </div>
                      </div>
                 
                    <div class="col-md-3">
                      <div class="row mt-3 donar_detailForm">
                        <div class="mb-3">
                          <p class="panel_titleDetail mb-1">اسم</p>
                          <input type="text" class="form-control" id="donor_name" name="donor_name" >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="row mt-3 donar_detailForm">
                        <div class="mb-3">
                          <p class="panel_titleDetail mb-1">هاتف</p>
                          <input type="text" class="form-control" id="donor_phone" name="donor_phone" >
                        </div>
                      </div>
                    </div>
                          <div class="col-md-12">
                        <div class="row mt-3 donar_detailCheckbox">
                          <p class="panel_titleDetail mb-1">اختار طريقة الدفع:</p>
                         <ul>
                              <li>
                          <input class="form-check-input" type="radio" id="flexRadioDefault1" name="paymentmethode_id" style="display: none;" value="1" checked />
                           <label class="form-check-label" for="flexRadioDefault1"><img src="../assets/img/kn.png"/><span>كي نت</span></label>
                        </li>
                        <li>
                          <input class="form-check-input" type="radio" id="flexRadioDefault2" name="paymentmethode_id" value="2" style="display: none;" />
                         <label class="form-check-label" for="flexRadioDefault2"><img src="../assets/img/vm.png"/><span>تأشيرة / ماجستير</span></label>
                        </li>
                        @if($loginuser) 
                         <li>
                          <input class="form-check-input" type="radio" id="flexRadioDefault3" name="paymentmethode_id" value="3" style="display: none;" />
                         <label class="form-check-label" for="flexRadioDefault3" style="font-size: 19px;"><i class="fa-solid fa-wallet"></i><span>محفظة ({{$loginuser->wallet_balance}} د.ك)</span></label>
                        </li>
                       @endif
                            </ul>
                        </div>
                   </div>
                    <div class="text-center"> 
                      <button type="sumbmit" class="btn BTN-1 btn-sm"><i class="fa-solid fa-check p-2"></i> التبرع الكامل</button>
                    </div>
                  </div>
                  </form>
            </div>
            <!-- ========== tab-2 ========== -->
            <div class="tab-pane fade" id="pills-PreviousDonor" role="tabpanel" aria-labelledby="pills-PreviousDonor-tab" tabindex="0">
			
               
					@if($loginuser) 
				 <div class="row justify-content-center">
					  <div class="col-md-12 mt-3">
				<form id="previousdonorform" name="previousdonorform" class="forms-sample" method="POST" action="{{ route('myfatoorah.cartpayment',app()->getLocale())}}">	
						 @csrf	 
					<div class="col-md-6">
                        <div class="row mt-3 donar_detailForm">
                          <div class="mb-3">
                            <p class="panel_titleDetail mb-1">بريد إلكتروني</p>
                            <input type="email" class="form-control" id="donor_email_previous" name="donor_email" value="{{ $loginuser->email}}" >
                          </div>
                        </div>
                      </div>
					<div class="col-md-6">
                      <div class="row mt-3 donar_detailForm">
                        <div class="mb-3">
                          <p class="panel_titleDetail mb-1">اسم</p>
                          <input type="text" class="form-control" id="donor_name_previous" name="donor_name" value="{{ $loginuser->full_name}}" >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row mt-3 donar_detailForm">
                        <div class="mb-3">
                          <p class="panel_titleDetail mb-1">هاتف</p>
                          <input type="text" class="form-control" id="donor_phone_previous" name="donor_phone" value="{{ $loginuser->phone}}" >
                        </div>
                      </div>
                    </div>
					<div class="col-md-12">
                        <div class="row mt-3 donar_detailCheckbox">
                          <p class="panel_titleDetail mb-1">اختار طريقة الدفع:</p>
                            <ul>
                            <li>
                          <input class="form-check-input" type="radio" id="flexRadioDefault4" name="paymentmethode_id" style="display: none;" value="1" checked />
                           <label class="form-check-label" for="flexRadioDefault4"><img src="../assets/img/kn.png"/><span>كي نت</span></label>
                        </li>
                        <li>
                          <input class="form-check-input" type="radio" id="flexRadioDefault5" name="paymentmethode_id" value="2" style="display: none;" />
                         <label class="form-check-label" for="flexRadioDefault5"><img src="../assets/img/vm.png"/><span>تأشيرة / ماجستير</span></label>
                        </li>
                        @if($loginuser) 
                         <li>
                          <input class="form-check-input" type="radio" id="flexRadioDefault6" name="paymentmethode_id" value="3" style="display: none;" />
                         <label class="form-check-label" for="flexRadioDefault6" style="font-size: 19px;"><i class="fa-solid fa-wallet"></i><span>محفظة ({{$loginuser->wallet_balance}} د.ك)</span></label>
                        </li>
                       @endif
                            </ul>
                        </div>
                        <div class="text-center mt-3"> 
                          <button type="submit" class="btn BTN-1 btn-sm"><i class="fa-solid fa-check p-2"></i> التبرع الكامل</button>
                        </div>
                      </div>
                       </form>
                      </div>
                      </div>
					@else
					 <div class="row justify-content-center">
                      <div class="col-md-6 mt-3">
						  <form action="{{ route('login-cart',app()->getLocale()) }}" method="post">	
			                 @csrf	
                        <div class="row box justify-content-center">
							
                           <div class="col-md-6 ">
                            <h5 class="mt-4" style="font-size: 16px; font-weight: 700; color: #6c757d;">قم بتسجيل الدخول لاستخدام خدمات الميزات.</h5>
                              <div class="row mt-4 ">
                                <div class="mb-3 donar_detailForm">
                                
                                   @if (Cookie::get('reeeee')) 
									<input type="text" class="form-control login_email"  placeholder="بريد إلكتروني" name="email" id="email" value="{{$alldata[3]}}">
									@else
									 <input type="text" class="form-control login_email"  placeholder="بريد إلكتروني" name="email" id="email" value="">
									@endif
                                  @if ($errors->has('email'))
									<span style="width: 100%;" class="text-danger">{{ $errors->first('email') }}</span>
								 @endif  
                                </div>
                                <div class="mb-3 donar_detailForm">
                                  @if (Cookie::get('reeeee')) 
									<input type="password" class="form-control login_pass"  placeholder="كلمة المرور"  name="password" id="password" value="{{$alldata[2]}}">
									@else
									  <input type="password" class="form-control login_pass"  placeholder="كلمة المرور"  name="password" id="password" value="">
									@endif
									 @if ($errors->has('password'))
										<span style="width: 100%;" class="text-danger">{{ $errors->first('password') }}</span>
									@endif  
                                </div>
                                <div class="form-check ">
                                  <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1" @if (Cookie::get('reeeee')) checked="checked" @endif>
                                  <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px;">
                                    تذكرنى؟
                                  </label>
                                  <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px;">
                                    <a href="{{ route('forget.password.get',app()->getLocale()) }}" class="CLR"> هل نسيت كلمة السر؟</a>
                                  </label>
                                </div>
                                <div class="text-center mt-4 mb-4">
                                  <button type="submit" class="btn BTN-1 btn-sm ">تسجيل الدخول</button>
                                </div>
                                 @if(session()->get('flash_notice'))
								  <span  class="text-danger text-center" >{{session()->get('flash_notice')}}</span>
								  @enderror
                              </div>
                           </div> 
                           <div class="col-md-12">
                             
                           </div>
                        </div>
                         </form>
                      </div>
                      </div>
                      @endif
                </div>
            <!-- ========== tab-3 ========== -->
            <div class="tab-pane fade" id="pills-NewDonor" role="tabpanel" aria-labelledby="pills-NewDonor-tab" tabindex="0">
				 <form id="newdonorform" id="newdonorform" action="{{ route('register-cart',app()->getLocale()) }}" method="post">	
			      @csrf
                <div class="row justify-content-center">
			     
                  <div class="col-md-5 mt-5">
                    <div class=" box justify-content-center">
                      <div class="boxInnerbox">
                        <h5 class="m-0" style="font-size: 16px; font-weight: 700; color: #6c757d;">تفاصيلك الشخصية</h5>
                      </div>
                      <div class="row mt-2 p-3">
                        <div class="mb-3 donar_detailForm">
                          <p class="panel_titleDetail mb-1">الاسم الكامل :</p>
                          <input type="text" class="form-control" name="full_name_register" id="full_name_register"  >
                          @if ($errors->has('full_name_register'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('full_name_register') }}</span>
                            @endif  
                        </div>
                        <div class="mb-3 donar_detailForm">
                          <p class="panel_titleDetail mb-1">بريد إلكتروني :</p>
                          <input type="text" class="form-control"  name="email_register" id="email_register"  >
                           @if ($errors->has('email_register'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('email_register') }}</span>
                            @endif 
                        </div>
                      </div>
                    </div>

                    <div class=" box justify-content-center mt-3">
                      <div class="boxInnerbox">
                        <h5 class="m-0" style="font-size: 16px; font-weight: 700; color: #6c757d;">معلومات الاتصال الخاصة بك</h5>
                      </div>
                      <div class="row mt-2 p-3">
                        <div class="mb-3 donar_detailForm">
                          <p class="panel_titleDetail mb-1">هاتف :</p>
                          <input type="text" class="form-control"  name="phone_register" id="phone_register"  >
                        </div>
                      </div>
                    </div>

                    <div class=" box justify-content-center mt-3">
                      <div class="boxInnerbox">
                        <h5 class="m-0" style="font-size: 16px; font-weight: 700; color: #6c757d;">كلمة السر خاصتك</h5>
                      </div>
                      <div class="row mt-2 p-3">
                        <div class="mb-3 donar_detailForm">
                          <p class="panel_titleDetail mb-1">كلمة المرور :</p>
                          <input type="password" class="form-control" name="password_register" id="password_register"  >
                          @if ($errors->has('password_register'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('password_register') }}</span>
                            @endif 
                        </div>
                        <div class="mb-3 donar_detailForm">
                          <p class="panel_titleDetail mb-1">تأكيد كلمة المرور :</p>
                          <input type="password" class="form-control" name="password_register_confirmation" id="password_register_confirmation">
                            @if ($errors->has('password_confirmation_register'))
                                <span style="width: 100%;"  class="text-danger">{{ $errors->first('password_confirmation_register') }}</span>
                            @endif 
                        </div>
                      </div>
                    </div>
                    <div class="text-center mt-3"> 
                      <button type="submit" class="btn BTN-1 btn-sm"> يسجل </button>
                    </div>

                  </div>
                  <!--<div class="col-md-11">
                    <div class="row mt-3 donar_detailCheckbox">
                      <p class="panel_titleDetail mb-1">Select payment method:</p>
                        <ul>
                          <li>
                            <input type="checkbox" id="myCheckbox7" />
                            <label for="myCheckbox7"><img src="../assets/img/kn.png"/><span>KNET</span></label>
                          </li>
                          <li>
                            <input type="checkbox" id="myCheckbox8" />
                            <label for="myCheckbox8"><img src="../assets/img/vm.png"/><span>VISA/MASTER</span></label>
                          </li>
                        </ul>
                    </div>
                    <div class="text-center mt-3"> 
                      <button type="button" class="btn BTN-1 btn-sm"><i class="fa-solid fa-check p-2"></i> Complete Donation</button>
                    </div>
                  </div> -->
                  
               
                </div>
               </form>
            </div>
          
          </div>
      </div>

  </div>
</section>
<!-- ====================== Projects Section End ===================== -->

<script type="text/javascript">
$(".delete-product").click(function(e) {
    var ele = $(this);
    e.preventDefault();

    Swal.fire({
            title: "هل أنت متأكد؟",
            text: "هل تريد حقا الحذف؟",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#19642c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم، احذفه!'

        })
        .then((willDelete) => {
            if (willDelete.value) {
                $.ajax({
                    url: '{{ route("delete.cart.project",app()->getLocale()) }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("rowId")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });

            }
            // Swal.fire("Deleted Succesfully!");

        });
});

$(".clear-cart").click(function(e) {
    e.preventDefault();

    var ele = $(this);

    if (confirm("Do you really want to clear?")) {
        $.ajax({
            url: '{{ route("clear.cart.project",app()->getLocale()) }}',
            method: "DELETE",
            data: {
                _token: '{{ csrf_token() }}',

            },
            success: function(response) {
                window.location.reload();
            }
        });
    }
});

$(document).ready(function() {

    var tab_id = '{{ session()->get("tab_id")  }}';
    var tab_content_id = '{{ session()->get("tab_content_id")  }}';

    if (tab_id != '') {
        $('#pills-tab .active').removeClass('active');
        $('#' + tab_id).addClass('active');

        $('.tab-content .active').removeClass('active');
        $('.tab-content .active').removeClass('show');
        $('.tab-content #' + tab_content_id).addClass('active');
        $('.tab-content #' + tab_content_id).addClass('show');
    }
});
</script>


@stop
