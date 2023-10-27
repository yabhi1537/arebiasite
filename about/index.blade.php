@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">About Us</h4>

                <!-- <a href="{{ route('about.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Create About -->
                     </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
         <div class="fillterDrpdown">
                <div class="">
                        <div class="row">
                            <div class="col-md-2">
                                <select name="titleserch" id="titleserch" class="form-select" aria-label="Default select example">
                                    <option value="">Title Search</option>
                                    @if(!$Allabout->isEmpty())
                                    @foreach($Allabout as $abot)
                                    <option value="{{ $abot->title}}"
                                        {{ Request::get('titleserch') == $abot->title  ? 'selected="selected"' : '' }}>
                                        {{ $abot->title}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2 d-flex">
                                <button type="button" class="btn btn-inverse-light btn-fw mr-2" onclick="getdata()">Filter results</button>
                                <a href="{{ route('about.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                            </div>
                        </div>
                </div>
            </div> 
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created_at</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="listdata">
                    @if(!$about->isEmpty())
                    @foreach($about as $new)
                    <tr>
                    <td>
                            <img src="{{ asset('uploads/about/image/'.$new->image) }}"
                                style="height: 30px;width:30px;">
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
                            <a href="{{ route('about.edit',$new->id) }}"
                                class="fa fa-edit">Edit</a>
                        </td>
                        <!-- <td>
                            <span>
                                <form method="POST" action="{{ route('about.destroy',$new->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-outline-danger  ">delete</button>
                                </form>
                            </span>
                        </td> -->
                    </tr>
                    @endforeach
                    @else
                  <p> Note : About Is Empty ?.</p>
                   @endif
                </tbody>
            </table>
        </div>
        {!! $about->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
<script type="text/javascript">

 function getdata(){
    var titleserch = $('#titleserch').val();

    $.ajax({
           url: "{{ route('about.index')  }}",
           type: 'GET',
           data:{
              'titleserch':titleserch
           },
           success: function(response){
            $('#listdata').html(response);
           }
    });

 }


</script>

@endsection