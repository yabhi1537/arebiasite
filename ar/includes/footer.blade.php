<!--========================== Footer ============================-->
@php   $contactdetails_head =  DB::table('manage_domain')->get()->first(); @endphp
<footer class="text-center text-lg-start text-muted mt-5">
  
  <section class="footer pt-1">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            <a href="{{route('home')}}"><img src="{{url('uploads/contact/logo/'.$contactdetails_head->logo.'' )}}" alt="" srcset=""></a>
          </h6>
          <p>
{!!$contactdetails_head->description_ar!!}
          </p>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase  mb-4">
            روابط مفيدة
          </h6>
           <p>
            <a href="{{route('home')}}" class="text-reset">بيت</a>
          </p>
          <p>
             <a  href="{{route('requestyourproject',app()->getLocale()) }}" class="text-reset">اطلب مشروعك</a>
          </p>
           <p>
             <a  href="{{route('needy_families',app()->getLocale()) }}" class="text-reset">دعم الأسر المحتاجة </a>
          </p>
        </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase  mb-4">
            روابط مفيدة
          </h6>
           <p>
            <a href="{{route('governance',app()->getLocale())}}" class="text-reset">دعم الأسر المحتاجة</a>
          </p>
           <p>
            <a href="{{route('faq',app()->getLocale())}}" class="text-reset">الحكم</a>
          </p>
          <p>
            <a href="{{route('aboutus',app()->getLocale())}}" class="text-reset">عن</a>
          </p>
          <p>
            <a href="{{route('contactus',app()->getLocale())}}" class="text-reset">اتصل بنا</a>
          </p>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3  mb-md-0 mb-4">
          <h6 class="text-uppercase mb-4">اتصال</h6>
          <p><i class="fa-solid fa-house"></i> {{$contactdetails_head->address_ar}}, {{$contactdetails_head->city_ar}} {{$contactdetails_head->pincode}}</p>
          <p><i class="fa-solid fa-envelope-open-text"></i> {{$contactdetails_head->email}}</p>
          <p><i class="fa-solid fa-phone"></i> {{$contactdetails_head->phone}}</p>
        </div> 
      </div>
    </div>
  </section>
  
  <div class="text-center p-4 text-white" style="background-color: #29a64a">
   © 2023 حقوق النشر:
    <a class="text-reset fw-bold" href="#">الحكماكو</a>
  </div>
</footer>
<!-- =========================== Footer End ====================== -->
<script>
      AOS.init();
    </script>

