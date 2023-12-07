@forelse ($awqafprojects as $key => $awqafproject)  
                 <div class="col-md-4 " >
                <!-- -------- Panel Start-------->
                <div class="panel">
                  <div class="card" style="width: auto ;">
                    <a href="{{route('chooseDonation',[app()->getLocale(), $awqafproject->project_code  ] )}}">
                      <img src="../uploads/projectimage/{{ $awqafproject->image }}" class="card-img-top d-block w-100 " alt="...">
                    </a>
                      <div class="card-body">
                        <a href="{{route('chooseDonation',[app()->getLocale(), $awqafproject->project_code ] )}}">
                           <h6 class=" mt-1 CLR ">{{ $awqafproject->project_name_ar }} </h6>
                        </a>
                                       
                         <div class="row mt-2">
						  <div class="col-md-2">
							  <p class="mb-0" style="font-size:12px;"><span>{{round($awqafproject->donated/$awqafproject->target_amount * 100)}}</span>%</p>
						  </div>
                          <div class="col-md-10">
                            <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$awqafproject->donated/$awqafproject->target_amount * 100}}" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-success1 " style="width: {{$awqafproject->donated/$awqafproject->target_amount * 100}}%;">{{round($awqafproject->donated/$awqafproject->target_amount * 100)}}%</div>
                            </div>
                          </div>
                        </div>
                        <div class="row card-title borderd mt-3 cardAmountDetails pt-2">
                          <div class="col-4 borderRight ">
                              <h6 class="mt-1"><span>التكلفة</span> </h6>
                              <p class="m-0">{{ number_format($awqafproject->target_amount) }} د.ك </p>
                          </div>
                          <div class="col-4 borderRight">
                              <h6 class="mt-1"><span>التبرعات</span> </h6>
                              <p class="m-0">{{ number_format($awqafproject->donated) }} د.ك </p>
                          </div>
                          <div class="col-4">
                              <h6 class="mt-1"><span>المتبقية</span> </h6>
                              <p class="m-0">{{ number_format($awqafproject->residual) }} د.ك </p>
                          </div>
                        </div>
                        <div class="row text-center mt-3">
                            <div class="d-flex">
                                <div class="value-button decreaseBtn" id="decrease" onclick="decreaseValue('awqafproject_number_{{$key}}',{{ number_format($awqafproject->project_price) }})" value="Decrease Value">-</div> 
                                  <input type="number" class="number" id="awqafproject_number_{{$key}}" value="{{ number_format($awqafproject->project_price) }}"/>
                                <div class="value-button increaseBtn" id="increase" onclick="increaseValue('awqafproject_number_{{$key}}',{{ number_format($awqafproject->project_price) }})" value="Increase Value">+</div> 
                            </div>
                        </div>
                        <div class="row mt-3">   
                          <div class="col-6"><button type="button" onclick="donatenow('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($awqafproject->project_id)] )}}','awqafproject_number_{{$key}}')"  class="btn w-100 BTN-1">تبرع الآن</button></div>
                          <div class="col-6"><button type="button" onclick="addtocart('{{route('addproduct.to.cart',[app()->getLocale(), encrypt($awqafproject->project_id)] )}}','awqafproject_number_{{$key}}')" class="btn w-100 BTN-2"><i class="fa-solid fa-cart-shopping"></i></button></div>
                        </div>  
                      </div>
                  </div>
              </div>
                <!-- -------- Panel End---------->
             </div>
              @empty
               <p>لا مشاريع</p>
              @endforelse
