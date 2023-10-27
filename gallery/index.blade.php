@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">Gallery</h4>
                <a href="{{ route('gallery.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Add
                </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="type" id="type" class="form-select" aria-label="Default s
                                elect example">
                                <option value="">Type Search</option>
                                @if(!$gallery->isEmpty())
                                @foreach($gallery as $types)
                                <option value="{{ $types->type}}"
                                    {{ Request::get('type') == $types->type  ? 'selected="selected"' : '' }}>
                                    {{ $types->type}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2 d-flex">
                            <button type="button" class="btn btn-inverse-light btn-fw mr-2"
                                onclick="getserdata()">Filter
                                results</button>

                            <a href="{{ route('gallery.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th> Type</th>
                        <th>Media / Gallery</th>
                        <th class="text-center" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody id="projectlist">
                    @if(!$gallery->isEmpty())
                    @foreach($gallery as $new)
                    <tr>
                        <td>
                            {{ $new->title }}
                        </td>
                        <td>
                            {{ $new->type }}
                        </td>
                        <td>
                            {{ $new->video_image }}
                        </td>

                        <td>
                            <a href="{{ route('gallery.show',$new->id)}}" class="fa fa-eye">View</a>
                        </td>
                        <td>
                            <a href="{{ route('gallery.edit',$new->id)}}" class="fa fa-edit">Edit</a>
                        </td>
                        <td>
                            <span>
                                <form method="POST" action="{{ route('gallery.destroy',$new->id)}}">
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
            <p> Note : Gallery Is Empty ?.</p>
            @endif
        </div>
        {!! $gallery->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

<script type="text/javascript">
function getserdata() {

    var type = $('#type').val();
    $.ajax({
        url: "{{ route('gallery.index') }}",
        type: "GET",
        data: {
            'type': type,

        },
        dataType: 'html',
        success: function(data) {
            $('#projectlist').html(data);
        }
    })
}
</script>
@endsection