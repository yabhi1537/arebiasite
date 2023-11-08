@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All Banner Image</h4>
                <a href="{{ route('banner.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Add Banner
                </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                    <div class="row">

                        <div class="col-md-2">
                            <input name="banserch" id="banserch" placeholder="search by title"
                                value="{{ Request::get('banserch')}}">
                        </div>
                        <div class="col-md-2">
                            <select name="status" id="status" class="form-select" aria-label="Default select example">
                                <option value="">Status</option>
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex">
                            <button type="button" class="btn btn-inverse-light btn-fw mr-2" onclick="getdata()">Filter
                                results</button>
                            <a href="{{ route('banner.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="listdata">
                @include('admin.banner.data')
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
function getdata(page = 0) {
    var banserch = $('#banserch').val();
    var status = $('#status').val();
    $.ajax({
        url: "{{ route('banner.index') }}?page=" + page,
        type: "GET",
        data: {
            'banserch': banserch,
            'status': status,
        },
        dataType: 'html',
        success: function(data) {
            $('#listdata').empty().html(data);
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
                    url: '{{ route("bannerStatus") }}',
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

$(function() {
    $('table.db tbody').sortable({
        'containment': 'parent',
        'revert': true,
        helper: function(e, tr) {
            var $originals = tr.children();
            var $helper = tr.clone();
            $helper.children().each(function(index) {
                $(this).width($originals.eq(index).width());
            });
            return $helper;
        },

        update: function(event, ui) {
            $.ajax({
                url: "{{ route('banner-reposition') }}",
                type: "Post",
                dataType: 'json',
                data: $(this).sortable('serialize') + "&_token=" + '{{ csrf_token() }}',
                success: function(data) {
                    if (!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }
            });


        }
    });

});
</script>
@endsection