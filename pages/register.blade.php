@extends('ar.layouts.default')

@section('content')

<!-- ====================== Section Start ===================== -->

<section id="Login" class="container mt-3 mb-5 pb-5">
  <div class="row justify-content-center">
    <div class="col-md-6 mt-3">
      <div class="row box justify-content-center mt-4">
		  
         <div class="col-md-12 ">
          <h5 class="mt-4 text-center" style="font-size: 17px; font-weight: 700; color: #2B2C2B;">يسجل</h5>
         
         <form autocomplete="off" action="{{ route('register',app()->getLocale()) }}" method="post">	
			  @csrf
				<div class="row mt-4 ">
					  <div class="input-group mb-3">
						<span class="input-group-text"><i class="fa-solid fa-user"></i></span>
						<input type="text" class="form-control login_email" name="full_name" id="full_name"  placeholder="الاسم الكامل">
						 @if ($errors->has('full_name'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('full_name') }}</span>
                            @endif  
					  </div>
					        
					  <div class="input-group mb-3 mt-2">
						<span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
						<input type="email" class="form-control login_pass" name="email" id="email"  placeholder="بريد إلكتروني">
						 @if ($errors->has('email'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('email') }}</span>
                            @endif 
					  </div>
					  
					  <div class="input-group mb-3 mt-2">
						<span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
						<input type="text" class="form-control login_pass" name="phone" id="phone"  placeholder="هاتف">
					  </div>
					  <div class="">
						<div class="form-check">
						  <input class="form-check-input" type="checkbox" value="1" id="newsletter" name="newsletter" style="float: none; margin-left: 0px;">
						  <label class="form-check-label mt-0" for="flexCheckDefault"  style="font-size: 15px; font-weight: 700; color: #6d6c6c;">
							النشرة الإخبارية
						  </label>
						</div>
					  </div>
					  <div class="col-md-6">
						<div class="input-group mb-3 mt-3">
						  <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
						  <input type="password" class="form-control login_pass" name="password" id="password"   placeholder="كلمة المرور">
						   @if ($errors->has('password'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('password') }}</span>
                            @endif 
						</div>
					  </div>
					      
					  <div class="col-md-6">
						<div class="input-group mb-3 mt-3 ">
						  <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
						  <input type="password" class="form-control login_pass"  name="password_confirmation" id="password_confirmation"   placeholder="تأكيد كلمة المرور">
						    @if ($errors->has('password_confirmation'))
                                <span style="width: 100%;"  class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif 
						</div>
					  </div>
					 
						
					  <div class="text-center mt-4 ">
						<button type="submit" class="btn BTN-1 btn-sm w-100 p-2">يسجل</button>
					  </div>
					  <div class="text-center ">
						<h5 class="mt-4 text-center" style="font-size: 15px;"><a href="{{route('login',app()->getLocale())}}" style="color: #1a6b48;">لديه حساب بالفعل</a></h5>
					  </div>
				</div>
            </form>
         </div> 
      </div>
  </div>
  </div> 
</section>
@stop
