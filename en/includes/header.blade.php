
  <!-- ------------- First header ------------- -->
   @php   $contactdetails_head =  DB::table('manage_domain')->get()->first(); @endphp
   @php   $sociallink_heads =  DB::table('sociall_links')->get(); @endphp
  <div id="Firsttop_header" class="header pt-3 pb-2 ">
    <div class="container-fluid">
      <div class="row animate__animated animate__fadeInRight" style="animation-duration: 4s;" >
          <div class="col-2"></div>
          <div class="col-2">
            <div class="row Tophead_detail">
              <div class="col-2 p-0 pt-2 text-center">
                <i class="fa-solid fa-phone-volume"></i>
              </div>
              <div class="col-9 ">
                <p>cell phone</p> 
                <h5>{{$contactdetails_head->phone}}</h5>
              </div>
            </div>
          </div>
          <div class="col-2">
            <div class="row Tophead_detail">
              <div class="col-2 p-0 pt-2 text-center">
                <i class="fa-solid fa-envelope"></i>
              </div>
              <div class="col-9 ">
                <p>Send mail</p> 
                <h5>{{$contactdetails_head->email}}</h5>
              </div>
            </div>
          </div>
          <div class="col-2">
            <div class="row Tophead_detail">
              <div class="col-2 p-0 pt-2 text-center">
                <i class="fa-solid fa-location-dot"></i>
              </div>
              <div class="col-10 ">
                <p>the desk</p> 
                <h5>{{$contactdetails_head->address}}, {{$contactdetails_head->city}} {{$contactdetails_head->pincode}}</h5>
              </div>
            </div>
          </div>
          <div class="col-2">
            <div class="row Tophead_detail pt-1">
              <div class="socialIcn">
				@foreach($sociallink_heads as $sociallink_head)
				@if($sociallink_head->name=='facebook')
                <a href="{{$sociallink_head->links}}"><i class="fa-brands fa-facebook-f"></i></a>
                @endif
                @if($sociallink_head->name=='twitter')
                <a href="{{$sociallink_head->links}}"><i class="fa-brands fa-twitter"></i></a>
                @endif
                @if($sociallink_head->name=='linkedin')
                <a href="{{$sociallink_head->links}}"><i class="fa-brands fa-linkedin-in"></i></a>
                @endif
                @if($sociallink_head->name=='instagram')
                <a href="{{$sociallink_head->links}}"><i class="fa-brands fa-instagram"></i></a>
                @endif
                @endforeach
              </div>  
             
            </div>
          </div>
          <div class="col-2 PRJCT_cmplt">
			  @php   $totalcompleteproject =  DB::table('tbl_projects')->where('status','=',1)->count(); @endphp
              <button type="submit" class="btn Btn-1 mt-1"> Project Completed <span class="">({{ $totalcompleteproject  }})</span></button>
          </div>
      </div>
    </div>
  </div>
<!-- ------------- Second header ------------- -->
  <div id="header" class="header"> 
    <nav class="navbar navbar-expand-lg bg-body-tertiary p-0">
      <div class="container-fluid " >
        <div class="logoBlock animate__animated animate__fadeInLeft" style="animation-duration: 4s;">
        
           <img src="{{url('uploads/contact/logo/'.$contactdetails_head->logo.'' )}}" class="LOGO"> 
          
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse main-navB-1" id="navbarTogglerDemo02">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-3">
            <li class="nav-item">
              <a class="nav-link active " aria-current="page" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('awqaf',app()->getLocale())}}">Awqaf</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{route('projects',app()->getLocale())}}">Our projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{route('sponsorship',app()->getLocale())}}">Sponsorship</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{route('zakat_project',app()->getLocale())}}"> Zakat</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{route('dedications',app()->getLocale())}}">Dedications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{route('deductions',app()->getLocale()) }}">Deductions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="{{route('smallkiddonorproject',app()->getLocale()) }}">Small kid donor</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Who are we
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item " href="{{route('aboutus',app()->getLocale()) }}">About Us</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item " href="{{route('news',app()->getLocale()) }}">News and Reports</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item " href="{{route('achievements',app()->getLocale()) }}">Our Achievements</a></li>
                 <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item " href="{{route('gallery',app()->getLocale()) }}">Media Gallary</a></li>
                
              </ul>
            </li>
          </ul> 
          
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               {{ Str::upper(app()->getLocale())}} <i class="bi bi-caret-down-fill" style="font-size: 15px;"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item " href="{{route('switchLan','en')}}" alt="English">EN</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item " href="{{route('switchLan','ar')}}" alt="Arabic">AR</a></li>
                <li><hr class="dropdown-divider"></li>
              </ul>
             </li>
           </ul> 
          
          <div class="d-flex SeconHead" >
		   
            <div class="dropdown drop_cartBtn mt-0 me-2 user_icnBTN">
					@guest('web')
					  <button class="btn btn-secondary dropDownBtn dropdown-toggle pe-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
						<i class="bi bi-person"></i>
					  </button>
                    @else
				      <a class="btn btn-secondary dropDownBtn dropdown-toggle pe-0" href="{{ route('userprofile',app()->getLocale()) }}" style="padding-top:11px;">
						<i class="fa fa-user"></i>
					  </a>
                    <!-- <a class="btn btn-secondary dropDownBtn dropdown-toggle pe-0" href="{{ route('logout',app()->getLocale()) }}" style="padding-top:11px;">
						<i class="bi bi-box-arrow-right" style="font-size:22px;"></i>
					  </a> -->
				  @endguest 	
				
              <div class="modal right fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <p class="modal-title fs-6" id="exampleModalLabel"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"  style="font-size: 11px;"></button></p>
                            <h1 class="modal-title " id="exampleModalLabel" style="font-size: 18px;">My account</h1>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <h5 class="mt-4" style="font-size: 17px; font-weight: 600; color: #4d5154;">Sign in to use features services. / New Donor</h5>
                            <div class="col-md-6 mt-2">
                                <a href="{{route('login',app()->getLocale())}}" class="btn BTN-1 btn-sm w-100"><i class="fa-solid fa-shield-halved"></i> LOG IN</a>
                            </div>
                            <div class="col-md-6 mt-2">
                                <a href="{{route('register',app()->getLocale())}}" class="btn BTN-1 btn-sm w-100"><i class="fa-solid fa-user"></i> REGISTER</a>
                            </div>
                            <h5 class="mt-4 text-center" style="font-size: 15px; font-weight: 600; color: #4d5154; ">By creating an account on our website you will be able to shop faster, be up to date on an donations status, and keep track of the donations you have previously made.</h5>
                          </div>
                        </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="dropdown drop_cartBtn mt-0 p-1 pe-0" style="margin-right: 10px;">
              <a href="{{route('cart',app()->getLocale())}}" class="btn btn-secondary dropDownBtn dropdown-toggle"><i class="bi bi-basket3"></i> <span> {{ count((array) session('cart')) }} </span></a>
            </div>
            <div class="">
              <a href="{{route('zakat',app()->getLocale())}}" class="btn btn-secondary btn-sm zakatCalciBtn" >Zakat Calculator</a>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </div>  
  <!-- ========================= Header Navbar End ======================= -->

  <!-- =================== Side wrapper donation start=============== -->
  <div id="fastDonate" class="fast-donation-wrapper" style="display: block;">
    <div class="dropend animate__animated animate__fadeInRight" style="animation-duration: 3s;">
        <button class="btn btn-secondary dropdown-toggle BG" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span style="writing-mode: vertical-rl; text-orientation: mixed;">
                <p style="vertical-align: inherit;">
                  <p class=" mb-0 fw-bold" style="vertical-align: inherit;">Fast Donation</p>
                  <i class="fa-solid fa-caret-left"></i>
                </p>
            </span>
        </button>
         @php   $allproject_fastdonation =  DB::table('tbl_projects')->where('status','!=',1)->where('project_type','!=',7)->get(); @endphp
         <form id="fastdonationform" name="fastdonationform" class="dropdown-menu p-3 text-center" autocomplete="off" method="POST" action="{{ route('myfatoorah.fastdonation_request',app()->getLocale())}}">
            @csrf
            <div class="mb-3">
              <select class="form-select field" required name="fastdonation_project_id" name="fastdonation_project_id" aria-label="Default select example">
                <option value="" selected>Select project</option>
                @foreach($allproject_fastdonation as $key => $datafastdonation)
                <option value="{{ $datafastdonation->project_id}}">{{ $datafastdonation->project_name}}</option>
               @endforeach
              </select>
            </div>
            <div class="mb-3">
              <input type="number" required class="form-control field" id="fastdonation_amount" name="fastdonation_amount" placeholder="Donation Amount">
               <input type="hidden" class="form-control field" id="fastdonation_paymentmethode_id" name="fastdonation_paymentmethode_id" placeholder="Donation Amount" value="1">
            </div>
            <button type="submit" class="btn btn-primary w-100 fast_donateBtn">Donate now</button>
        </form>
      
    </div>
  </div>
  <!-- =================== Side wrapper donation start=============== -->
  <!-- =================== Whatsapp icon =============== -->
  <a href="#" class="float animate__animated animate__fadeInUp" style="animation-duration: 5s;" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
  </a>


<!-- Whats 1 start -->	
	<div class="whatsapp_chat_support wcs_fixed_right" id="example_3">
		<div class="wcs_button_label">
 			do you need help? let's talk!
 		</div>	
		<div class="float animate__animated animate__fadeInUp wcs_button wcs_button_circle" style="animation-duration: 5s;">
			<span class="fa fa-whatsapp my-float"></span>
		</div>	
		

		<div class="wcs_popup">
			<div class="wcs_popup_close">
				<span class="fa fa-close"></span>
			</div>
			<div class="wcs_popup_header">
				<strong>do you need help? let's talk</strong>
				<br>
				<div class="wcs_popup_header_description">Click on one of our representatives below</div>
			</div>	
			<div class="wcs_popup_person_container">
		

				<div class="wcs_popup_person" data-number="+96560627111">
					<div class="wcs_popup_person_img"><img src="{{url('assets/img/logo.png')}}" alt=""></div>
					<div class="wcs_popup_person_content">
						<div class="wcs_popup_person_name">Public Relations Officer</div>
						<div class="wcs_popup_person_description">Customer Support</div>
						<div class="wcs_popup_person_status"> Online</div>
					</div>
				</div>

			</div>
		</div>
	</div>		
<!-- Whats 1 end -->	


<script>

	    $('#example_3').whatsappChatSupport();
	</script>
