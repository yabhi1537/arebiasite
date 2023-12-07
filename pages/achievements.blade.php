@extends('ar.layouts.default')

@section('content')

  <!-- ========================= hero section start ======================= -->
  <div id="aboutHero">
    <div  class="bsb-hero-1 px-3 bsb-overlay bsb-hover-pull" style="background-image:url('/uploads/achievementsttitleimage/{{$achievementsheader->image}}');">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-11 col-lg-9 col-xl-7 col-xxl-6 text-center text-white mt-5 pt-5">
            <h1 class="display-3 fw-bold mb-3 mt-5">{{$achievementsheader->title_ar}}</h1>
            <p class=" mb-5">{{$achievementsheader->description_ar}}</p>
          </div>
        </div>
      </div>
    </div>
  </div> 
  <!-- ========================= hero section End ======================= -->

<!-- ====================== Projects Section Start ===================== -->
<section id="mediaReports" class="container mt-5">
    <div class="mediaReports " >
        <div class="row sectionHeading mb-3">
            <h1 class="text-center CLR">إنجازاتنا</h1>
            <p class="text-center">لوريم إيبسوم هو ببساطة نص وهمي من صناعة الطباعة والتنضيد</p>
        </div>
        <div class="row" style="margin:0 auto; width: 96%;">
		@forelse ($achivements as $key => $achivement)  		
          <div class="col-12 col-md-6 col-xl-4 mb-4">
              <div class="card mr-3">
                  <img src="../../uploads/achivement/images/{{$achivement->images}}" class="card-img-top" alt="...">
                  <div class="card-body">
                      <div class="row justify-content-between">
                          <div class="col-6">
                              <p class="blogDetailpara">{{$achivement->achivement_type}} <i class="fa-solid fa-folder-open"></i></p>
                          </div>
                          <div class="col-6">
                              <p class="blogDetailpara text-end">{{ date('j M, Y', strtotime($achivement->created_at)) }} <i class="fa-solid fa-clock"></i></p>
                          </div>
                      </div>
                    <h6 class="card-title">{{$achivement->description_ar}}</h6>
                  </div>
              </div>
          </div>
          @empty
               <p>لا توجد إنجازات</p>
         @endforelse
      </div>
</section>
<!-- ====================== Projects Section End ===================== -->
@stop
