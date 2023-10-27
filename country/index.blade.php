@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All Countries</h4>
                <a href="{{ route('country.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Add
                    Country </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                    <div class="row">
                        <!-- <div class="col-md-2">
                            <select name="title_ar" id="title_ar" class="form-select" aria-label="Default s
                                elect example">
                                <option value="">Title (AR)</option>
                                @if(!$count->isEmpty())
                                @foreach($count as $contin)
                                <option value="{{ $contin->title_ar}}"
                                    {{ Request::get('title_ar') == $contin->title_ar  ? 'selected="selected"' : '' }}>
                                    {{ $contin->title_ar}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div> -->
                        <div class="col-md-2">
                            <select name="title" id="title" class="form-select" aria-label="Default s
                                elect example">
                                <option value="">Title</option>
                                @if(!$count->isEmpty())
                                @foreach($count as $contin)
                                <option value="{{ $contin->title}}"
                                    {{ Request::get('title') == $contin->title  ? 'selected="selected"' : '' }}>
                                    {{ $contin->title}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="country" id="country" class="form-select" aria-label="Default s
                                elect example">
                                <option value="">Country</option>
                                @if(!$count->isEmpty())
                                @foreach($count as $contin)
                                <option value="{{ $contin->country}}"
                                    {{ Request::get('country') == $contin->country  ? 'selected="selected"' : '' }}>
                                    {{ $contin->country}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <!-- <div class="col-md-2">
                            <select name="status" id="status" class="form-select" aria-label="Default select example">
                                <option value="">Status</option>
                                @if(!$count->isEmpty())
                                @foreach($count as $contin)
                                <option value="{{ $contin->status}}"
                                    {{ Request::get('status') == $contin->status  ? 'selected="selected"' : '' }}>
                                    @if($contin->status == 1)
                                    Active
                                    @elseif($contin->status == 0)
                                    deactive 
                                    @endif
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div> -->
                        <!-- <div class="col-md-3">
                            <div id="datepicker-popup" class="input-group date datepicker">
                                <input type="text" placeholder="Date Search" class="form-control" id="created_at"
                                    name="created_at" value="{{ Request::get('created_at')}}">
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="mdi mdi-calendar input-group-text"></span>
                                </span>
                            </div>
                        </div> -->
                        <div class="col-md-2 d-flex">
                            <button type="button" class="btn btn-inverse-light btn-fw mr-2"
                                onclick="getserdata()">Filter
                                results</button>

                            <a href="{{ route('country.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Country</th>
                        <th class="text-center" colspan="">Action</th>
                    </tr>
                </thead>
                <tbody id="projectlist">
                    @if(!$country->isEmpty())
                    @foreach($country as $new)
                    <tr>

                        <td>
                            {{ $new->title }}
                        </td>
                        <td>
                            {{ $new->country }}
                        </td>
                        <td>
                            <a href="{{ route('country.show',$new->id)}}"
                                class="fa fa-eye">View</a>
                        </td>
                        <td>
                            <a href="{{ route('country.edit',$new->id)}}"
                                class="fa fa-edit">Edit</a>
                        </td>
                        <td>
                            <span>
                                <form method="POST" action="{{ route('country.destroy',$new->id)}}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-outline-danger  ">delete</button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p> Note : Country Is Empty ?.</p>
            @endif
        </div>
        {!! $country->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

<script type="text/javascript">
function getserdata() {

    var title_ar = $('#title_ar').val();
    var title = $('#title').val();
    var country = $('#country').val();


    $.ajax({
        url: "{{ route('country.index') }}",
        type: "GET",
        data: {
            'title_ar': title_ar,
            'title': title,
            'country': country,
        },
        dataType: 'html',
        success: function(data) {
            $('#projectlist').html(data);
        }
    })
}

function changeStatus(id, status) {

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
                    url: '{{ route("CountryStatus") }}',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);
                        window.location.reload();
                    }
                });
                swal("Status has Been changed Succesfully!", {
                    icon: "success",
                });
            }
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