@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title"> Add Media</h4>
    <form id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('gallery.store')}}"
        enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="email">Media Title</label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="title">

            @error('title')
            <label id="	title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title_ar">Media Title (AR)</label>
            <input type="text" class="form-control required" id="title_ar" placeholder="Name" name="title_ar">

            @error('title_ar')
            <label id="	title_ar-error" class="text-danger mt-2" for="title_ar"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Media</label>
            <select name="type" id="type" class="form-control required">
                <option for="newstype" value="">Select Media Type</option>
                <option name="image" value="1">image</option>
                <option name="Video" value="2">Video</option>
               
            </select>
        </div>


        <div class="form-group" id="row_dim">
            <label>Media Image</label>
            <input type="file" id="photoshow" name="video_image" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                </span>
            </div>
            @error('video_image')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group" id="showurl">
            <label for="email"> Video Links</label>
            <input type="text" class="form-control required" id="title" placeholder="Pleage.. Enter Url..."
                name="video_image">
            @error('video_image')
            <label id="	title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mr-2">Submit</button>
        <a href="{{ route('gallery.index') }}" class="btn btn-light required">Cancel</a>
    </form>
</div>
<script type="text/javascript">
$(function() {
    $('#row_dim').hide();
    $('#type').change(function() {
        if ($('#type').val() == '1') {
            $('#row_dim').show();
        } else {
            $('#row_dim').hide();
        }

    });
    $('#showurl').hide();
    $('#type').change(function() {
        if ($('#type').val() == '2') {
            $('#showurl').show();
        } else {
            $('#showurl').hide();
        }
    });
});
</script>
@endsection