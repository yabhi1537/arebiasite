@extends('ar.layouts.default')

@section('content')


  <!-- ========================= hero section start ======================= -->
  <div id="aboutHero">
    <div  class="bsb-hero-1 px-3 bsb-overlay bsb-hover-pull" style="background-image:url('/uploads/sponsortitleimage/{{$sponsershipsheader->image}}');">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-11 col-lg-9 col-xl-7 col-xxl-6 text-center text-white mt-5 pt-5">
            <h1 class="display-3 fw-bold mb-3 mt-5">{{$sponsershipsheader->title_ar}}</h1>
            <p class=" mb-5">{{$sponsershipsheader->description_ar}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ========================= hero section End ======================= -->

<!-- ====================== Calculator Section Start ===================== -->

<section id="sponsorShip" class="container mt-5">
    <div class="sponsorShip " style="margin:0 auto; width: 96%;">
      <div class="row sectionHeading mb-3">
        <h1 class="text-center CLR">رعاية</h1>
        <p class="text-center"></p>
      </div>
      <!-- -----Tab start----- -->
      <div class="row">
        <div class="col-md-4">
          <div class="img_Box text-center">
            <a href="#">
              <img src="../assets/img/teacher.png" alt="" srcset="">
              <h6 class="text-center CLR mt-3">مدرس</h6>
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="img_Box text-center">
            <a href="#">
              <img src="../assets/img/hafez.png" alt="" srcset="" >
              <h6 class="text-center CLR mt-3">حافظ</h6>
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="img_Box text-center">
            <a href="#">
              <img src="../assets/img/oraphone.png" alt="" srcset="" >
              <h6 class="text-center CLR mt-3">حافظ (يتيم)</h6>
            </a>
          </div>
        </div>
      </div>

      <div class="row mt-5">
		   @forelse ($sponserships as $key => $sponsership)  
         <div class="col-md-4 block4">
            <div class="box p-3">
               <div class="row">
                  <div class="col-5">
                     <img src="../assets/img/54.png" alt="" class="w-100">
                  </div>
                  <div class="col-7">
                     <div class="details text-end">
                        <p class="CLR mb-1">اسم / {{ $sponsership->name_ar }}</p>
                        <p class="mb-1">عمر: <span>{{ $sponsership->age }}</span> سنين</p>
                        @if($sponsership->gender == 1)
                        <p class="mb-1">جنس: ذكر</p>
                        @else
                        <p class="mb-1">جنس: أنثى</p>
                        @endif
                        <p class="mb-1">يكتب: {{ $sponsership->sponser_type_ar }}</p>
                        <p class="mb-1 mt-3 CLR">{{ $sponsership->country_ar }}  <span> <img src="../assets/img/kw.png" class="flag_img"></span></p>
                     </div>
                  </div>
                  <div class=" text-center mt-3">
                    <div class="MiniLeftNav">
                        <div class="sharethis">
                            <a class="navtext" href="#"><i class="fa fa-share-alt"></i>
                              <span class="arrow_box_left">
                                <i class="fa fa-clipboard"></i>
                                <i class="fa fa-whatsapp"></i>
                                <i class="fa fa-facebook"></i>
                                <i class="fa fa-twitter"></i>
                              </span>
                            </a>
                        </div>
                    </div>
                  </div>
               </div>
               <div class=" row mt-3 justify-content-center">   
                <div class="col-4 "><button type="button" class="btn w-100 BTN-1" onclick="donatenow('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($sponsership->id)] )}}','sponserprice_{{$key}}')" >راعي</button></div>
                <div class="col-4 "><button type="button" class="btn w-100 BTN-2" onclick="addtocart('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($sponsership->id)] )}}','sponserprice_{{$key}}')"><i class="fa-solid fa-cart-shopping"></i></button></div>
                <div class="col-4 ">
                  <div class="d-flex">
                    <div class="value-button decreaseBtn" id="decrease"  value="Decrease Value">-</div> 
                    <input disabled type="number" id="sponserprice_{{$key}}" class="number" value="{{ $sponsership->project_price }}"/>
                    <div class="value-button increaseBtn" id="increase"  value="Increase Value">+</div> 
                  </div>
                </div>
              </div>  
            </div>
         </div>
           @empty
		   <p>لا الراعي</p>
		  @endforelse

          <div class="mt-5">
            <button type="button" id="load4"  class="btn w-100 BTN-1">أكثر</button>
          </div>
         
      </div>
    </div>
  </section>
<!-- ====================== Projects Section End ===================== -->

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
                type:'sponser',
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
                type:'sponser',
            },
            success: function (response) {
               location.href= '{{ route('cart',app()->getLocale()) }}'
            }
        });
    }
   $(document).ready(function () { 
            $(".block4").slice(0, 3).show(); 
            if ($(".block4:hidden").length != 0) { 
                $("#load4").show(); 
            } 
            $("#load4").on("click", function (e) { 
                e.preventDefault(); 
                $(".block4:hidden").slice(0, 3).slideDown(); 
                if ($(".block4:hidden").length == 0) { 
                    $("#load4").text("No More to view") 
                        .fadOut("slow"); 
                } 
            }); 
        })  
  
</script>
@stop
