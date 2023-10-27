@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All Contect</h4>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                         <div class="row">
                            <div class="col-md-2">
                                <select name="nameserch" id="nameserch" class ="form-select" aria-label="Default select example">
                                    <option value="">Name Search</option>
                                    @if(!$Allabout->isEmpty())
                                    @foreach($Allabout as $achiv)
                                    <option value="{{ $achiv->name}}"
                                        {{ Request::get('nameserch') == $achiv->name  ? 'selected="selected"' : '' }}>
                                        {{ $achiv->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="emailserch" id="emailserch" class="form-select" aria-label="Default select example">
                                    <option value="">Email Search</option>
                                    @if(!$Allabout->isEmpty())
                                    @foreach($Allabout as $achiv)
                                    <option value="{{ $achiv->email}}"
                                        {{ Request::get('emailserch') == $achiv->email  ? 'selected="selected"' : '' }}>
                                        {{ $achiv->email}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="phone" id="phone" class="form-select" aria-label="Default select example">
                                    <option value="">Phone Search</option>
                                    @if(!$Allabout->isEmpty())
                                    @foreach($Allabout as $achiv)
                                    <option value="{{ $achiv->phone}}"
                                        {{ Request::get('phone') == $achiv->phone  ? 'selected="selected"' : '' }}>
                                        {{ $achiv->phone}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2 d-flex">
                                <button type="button" class="btn btn-inverse-light btn-fw mr-2" onclick="getdata()">Filter results</button>

                                <a href="{{ route('contactquery.index') }}"
                                    class="btn btn-inverse-light btn-fw">Clear</a>
                    <div class="col-md-2 d-flex">
                        <!-- <a type="submit" class="btn btn-inverse-light btn-fw mr-6"> Replay</a> -->
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Replay
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form id="baseForm" name="" class="forms-sample" method="POST"
                                    action="{{ route('contacmail.send')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Send Email</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="title">Name</label>
                                                <input type="text" class="form-control required" id="nameval"
                                                    placeholder="Name" name="name">

                                                @error('name')
                                                <label id="title-error" class="text-danger mt-2" for="title">
                                                    {{ $message }}</label>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Email</label>
                                                <input type="email" class="form-control required" id="emaivall"
                                                    placeholder="email" name="email">

                                                @error('email')
                                                <label id="title-error" class="text-danger mt-2" for="title">
                                                    {{ $message }}</label>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Description</label>
                                                <input type="text" class="form-control required" id="description"
                                                    placeholder="description" name="description">

                                                @error('description')
                                                <label id="title-error" class="text-danger mt-2" for="title">
                                                    {{ $message }}</label>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success mr-2">Send</button>
                                        </div>
                                    </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>


        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    <div><input type="checkbox" class="all_checked form-check-input m-0" style="position: relative;">
                    </div>
                </th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Quiries</th>
                <th>Date</th>

                <th class="text-center" colspan="3">Action</th>
            </tr>
        </thead>
        <tbody id="listdatas">
            @if(!$contactquery->isEmpty())
            @foreach($contactquery as $new)
            <tr>
                <td>
                    <div>
                        <input type="checkbox" data-name="{{$new->name}}" data-email="{{$new->email}}"
                            name="checkboxlist[]" value="{{$new->id}}" class="one_checked checkbox form-check-input m-0"
                            style="position: relative;">
                    </div>

                </td>
                <td>
                    {{ $new->name }}
                </td>
                <td>
                    {{ $new->phone }}
                </td>
                <td>
                    {{ $new->email }}
                </td>
                <td>
                    {{ $new->quiries }}
                </td>
                <td>
                    {{ $new->date }}
                </td>

                <td>
                    <a href="{{ route('contactquery.edit',$new->id)}}" class="fa fa-edit">Edit</a>
                </td>

            </tr>
            @endforeach
            @else
            <p> Note : Contact Query Is Empty ?.</p>
            @endif
        </tbody>
    </table>
</div>
{!! $Allabout->withQueryString()->links('pagination::bootstrap-5') !!}
</div>
</div>

<script type="text/javascript">

function getdata() {
    var nameserch = $('#nameserch').val();
    var emailserch = $('#emailserch').val();
    var phone = $('#phone').val();
    $.ajax({
        url: "{{ route('contactquery.index') }}",
        type: 'GET',
        data: {
            'nameserch': nameserch,
            'emailserch': emailserch,
            'phone': phone
        },
        success: function(response) {
            console.log(response);
            $('#listdatas').html(response);
        }
    });

}

$(document).ready(function() {


    // $('.one_checked').on('click', function() {
    //     var name = $(this).attr('data-name');
    //     var email = $(this).attr('data-email');
    //     var hdnid = $("#nameval").val(name);
    //     var recipient = $("#emaivall").val(email);
    //     // console.log(email); 
    //     $("#exampleModal").modal('show');
    // })

    $('.all_checked').on('click', function() {
        const allCheckedCheckbox = $(this);
        $('.checkbox').each(function() {
            $(this).prop('checked', allCheckedCheckbox.prop('checked'));
       
        });
        
        $('.one_checked').on('click', function() {
        var name = $(this).attr('data-name');
        var email = $(this).attr('data-email');
        var hdnid = $("#nameval").val(name);
        var recipient = $("#emaivall").val(email);
        // console.log(email); 
        // $("#exampleModal").modal('show');
     
    })

    });


    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })

});
</script>
@endsection