@extends('en.layouts.default')

@section('content')

  <!-- ========================= hero section start ======================= -->
 <div id="aboutHero">
    <div  class="bsb-hero-1 px-3 bsb-overlay bsb-hover-pull" style="background-image:url('/uploads/newsreporttitleimage/{{$newsreportheader->image}}');">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-11 col-lg-9 col-xl-7 col-xxl-6 text-center text-white mt-5 pt-5">
            <h1 class="display-3 fw-bold mb-3 mt-5">{{$newsreportheader->title}}</h1>
            <p class=" mb-5">{{$newsreportheader->description}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ========================= hero section End ======================= -->

<!-- ====================== Projects Section Start ===================== -->
<section id="mediaReports" class="container mt-5">
  <div class="mediaReports " style="margin:0 auto; width: 95%;">
    <div class="row sectionHeading mb-3">
      <h1 class="text-center CLR">Our News and Reports</h1>
      <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
    </div>
    <!-- -----Tab start----- -->
    <div class="row">
      <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-completed-tab" data-bs-toggle="pill" data-bs-target="#pills-completed" type="button" role="tab" aria-controls="pills-completed" aria-selected="true">Projects reports</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-seasonal-tab" data-bs-toggle="pill" data-bs-target="#pills-seasonal" type="button" role="tab" aria-controls="pills-seasonal" aria-selected="false">General news</button>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <!-- ---- Tab-1 ----- -->
        <div class="tab-pane fade show active" id="pills-completed" role="tabpanel" aria-labelledby="pills-completed-tab" tabindex="0">
          <div class="row">
            @forelse ($projectreportnewss as $key => $news)  	
				  <div class="col-md-3 hover" >
					<div class="snip1527 ">
					  <div class="image"><img src="../../uploads/news/{{$news->bannerImage}}" alt="pr-sample24" /></div>
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
        <!-- ---- Tab-2 ----- -->
        <div class="tab-pane fade" id="pills-seasonal" role="tabpanel" aria-labelledby="pills-seasonal-tab" tabindex="0">
          <div class="row">
            @forelse ($generalnewss as $key => $news)  	
				  <div class="col-md-3 hover" >
					<div class="snip1527 ">
					  <div class="image"><img src="../../uploads/news/{{$news->bannerImage}}" alt="pr-sample24" /></div>
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
      </div>
    </div>
     <!-- -----Tab end----- -->
  </div>
</section>
<!-- ====================== Projects Section End ===================== -->
@stop
