@extends('ar.layouts.default')

@section('content')


<!-- ====================== Section Start ===================== -->

<section id="ForgotPassword" class="container mt-3">
	
    <div class="row p-3">
		@if (Session::has('message'))
		 <div class="alert alert-success" role="alert">
			{{ Session::get('message') }}
		</div>
	@endif
        <h5 class="mt-4" style="font-size: 25px; font-weight: 700; color: #6c757d;">استعادة كلمة السر</h5>
        <div class="col-md-10">
		<form autocomplete="off" action="{{ route('forget.password.post',app()->getLocale()) }}" method="POST">	
		@csrf
            <div class="row mt-3 donar_detailForm">
              <div class="mb-3">
                <p class="panel_titleDetail mb-1">عنوان بريدك  الإلكتروني:</p>
                 <input type="text" id="email_address" class="form-control" name="email" required autofocus>
				  @if ($errors->has('email'))
					  <span class="text-danger">{{ $errors->first('email') }}</span>
				  @endif
              </div>
            </div>   
            <div class="text-center"> 
                <button type="submit" class="btn BTN-1 btn-sm"> إرسال رابط إعادة تعيين كلمة السر</button>
            </div>
            <div class="alert alert-success p-3 mt-4" role="alert" style="font-size: 14px;">
                يرجى إدخال عنوان البريد الالكتروني أدناه. سوف تتلقى وصلة لإعادة تعيين كلمة المرور الخاصة بك.
            </div>
            </form>
        </div>
    </div>
</section>
@stop
