@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title">Update Donation Policy</h4>
    <form id="baseForm" name="baseForm" class="forms-sample" method="POST"
        action="{{ route('donationpolicy.update',$donationpolicy->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" value="{{$donationpolicy->title}}" class="form-control required" id="" placeholder="Enter text here..." name="title">

            @error('title')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control required" id="description" name="description"
                rows="2"> {{ $donationpolicy->description }}</textarea>

            @error('description')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title_ar">Title (AR)</label>
            <input type="text" value="{{$donationpolicy->title_ar}}" class="form-control required" id="" placeholder="Enter text here..." name="title_ar">

            @error('title_ar')
            <label id="title_ar-error" class="text-danger mt-2" for="title_ar"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="description_ar">Description (AR)</label>
            <textarea class="form-control required" id="description_ar" name="description_ar"
                rows="2"> {{ $donationpolicy->description_ar }}</textarea>

            @error('description_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <br/>
        <button type="submit" class="btn btn-success mr-2">Submit</button>
        <a href="{{ route('donationpolicy.index') }}" class="btn btn-light required">Cancel</a>
    </form>
</div>

<script>
$(document).ready(function() {
    /*Tinymce editor*/
    if ($("#description,#description_ar").length) {
        tinymce.init({
            selector: '#description,#description_ar',
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
@endsection