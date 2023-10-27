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
                            <select name="banserch" id="banserch" class="form-select"
                                aria-label="Default select example">
                                <option value="">Title</option>
                                @if(!$bann->isEmpty())
                                @foreach($bann as $banne)
                                <option value="{{ $banne->title}}"
                                    {{ Request::get('banserch') == $banne->title  ? 'selected="selected"' : '' }}>
                                    {{ $banne->title}}</option>
                                @endforeach
                                @endif
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <!-- <th>Links</th> -->
                        <th>Description</th>
                        <th>Status</th>
                        <!-- <th>Created_at</th> -->
                        <th class="text-center" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody id="listdata">
                    @if(!$banner->isEmpty())
                    @foreach($banner as $new)
                    <tr>
                        <td> <img src="{{ asset('uploads/BannerImg/'.$new->bannerImg) }}"
                                style="height: 30px;width:30px;"></td>
                        <td>
                            {{ $new->title }}
                        </td>

                        <td>
                            {{ $new->description }}
                        </td>
                        <!-- <td>
                            {{ $new->created_at }}
                        </td> -->
                        <td class="text-center">
                            @if($new->status =='0')
                            <span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
                                onclick="changeStatus('{{ $new->id }}',1)">Deactive</span>

                            @else
                            @if($new->status =='1')
                            <span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                                onclick="changeStatus('{{ $new->id }}',0 )">Active</span>
                            @endif
                            @endif

                        </td>
                        <td>
                            <a href="{{ route('banner.show', $new->id) }}"
                                class="fa fa-eye">View</a>
                        </td>
                        <td>
                            <a href="{{ route('banner.edit', $new->id) }}"
                                class="fa fa-edit">Edit</a>
                        </td>
                        <td>
                            <span>
                                <form method="POST" action="{{ route('banner.destroy', $new->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <!-- {{ method_field('delete') }} -->
                                    <button type="submit" class="btn btn-outline-danger  ">delete</button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <p> Note : Banner Is Empty ?.</p>
                    @endif
                </tbody>
            </table>
        </div>
        {!! $banner->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
<script type="text/javascript">
function getdata() {
    var banserch = $('#banserch').val();
    $.ajax({
        url: "{{ route('banner.index') }}",
        type: "GET",
        data: {
            'banserch': banserch,
        },
        dataType: 'html',
        success: function(data) {
            $('#listdata').html(data);
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
</script>
@endsection