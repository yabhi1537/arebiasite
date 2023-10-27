@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All Achivements</h4>
                <a href="{{ route('achivement.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Add
                    Achivement </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                        <div class="row">
                            <div class="col-md-2">
                                <select name="achivserch" id="achivserch" class="form-select" aria-label="Default select example">
                                    <option value="">Achivement</option>
                                    @if(!$achivement->isEmpty())
                                    @foreach($achivem as $achiv)
                                    <option value="{{ $achiv->achivement_type}}"
                                        {{ Request::get('cateserch') == $achiv->achivement_type  ? 'selected="selected"' : '' }}>
                                        {{ $achiv->achivement_type}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="achivtitle" id="achivtitle" class="form-select" aria-label="Default select example">
                                    <option value="">Title</option>
                                    @if(!$achivement->isEmpty())
                                    @foreach($achivem as $achiv)
                                    <option value="{{ $achiv->title}}"
                                        {{ Request::get('achivtitle') == $achiv->title  ? 'selected="selected"' : '' }}>
                                        {{ $achiv->title}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2 d-flex">
                                <button type="button" class="btn btn-inverse-light btn-fw mr-2" onclick="getdata()">Filter results</button>

                                <a href="{{ route('achivement.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                            </div>
                        </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Achivement</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created_at</th>
                        <th class="text-center" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody id="listdata">
                    @if(!$achivement->isEmpty())
                    @foreach($achivement as $new)
                    <tr>
                        <td>
                            <img src="{{ asset('uploads/achivement/images/'.$new->images) }}"
                                style="height: 30px;width:30px;">
                        </td>
                        <td>
                            {{ $new->achivement_type }}
                        </td>
                        <td>
                            {{ $new->title }}
                        </td>
                        <td>
                            {{ $new->description }}
                        </td>
                        <td>
                            {{ $new->created_at }}
                        </td>
                        <td>
                            <a href="{{ route('achivement.show',$new->id)}}"
                                class="fa fa-eye">View</a>
                        </td>
                        <td>
                            <a href="{{ route('achivement.edit',$new->id)}}"
                                class="fa fa-edit">Edit</a>
                        </td>
                        <td>
                            <span>
                                <form method="POST" action="{{ route('achivement.destroy',$new->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <!-- {{ method_field('delete') }} -->
                                    <button type="submit" class="buttonrem fa fa-trash-o ">delete</button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @else
                  <p> Note : Achivments Is Empty ?.</p>
                   @endif
                </tbody>
            </table>
        </div>
        {!! $achivem->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

<script type="text/javascript">
    
function getdata() {
    var achivserch = $('#achivserch').val();
    var achivtitle = $('#achivtitle').val();

    $.ajax({
        url: "{{ route('achivement.index') }}",
        type: "GET",
        data: {
            'achivserch': achivserch,
            'achivtitle': achivtitle,
           
        },
        dataType: 'html',
        success: function(data) {
            $('#listdata').html(data);
        }
    })
}

</script>
@endsection