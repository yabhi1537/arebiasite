@extends('ar.layouts.default')

@section('content')
<!-- ====================== Section Start ===================== -->
<section id="Login" class="container mt-3 mb-5 pb-5">
	@if (Session::has('message'))
		 <div class="alert alert-success" role="alert">
			{{ Session::get('message') }}
		</div>
	@endif
	
  <div class="row justify-content-center">
    <div class="col-md-6 mt-3">
      <div class="row box justify-content-center mt-4">
         <div class="col-md-7 ">
          <h5 class="mt-4 text-center" style="font-size: 17px; font-weight: 700; color: #2B2C2B;">تسجيل الدخول</h5>
          
           <form autocomplete="off" action="{{ route('login',app()->getLocale()) }}" method="post">	
			    @csrf
          <p class="text-center" style="font-size: 12px; color: #1a6b48;">قم بتسجيل الدخول لاستخدام خدمات الميزات.</p>
            <div class="row mt-4 ">
              <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                
                @if (Cookie::get('reeeee')) 
                <input type="text" class="form-control login_email"  placeholder="بريد إلكتروني" name="email" id="email" value="{{$alldata[3]}}">
                @else
                 <input type="text" class="form-control login_email"  placeholder="بريد إلكتروني" name="email" id="email" value="">
                @endif
                
				@if ($errors->has('email'))
					<span style="width: 100%;" class="text-danger">{{ $errors->first('email') }}</span>
				@endif  
              </div>
               
              <div class="input-group mb-3 mt-2">
                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                 @if (Cookie::get('reeeee')) 
                <input type="password" class="form-control login_pass"  placeholder="كلمة المرور"  name="password" id="password" value="{{$alldata[2]}}">
                @else
                  <input type="password" class="form-control login_pass"  placeholder="كلمة المرور"  name="password" id="password" value="">
                @endif
                 @if ($errors->has('password'))
					<span style="width: 100%;" class="text-danger">{{ $errors->first('password') }}</span>
				@endif  
              </div>
                
              <div class="d-flex justify-content-between">
                <div class="form-check">
				  
                  <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1" @if (Cookie::get('reeeee')) checked="checked" @endif  >
                  <label class="form-check-label mt-0" for="flexCheckDefault" style="font-size: 12px;">
                    تذكرنى؟
                  </label>
                </div>
               
                <label class="form-check-label" for="flexCheckDefault" style="font-size: 12px; margin-top: 6px;">
                  <a href="{{ route('forget.password.get',app()->getLocale()) }}" class="CLR"> هل نسيت كلمة السر؟</a>
                </label>
              </div>
              <div class="text-center mt-4 ">
                <button type="submit" class="btn BTN-1 btn-sm w-100 p-2">تسجيل الدخول</button>
              </div>
               @error('flash_notice')
			  <span  class="text-danger text-center" >{{$message}}</span>
			  @enderror
              <div class="text-center ">
                <h5 class="mt-4 text-center" style="font-size: 15px;"><a href="{{route('register',app()->getLocale())}}" style="color: #1a6b48;">انشاء حساب جديد.</a></h5>
              </div>
            </div>
            </form>
         </div> 
      </div>
  </div>
  </div>
</section>
@stop
