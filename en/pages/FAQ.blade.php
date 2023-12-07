@extends('en.layouts.default')

@section('content')
  <section id="FAQ" class="FAQ ">
    <div class="container">
      <div class="row sectionHeading my-5">
        <h1 class="text-center CLR">FAQ</h1>
        <p class="text-center">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
      </div>

      <div class="row ">
          
          <div class="FAQ_List align-items-start">
            <div class="col-md-3">
              <div class="nav nav-pills FAQ_List_arange me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active" id="v-pills-projects-tab" data-bs-toggle="pill" data-bs-target="#v-pills-projects" type="button" role="tab" aria-controls="v-pills-projects" aria-selected="true">Projects</button>
                <button class="nav-link" id="v-pills-guarantees-tab" data-bs-toggle="pill" data-bs-target="#v-pills-guarantees" type="button" role="tab" aria-controls="v-pills-guarantees" aria-selected="false">Guarantees</button>
                <button class="nav-link" id="v-pills-dedications-tab" data-bs-toggle="pill" data-bs-target="#v-pills-dedications" type="button" role="tab" aria-controls="v-pills-dedications" aria-selected="false">Dedications</button>
                <button class="nav-link" id="v-pills-deductions-tab" data-bs-toggle="pill" data-bs-target="#v-pills-deductions" type="button" role="tab" aria-controls="v-pills-deductions" aria-selected="false">Deductions</button>
              </div>
            </div>
            <div class="col-md-9">
             <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-projects" role="tabpanel" aria-labelledby="v-pills-projects-tab" tabindex="0">
                  <!-- ============== -->
                  <div class="accordion" id="accordionExample">
                    @forelse ($faqprojects as $key => $faqproject)  
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#One_{{$key}}" aria-expanded="true" aria-controls="One_{{$key}}">
                         {{$faqproject->question}}
                        </button>
                      </h2>
                      <div id="One_{{$key}}" class="accordion-collapse collapse" data-bs-parent="#accordionExampl">
                        <div class="accordion-body">
                           {{$faqproject->answer}}
                        </div>
                      </div>
                    </div>
                     @empty
						   <p>No Project Question</p>
					 @endforelse
                  </div>
                  <!-- ============== -->
                </div>
                <div class="tab-pane fade" id="v-pills-guarantees" role="tabpanel" aria-labelledby="v-pills-guarantees-tab" tabindex="0">
                  <!-- ============== -->
                   <div class="accordion" id="accordionExampl1">
                    @forelse ($faqguarantees as $key => $Guarantee)  
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#One_{{$key}}" aria-expanded="true" aria-controls="One_{{$key}}">
                         {{$Guarantee->question}}
                        </button>
                      </h2>
                      <div id="One_{{$key}}" class="accordion-collapse collapse" data-bs-parent="#accordionExampl1">
                        <div class="accordion-body">
                           {{$Guarantee->answer}}
                        </div>
                      </div>
                    </div>
                     @empty
						   <p>No Guarantee Question</p>
					 @endforelse
                  </div>
                  <!-- ============== -->
                </div>
                <div class="tab-pane fade" id="v-pills-dedications" role="tabpanel" aria-labelledby="v-pills-dedications-tab" tabindex="0"><!-- ============== -->
                  <div class="accordion" id="accordionExampl2">
                    @forelse ($faqdedications as $key => $Dedication)  
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#One_{{$key}}" aria-expanded="true" aria-controls="One_{{$key}}">
                         {{$Dedication->question}}
                        </button>
                      </h2>
                      <div id="One_{{$key}}" class="accordion-collapse collapse" data-bs-parent="#accordionExampl2">
                        <div class="accordion-body">
                           {{$Dedication->answer}}
                        </div>
                      </div>
                    </div>
                     @empty
						   <p>No Dedication Question</p>
					 @endforelse
                  </div>
                  <!-- ============== -->
                </div>
                <div class="tab-pane fade" id="v-pills-deductions" role="tabpanel" aria-labelledby="v-pills-deductions-tab" tabindex="0">
                  <!-- ============== -->
                 <div class="accordion" id="accordionExampl3">
                    @forelse ($faqdeductions as $key => $Deduction)  
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#One_{{$key}}" aria-expanded="true" aria-controls="One_{{$key}}">
                         {{$Deduction->question}}
                        </button>
                      </h2>
                      <div id="One_{{$key}}" class="accordion-collapse collapse" data-bs-parent="#accordionExampl3">
                        <div class="accordion-body">
                           {{$Deduction->answer}}
                        </div>
                      </div>
                    </div>
                     @empty
						   <p>No Deduction Question</p>
					 @endforelse
                  </div>
                  <!-- ============== -->
                </div>
             </div>
           </div>
          </div>
  
      </div>
    </div>
  </section>
 @stop
