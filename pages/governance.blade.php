@extends('ar.layouts.default')

@section('content')

  <section id="Governance" class="Governance ">
    <div class="container">
      <div class="row sectionHeading my-5">
        <h1 class="text-center CLR">الحكم</h1>
        <p class="text-center">لوريم إيبسوم هو ببساطة نص وهمي من صناعة الطباعة والتنضيد</p>
      </div>

      <div class="row justify-content-center">
        <div class="Pdf_card_head text-center">
          <h4>  دليل الحوكمة </h4>
        </div>
        <div class="col-md-3 ">
          <div class="Pdf_card mt-4">
            <div class="Pdf_card_img p-2">
             <embed
			src="{{ asset('uploads/governance/'.$governancedata->governance_manual) }}"
			type="application/pdf" width="100%" height="350px">
            </div>
             <h5 class="text-center mt-2">{{$governancedata->governance_manual}}</h5>
          </div> 
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="Pdf_card_head text-center">
          <h4>النظام الأساسي</h4>
        </div>
        <div class="col-md-3 ">
          <div class="Pdf_card mt-4">
		    <div class="Pdf_card_img p-2">	  
           <embed
			src="{{ asset('uploads/governance/'.$governancedata->articles_of_association) }}"
			type="application/pdf" width="100%" height="350px">
            </div>
             <h5 class="text-center mt-2">{{$governancedata->articles_of_association}}</h5>
          </div> 
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="Pdf_card_head text-center">
          <h4>تقارير مالية</h4>
        </div>
        <div class="col-md-3 ">
          <div class="Pdf_card mt-4">
		    <div class="Pdf_card_img p-2">	  
           <embed
			src="{{ asset('uploads/governance/'.$governancedata->financial_reports) }}"
			type="application/pdf" width="100%" height="350px">
            </div>
             <h5 class="text-center mt-2">{{$governancedata->financial_reports}}</h5>
          </div> 
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="Pdf_card_head text-center">
          <h4>سياسة التبرع</h4>
        </div>
        <div class="col-md-3 ">
          <div class="Pdf_card mt-4">
		    <div class="Pdf_card_img p-2">	  
           <embed
			src="{{ asset('uploads/governance/'.$governancedata->donation_policy) }}"
			type="application/pdf" width="100%" height="350px">
            </div>
             <h5 class="text-center mt-2">{{$governancedata->donation_policy}}</h5>
          </div> 
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="Pdf_card_head text-center">
          <h4>التقارير الإدارية</h4>
        </div>
         <div class="col-md-3 ">
          <div class="Pdf_card mt-4">
		    <div class="Pdf_card_img p-2">	  
           <embed
			src="{{ asset('uploads/governance/'.$governancedata->administrative_reports) }}"
			type="application/pdf" width="100%" height="350px">
            </div>
             <h5 class="text-center mt-2">{{$governancedata->administrative_reports}}</h5>
          </div> 
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="Pdf_card_head text-center">
          <h4>اللوائح الداخلية</h4>
        </div>
         <div class="col-md-3 ">
          <div class="Pdf_card mt-4">
		    <div class="Pdf_card_img p-2">	  
           <embed
			src="{{ asset('uploads/governance/'.$governancedata->internal_regulations) }}"
			type="application/pdf" width="100%" height="350px">
            </div>
             <h5 class="text-center mt-2">{{$governancedata->internal_regulations}}</h5>
          </div> 
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="Pdf_card_head text-center">
          <h4>الخطط</h4>
        </div>
         <div class="col-md-3 ">
          <div class="Pdf_card mt-4">
		    <div class="Pdf_card_img p-2">	  
           <embed
			src="{{ asset('uploads/governance/'.$governancedata->plans) }}"
			type="application/pdf" width="100%" height="350px">
            </div>
             <h5 class="text-center mt-2">{{$governancedata->plans}}</h5>
          </div> 
        </div>
      </div>

    </div>
  </section>
 @stop
