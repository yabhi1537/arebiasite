@extends('en.layouts.default')

@section('content')


<!-- ====================== Section Start ===================== -->

<section id="ForgotPassword" class="container mt-3">
	
    <div class="row p-3">
		@if (Session::has('message'))
		 <div class="alert alert-success" role="alert">
			{{ Session::get('message') }}
		</div>
	@endif
        <h5 class="mt-4" style="font-size: 25px; font-weight: 700; color: #6c757d;">Password recovery</h5>
        <div class="col-md-10">
		<form autocomplete="off" action="{{ route('forget.password.post',app()->getLocale()) }}" method="POST">	
		@csrf
            <div class="row mt-3 donar_detailForm">
              <div class="mb-3">
                <p class="panel_titleDetail mb-1">Your email address:</p>
                 <input type="text" id="email_address" class="form-control" name="email" required autofocus>
				  @if ($errors->has('email'))
					  <span class="text-danger">{{ $errors->first('email') }}</span>
				  @endif
              </div>
            </div>   
            <div class="text-center"> 
                <button type="submit" class="btn BTN-1 btn-sm"> Send Password Reset Link</button>
            </div>
            <div class="alert alert-success p-3 mt-4" role="alert" style="font-size: 14px;">
                Please enter your email address below. You will receive a link to reset your password.
            </div>
            </form>
        </div>
    </div>
</section>
@stop
