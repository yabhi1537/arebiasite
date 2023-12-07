@extends('en.layouts.default')
@section('content')
  <!-- ========================= hero section start ======================= -->

  <div id="aboutHero">
    <div  class="bsb-hero-1 px-3 bsb-overlay bsb-hover-pull" style="background-image:url('/uploads/contacabout/image/{{$contactusheader->image}}');">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-11 col-lg-9 col-xl-7 col-xxl-6 text-center text-white mt-5 pt-5">
            <h1 class="display-3 fw-bold mb-3 mt-5">{{$contactusheader->title}}</h1>
            <p class=" mb-5">{{$contactusheader->description}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ========================= hero section End ======================= -->
  <!-- ========================= hero section End ======================= -->
  <section id="contactUs" class="container mt-3 mb-5 pb-5">
    <div class="row justify-content-center">
      <div class="col-md-8 mt-3">
        <div class="row box justify-content-center mt-4">
           <div class="col-md-12 ">
            <h2 class="mt-2 text-center" style="font-size: 26px; font-weight: 700; color: #5d5d5d;">Call Us</h2>
           
		   @if(session('flash_notice'))
				<div class="alert alert-success">
				  {{ session('flash_notice') }}
				</div> 
			@endif
              <div class="row mt-4 ">
				 <form autocomplete="off" action="{{ route('contactus',app()->getLocale()) }}" method="post">	
				 @csrf
                <div class="input-group mb-3">
                  <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                  <input type="text" class="form-control login_email" name="fullname" id="fullname"  placeholder="Full Name">
                       @if ($errors->has('fullname'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('fullname') }}</span>
                            @endif  
                </div>

                <div class="col-md-6">
                  <div class="input-group mb-3 mt-3">
                    <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                    <input type="text" class="form-control login_pass" name="phonenumber" id="phonenumber"   placeholder="Phone number">
                      @if ($errors->has('phonenumber'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('phonenumber') }}</span>
                            @endif  
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="input-group mb-3 mt-3 ">
                    <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                    <input type="text" class="form-control login_pass" name="email" id="email"   placeholder="E-mail">
                    @if ($errors->has('email'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('email') }}</span>
                            @endif  
                  </div>
                </div>
                
                <div class="input-group mb-3 mt-3">
                  <textarea class="form-control px-3" name="querie" id="querie" rows="3" placeholder="Contact us for inquiries"></textarea>
                  @if ($errors->has('querie'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('querie') }}</span>
                            @endif  
                </div>
                
                <div class="text-center mt-4 ">
                  <button type="submit" class="btn BTN-1 btn-sm w-100 p-2">Send</button>
                </div>
                </form>
              </div>
           </div> 
        </div>
    </div>
  </section>


@stop
