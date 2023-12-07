@extends('en.layouts.default')

@section('content')

  <!-- ========================= hero section start ======================= -->
 <div id="aboutHero">
    <div  class="bsb-hero-1 px-3 bsb-overlay bsb-hover-pull" style="background-image:url('/uploads/smallkidtitleimage/{{$smallkiddonorheader->image}}');">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-11 col-lg-9 col-xl-7 col-xxl-6 text-center text-white mt-5 pt-5">
            <h1 class="display-3 fw-bold mb-3 mt-5">{{$smallkiddonorheader->title}}</h1>
            <p class=" mb-5">{{$smallkiddonorheader->description}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ========================= hero section End ======================= -->

<!-- ====================== Calculator Section Start ===================== -->

<section id="mediaReports" class="container mt-5">
  <div class="mediaReports ">
    <div class="row sectionHeading">
      <h1 class="text-center CLR">Small Kid Donor</h1>
      <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
    </div>
   
    <div class="row " style="margin:0 auto; width: 96%;">
		@forelse ($smallkidsprojects as $key => $smallkidsproject) 
        <div class="col-md-4 ">
         <!-- -------- Panel Start-------->
         <div class="panel mt-3">
          <div class="card" style="width: auto ;">
            <a href="{{route('chooseDonation',[app()->getLocale(), $smallkidsproject->project_code ] )}}">
                <img src="../uploads/projectimage/{{ $smallkidsproject->image }}" class="card-img-top d-block w-100" alt="...">
            </a>
              <div class="card-body">
               <a href="{{route('chooseDonation',[app()->getLocale(), $smallkidsproject->project_code ] )}}">
                 <h6 class=" mt-1 card-title">{{ $smallkidsproject->project_name }}</h6>
               </a>
    
                  <div class="row text-center mt-3">
                   <div class="d-flex">
                      <div class="value-button decreaseBtn" id="decrease" onclick="decreaseValue('smallkidsproject_number_{{$key}}',{{ number_format($smallkidsproject->project_price) }})" value="Decrease Value">-</div> 
					  <input type="number" class="number" id="smallkidsproject_number_{{$key}}" value="{{ number_format($smallkidsproject->project_price) }}"/>
					<div class="value-button increaseBtn" id="increase" onclick="increaseValue('smallkidsproject_number_{{$key}}',{{ number_format($smallkidsproject->project_price) }})" value="Increase Value">+</div> 
                   </div>
                  </div>
       
                  <div class="row mt-3">  
					   <div class="col-12"><button type="button" onclick="donatenow('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($smallkidsproject->project_id)] )}}','smallkidsproject_number_{{$key}}')"  class="btn w-100 BTN-1"> DONATE NOW <i class="fa-solid fa-money-bill-wave"></i></button></div>
					    
                    
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
  </div>
</section>
<!-- ====================== Projects Section End ===================== -->
<script type="text/javascript">
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
   
  
</script>
@stop
