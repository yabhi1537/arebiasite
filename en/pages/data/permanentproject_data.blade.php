 @forelse ($permanentprojects as $key => $permanentproject)  
             <div class="col-md-4 " >
                <!-- -------- Panel Start-------->
                <div class="panel">
                  <div class="card" style="width: auto ;">
                    <a href="{{route('chooseDonation',[app()->getLocale(), $permanentproject->project_code ] )}}">
                      <img src="../uploads/projectimage/{{ $permanentproject->image }}" class="card-img-top d-block w-100 " alt="...">
                    </a>
                      <div class="card-body">
                        <a href="{{route('chooseDonation',[app()->getLocale(), $permanentproject->project_code ] )}}">
                          <h6 class=" mt-1 CLR ">{{ $permanentproject->project_name }} </h6>
                        </a>
                                       
                         <div class="row mt-2">
						  <div class="col-md-2">
							  <p class="mb-0" style="font-size:12px;"><span>{{round($permanentproject->donated/$permanentproject->target_amount * 100)}}</span>%</p>
						  </div>
                          <div class="col-md-10">
                            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$permanentproject->donated/$permanentproject->target_amount * 100}}" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-success1 " style="width: {{$permanentproject->donated/$permanentproject->target_amount * 100}}%;">{{round($permanentproject->donated/$permanentproject->target_amount * 100)}}%</div>
                            </div>
                          </div>
                        </div>
                        <div class="row card-title borderd mt-3 cardAmountDetails pt-2">
                          <div class="col-4 borderRight ">
                              <h6 class="mt-1"><span>The Cost </span> </h6>
                              <p class="m-0">{{ number_format($permanentproject->target_amount) }} KD </p>
                          </div>
                          <div class="col-4 borderRight">
                              <h6 class="mt-1"><span>Donations</span> </h6>
                              <p class="m-0">{{ number_format($permanentproject->donated) }} KD </p>
                          </div>
                          <div class="col-4">
                              <h6 class="mt-1"><span>Residual</span> </h6>
                              <p class="m-0">{{ number_format($permanentproject->residual) }} KD </p>
                          </div>
                        </div>
                        <div class="row text-center mt-3">
                            <div class="d-flex">
                                <div class="value-button decreaseBtn" id="decrease" onclick="decreaseValue('permanentproject_number_{{$key}}',{{ number_format($permanentproject->project_price) }})" value="Decrease Value">-</div> 
                                  <input type="number" class="number" id="permanentproject_number_{{$key}}" value="{{ number_format($permanentproject->project_price) }}"/>
                                <div class="value-button increaseBtn" id="increase" onclick="increaseValue('permanentproject_number_{{$key}}',{{ number_format($permanentproject->project_price) }})" value="Increase Value">+</div> 
                            </div>
                        </div>
                        <div class="row mt-3">   
                          <div class="col-6"><button type="button" onclick="donatenow('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($permanentproject->project_id)] )}}','permanentproject_number_{{$key}}')"  class="btn w-100 BTN-1"> Donate Now</button></div>
                          <div class="col-6"><button type="button" onclick="addtocart('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($permanentproject->project_id)] )}}','permanentproject_number_{{$key}}')" class="btn w-100 BTN-2"><i class="fa-solid fa-cart-shopping"></i></button></div>
                        </div>  
                      </div>
                  </div>
              </div>
                <!-- -------- Panel End---------->
             </div>
              @empty
               <p>No Projects</p>
              @endforelse
