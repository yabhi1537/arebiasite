@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All Category</h4>
                <a href="{{ route('category.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Add
                    Category </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="cateserch" id="cateserch" class="form-select"
                                aria-label="Default select example">
                                <option value="">Type</option>
                                @if(!$categoryser->isEmpty())
                                @foreach( $categoryser as $categ)
                                <option value="{{ $categ->project_type}}"
                                    {{ Request::get('cateserch') == $categ->project_type  ? 'selected="selected"' : '' }}>
                                    {{ $categ->project_type}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="titlserch" id="titlserch" class="form-select"
                                aria-label="Default select example">
                                <option value="">Category</option>
                                @if(!$categoryser->isEmpty())
                                @foreach( $categoryser as $categ)
                                <option value="{{ $categ->title}}"
                                    {{ Request::get('titlserch') == $categ->title  ? 'selected="selected"' : '' }}>
                                    {{ $categ->title}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2 d-flex">
                            <button type="button" class="btn btn-inverse-light btn-fw mr-2"
                                onclick="getajaxdata()">Filter results</button>
                            <a href="{{ route('category.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                        </div>
                    </div>

                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Project Type</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Status</th>


                        <th class="text-center" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody id="datalist">
                    @if(!$categorys->isEmpty())
                    @foreach($categorys as $categor)
                    <tr>
                        <td> <img src="{{ asset('uploads/category/image/'.$categor->image) }}"
                                style="height: 30px;width:30px;"></td>
                        <td>
                            {{ $categor->project_type }}
                        </td>
                        <td>
                            {{ $categor->title }}
                        </td>
                        <td>{{ $categor->description }}</td>
                        <td class="text-center">
                            @if($categor->status =='0')
                            <span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
                                onclick="changeStatus('{{ $categor->id }}',1)">Deactive</span>

                            @else
                            @if($categor->status =='1')
                            <span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                                onclick="changeStatus('{{ $categor->id }}',0 )">Active</span>
                            @endif
                            @endif

                        </td>

                        <td class="d-flex justify-content-center">
                            <a href="{{ route('category.show', $categor->id) }}" class=""><i
                                    class="bi bi-eye-fill f-21"></i></a>


                            <a href="{{ route('category.edit', $categor->id) }}" class=""><i
                                    class="bi bi-pencil-square f-21"></i></a>
                            <span>
                                <form method="POST" action="{{ route('category.destroy',$categor->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <p> Note : Category Is Empty ?.</p>
                    @endif
                </tbody>
            </table>
        </div>
        {!! $categorys->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

<script type="text/javascript">
function getajaxdata() {
    var cateserch = $('#cateserch').val();
    var titlserch = $('#titlserch').val();

    $.ajax({
        url: "{{ route('category.index') }}",
        type: "GET",
        data: {
            'cateserch': cateserch,
            'titlserch': titlserch,
        },
        dataType: 'html',
        success: function(data) {
            $('#datalist').html(data);
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
                    url: '{{ route("categoryStatus") }}',
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