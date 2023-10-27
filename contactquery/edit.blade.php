@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title">Edit Contect</h4>

    <form id="baseForm" name="baseForm" class="forms-sample" method="POST"
        action="{{ route('contactquery.update',$contactquery->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" value="{{$contactquery->images}}" name="image">
        <div class="form-group">
            <label for="title">Name</label>
            <input type="text" class="form-control required" id="title" value="{{ $contactquery->name}}"
                placeholder="Name" name="name">

            @error('name')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Phone</label>
            <input type="text" value="{{ $contactquery->phone}}" class="form-control required" id="phone"
                placeholder="Name" name="phone">

            @error('phone')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Email</label>
            <input type="text" value="{{ $contactquery->email}}" class="form-control required" id="email"
                placeholder="Name" name="email">

            @error('email')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Quiries</label>
            <input type="text" value="{{ $contactquery->quiries}}" class="form-control required" id="quiries"
                placeholder="Name" name="quiries">

            @error('quiries')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

      
        <br /><br />

        <button type="submit" class="btn btn-success mr-2">Update</button>
        <a href="{{ route('contactquery.index') }}" class="btn btn-light required">Cancel</a>
    </form>
</div>

@endsection



<script>
$(document).ready(function() {
    // $('#baseForm').validate();

    /*Tinymce editor*/
    if ($("#description").length) {
        tinymce.init({
            selector: '#description',
            height: 500,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true,
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: []
        });
    }
});
</script>