@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All News Type</h4>

                <a href="{{ route('newstype.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Add News
                    Type </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                    <!-- <form action="{{ route('newsType.index') }}" method="GET"> -->
                    <div class="row">
                        <div class="col-md-2">
                            <select name="typeserch" id="typeserch" class="form-select"
                                aria-label="Default select example">
                                <option>News Type</option>
                                @if(!$newsty->isEmpty())
                                @foreach($newsty as $news)
                                <option value="{{ $news->type}}"
                                    {{ Request::get('typeserch') == $news->type  ? 'selected="selected"' : '' }}>
                                    {{ $news->type}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2 d-flex">
                            <button type="button" class="btn btn-inverse-light btn-fw mr-2"
                                onclick="getDataajax()">Filter results</button>
                            <a href="{{ route('newsType.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                        </div>
                    </div>
                    <!-- </form> -->
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>S. No</th>
                        <th>News Type</th>
                        <th>Created_at</th>
                        <th class="text-center" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody id="newslist">
                    @if(!$newstype->isEmpty())
                    @foreach($newstype as $new)
                    <tr>
                        <td>
                            {{ $new->newstypeid }}
                        </td>
                        <td>
                            {{ $new->type }}
                        </td>
                        <td>
                            {{ $new->created_at }}
                        </td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('newstype.show',$new->newstypeid)}}"
                                class=""><i class="bi bi-eye-fill f-21" ></i></a>     
                     
                            <a href="{{ route('newstype.edit',$new->newstypeid)}}"
                                class=""><i class="bi bi-pencil-square f-21"></i></a> 
                 
                            <span>
                                <form method="POST" action="{{ route('newstype.destroy',$new->newstypeid)}}">
                                    @csrf
                                    @method('DELETE')
                                    <!-- {{ method_field('delete') }} -->
                                    <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>                                </form>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <td colspan="4"> Note : News Type Is Empty ?.</td>
                    @endif

                </tbody>
            </table>
        </div>
        {!! $newstype->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

<script type="text/javascript">
function getDataajax() {
    var typeserch = $('#typeserch').val();
    $.ajax({
        url: "{{ route('newsType.index') }}",
        type: "GET",
        data: {
            'typeserch': typeserch
        },
        dataType: 'html',
        success: function(data) {
            $('#newslist').html(data);
        }
    })
}
</script>
@endsection