@extends('ar.layouts.default')

@section('content')

  <section id="supportNeedyfamily" class="container mt-5">
    <div class="supportNeedyfamily">
		 <form action="{{ route('saveneedy_families',app()->getLocale()) }}" name="needy_form" id="needy_form" autocomplete="off" method="post" enctype="multipart/form-data">	
			     @csrf
      <h2 class="mb-4">طلب مساعدة</h2>
       @if(session('flash_notice'))
				<div class="alert alert-success">
				  {{ session('flash_notice') }}
				</div> 
			@endif
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">اسم المتبرع</label>
        <input type="text" class="form-control" id="donor_name" name="donor_name" placeholder="اسم التبرع">
        @if ($errors->has('donor_name'))
				<span style="width: 100%;" class="text-danger">{{ $errors->first('donor_name') }}</span>
		@endif  
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">هاتف المتبرع</label>
        <input type="text" class="form-control" id="donor_phone" name="donor_phone" placeholder="9999999999">
        @if ($errors->has('donor_phone'))
				<span style="width: 100%;" class="text-danger">{{ $errors->first('donor_phone') }}</span>
		@endif  
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">بريد إلكتروني</label>
        <input type="email" class="form-control" id="donor_email" name="donor_email" placeholder="عنوان البريد الإلكتروني">
         @if ($errors->has('donor_email'))
				<span style="width: 100%;" class="text-danger">{{ $errors->first('donor_email') }}</span>
		@endif  
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">عدد العائلة</label>
        <input type="text" class="form-control"  id="family_count" name="family_count" placeholder="عدد العائلة">
         @if ($errors->has('family_count'))
				<span style="width: 100%;" class="text-danger">{{ $errors->first('family_count') }}</span>
		@endif  
      </div>
      
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">المرفق الأول</label>
        <div class="input-group">
          <input type="file" class="form-control" id="first_attachment" name="first_attachment">
          <label class="input-group-text" for="inputGroupFile02">رفع</label>
        </div>
         @if ($errors->has('family_count'))
				<span style="width: 100%;" class="text-danger">{{ $errors->first('first_attachment') }}</span>
		@endif  
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">المرفق الثاني</label>
        <div class="input-group">
          <input type="file" class="form-control" id="second_attachment" name="second_attachment">
          <label class="input-group-text" for="inputGroupFile02">رفع</label>
        </div>
      </div>
      
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">ولاية:</label>
          <input type="text" class="form-control" id="state" name="state" placeholder="ولاية">
         @if ($errors->has('state'))
				<span style="width: 100%;" class="text-danger">{{ $errors->first('state') }}</span>
		@endif  
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">مدينة:</label>
        <input type="text" class="form-control" id="city" name="city" placeholder="مدينة">
       
         @if ($errors->has('city'))
				<span style="width: 100%;" class="text-danger">{{ $errors->first('city') }}</span>
		@endif  
      </div>
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">عنوان</label>
        <input type="text" class="form-control" id="address" name="address" placeholder="عنوان">
         @if ($errors->has('address'))
				<span style="width: 100%;" class="text-danger">{{ $errors->first('address') }}</span>
		@endif  
      </div>
    
      <div class="row justify-content-center">
        <div class="col-md-4 ">
          <button type="sumbmit" class="btn BTN-1 p-2 w-100 mt-3">ارسل طلب</button>
        </div>
      </div>
      </form>
    </div>
  </section>

@stop
