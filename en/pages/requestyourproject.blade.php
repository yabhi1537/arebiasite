@extends('en.layouts.default')

@section('content')
  <!-- ========================= hero section start ======================= -->
  <div id="aboutHero">
    <div  class="bsb-hero-1 px-3 bsb-overlay bsb-hover-pull">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-12 col-md-11 col-lg-9 col-xl-7 col-xxl-6 text-center text-white mt-5 pt-5">
            <h1 class="display-3 fw-bold mb-3 mt-5">Project Request</h1>
            <p class=" mb-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ========================= hero section End ======================= -->


  <section id="requestYourproject" class="container mt-3 mb-5 pb-5"> 
    <div class="row justify-content-center">
      <div class="col-md-10 mt-3">
        <div class="row box justify-content-center mt-4">
           <div class="col-md-12 ">
            <h2 class="mt-2 text-center" style="font-size: 26px; font-weight: 700; color: #5d5d5d;">Request Your Project</h2>
                @if(session('flash_notice'))
				<div class="alert alert-success">
				  {{ session('flash_notice') }}
				</div> 
			@endif
			 <form action="{{ route('saveproject_request',app()->getLocale()) }}" autocomplete="off" name="project_request_form" id="project_request_form" method="post" enctype="multipart/form-data">	
			     @csrf
              <div class="row mt-5 ">
               
                <div class="col-md-6">
                    <div class="mb-3">
                       <label class="form-label">Donor Name :</label>
                       <input type="text" class="form-control" id="donor_name" name="donor_name" placeholder="Enter the donor name">
                        @if ($errors->has('donor_name'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('donor_name') }}</span>
                        @endif  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                       <label class="form-label">Project name :</label>
                       <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Enter your project name">
                        @if ($errors->has('project_name'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('project_name') }}</span>
                        @endif 
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                       <label class="form-label">Choose project :</label>
                       <select class="form-select form-control" id="project_id" name="project_id" >
                         <option value="" selected>Select the project</option>
                          @foreach ($allprojects as $key => $allproject)  
                         <option value="{{$allproject->project_id}}">{{$allproject->project_name}}</option>
                         @endforeach
                       </select>
                        @if ($errors->has('project_id'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('project_id') }}</span>
                        @endif 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                       <label class="form-label">ID number :</label>
                       <input type="text" class="form-control" id="id_number" name="id_number" placeholder="Enter your ID number">
                        @if ($errors->has('id_number'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('id_number') }}</span>
                        @endif 
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                       <label class="form-label">From amount :</label>
                       <input type="number" class="form-control" iid="from_amount" name="from_amount"  placeholder="Enter the from amount">
                        @if ($errors->has('from_amount'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('from_amount') }}</span>
                        @endif 
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="mb-3">
                       <label class="form-label">To amount :</label>
                       <input type="number" class="form-control" id="to_amount" name="to_amount"  placeholder="Enter the to amount">
                       @if ($errors->has('from_amount'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('to_amount') }}</span>
                        @endif 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                       <label class="form-label">Phone number :</label>
                       <input type="text" class="form-control"  id="phone_number" name="phone_number" placeholder="Enter your phone number">
                       @if ($errors->has('phone_number'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('phone_number') }}</span>
                        @endif 
                    </div>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Notes :</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter your comments"></textarea>
                    
                </div>
                
                <div class="mb-3">
                    <label for="projectimage" class="form-label">Picture :</label>
                    <input class="form-control" type="file" name="projectimage" id="projectimage">
                     @if ($errors->has('projectimage'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('projectimage') }}</span>
                        @endif 
                </div>
                <!-- ========== Signature pad ========== -->
                <input type="hidden" name="segnatureimage" id="segnatureimage">
                <div class="signaturePad">
                  <label for="formFile" class="form-label">Sign here :</label>
                  <div class="wrapper">
                      <canvas id="signature-pad" width="400" height="200"></canvas>
                  </div>
                  
                  <div class="clear-btn">
                      <button type="button" id="clear" class="btn BTN-1">Clear</button>
                  </div>
                   @if ($errors->has('segnatureimage'))
                                <span style="width: 100%;" class="text-danger">{{ $errors->first('segnatureimage') }}</span>
                        @endif 
               </div>
               
                <!-- ========== Signature pad ========== -->
                <div class="text-center mt-4 ">
                  <button type="submit" class="btn BTN-1 btn-sm w-100 p-2">Send</button>
                </div>
                
              </div>
                </form>
           </div> 
         
        </div>
    </div>
  </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.3.5/signature_pad.min.js" integrity="sha512-kw/nRM/BMR2XGArXnOoxKOO5VBHLdITAW00aG8qK4zBzcLVZ4nzg7/oYCaoiwc8U9zrnsO9UHqpyljJ8+iqYiQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      var canvas = document.getElementById("signature-pad");
      function resizeCanvas() {
          var ratio = Math.max(window.devicePixelRatio || 1, 1);
          canvas.width = canvas.offsetWidth * ratio;
          canvas.height = canvas.offsetHeight * ratio;
          canvas.getContext("2d").scale(ratio, ratio);
      }
      window.onresize = resizeCanvas;
      resizeCanvas();

      var signaturePad = new SignaturePad(canvas, {
      backgroundColor: 'rgb(250,250,250)'
      });
      
    
      document.getElementById("clear").addEventListener('click', function(){
      signaturePad.clear();
      })
      
      
		
      
       $("#project_request_form").submit(function() {
	
	 if (!signaturePad.isEmpty()) {	  
		var  base64Image = signaturePad.toDataURL();
		$("#segnatureimage").val(base64Image);
	   }
		
	  });
      
    </script>
@stop
 
