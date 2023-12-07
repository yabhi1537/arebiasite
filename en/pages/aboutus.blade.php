@extends('en.layouts.default')

@section('content')

    <!-- ========================= hero section start ======================= -->
    <div id="aboutHero">
      <div  class="bsb-hero-1 px-3 bsb-overlay bsb-hover-pull">
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="col-12 col-md-11 col-lg-9 col-xl-7 col-xxl-6 text-center text-white mt-5 pt-5">
              <h1 class="display-3 fw-bold mb-3 mt-5">{{$aboutusdata->title}}</h1>
              <p class=" mb-5">{{$aboutusdata->description}}</p>
            </div>
          </div>
        </div>
      </div>
    </div> 
   <!-- ========================= hero section End ======================= -->

   <!-- ========================= mission-vision Start ======================= -->
    <section id="mission-vision" class="container mt-5">
      <div class="mission-vision" style="margin:0 auto; width: 95%;">
        <div class="row sectionHeading mb-4">
          <h1 class="text-center CLR">Vision and mission</h1>
          <p class="text-center" >{{$aboutusdata->titles}}</p>
        </div>

        <div class="container my-5">
          <div class="row">
            <div class="col-md-6">
              <img class="w-100 shadow" src="../../uploads/visionmission/photo/{{$aboutusdata->photo}}" />
            </div>
            <div class="col-md-6">
              <div class="p-md-5 py-md-0 mt-4">
                  <h3 class="CLR">Our mission </h3>
                  <p class="" style="font-size: 14px;">{{$aboutusdata->mission}}</p>
              </div>
              <div class="p-md-5 py-md-0 pt-0 mt-4">
                  <h3 class="CLR">Our vision </h3>
                  <p class="" style="font-size: 14px;">{{$aboutusdata->vision}}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
   <!-- ========================= mission-vision End ======================= -->

   <!-- ========================= Objective Start ======================= -->
   <section id="mission-vision" class="mission-vision mt-0">
    <div class="container" >
      <div class="row sectionHeading">
        <h1 class="text-center CLR">Objectives</h1>
        <p class="text-center">{{$aboutusdata->obj_title}}</p>
      </div>
      <div class="my-4" style="margin:0 auto; width: 95%;">
       {!!$aboutusdata->obj_description!!}
      </div>
    </div>
  </section>
   <!-- ========================== Objective End ======================== -->

   <!-- ========================== Founder start ======================== -->
   <section id="mission-vision" class="mission-vision ">
    <div class="container">
      <div class="row sectionHeading">
        <h1 class="text-center CLR">Founder of the association</h1>
        <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
      </div>

      <div class="row mt-4" style="margin:0 auto; width: 95%;">
	 @forelse ($founders as $key => $founder)  	  
        <div class="col-md-3">
          <div class="panel">
            <div class="card" style="width: auto ;">
              <a href="#">
                <img src="../../uploads/founder/image/{{$founder->image}}" class="card-img-top d-block w-100" alt="...">
              </a>
                <div class="card-body">
                    <h6 class=" mt-1 CLR text-center">{{$founder->name}}</h6>
                  <p class="mt-3 text-center" style="font-size: 14px; font-weight: 700;">{{$founder->designation}}</p>
                </div>
            </div>
          </div>
        </div>
         @empty
               <p>No Founders</p>
         @endforelse
      </div> 
    </div>
  </section>
   <!-- ========================== Founder End ======================== -->

   <!-- ========================== Members of the board start ======================== -->
    <section id="mission-vision" class="mission-vision mt-5">
      <div class="container">
        <div class="row sectionHeading">
          <h1 class="text-center CLR">Members of the board of directors</h1>
          <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
        </div>

        <div class="row mt-4" style="margin:0 auto; width: 95%;">
		@forelse ($memberofboards as $key => $memberofboard)  	
          <div class="col-md-3">
            <div class="panel">
              <div class="card" style="width: auto ;">
                <a href="#">
                  <img src="../../uploads/memberboard/image/{{$memberofboard->image}}" class="card-img-top d-block w-100" alt="...">
                </a>
                  <div class="card-body">
                      <h6 class=" mt-1 CLR text-center">{{$founder->name}}</h6>
                    <p class="mt-3 text-center" style="font-size: 14px; font-weight: 700;">{{$founder->designation}}</p>
                  </div>
              </div>
            </div>
          </div>
           @empty
               <p>No Members</p>
         @endforelse
        </div> 
      </div>
    </section>
   <!-- ========================== Members of the board End ======================== -->

   <!-- ========================== Our Achievements start ======================== -->
   <section id="mission-vision" class="mission-vision mt-5 mb-5">
    <div class="container">
      <div class="row sectionHeading">
        <h1 class="text-center CLR">Our achievements</h1>
        <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
      </div>

      <div class="row mt-4" style="margin:0 auto; width: 95%;">
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
                    <h6 class="card-title">{{$achivement->description}}</h6>
                  </div>
              </div>
          </div>
          @empty
               <p>No achievements</p>
         @endforelse
      </div> 
    </div>
  </section>
 <!-- ========================== Our Achievements start ======================== -->
 @stop
