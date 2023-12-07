@extends('ar.layouts.default')

@section('content')

  <!-- ====================== Section Start ===================== -->
  <section id="mediaGallery" class="container mt-3 mb-5">
    <div class="row justify-content-center">

      <div class="donationTab mt-5">
        <ul class="nav nav-pills justify-content-center" id="pills-tab" role="tablist">
          <li class="nav-item me-2" role="presentation">
            <button class="nav-link active" id="pills-Videos-tab" data-bs-toggle="pill" data-bs-target="#pills-Videos"
              type="button" role="tab" aria-controls="pills-Videos" aria-selected="true">أشرطة فيديو</button>
          </li>
          <li class="nav-item me-2" role="presentation">
            <button class="nav-link" id="pills-Image-tab" data-bs-toggle="pill" data-bs-target="#pills-Image"
              type="button" role="tab" aria-controls="pills-Image" aria-selected="false">صورة</button>
          </li>
          <li class="nav-item me-2" role="presentation">
            <button class="nav-link" id="pills-Pdf-tab" data-bs-toggle="pill" data-bs-target="#pills-Pdf"
              type="button" role="tab" aria-controls="pills-Pdf" aria-selected="false">بي دي إف</button>
          </li>
        </ul> 
      </div>
      <div class="tab-content" id="pills-tabContent">
        <!-- ========== tab-1 ========== -->
        <div class="tab-pane fade show active" id="pills-Videos" role="tabpanel" aria-labelledby="pills-Videos-tab"
          tabindex="0">
          <div class="row my-4">
			  @forelse ($media_videos as $key => $media_video)  		
            <div class="col-12 col-sm-6 col-lg-4 mb-3 mb-lg-4 px-2 px-lg-2 position-relative"><a
                href="{{ $media_video->video_image }}" class="light-gallery-trigger d-block"><iframe
                  width="100%" height="250" src="{{ $media_video->video_image }}" frameborder="0"
                  allowfullscreen="allowfullscreen" autohide="1"></iframe>
                <p class="title" style="font-size: 14px; color: #717891; font-weight: 600;">
                     {{ $media_video->title_ar }}
                </p>
              </a>
            </div>
            @empty
               <p>لا يوجد فيديو متاح الآن</p>
              @endforelse
            
          </div>
        </div>
        <div class="tab-pane fade" id="pills-Image" role="tabpanel" aria-labelledby="pills-Image-tab"
          tabindex="0">
          <div class="row my-4">
            @forelse ($media_images as $key => $media_image)  		
            <div class="col-12 col-sm-6 col-lg-4 mb-3 mb-lg-4 px-2 px-lg-2 position-relative"><img
                  width="100%" height="250" src="../../uploads/gallery/video_image/{{ $media_image->video_image }}" >
                <p class="title" style="font-size: 14px; color: #717891; font-weight: 600;">
                     {{ $media_image->title_ar }}
                </p>
              
            </div>
            @empty
               <p>لا توجد صورة متاحة الآن</p>
              @endforelse
          </div>
        </div>
         <div class="tab-pane fade" id="pills-Pdf" role="tabpanel" aria-labelledby="pills-Pdf-tab"
          tabindex="0">
          <div class="row my-4">
            @forelse ($media_pdfs as $key => $media_pdf)  		
            <div class="col-12 col-sm-6 col-lg-4 mb-3 mb-lg-4 px-2 px-lg-2 position-relative"><iframe src="{{URL::asset('uploads/gallery/video_image/'.$media_pdf->video_image)}}" style="width:250px; height:250px;" frameborder="0"></iframe>
                 <p class="title" style="font-size: 14px; color: #717891; font-weight: 600;"><a target="_blank" href="{{URL::asset('uploads/gallery/video_image/'.$media_pdf->video_image)}}">{{ $media_pdf->video_image}}</a> </p>
                <p class="title" style="font-size: 14px; color: #717891; font-weight: 600;">
                     {{ $media_pdf->title_ar }}
                </p>
              
            </div>
            @empty
               <p>لا يوجد قوات الدفاع الشعبي المتاحة الآن</p>
              @endforelse
          </div>
        </div>
      </div>

    </div>
  </section>
@stop
