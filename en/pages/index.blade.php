@extends('en.layouts.default')

@section('content')

 <!-- ======================= Slide-Hero Start ==================== -->
<div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
  <div class="carousel-inner">
	 @forelse ($banners as $key => $banner)  
	  
	 @if($key == 0)
    <div class="carousel-item active">
      <img src="uploads/BannerImg/{{ $banner->bannerImg }}" class="d-block w-100 h-600" alt="...">
      <div class="carousel-caption">
        <h1 class="animate__animated animate__fadeInDownBig" style="animation-duration: 2s;">{{ $banner->title }}</h1>
        <p class="animate__animated animate__fadeInDownBig" style="animation-duration: 2s;">{{ $banner->description }}</p>
        <button type="button" class="btn btn-primary BTN-1 animate__animated animate__backInUp" style="animation-duration: 2s;">Primary</button>
      </div>
    </div>
    @else
    <div class="carousel-item ">
      <img src="uploads/BannerImg/{{ $banner->bannerImg }}" class="d-block w-100 h-600" alt="...">
      <div class="carousel-caption">
        <h1 class="animate__animated animate__fadeInDownBig" style="animation-duration: 2s;">{{ $banner->title }}</h1>
        <p class="animate__animated animate__fadeInDownBig" style="animation-duration: 2s;">{{ $banner->description }}</p>
        <button type="button" class="btn btn-primary BTN-1 animate__animated animate__backInUp" style="animation-duration: 2s;">Primary</button>
      </div>
    </div>
    @endif
    @empty
     <div class="carousel-item active">
      <img src="uploads/BannerImg/slide--8.jpg" class="d-block w-100 h-600" alt="...">
      <div class="carousel-caption">
        <h1 class="animate__animated animate__fadeInDownBig" style="animation-duration: 2s;">NO Title</h1>
        <p class="animate__animated animate__fadeInDownBig" style="animation-duration: 2s;">No Description</p>
        <button type="button" class="btn btn-primary BTN-1 animate__animated animate__backInUp" style="animation-duration: 2s;">Primary</button>
      </div>
    </div>
    @endforelse
 
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- ======================== Slide-Hero End ====================== -->

<!-- ======================== Zakat start ====================== -->
<section id="zakatHome" class="">
  <div class="container">
  <div class=" sectionHeading mb-4" >
    <h1 class="text-center CLR" data-aos="fade-left" data-aos-duration="2000">Zakat project</h1>
    <p class="text-center" data-aos="fade-right" data-aos-duration="2000">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
  </div>
    <div class="row mt-4 w-95" data-aos="fade" data-aos-duration="1000" data-aos-delay="100">
        <div class="detailS-1 col-md-9 BG ">
            <div class="detailS">
                <h2>{{$zakatproject->title}}</h2>
                <p class="mt-1">{!!$zakatproject->description!!}</p>
              <div class="row text-center mt-3 zakathome">
             <div class="d-flex col-md-6">
				<div class="value-button decreaseBtn" id="decrease"  value="Decrease Value" onclick="decreaseValue('zakatproject_number',{{ number_format($zakatproject->project_price) }})">-</div> 
				  <input type="number" class="number"  id="zakatproject_number" value="{{ number_format($zakatproject->project_price) }}"/>
				<div class="value-button increaseBtn" id="increase"  value="Increase Value" onclick="increaseValue('zakatproject_number',{{ number_format($zakatproject->project_price) }})">+</div> 
			</div>
			</div>
                <div class="row mt-3 " >   
                  <div class="col-md-3"><button type="button" class="btn w-100 BTN-1"  onclick="donatenow('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($zakatproject->project_id)] )}}','zakatproject_number')" > Donate Now</button></div>
                  <div class="col-md-3"><button type="button" class="btn w-100 BTN-1" onclick="addtocart('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($zakatproject->project_id)] )}}','zakatproject_number')"><i class="fa-solid fa-cart-shopping"></i></button></div>
                  
                  <div class="col-md-4 offset-md-2"><a href="{{route('zakat',app()->getLocale())}}" class="btn BTN-1 w-100">Calculate your Zakat</a></div>
                </div> 
            </div>
        </div>
        <div class="detailS_imG-1 col-md-3 p-0 ">
             <div class="detailS_imG">
                 <img src="assets/img/about-us-1.avif" class="w-100">
             </div>
        </div>
    </div>
  </div>
</section>
<!-- ======================== Zakat end ====================== -->

<!-- ======================== Project start ====================== -->
<section id="projectsTabs" class="container mt-5">
  <div class="projectsTabs ">
    <!-- -----Tab start----- -->
    <div class="row">
      <div class="table-responsive p-0" data-aos="flip-up" data-aos-duration="2000" data-aos-delay="100">
        <table class="table ">
          <thead class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <tr>
              <th scope="col-5" class="nav-item" role="presentation"><button class="nav-link active" id="pills-completed-tab" data-bs-toggle="pill" data-bs-target="#pills-completed" type="button" role="tab" aria-controls="pills-completed" aria-selected="true">New Projects</button></th>
              <th scope="col"class="nav-item" role="presentation"><button class="nav-link" id="pills-seasonal-tab" data-bs-toggle="pill" data-bs-target="#pills-seasonal" type="button" role="tab" aria-controls="pills-seasonal" aria-selected="false">Projects that Need Support</button></th>
              <th scope="col" class="nav-item" role="presentation"><button class="nav-link" id="pills-permanent-tab" data-bs-toggle="pill" data-bs-target="#pills-permanent" type="button" role="tab" aria-controls="pills-permanent" aria-selected="false">Completed Projects</button></th>
            </tr>
          </thead>
        </table>
      </div>
   
      <div class="tab-content" id="pills-tabContent">
        <!-- ---- Tab-1 ----- -->
        <div class="tab-pane fade show active" id="pills-completed" role="tabpanel" aria-labelledby="pills-completed-tab" tabindex="0">
          <div class="row">
			  @forelse ($newprojects as $key => $newproject)  
             <div class="col-md-4 block" >
                <!-- -------- Panel Start-------->
                <div class="panel" data-aos="fade" data-aos-duration="2000">
                  <div class="card">
                    <a href="{{route('chooseDonation',[app()->getLocale(),$newproject->project_code ] )}}">
                      <img src="uploads/projectimage/{{ $newproject->image }}" class="card-img-top d-block w-100 " alt="...">
                      
                    </a>
                      <div class="card-body">
                        <a href="{{route('chooseDonation',[app()->getLocale(), $newproject->project_code ])}}">
                          <h6 class=" mt-1 CLR ">{{ $newproject->project_name }} </h6>
                        </a>
                        
                        <div class="row mt-2">
						  <div class="col-md-2">
							  <p class="mb-0" style="font-size:12px;"><span>{{round($newproject->donated/$newproject->target_amount * 100) }}</span>%</p>
						  </div>
                          <div class="col-md-10">
                            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$newproject->donated/$newproject->target_amount * 100}}" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-success1 " style="width: {{$newproject->donated/$newproject->target_amount * 100}}%;">{{round($newproject->donated/$newproject->target_amount * 100)}}%</div>
                            </div>
                          </div>
                        </div>
                        <div class="row card-title borderd mt-3 cardAmountDetails pt-2">
                          <div class="col-4 borderRight ">
                              <h6 class="mt-1"><span>The Cost </span> </h6>
                              <p class="m-0">{{ number_format($newproject->target_amount) }} KD </p>
                          </div>
                          <div class="col-4 borderRight">
                              <h6 class="mt-1"><span>Donations</span> </h6>
                              <p class="m-0">{{ number_format($newproject->donated) }} KD </p>
                          </div>
                          <div class="col-4">
                              <h6 class="mt-1"><span>Residual</span> </h6>
                              <p class="m-0">{{ number_format($newproject->residual) }} KD </p>
                          </div>
                        </div>
                        <div class="row text-center mt-3">
                            <div class="d-flex">
                                <div class="value-button decreaseBtn" id="decrease" onclick="decreaseValue('newproject_number_{{$key}}',{{ number_format($newproject->project_price) }})" value="Decrease Value">-</div> 
                                  <input type="number" class="number" id="newproject_number_{{$key}}" value="{{ number_format($newproject->project_price) }}"/>
                                <div class="value-button increaseBtn" id="increase" onclick="increaseValue('newproject_number_{{$key}}',{{ number_format($newproject->project_price) }})" value="Increase Value">+</div> 
                            </div>
                        </div>
                        <div class="row mt-3">   
                          <div class="col-6"><button type="button" onclick="donatenow('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($newproject->project_id)] )}}','newproject_number_{{$key}}')" class="btn w-100 BTN-1"> Donate Now</button></div>
                          <div class="col-6"><button type="button" onclick="addtocart('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($newproject->project_id)] )}}','newproject_number_{{$key}}')" class="btn w-100 BTN-2"><i class="fa-solid fa-cart-shopping"></i></button></div>
                        </div>  
                      </div>
                  </div>
              </div>
                <!-- -------- Panel End---------->
             </div>
              @empty
               <p>No Projects</p>
              @endforelse
             
          </div>
           <div class="text-center mt-5">
            <a href="#" id="load" class="btn BTN-1">MORE <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
          </div>
        </div>
        <!-- ---- Tab-2 ----- -->
        <div class="tab-pane fade" id="pills-seasonal" role="tabpanel" aria-labelledby="pills-seasonal-tab" tabindex="0">
           <div class="row">
			  @forelse ($needsupportprojects as $key => $needsupportproject)  
             <div class="col-md-4 block2" >
                <!-- -------- Panel Start-------->
                <div class="panel" data-aos="fade" data-aos-duration="2000">
                  <div class="card">
                    <a href="{{route('chooseDonation',[app()->getLocale(), $needsupportproject->project_code ] )}}">
                      <img src="uploads/projectimage/{{ $needsupportproject->image }}" class="card-img-top d-block w-100 " alt="...">
                    </a>
                      <div class="card-body">
                        <a href="{{route('chooseDonation',[app()->getLocale(),$needsupportproject->project_code] )}}">
                          <h6 class=" mt-1 CLR ">{{ $needsupportproject->project_name }} </h6>
                        </a>
                        
                        <div class="row mt-2">
						  <div class="col-md-2">
							  <p class="mb-0" style="font-size:12px;"><span>{{round($needsupportproject->donated/$needsupportproject->target_amount * 100)}}</span>%</p>
						  </div>
                          <div class="col-md-10">
                            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$needsupportproject->donated/$needsupportproject->target_amount * 100}}" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-success1 " style="width: {{$needsupportproject->donated/$needsupportproject->target_amount * 100}}%;">{{round($needsupportproject->donated/$needsupportproject->target_amount * 100)}}%</div>
                            </div>
                          </div>
                        </div>
                        <div class="row card-title borderd mt-3 cardAmountDetails pt-2">
                          <div class="col-4 borderRight ">
                              <h6 class="mt-1"><span>The Cost </span> </h6>
                              <p class="m-0">{{ number_format($needsupportproject->target_amount) }} KD </p>
                          </div>
                          <div class="col-4 borderRight">
                              <h6 class="mt-1"><span>Donations</span> </h6>
                              <p class="m-0">{{ number_format($needsupportproject->donated) }} KD </p>
                          </div>
                          <div class="col-4">
                              <h6 class="mt-1"><span>Residual</span> </h6>
                              <p class="m-0">{{ number_format($needsupportproject->residual) }} KD </p>
                          </div>
                        </div>
                        <div class="row text-center mt-3">
                            <div class="d-flex">
                                <div class="value-button decreaseBtn" id="decrease" onclick="decreaseValue('needsupport_number_{{$key}}',{{ number_format($needsupportproject->project_price) }})" value="Decrease Value">-</div> 
                                  <input type="number" class="number" id="needsupport_number_{{$key}}" value="{{ number_format($needsupportproject->project_price) }}"/>
                                <div class="value-button increaseBtn" id="increase" onclick="increaseValue('needsupport_number_{{$key}}',{{ number_format($needsupportproject->project_price) }})" value="Increase Value">+</div> 
                            </div>
                        </div>
                        <div class="row mt-3">   
                          <div class="col-6"><button type="button" onclick="donatenow('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($needsupportproject->project_id)] )}}','needsupport_number_{{$key}}')"  class="btn w-100 BTN-1"> Donate Now</button></div>
                          <div class="col-6"><button type="button"  onclick="addtocart('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($needsupportproject->project_id)] )}}','needsupport_number_{{$key}}')" class="btn w-100 BTN-2"><i class="fa-solid fa-cart-shopping"></i></button></div>
                        </div>  
                      </div>
                  </div>
              </div>
                <!-- -------- Panel End---------->
             </div>
              @empty
               <p>No Projects</p>
              @endforelse
             
          </div>
          <div class="text-center mt-5">
            <a href="#" id="load2" class="btn BTN-1">MORE <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
          </div>
          
        </div>
        <!-- ---- Tab-3 ----- -->
        <div class="tab-pane fade" id="pills-permanent" role="tabpanel" aria-labelledby="pills-permanent-tab" tabindex="0">
          <div class="row">
			  @forelse ($completeprojects as $key => $completeproject)  
             <div class="col-md-4 block3" >
                <!-- -------- Panel Start-------->
                <div class="panel" data-aos="fade" data-aos-duration="2000">
                  <div class="card">
                    <a href="{{route('chooseDonation',[app()->getLocale(), $completeproject->project_code ] )}}">
                      <img src="uploads/projectimage/{{ $completeproject->image }}" class="card-img-top d-block w-100 " alt="...">
                      <img src="assets/img/completeproject.png" class="card-img-top d-block w-100 completeprojectImg" alt="...">
                    </a>
                      <div class="card-body">
                        <a href="{{route('chooseDonation',[app()->getLocale(), $completeproject->project_code ] )}}">
                          <h6 class=" mt-1 CLR ">{{ $completeproject->project_name }} </h6>
                        </a>
                                       
                         <div class="row mt-2">
						  <div class="col-md-2">
							  <p class="mb-0" style="font-size:12px;"><span>{{round($completeproject->donated/$completeproject->target_amount * 100)}}</span>%</p>
						  </div>
                          <div class="col-md-10">
                            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$completeproject->donated/$completeproject->target_amount * 100}}" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-success1 " style="width: {{$completeproject->donated/$completeproject->target_amount * 100}}%;">{{round($completeproject->donated/$completeproject->target_amount * 100)}}%</div>
                            </div>
                          </div> 
                        </div>
                        <div class="row card-title borderd mt-3 cardAmountDetails pt-2">
                          <div class="col-4 borderRight ">
                              <h6 class="mt-1"><span>The Cost </span> </h6>
                              <p class="m-0">{{ number_format($completeproject->target_amount) }} KD </p>
                          </div>
                          <div class="col-4 borderRight">
                              <h6 class="mt-1"><span>Donations</span> </h6>
                              <p class="m-0">{{ number_format($completeproject->donated) }} KD </p>
                          </div>
                          <div class="col-4">
                              <h6 class="mt-1"><span>Residual</span> </h6>
                              <p class="m-0">{{ number_format($completeproject->residual) }} KD </p>
                          </div>
                        </div>
                        <div class="row text-center mt-3">
                            <div class="d-flex">
                                <div class="value-button decreaseBtn" id="decrease" onclick="decreaseValue('completeproject_number_{{$key}}',{{ number_format($completeproject->project_price) }})" value="Decrease Value">-</div> 
                                  <input type="number" class="number" id="completeproject_number_{{$key}}" value="{{ number_format($completeproject->project_price) }}"/>
                                <div class="value-button increaseBtn" id="increase" onclick="increaseValue('completeproject_number_{{$key}}',{{ number_format($completeproject->project_price) }})" value="Increase Value">+</div> 
                            </div>
                        </div>
                        <!--<div class="row mt-3">   
                          <div class="col-6"><button type="button" class="btn w-100 BTN-1"> Donate Now</button></div>
                          <div class="col-6"><button type="button" onclick="addtocart('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($completeproject->project_id)] )}}','completeproject_number_{{$key}}')" class="btn w-100 BTN-2"><i class="fa-solid fa-cart-shopping"></i></button></div>
                        </div>  -->
                      </div>
                  </div>
              </div>
                <!-- -------- Panel End---------->
             </div>
              @empty
               <p>No Projects</p>
              @endforelse
             
          </div>
          <div class="text-center mt-5">
            <a href="#" id="load3" class="btn BTN-1">MORE <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
          </div>
        </div>
      
      </div>
    </div>
     <!-- -----Tab end----- -->
  </div>
</section>
<!-- ====================== Projectsection End ===================== -->

 <!-- ======================= Blog/News Start ====================== -->
 <section id="siteNews" class="siteNews mt-5">
  <div class="sectionHeading mb-4 mt-3">
    <h1 class="text-center CLR" data-aos="fade-down" data-aos-duration="1000">Site's News</h1>
    <p class="text-center" data-aos="fade-up" data-aos-duration="1000">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
  </div>
  <div class="container">
    <div class="row" data-aos="fade" data-aos-duration="2000">
		
	 @forelse ($newses as $key => $news)  	
      <div class="col-md-3 hover" >
        <div class="snip1527 ">
          <div class="image"><img src="../uploads/news/{{$news->bannerImage}}" alt="pr-sample24" /></div>
          <div class="date ">
            <p>{{ date('j M, Y', strtotime($news->publish_date)) }}</p>
          </div>
          <figcaption>
            <p class="cardDetail"> <span> {{ $news->city }} </span> <i class="fa-solid fa-location-dot"></i> <span> {{ date('H:i A', strtotime($news->time)) }} </span> <i class="fa-solid fa-clock"></i></p> 
            <h6>{{ $news->title }}</h6>
          </figcaption>
          <a href="{{route('newsdetails',[app()->getLocale(), encrypt($news->newsid)] )}}"></a>
        </div>
      </div>
     @empty
      <div class="col-md-3 hover" >
         <p>No News</p>
      </div>
     
     @endforelse
     

    </div>
  </div>
</section>
<!-- ======================= Our Achievements Start ====================== -->
<section id="AchievementsCount" class="siteNews mt-5 " >
  <div class="container justify-content-center ">
    <div class="row AchievementsCountBack">
      <div class="col-12 ">
        <div class="row  ">
          <div class="four col-3">
            <div class="counter-box colored"><span class="counter">{{$totalprojects}}</span>
                <p>Total Projects</p>
            </div>
          </div>
          <div class="four col-3">
            <div class="counter-box"><span class="counter">{{$totaldonation}}</span>
                <p>Total Donations</p>
            </div>
          </div>
          <div class="four col-3">
            <div class="counter-box"><span class="counter">{{$totalusers}}</span>
                <p>Total Users</p>
            </div>
          </div>
          <div class="four col-3">
            <div class="counter-box"> <span class="counter">{{$totalmarketer}}</span>
                <p>Total Marketers</p>
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
    function donatenow(route,id)
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
               location.href= '{{ route('cart',app()->getLocale()) }}'
            }
        });
    }
    $(document).ready(function () { 
            $(".block").slice(0, 6).show(); 
            if ($(".block:hidden").length != 0) { 
                $("#load").show(); 
            } 
            $("#load").on("click", function (e) { 
                e.preventDefault(); 
                $(".block:hidden").slice(0, 6).slideDown(); 
                if ($(".block:hidden").length == 0) { 
                    $("#load").text("No More to view") 
                        .fadOut("slow"); 
                } 
            }); 
        })
        
    
    $(document).ready(function () { 
            $(".block2").slice(0, 3).show(); 
            if ($(".block2:hidden").length != 0) { 
                $("#load2").show(); 
            } 
            $("#load2").on("click", function (e) { 
                e.preventDefault(); 
                $(".block2:hidden").slice(0, 3).slideDown(); 
                if ($(".block2:hidden").length == 0) { 
                    $("#load2").text("No More to view") 
                        .fadOut("slow"); 
                } 
            }); 
        })  
        
     $(document).ready(function () { 
            $(".block3").slice(0, 3).show(); 
            if ($(".block3:hidden").length != 0) { 
                $("#load3").show(); 
            } 
            $("#load3").on("click", function (e) { 
                e.preventDefault(); 
                $(".block3:hidden").slice(0, 3).slideDown(); 
                if ($(".block3:hidden").length == 0) { 
                    $("#load3").text("No More to view") 
                        .fadOut("slow"); 
                } 
            }); 
        })  
  
</script>


@stop




