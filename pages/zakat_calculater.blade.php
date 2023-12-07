@extends('ar.layouts.default')

@section('content')

  <!-- ========================= hero section start ======================= -->
<div id="aboutHero">
    <div  class="bsb-hero-1 px-3 bsb-overlay bsb-hover-pull" style="background-image:url('/uploads/zakatshowimage/{{$zakatheader->image}}');">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-11 col-lg-9 col-xl-7 col-xxl-6 text-center text-white mt-5 pt-5">
            <h1 class="display-3 fw-bold mb-3 mt-5">{{$zakatheader->title_ar}}</h1>
            <p class=" mb-5">{{$zakatheader->description_ar}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ========================= hero section End ======================= -->

<!-- ====================== Calculator Section Start ===================== -->
<section id="zakatCalculator" class="container mt-5 mb-5">
  <div class="mediaReports ">
    <div class=" sectionHeading mb-3">
      <h1 class="text-center CLR">حاسبة الزكاة</h1>
    </div>
    <!-- -----Tab start----- -->
    <div class="row">
      <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
		 <li class="nav-item me-2" role="presentation">
            <button class="nav-link BTN-1 active" id="moneyZakat-tab" data-bs-toggle="pill" data-bs-target="#pills-moneyZakat" type="button" role="tab" aria-controls="pills-moneyZakat" aria-selected="false"> زكاة المال</button>
        </li> 
        <li class="nav-item me-2" role="presentation">
          <button class="nav-link BTN-1" id="shareZakat-tab" data-bs-toggle="pill" data-bs-target="#pills-shareZakat" type="button" role="tab" aria-controls="pills-shareZakat" aria-selected="true"> أسهم الزكاة</button>
        </li>
        <li class="nav-item me-2" role="presentation">
          <button class="nav-link BTN-1" id="metalZakat-tab" data-bs-toggle="pill" data-bs-target="#pills-metalZakat" type="button" role="tab" aria-controls="pills-metalZakat" aria-selected="false"> الزكاة المعدنية</button>
        </li>
        <li class="nav-item me-2" role="presentation">
          <button class="nav-link BTN-1" id="goldZakat-tab" data-bs-toggle="pill" data-bs-target="#pills-goldZakat" type="button" role="tab" aria-controls="pills-goldZakat" aria-selected="false"> زكاة الذهب</button>
        </li>
        
      </ul>
      <div class="tab-content" id="pills-tabContent">
		   <!-- ---- Tab-1 ----- -->
        <div class="tab-pane fade show active" id="pills-moneyZakat" role="tabpanel" aria-labelledby="pills-moneyZakat-tab" tabindex="0">
            <div class="row justify-content-center">
                <div class="col-md-11">
                  <!-- -------- Panel Start-------->
                  <div class="panel mt-3">
                      <div class="card" style="width: auto ;">
                          <div class="card-body">
                            <label class="CLR mt-3 mb-2">القيمة</label>
                              <div class="mb-2">
                                  <input type="number" name="txtzakatcalc_0" id="txtzakatcalc_0" onkeyup="ValidateAmount('0')" class="form-control">
                                   <span id="txtzakatcalc_error_0" class="text-danger bold"></span>
                              </div>
                              <label class="CLR mt-2 mb-2">نوع الزكاة</label>
                              <select class="form-select f-14" id="txtzakatdrp_0" name="txtzakatdrp_0" onchange="ValidateSelect('0')">
                                  <option value="" selected>اختر نوع الزكاة</option>
                                  <option value="501">نقدي</option>
                                  <option value="502">حسابات التوفير النقدية في البنوك</option> 
                                  <option value="503">الحساب الجاري النقدي بالبنك</option>
                                  <option value="504">النقدية في الودائع المجمدة</option>
                              </select>
                               <span id="txtzakatdrp_error_0" class="text-danger bold"></span>
                              <div class="row mt-4">   
                              <div class="col-12"><button type="button" class="btn w-100 BTN-1" onclick="CalcZakat('0','زكاة المال','bbdd234345')">احسب ذكائك</button></div>
                              </div>
                          
                          </div>
                      </div>
                  </div>
                  <!-- -------- Panel End---------->
               </div>
            </div>
        </div>
        <!-- ---- Tab-2 ----- -->
        <div class="tab-pane fade" id="pills-shareZakat" role="tabpanel" aria-labelledby="pills-shareZakat-tab" tabindex="0">
          <div class="row justify-content-center">
              <div class="col-md-11">
                <!-- -------- Panel Start-------->
                <div class="panel mt-3">
                    <div class="card" style="width: auto ;">
                        <div class="card-body">
                            <label class="CLR mt-3 mb-2">القيمة</label>
                            <div class="mb-2">
                                <input type="number" name="txtzakatcalc_1" id="txtzakatcalc_1" onkeyup="ValidateAmount('1')" class="form-control">
                                 <span id="txtzakatcalc_error_1" class="text-danger bold"></span>
                            </div>
                            <label class="CLR mt-2 mb-2">نوع الزكاة</label>
                           <select class="form-select f-14" id="txtzakatdrp_1" name="txtzakatdrp_1" onchange="ValidateSelect('1')">
                              <option value="" selected>اختر نوع الزكاة</option>
                              <option value="601">قروض شخصية</option>
							  <option value="602">السندات الحكومية</option> 
							  <option value="603">سندات</option>
							  <option value="604">تشارك</option>
							  <option value="605">الاستثمارات في الشركات</option>
							   <option value="606">مصادر الدخل الأخرى</option>
                            </select>
                            <span id="txtzakatdrp_error_1" class="text-danger bold"></span>
                            <div class="row mt-4">   
                             <div class="col-12"><button type="button" class="btn w-100 BTN-1" onclick="CalcZakat('1','شارك الزكاة','bbdd234346')">احسب ذكائك</button></div>
                            </div>
                        
                        </div>
                    </div>
                </div>
                <!-- -------- Panel End---------->
             </div>
          </div>
        </div>
        <!-- ---- Tab-3 ----- -->
        <div class="tab-pane fade" id="pills-metalZakat" role="tabpanel" aria-labelledby="pills-metalZakat-tab" tabindex="0">
            <div class="row justify-content-center">
                <div class="col-md-11">
                  <!-- -------- Panel Start-------->
                  <div class="panel mt-3">
                      <div class="card" style="width: auto ;">
                          <div class="card-body">
                            <label class="CLR mt-3 mb-2">القيمة</label>
                              <div class="mb-3">
                                  <input type="number" name="txtzakatcalc_2" id="txtzakatcalc_2" onkeyup="ValidateAmount('2')" class="form-control">
                                 <span id="txtzakatcalc_error_2" class="text-danger bold"></span>
                              </div>
                              <label class="CLR mt-3 mb-2">نوع الزكاة</label>
                              <select class="form-select f-14" id="txtzakatdrp_2" name="txtzakatdrp_2" onchange="ValidateSelect('2')">
                                  <option selected>اختر نوع الزكاة</option>
                                  <option value="701">فضة</option>
                                  <option value="702">البلاتين</option>
                             
                              </select>
                              <span id="txtzakatdrp_error_1" class="text-danger bold"></span>
                              <div class="row mt-3">   
                              <div class="col-12"><button type="button" class="btn w-100 BTN-1" onclick="CalcZakat('2','الزكاة المعدنية','bbdd234347')">احسب ذكائك</button></div>
                              </div>
                          
                          </div>
                      </div>
                  </div>
                  <!-- -------- Panel End---------->
               </div>
            </div>
        </div>
        <!-- ---- Tab-4 ----- -->
        <div class="tab-pane fade" id="pills-goldZakat" role="tabpanel" aria-labelledby="pills-goldZakat-tab" tabindex="0">
            <div class="row justify-content-center">
                <div class="col-md-11">
                  <!-- -------- Panel Start-------->
                  <div class="panel mt-3">
                      <div class="card" style="width: auto ;">
                          <div class="card-body">
                          
                                <div class="row">
                                  <h5 class="CLR mt-3 mb-2 text-center">نوع الزكاة</h5>
                                   
                                </div>
                                  <div class="row">
                                    <h5 class="CLR mt-3 mb-2 text-center">ذهب عيار 24 قيراط</h5>
                                    <div class="col-md-4">
                                        <label class="CLR mt-3 mb-2">وزن :</label>
                                        <input type="number" oninput="gold('24')"  class="form-control goldclear gold-22" id="gold-24-weight" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                      <label class="CLR mt-3 mb-2">سعر الجرام :</label>
                                        <input type="number" oninput="gold('24')" class="form-control goldclear gold-22" id="gold-24-price" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                      <label class="CLR mt-3 mb-2">قيمة الزكاة الواجبة:</label>
                                        <input type="number"  readonly="readonly" class="form-control goldclear gold-22" id="gold-24-result" placeholder="">
                                    </div>
                                </div>

                                <div class="row">
                                    <h5 class="CLR mt-3 mb-2 text-center">ذهب عيار 22 قيراط</h5>
                                    <div class="col-md-4">
                                        <label class="CLR mt-3 mb-2">وزن :</label>
                                        <input type="number" oninput="gold('22')"  class="form-control goldclear gold-22" id="gold-22-weight" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                      <label class="CLR mt-3 mb-2">سعر الجرام :</label>
                                        <input type="number" oninput="gold('22')" class="form-control goldclear gold-22" id="gold-22-price" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                      <label class="CLR mt-3 mb-2">قيمة الزكاة الواجبة:</label>
                                        <input type="number"  readonly="readonly" class="form-control goldclear gold-22" id="gold-22-result" placeholder="">
                                    </div>
                                </div>

                                 <div class="row">
                                    <h5 class="CLR mt-3 mb-2 text-center">ذهب عيار 21 قيراط</h5>
                                    <div class="col-md-4">
                                        <label class="CLR mt-3 mb-2">وزن :</label>
                                        <input type="number" oninput="gold('21')"  class="form-control goldclear gold-22" id="gold-21-weight" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                      <label class="CLR mt-3 mb-2">سعر الجرام :</label>
                                        <input type="number" oninput="gold('21')" class="form-control goldclear gold-22" id="gold-21-price" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                      <label class="CLR mt-3 mb-2">قيمة الزكاة الواجبة:</label>
                                        <input type="number"  readonly="readonly" class="form-control goldclear gold-22" id="gold-21-result" placeholder="">
                                    </div>
                                </div>

                                 <div class="row">
                                    <h5 class="CLR mt-3 mb-2 text-center">ذهب عيار 18 قيراط</h5>
                                    <div class="col-md-4">
                                        <label class="CLR mt-3 mb-2">وزن :</label>
                                        <input type="number" oninput="gold('18')"  class="form-control goldclear gold-22" id="gold-18-weight" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                      <label class="CLR mt-3 mb-2">سعر الجرام :</label>
                                        <input type="number" oninput="gold('18')" class="form-control goldclear gold-22" id="gold-18-price" placeholder="">
                                    </div>
                                    <div class="col-md-4">
                                      <label class="CLR mt-3 mb-2">قيمة الزكاة الواجبة:</label>
                                        <input type="number"  readonly="readonly" class="form-control goldclear gold-22" id="gold-18-result" placeholder="">
                                    </div>
                                </div>
                                <div class="row mt-4">
									 <div class="col-12">
                                <p id="txtzakatcalc_error_gold" class="text-danger" style="text-align: center!important;"></p>
                                  </div>
                                </div>
                              <div class="row mt-4">   
                                <div class="col-12"><button onclick="CalcGoldZakat(1,'الزكاة على الذهب','bbdd234348')" type="button" class="btn w-100 BTN-1">احسب ذكائك</button></div>
                              </div>
                         
                          </div>
                      </div>
                  </div>
                  <!-- -------- Panel End---------->
               </div>
            </div>
        </div>
       
      </div>
       <!-- -----table----- -->
         @if(count($allzakatsessiondata) > 0)
		 <div class="row justify-content-center" id="ZakatCalcdiv">
			<div class="col-md-11">
			  <div class="panel mt-3">
				<div class="card border-0" style="width: auto ;">
					 <h4 class="text-center mb-4 mt-4">قيم الزكاة</h4>
					<div class="card-body  table-responsive">
				      
						 <div class="table-zakat-amount" id="zakatList">
						  @php $total = 0;@endphp
						  @foreach ($allzakatsessiondata as $key => $zakatsessiondata) 
						  
						  <div class="row border-top py-3 mx-2 zakat_tr" id="{{$zakatsessiondata->zakatTypeId}}{{$zakatsessiondata->secondTypeId}}">
							<div class="col-md-8" id="{{$zakatsessiondata->zakatTypeId}}" class="{{$zakatsessiondata->secondTypeId}}">
								  <p class="m-0">{{$zakatsessiondata->text}}</p>
						   	</div>
							 <div  class="col-md-3 tr_result_{{$zakatsessiondata->proid}} zakattotal">
								 <p class="m-0">{{$zakatsessiondata->value}} KD</p>
							</div>
							<div class="col-md-1"><button type="button" id="{{$zakatsessiondata->proid}}" class="btn p-0 text-danger btn_remove"><i class="bi bi-x-square"></i></button></div>
						</div>
						  @php $total =$total + $zakatsessiondata->value  @endphp
						 
						   @endforeach
				         </div>
				       <div class="row border-top py-3 mx-2 table-zakat-amount">
						 <div class="col-md-7 text-center"><h6 class="m-0">مجموع الزكاة</h6></div>
				         <div class="col-md-2 text-end" id="td_result"><h6 class="m-0">{{ number_format($total,2) }}  KD</h6></div>
				         <input type="hidden" id="total_zakat_donation" value="{{ number_format($total,2) }}">
				          <div class="col-md-2 text-end"><h6 class="m-0"></h6></div>
				       </div>
						<div class="row mt-4">   
						  <div class="col-12"><button type="button" class="btn w-100 BTN-1" onclick="donatenow('{{route('addproduct.to.cart',[app()->getLocale(), encrypt(10)] )}}','total_zakat_donation')" >هبة</button></div>
						</div>
					
					</div>
				</div>
			  </div>
			</div>
		 </div>
		 @else
		  <div class="row justify-content-center" id="ZakatCalcdiv" style="display:none;">
			<div class="col-md-11">
			  <div class="panel mt-3">
				<div class="card border-0" style="width: auto ;">
					 <h4 class="text-center mb-4 mt-4">قيم الزكاة</h4>
					<div class="card-body  table-responsive">
				      
						 <div class="table-zakat-amount" id="zakatList">
						 
				         </div>
				       <div class="row border-top py-3 mx-2 table-zakat-amount">
						 <div class="col-md-7 text-center"><h6 class="m-0">مجموع الزكاة</h6></div>
				         <div class="col-md-2 text-end" id="td_result"><h6 class="m-0">0 KD</h6></div>
				         <input type="hidden" id="total_zakat_donation" value="0">
				          <div class="col-md-2 text-end"><h6 class="m-0"></h6></div>
				       </div>
						<div class="row mt-4">   
						  <div class="col-12"><button type="button" class="btn w-100 BTN-1" onclick="donatenow('{{route('addproduct.to.cart',[app()->getLocale(), encrypt(10)] )}}','total_zakat_donation')">هبة</button></div>
						</div>
					
					</div>
				</div>
			  </div>
			</div>
		 </div>
		 @endif
       <!-- -----table----- -->
    </div>
     <!-- -----Tab end----- -->
  </div>
</section>
<!-- ====================== Projects Section End ===================== -->
 <script>
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
  function CalcZakat(index, zakatName, typeId) {
        $(`#txtzakatcalc_error_${index}`).html("");
        $(`#txtzakatdrp_error_${index}`).html("");

        const txtVal = $(`#txtzakatcalc_${index}`)[0].value;
        const drp = $(`#txtzakatdrp_${index}`)[0];

        if (txtVal === "" && (drp != undefined && drp.value === "")) {
            $(`#txtzakatcalc_error_${index}`).html("الرجاء إدخال القيمة");
            $(`#txtzakatdrp_error_${index}`).html("الرجاء إدخال القيمة");
            return;
        }

        if (txtVal === "") {
            $(`#txtzakatcalc_error_${index}`).html("الرجاء إدخال القيمة");
            return;
        }

        if (drp != undefined && drp.value === "") {
            $(`#txtzakatdrp_error_${index}`).html("الرجاء إدخال القيمة");
            return;
        }

        if (txtVal !== "" && (drp != undefined && drp.value !== "")) {
            const zakatamount = parseFloat(txtVal);
            const optionid = drp.value;
            const text = `${zakatName} - ` + $(`#txtzakatdrp_${index} option:selected`).text();
            Save(optionid, zakatamount, 0, text, typeId, false);
            clear(index);
        } else {
            const zakatamount = parseFloat(txtVal);
            const optionid = "";
            const text = `${zakatName}`;
            Save(optionid, zakatamount, 0, text, typeId, false);
            clear(index);
        }
    }
    function CalcGoldZakat(index, zakatName, typeId) {
        $(`#txtzakatcalc_error_gold`).html("");

        const txtVal0 = Number($(`#gold-24-result`).val() || 0);
        const txtVal1 = Number($(`#gold-22-result`).val() || 0);
        const txtVal2 = Number($(`#gold-21-result`).val() || 0);
        const txtVal3 = Number($(`#gold-18-result`).val() || 0);

        if (txtVal0 <= 0 && txtVal1 <= 0 && txtVal2 <= 0 && txtVal3 <= 0) {
              $(`#txtzakatcalc_error_gold`).html("قيمة مطلوبة");
              return;
        }

        if ((txtVal0 > 0) || (txtVal1 > 0) ||
            (txtVal2 > 0) || (txtVal3 > 0)) {
                const zakatamount = Number(txtVal0 || 0) + Number(txtVal1 || 0) + Number(txtVal2 || 0) + Number(txtVal3 || 0);
                const optionid = "";
                const text = `${zakatName}`;
                Save(optionid, zakatamount, 0, text, typeId, true);
                clear(index);
        }
    }
    function ValidateAmount(index) {
        const txtVal = $(`#txtzakatcalc_${index}`)[0].value;
        if (txtVal !== "") {
            $(`#txtzakatcalc_error_${index}`).html("");
        } else {
            $(`#txtzakatcalc_error_${index}`).html("الرجاء إدخال القيمة");
        }
    }
    function ValidateSelect(index) {
        const drp = $(`#txtzakatdrp_${index}`)[0].value;
        if (drp !== "") {
            $(`#txtzakatdrp_error_${index}`).html("");
        } else {
            $(`#txtzakatdrp_error_${index}`).html("الرجاء إدخال القيمة");
        }
    }
    function Save(optionId, value1, value2, text, typeId, isGold) {
        const url = '{{ route('zakat_calculate',app()->getLocale()) }}';
        $.get(url, {
                ZakatTypeId: typeId,
                OptionId: optionId,
                Value1: value1,
                Value2: value2,
                text:text,
                IsGold: isGold
            }
            , function (data, textStatus, jqXHR) {
				
                $("#ZakatCalcdiv").show();
                if (data.data !== "" && parseFloat(data.result) > 0) {
                    if ($(".btn_remove").length === 0) {
                        ZakatResult(data.resultStr, text, data.data, typeId, optionId, data.TotalZakat, data.AllTotal);
                    } else {
                        const currentItem = document.getElementById(data.data);
                        if ($(currentItem).attr("id") === data.data) {
                            $(`.tr_result_${data.data}`).html(data.resultStr);
                            $("#td_result").html(data.TotalZakat);
                            $("#total_zakat_donation").val(data.AllTotal);
                            
                            resultZakat = data.TotalZakat;
                            $("#td_result").html(resultZakat);
                            $("#total_zakat_donation").val(data.AllTotal);
                            if (data.AllTotal === 0) {
                                $("#ZakatCalcdiv").hide();
                                $("#box-white").show();
                            }
                        } else {
                            ZakatResult(data.resultStr, text, data.data, typeId, optionId, data.TotalZakat, data.AllTotal);
                        }
                    }
                }
                return false;
            });
    }
	 function ZakatResult(result, text, id, zakatTypeId, secondTypeId, TotalZakat, AllTotal) {
		 
		const $div = $(`<div class="row border-top py-3 mx-2 zakat_tr" id="${zakatTypeId}${secondTypeId}"><div class="col-md-8" id="${zakatTypeId}"class="${secondTypeId}"><p class="m-0">${text}</p></div><div  class="col-md-3 tr_result_${id} zakattotal"><p class="m-0">${result}</p></div><div class="col-md-1"><button type="button" id="${id}" class="btn p-0 text-danger btn_remove"><i class="bi bi-x-square"></i></button></div></div>`);
						
		 				
		if ($("#zakatList div").length === 0) {
			$("#zakatList").append($div);
		}
		else {
			 $("#zakatList").find('.zakat_tr:last').before($div);
		}

		resultZakat = AllTotal;
		if (resultZakat === 0) { $("#ZakatCalcdiv").hide(); $("#box-white").show(); }
		$("#td_result").html(TotalZakat);
		$("#total_zakat_donation").val(AllTotal);
		// clear();
	}
	
     function clear(index) {
        //txt
        $(`#txtzakatcalc_${index}`).val("");
        $(`#txtzakatdrp_${index}`).val("");

        //error msg
        $(`#txtzakatcalc_error_${index}`).html("");
        $(`#txtzakatdrp_error_${index}`).html("");


        $(".goldclear").val('');
    }
    
    $(document).on('click', '.btn_remove', function () {
         const $tr = $(this).parent("div").parent("div");
         Delete($tr, $(this).attr("id"));
    });
    
    function Delete($tr,id) {
        const url = '{{ route('zakat_value_delete',app()->getLocale()) }}';
        $.get(url, {id:id}
            , function (d, textStatus, jqXHR) {
                if (d.data === true) {
                    $tr.remove();
                    $("#td_result").html(d.TotalZakat);
                    $("#total_zakat_donation").html(d.TotalZakat);
                    resultZakat = d.Total;

                    if (resultZakat === 0) {
                        $("#ZakatCalcdiv").hide();
                        $("#box-white").show();
                    }
                }
                return false;
            });
    }
    function gold(id) {
        if (id === "24") {
            $(`#txtzakatcalc_error_gold`).html("");

            // do something
            if (Number($("#gold-24-weight").val() || 0) < 85) {
                $("#gold-24-result").val(0);
                return;
            }

            $("#gold-24-result").val(Number((Number($("#gold-24-weight").val() || 0) *
                                     Number($("#gold-24-price").val() || 0) * 2.5) / 100).toFixed(3));
        }

        if (id === "22") {
            $(`#txtzakatcalc_error_gold`).html("");

            // do something
            if (Number($("#gold-22-weight").val()) < 85) {
                $("#gold-22-result").val(0);
                return;
            }
            $("#gold-22-result").val(Number((Number($("#gold-22-weight").val() || 0) *
                                     Number($("#gold-22-price").val() || 0) * 22) / 960).toFixed(3));
        }

        if (id === "21") {
            $(`#txtzakatcalc_error_gold`).html("");

            // do something
            if (Number($("#gold-21-weight").val() || 0) < 85) {
                $("#gold-21-result").val(0);
                return;
            }
            $("#gold-21-result").val(Number((Number($("#gold-21-weight").val() || 0) *
                                     Number($("#gold-21-price").val() || 0) * 21) / 960).toFixed(3));
        }

        if (id === "18") {
            $(`#txtzakatcalc_error_gold`).html("");

            // do something
            if (Number($("#gold-18-weight").val() || 0) < 85) {
                $("#gold-18-result").val(0);
                return;
            }
            $("#gold-18-result").val(Number((Number($("#gold-18-weight").val() || 0) *
                                     Number($("#gold-18-price").val() || 0) * 18) / 960).toFixed(3));
        }
    }
    
    
 </script>
@stop
