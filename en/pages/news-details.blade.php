@extends('en.layouts.default')

@section('content')

<!-- =================== Side wrapper donation start=============== -->
  <section id="newsinner_Page" class="">
    <div class="container">
      <div class="row mt-4">
         <div class="col-md-9">
             <div class="news_Details ">
                <img src="../../../uploads/news/{{$news_details->bannerImage}}" alt="" srcset="">
                <div class="row justify-content-between mt-3">
                  <div class="col-6">
                      <p class="blogDetailpara"><i class="bi bi-clock-fill"></i><span style="font-size: 14px; font-weight: 700;"> {{ date('l, j M Y', strtotime($news_details->publish_date)) }}</span> </p>
                  </div>
                  <div class="col-6">
                      <p class="blogDetailpara text-end">
                        <a href="#"><i class="bi bi-facebook"></i> </a>
                        <a href="#"><i class="bi bi-twitter"></i>  </a>
                        <a href="#"> <i class="bi bi-whatsapp"></i> </a>
                      </p>
                  </div>
                </div>
                <h4 class="fw-bold">{{ $news_details->title }}</h4>
                <p style="font-size: 15px; text-align: justify;">{!! $news_details->description !!}</p>
             </div>
         </div>
         <div class="col-md-3"> 
           <h4 class="fw-bold border-bottom pb-3">Other news</h4>
           
            @foreach ($newss as $key => $news)  
           
           <div class="side_wrrapernews mt-3">
            <a href="{{route('newsdetails',[app()->getLocale(), encrypt($news->newsid)] )}}">
             <img src="../../../uploads/news/{{$news->bannerImage}}" alt="" srcset="">
             <div class="row justify-content-between mt-3">
               <div class="col">
                   <p class="blogDetailpara mb-2"><i class="bi bi-clock-fill"></i> <span style="font-size: 12px; font-weight: 700;"> {{ date('l, j M Y', strtotime($news->publish_date)) }}</span> </p>
               </div>
             </div>
             <h6 class="fw-bold">{{ $news->title }}</h6>
            </a>
           </div>
           @endforeach

       

         </div>
      </div>
    </div>
  </section>

@stop
