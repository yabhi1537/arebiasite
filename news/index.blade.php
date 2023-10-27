@extends('admin.layouts.app')

@section('content')

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All News Records</h4>
                <a href="{{ route('news.create')}}" class="btn btn-primary  btn-roundedmt-5 float-right">Add New News
                </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                        <div class="row">
                            <div class="col-md-2">
                                <select name="typesearch" id="typesearch" class="form-select" aria-label="Default select example">
                                    <option value="">Type Search</option>
                                    @if(!$newsty->isEmpty())
                                    @foreach($newsty as $newty)
                                    <option value="{{ $newty->newstypeid }}"
                                        {{ Request::get('typesearch') == $newty->newstypeid  ? 'selected="selected"' : '' }}>
                                        {{ $newty->type  }}</option>
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
                            <div class="col-md-3">
                                <input name="titleser" id="titleser" placeholder="search by title"
                                    value="{{ Request::get('titleser')}}">
                            </div>

                            <div class="col-md-2 d-flex">
                                <button type="button" class="btn btn-inverse-light btn-fw mr-2" onclick="getdata()">Filter results</button>
                                <a href="{{ route('news.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                            </div>
                        </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Publish Date</th>
                        <th>Created_at</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="listdata">
                    @if(!$news11->isEmpty())
                    @foreach($news11 as $new)
                    <tr>
                        <td></td>
                    </tr>
                    <tr>
                        <td> <img src="{{ asset('uploads/news/'.$new->bannerImage) }}" style="height: 30px;width:30px;">
                        </td>
                        <td>
                            {{ $new->title }}
                        </td>
                        <td>
                            {{ $new->newTyp ? $new->newTyp->type : '' }}
                        </td>
                        <td>{{$new->description}} </td>
                        <td>{{$new->publish_date}} </td>
                        <td>{{$new->created_at}} </td>

                        <td class="d-flex justify-content-center">
                            <a href="{{ route('news.show', $new->newsid) }}"
                                class=""><i class="bi bi-eye-fill f-21" ></i></a>
                      
                            <a href="{{ route('news.edit', $new->newsid) }}"
                                class=""><i class="bi bi-pencil-square f-21"></i></a>
                
                            <span>
                                <form method="POST" action="{{ route('news.destroy',$new->newsid) }}">
                                    @csrf
                                    @method('DELETE')
                                    <!-- {{ method_field('delete') }} -->
                                    <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @else
                  <p> Note : News Is Empty ?.</p>
                   @endif
                </tbody>
            </table>
        </div>
        {!! $news11->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
<script type="text/javascript">

function getdata() {
    var typesearch = $('#typesearch').val();
    var datesearch = $('#datesearch').val();
    var titleser = $('#titleser').val();

    $.ajax({
        url: "{{ route('news.index') }}",
        type: "GET",
        data: {
            'typesearch': typesearch,
            'datesearch': datesearch,
            'titleser': titleser,
        },
        dataType: 'html',
        success: function(data) {
            $('#listdata').html(data);
        }
    })
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