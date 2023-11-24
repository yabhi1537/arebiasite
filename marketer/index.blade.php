@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All Marketers</h4>
                <a href="{{ route('marketer.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Add
                    Marketer </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                        <div class="row">
                          
                            <div class="col-md-3">
                            <input autocomplete="off" name="nameserch" id="nameserch" placeholder="search by name & email..."
                                value="{{ Request::get('nameserch')}}">
                        </div>
                            <div class="col-md-2">
                                <select name="countryserch" id="countryserch" class="form-select" aria-label="Default select example">
                                    <option value="">Country Serach</option>
                                    @if(!$countries->isEmpty())
                                    @foreach($countries as $memard)
                                    <option value="{{ $memard->country}}"
                                        {{ Request::get('countryserch') == $memard->country  ? 'selected="selected"' : '' }}>
                                        {{ $memard->country}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div id="datepicker-popup" class="input-group date datepicker">
                                    <input type="text" placeholder="Date Search" class="form-control" id="datesearch" name="datesearch"
                                        value="{{ Request::get('datesearch')}}">
                                    <span class="input-group-addon input-group-append border-left">
                                        <span class="mdi mdi-calendar input-group-text"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex">
                                <button type="button" class="btn btn-inverse-light btn-fw mr-2" onclick="getdata()">Filter results</button>

                                <a href="{{ route('marketer.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                            </div>
                        </div>
                </div>
            </div>
            <div id="listshow">
                @include('admin.marketer.data')
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function getdata(page=0){
    var nameserch = $('#nameserch').val();
    var emailserch = $('#emailserch').val();
    var countryserch = $('#countryserch').val();
    var datesearch = $('#datesearch').val();

    $.ajax({
        url: "{{ route('marketer.index') }}?page="+ page,
        type: 'GET',
        data: {
            'nameserch': nameserch,
            'emailserch': emailserch,
            'datesearch': datesearch,
            'countryserch': countryserch
        },
        dataType: 'html',
        success: function(data){ 
            $('#listshow').empty().html(data);
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


        getdata(page);

    });

    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            } else {
                getdata(page);
            }
        }
    });
});


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