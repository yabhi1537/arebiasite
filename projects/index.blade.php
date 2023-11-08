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
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
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
                                <option value="">Select Name</option>
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

<script type="text/javascript">
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