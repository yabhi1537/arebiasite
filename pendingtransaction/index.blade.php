@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">Pending Transaction</h4>
                <a href="javascript:void(0);" onclick="getdata_pdf()" class="btn btn-primary  btn-roundedmt-5 float-right">Export Pdf
                </a>
                <a href="javascript:void(0);"  onclick="getdata_excel()" class="btn btn-primary  btn-roundedmt-5 float-right">Export Excel
                </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                    <div class="row">
                        <div class="col-md-3">
                            <select name="p_type" id="p_type" class="form-select" aria-label="Default select example">
                                <option value="">Project Type</option>
                                @if(!$projectyp->isEmpty())
                                @foreach($projectyp as $dat)
                                <option value="{{ $dat->type}}"
                                    {{ Request::get('p_type') == $dat->type  ? 'selected="selected"' : '' }}>
                                    {{ $dat->type}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="category" id="category" class="form-select"
                                aria-label="Default select example">
                                <option value="">Category Search</option>
                                @if(!$categories->isEmpty())
                                @foreach($categories as $dat)
                                <option value="{{ $dat->title}}"
                                    {{ Request::get('category') == $dat->title  ? 'selected="selected"' : '' }}>
                                    {{ $dat->title}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="p_name" id="p_name" class="form-select" aria-label="Default select example">
                                <option value="">Project Name</option>
                                @if(!$projects->isEmpty())
                                @foreach($projects as $dat)
                                <option value="{{ $dat->project_name}}"
                                    {{ Request::get('p_name') == $dat->project_name  ? 'selected="selected"' : '' }}>
                                    {{ $dat->project_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input autocomplete="off" name="transactionId" id="transactionId" placeholder="search by transactionId..."
                                value="{{ Request::get('transactionId')}}">
                        </div>
                         <div class="col-md-3 mt-2">
                            <div id="datepicker-popup" class="input-group date datepicker">
                                <input autocomplete="off" type="text" placeholder="From Date" class="form-control" id="from_date"
                                    name="from_date" >
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="mdi mdi-calendar input-group-text"></span>
                                </span>
                            </div>
                        </div> 
                        <div class="col-md-3 mt-2">
                            <div id="datepicker-popups" class="input-group date datepickers">
                                <input autocomplete="off" type="text" placeholder="To Date" class="form-control" id="to_date"
                                    name="to_date" >
                                <span class="input-group-addon input-group-append border-left">
                                    <span class="mdi mdi-calendar input-group-text"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-3 mr-2">
                        <div class="col-md-2 p-1 ">
                            <button type="button" class="btn btn-inverse-light btn-fw w-100" onclick="getdata()">Filter
                                results</button>
                        </div>
                        <div class="col-md-2 p-1 ">
                            <a href="{{ route('pendingtransaction') }}"
                                class="btn btn-inverse-light btn-fw w-100">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="projectlist">
                @include('admin.pendingtransaction.data')
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function getdata(page = 0) {
    var p_type = $('#p_type').val();
    var category = $('#category').val();
    var p_name = $('#p_name').val();
    var transactionId = $('#transactionId').val();
    var payment_status = $('#payment_status').val();
     var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    $.ajax({
        url: "{{ route('pendingtransaction') }}?page=" + page,
        type: "GET",
        data: {
            'p_type': p_type,
            'category': category,
            'p_name': p_name,
            'transactionId': transactionId,
            'payment_status': payment_status,
            'from_date': from_date,
            'to_date': to_date,
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

if ($("#datepicker-popup,#datepicker-popups".length)) {
    $('#datepicker-popup,#datepicker-popups').datepicker({
        enableOnReadonly: true,
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
}
});


function getdata_pdf() {
    var p_type = $('#p_type').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var category = $('#category').val();
    var p_name = $('#p_name').val();
    var transactionId = $('#transactionId').val();

    $.ajax({
        url: "{{ route('pendingtransactionPDF', 'pdf') }}",
        type: "GET",
        data: {
            'p_type': p_type,
            'from_date': from_date,
            'to_date': to_date,
            'category': category,
            'p_name': p_name,
            'transactionId': transactionId,
        },
         xhrFields: {
                responseType: 'blob'
            },
        success: function(response) {
        var blob = new Blob([response]);
		var link = document.createElement('a');
		link.href = window.URL.createObjectURL(blob);
		link.download = 'report_'+(new Date()).toISOString().split('T')[0]+'.pdf';
		link.click();
		link.remove();
          
        }
    })
}

function getdata_excel() {
    var p_type = $('#p_type').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    var category = $('#category').val();
    var p_name = $('#p_name').val();
    var transactionId = $('#transactionId').val();

    $.ajax({
        url: "{{ route('pendingtransactionExport', ['excel','xlsx']) }}",
        type: "GET",
        data: {
            'p_type': p_type,
            'from_date': from_date,
            'to_date': to_date,
            'category': category,
            'p_name': p_name,
            'transactionId': transactionId,
        },
         xhrFields: {
                responseType: 'blob'
            },
        success: function(response) {
        var blob = new Blob([response]);
		var link = document.createElement('a');
		link.href = window.URL.createObjectURL(blob);
		link.download = 'report_'+(new Date()).toISOString().split('T')[0]+'.xlsx';
		link.click();
		link.remove();
          
        }
    })
}

</script>
@endsection
