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

                        <div class="col-md-2 d-flex">
                            <button type="button" class="btn btn-inverse-light btn-fw mr-2"
                                onclick="getserdata()">Filter
                                results</button>

                            <a href="{{ route('country.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="projectlist">
                @include('admin.country.data')
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function getserdata(page = 0) {
    var title = $('#title').val();
    var country = $('#country').val();
    $.ajax({
        url: "{{ route('country.index') }}?page=" + page,
        type: "GET",
        data: {
            'title': title,
            'country': country,
        },
        dataType: 'html',
        success: function(data) {
            $('#projectlist').empty().html(data);
            location.hash = page;
        }
    })
}


$(document).ready(function() {
    $(document).on('click', '.pagination a', function(event) {
        $('li').removeClass('active');

        $(this).parent('li').addClass('active');

        event.preventDefault();

        var myurl = $(this).attr('href');

        var page = $(this).attr('href').split('page=')[1];

        getserdata(page);

    });

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getserdata(page);
            }
        }
    });
});




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
