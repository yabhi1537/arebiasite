@extends('admin.layouts.app')

@section('content')
<style type="text/css">
.container {
    width: 350px;
    height: 650px;
    background-color: white;

    border: 1px solid grey;
    border-radius: 50px;
    overflow: scroll;
}

.container::-webkit-scrollbar {
    display: none;
}

.setfont {
    font-size: 12px;
    text-align: center;
}

.aligntext {
    font-size: 10px;
    text-align: center;
}
</style>
<!-- partial -->


<div class="row user-profile">
    <div class="col-lg-12 side-left  align-items-stretch">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">

                    <div class="card">
                        <div class="card-body">
                            <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                                <h4 class="card-title mb-0">Show Project</h4>
                                <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a href="" class="nav-link active" id="info-tab" data-toggle="modal"
                                            href="#info" role="tab" data-target="#exampleModal" aria-controls="info"
                                            aria-expanded="true">Generate Campaign Link</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="wrapper">
                                <hr>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="info" role="tabpanel"
                                        aria-labelledby="info">

                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>
                                                    images </strong></label>
                                            <div class="col-sm-7">
                                                <td> <img src="{{ asset('uploads/projectimage/'.$projeId->image) }}"
                                                        style="height: 100px;width:135px;">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label">
                                                <strong>Project Name </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Name (AR) </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_name_ar  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Title</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->title  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Title (AR) </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->title_ar  }}
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2"
                                                class="col-sm-5 col-form-label"><strong>Project
                                                    Type</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->ProjTyp->type  }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Category </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->ProjCat->title }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Continents</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_continents  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Country</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_country   }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Price</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_price  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Donated</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->donated  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2"
                                                class="col-sm-5 col-form-label"><strong>Target
                                                    Amount</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->target_amount  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    qnty</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->qnty  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    From
                                                    Date</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->from_date  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    To
                                                    Date</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->to_date  }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    year</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->year  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Status</strong></label>
                                            <div class="col-sm-7">
												@if($projeId->status  == 0)
                                                New ProjectController
                                                @else
                                                Complete Project
                                                @endif
                                            </div>
                                        </div>
                                         <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Publish Status </strong></label>
                                            <div class="col-sm-7">
                                             
                                                @if($projeId->publish_status  == 1)
                                                Public 
                                                @else
                                                Private
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Donationtype Status </strong></label>
                                            <div class="col-sm-7">
                                             
                                                @if($projeId->donationtype_status  == 0)
                                                Enabled 
                                                @else
                                                Disabled
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Main
                                                    Project </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->main_project}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Target</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projeId->target}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Featured</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->featured}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2"
                                                class="col-sm-5 col-form-label"><strong>Short Link</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->short_url}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Code </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_code  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Description </strong></label>
                                            <div class="col-sm-7">
                                                {!! $projeId->description!!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Description (AR)</strong></label>
                                            <div class="col-sm-7">
                                                {!! $projeId->description_ar !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                   Marketer Links</strong></label>
                                            <div class="col-sm-7">
                                            @foreach($link as $links)
                                                <p>{{ $links->generatelink}} </p>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Created Date</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projeId->created_date}}
                                            </div>
                                        </div>
                                    </div><!-- tab content ends -->
                                </div>
                            </div>
                            <div class="text-center mt-3 "> <a href="{{ route('project.index') }}" class="btn btn-outline-danger w-25">Back</a></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ==================================================mobail======================================== -->

</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="baseForm" name="" class="forms-sample" method="POST" action="{{ route('generatelinkstore')}}"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Generate Link</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="newstype required">Language</label>

                            <select class="form-control required" id="languageid" name="language" required>
                                <option value="en">English</option>
                                <option value="ar">Arabic</option>
                            </select>
                            @error('language')
                            <label id="title-error" class="text-danger mt-2" for="title">
                                {{ $message }}</label>
                            @enderror
                        </div>
                      
                        <div class="form-group ">
                            <label for="date">Date</label>
                            <div id="datepicker-popup" class="input-group date datepicker">
                                <input autocomplete="off" type="text" placeholder="Date" class="form-control"
                                    id="date" name="date" value="">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="mdi mdi-calendar input-group-text"></span>
                                </span>
                            </div>
                            @error('date')
                            <label id="title-error" class="text-danger mt-2" for="title">
                                {{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="time">Time</label>
                            <div class="input-group date" id="timepicker-example" data-target-input="nearest">
                                <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
                                    <input type="text" name="time" class="form-control datetimepicker-input"
                                        data-target="#timepicker-example" placeholder="Time">
                                    <div class="input-group-addon input-group-append"><i
                                            class="mdi mdi-clock input-group-text"></i>
                                    </div>
                                </div>
                            </div>
                            @error('time')
                            <label id="time-error" class="text-danger mt-2" for="time">
                                {{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="newstype required">Marketer</label>
                            <select class="form-control required" id="myInput1" name="marketer"
                                onchange="createlink(this.value,'{{$projeId->project_code}}')" required>
                                <option value="">Select</option>
                                @if(! $marketers->isEmpty())
                                @foreach( $marketers as $markete)
                                <option value="{{ $markete->id }}">{{$markete->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('marketer')
                            <label id="title-error" class="text-danger mt-2" for="title">
                                {{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Generate Link</label>
                            <input autocomplete="off" type="text" value="" class="form-control required" id="myInput2"
                                placeholder="Generate Link" name="generatelink" required>
                            @error('generatelink')
                            <label id="title-error" class="text-danger mt-2" for="title">
                                {{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <!-- <input type="hidden" value="{{ $projeId->project_id }}"  name="project_id"> -->
                      <input type="hidden" value="{{ $projeId->project_code }}"  name="project_code">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mr-2">Send</button>
                    </div>
                </div>
            </div>
        </form>
    </div> 
   

    <script type="text/javascript">
    function createlink(marketerid, projectid) {

        var languageid = $('#languageid').val();
         var link = "{{ url('')}}/" + languageid + "/" + marketerid + "/" + projectid + "";
        $('#myInput2').val(link);
        }

    if ($("#timepicker-example".length)) {
        $('#timepicker-example').datetimepicker({
            format: 'LT'
        });
    }
    $(document).ready(function() {
     
        if ($("#datepicker-popup".length)) {
            $('#datepicker-popup').datepicker({
                enableOnReadonly: true,
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        }
    });
    </script>
    @endsection
