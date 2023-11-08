@extends('admin.layouts.app')
@section('content')
<div class="card-body mt-0">
    <h4 class="card-title">Add banner Image</h4>

    <form id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('banner.store')}}"
        enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">Banner Title</label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="title">

            @error('title')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <!-- <div class="form-group">
                      <label for="newstype required">Status</label>

                        <select class="form-control required" id="project_country" name="status" >
                        <option value="">Select</option>
                       
                            <option value="1">Active</option>
                            <option value="0">deactive</option>
                        </select>

                      @error('status') 
                    <label id="status-error" class="alert alert-danger" for="status"> {{ $message }}</label>
                    @enderror
                    </div> -->
        <div class="form-group">
            <label for="title_ar">Banner Title (AR)</label>
            <input type="text" class="form-control required" id="title_ar" placeholder="Name" name="title_ar">

            @error('title_ar')
            <label id="title_ar-error" class="text-danger mt-2" for="title_ar"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="link">Description (AR)</label>
            <textarea class="form-control required" placeholder="Enter text here..." name="description_ar"> </textarea>
            @error('description_ar')
            <label id="title-error" class="alert alert-danger" for="short_url"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="link">Description</label>
            <textarea class="form-control required" placeholder="Enter text here..." name="description"> </textarea>
            @error('description')
            <label id="title-error" class="alert alert-danger" for="short_url"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="link">Links</label>
            <input type="url" class="form-control required" id="to_date" placeholder="url" name="link" />

            @error('link')
            <label id="title-error" class="alert alert-danger" for="short_url"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label>Banner Image</label>
            <input type="file" name="bannerImg" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                </span>
            </div>
        </div>

        @error('bannerImg')
        <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
        @enderror

        <br /><br />

        <button type="submit" class="btn btn-success mr-2">Submit</button>
        <a href="{{ route('banner.index') }}" class="btn btn-outline-danger">Cancel</a>
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