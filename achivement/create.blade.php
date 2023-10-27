@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title"> Add Achivement</h4>
    <form id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('achivement.store')}}"
        enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Achivement</label>
            <input type="text" class="form-control required" id="achivement_type" placeholder="Name"
                name="achivement_type">

            @error('achivement_type')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="title">

            @error('title')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Title (AR)</label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="title_ar">

            @error('title_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Description (AR)</label>
            <textarea class="form-control required" id="description" name="description_ar" rows="2"></textarea>
            @error('description_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Description</label>
            <textarea class="form-control required" id="description" name="description" rows="2"></textarea>
            @error('description')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="images" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                </span>
            </div>
        </div>
        @error('images')
        <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
        @enderror
        <br />
        <button type="submit" class="btn btn-success mr-2">Submit</button>
        <a href="{{ route('achivement.index') }}" class="btn btn-light required">Cancel</a>
    </form>
</div>


<script>
$(document).ready(function() {

});
</script>
@endsection