@extends('en.layouts.default')

@section('content')

<!-- ====================== Section Start ===================== -->
<section id="ForgotPassword" class="container mt-3">
	@if (Session::has('error'))
		 <div class="alert alert-danger" role="alert">
			{{ Session::get('error') }}
		</div>
	@endif
    <div class="row p-3">
        <h5 class="mt-4" style="font-size: 25px; font-weight: 700; color: #6c757d;">Reset Password</h5>
        <div class="col-md-10">
                      <form autocomplete="off" action="{{ route('reset.password.post',app()->getLocale()) }}" method="POST">
                          @csrf
                          <input type="hidden" name="token" value="{{ $token }}">
                           
                           <div class="row mt-3 donar_detailForm">
							  <div class="mb-3">
								<p class="panel_titleDetail mb-1">E-Mail Address</p>
								 <input type="text" id="email_address" class="form-control" name="email" required autofocus>
								  @if ($errors->has('email'))
									  <span class="text-danger">{{ $errors->first('email') }}</span>
								  @endif
							  </div>
							
							  <div class="mb-3">
								<p class="panel_titleDetail mb-1">Password</p>
								 <input type="password" id="password" class="form-control" name="password" required autofocus>
								  @if ($errors->has('password'))
									  <span class="text-danger">{{ $errors->first('password') }}</span>
								  @endif
							  </div>
							
                            
							  <div class="mb-3">
								<p class="panel_titleDetail mb-1">Password</p>
								 <input type="password-confirm" id="password" class="form-control" name="password_confirmation" required autofocus>
								  @if ($errors->has('password_confirmation'))
									  <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
								  @endif
							  </div>
							</div>  
  
                         <div class="text-center"> 
                                <button type="submit" class="btn BTN-1 btn-sm">  Reset Password</button>
                                 
                          </div>
                      </form>
        </div>
    </div>
</section>
@stop
