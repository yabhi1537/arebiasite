@extends('admin.layouts.app')

@section('content')
</style>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All Projects Records</h4>
                <a href="{{ route('project.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Add New
                    Project </a>
                <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0 float-left" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a href="" class="nav-link active" id="info-tab" data-toggle="modal" href="#info" role="tab"
                            data-target="#exampleModal" aria-controls="info" aria-expanded="true">Generate Campaign
                            Link</a>
                    </li>
                </ul>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            @if(Session::has('error'))
            <p class="alert alert-danger">{{ Session::get('error') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="typesearch" id="typesearch" class="form-select"
                                aria-label="Default select example">
                                <option value="">Select Type</option>
                                @if(!$data['Ptype']->isEmpty())
                                @foreach($data['Ptype'] as $projec)
                                <option value="{{$projec->id}}"
                                    {{ Request::get('typesearch') == $projec->type  ? 'selected="selected"' : '' }}>
                                    {{$projec->type}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="catesearch" id="catesearch" class="form-select"
                                aria-label="Default select example">
                                <option value="">Select Category</option>
                                @if(!$data['PCategor']->isEmpty())
                                @foreach($data['PCategor'] as $proje)
                                <option value="{{$proje->id}}"
                                    {{ Request::get('catesearch') == $proje->title  ? 'selected="selected"' : '' }}>
                                    {{ $proje->title}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="continent" id="continent" class="form-select"
                                aria-label="Default select example">
                                <option value="">Select Continents</option>
                                @if(!$data['Pcontinent']->isEmpty())
                                @foreach($data['Pcontinent'] as $proje)
                                <option value="{{$proje->title}}"
                                    {{ Request::get('continent') == $proje->title  ? 'selected="selected"' : '' }}>
                                    {{ $proje->title}}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="country" id="country" class="form-select" aria-label="Default select example">
                                <option value="">Select Country</option>
                                @if(!$data['Pcountry']->isEmpty())
                                @foreach($data['Pcountry'] as $proje)
                                <option value="{{$proje->country}}"
                                    {{ Request::get('country') == $proje->country  ? 'selected="selected"' : '' }}>
                                    {{ $proje->country}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="pname" id="pname" class="form-select" aria-label="Default select example">
                                <option value="">Project Name</option>
                                @if(!$proserch->isEmpty())
                                @foreach($proserch as $proje)
                                <option value="{{$proje->project_name}}"
                                    {{ Request::get('pname') == $proje->project_name  ? 'selected="selected"' : '' }}>
                                    {{ $proje->project_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-3 mr-2">
                        <div class="col-md-2 p-1 ">
                            <button type="submit" class="btn btn-inverse-light btn-fw w-100"
                                onclick="getajaxdata()">Filter results</button>
                        </div>
                        <div class="col-md-2 p-1 ">
                            <a href="{{ route('project.index') }}" class="btn btn-inverse-light btn-fw w-100">Clear</a>
                        </div>
                    </div>

                </div>
            </div>

            <div id="projectlist">
                @include('admin.projects.data')
            </div>

        </div>

    </div>
</div>

<!-- Model -->
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
                            <label for="newstype required">Project</label>
                            <select class="form-control required" id="projectval" name="project_code" required>
                            <option value="">Select Project</option>
                                @if(!$proserch->isEmpty())
                                @foreach($proserch as $proje)
                                <option value="{{$proje->project_code}}">
                                    {{ $proje->project_name}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('project_name')
                            <label id="title-error" class="text-danger mt-2" for="title">
                                {{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="newstype required">Language</label>

                            <select class="form-control required" id="languageid" name="language">
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
                                    id="date" name="date" required>
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
                                        data-target="#timepicker-example" placeholder="Time" required>
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
                            <select class="form-control required" id="marketerid" name="marketer"
                            onchange="createlink(this.value)" required>
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
                                placeholder="Generate Link" name="generatelink">
                            @error('generatelink')
                            <label id="title-error" class="text-danger mt-2" for="title">
                                {{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" value="{{ $proje->project_id }}"  name="project_id">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success mr-2">Send</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script type="text/javascript">
    
    function createlink(marketerid) {
        var projectval = $('#projectval').val(); 

       if(projectval =='')
       {
        $("#marketerid option").prop("selected", false);

        swal({
            title: "Error?",
            text: "First Select Project!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        });
         return false;
       }
        $('#projectcod').val(projectval);
        
        var languageid = $('#languageid').val();
         var link = "{{ url('')}}/" + languageid + "/" + marketerid + "/" + projectval + "";
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
    


function getajaxdata(page = 0) {
    var typesearch = $('#typesearch').val();
    var catesearch = $('#catesearch').val();
    var continent = $('#continent').val();
    var country = $('#country').val();
    var pname = $('#pname').val();

    $.ajax({
        url: "{{ route('project.index') }}?page=" + page,
        type: "GET",
        data: {
            'typesearch': typesearch,
            'catesearch': catesearch,
            'continent': continent,
            'country': country,
            'pname': pname
        },
        dataType: 'html',
        success: function(data) {
            $('#projectlist').empty().html(data);
            location.hash = page;
        }
    })
}

$(document).ready(function()

    {
        $(document).on('click', '.pagination a', function(event) {
            $('li').removeClass('active');

            $(this).parent('li').addClass('active');

            event.preventDefault();

            var myurl = $(this).attr('href');

            var page = $(this).attr('href').split('page=')[1];


            getajaxdata(page);

        });

        $(window).on('hashchange', function() {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getajaxdata(page);
                }
            }
        });
    });

function changeStatus(id, donationtype_status) {

    swal({
            title: "Are you sure?",
            text: "You want to change Status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '{{ route("donationtypeStatus") }}',
                    method: 'POST',
                    data: {
                        id: id,
                        donationtype_status: donationtype_status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {

                        if (window.location.hash) {
                            var page = window.location.hash.replace('#', '');

                            if (page == Number.NaN || page <= 0) {
                                return false;
                            } else {
                                getajaxdata(page);
                            }
                        } else {
                            getajaxdata(1);
                        }

                    }
                });
                swal("Status has Been changed Succesfully!", {
                    icon: "success",
                });


            }
        });
}


function ProPublisStatus(id, publish_status) {

    swal({
            title: "Are you sure?",
            text: "You want to change Status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '{{ route("projpubliStatus") }}',
                    method: 'POST',
                    data: {
                        id: id,
                        publish_status: publish_status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (window.location.hash) {
                            var page = window.location.hash.replace('#', '');
                            if (page == Number.NaN || page <= 0) {
                                return false;
                            } else {
                                getajaxdata(page);
                            }
                        } else {
                            getajaxdata(1);
                        }

                    }
                });
                swal("Status has Been changed Succesfully!", {
                    icon: "success",
                });


            }
        });
}
</script>
@endsection