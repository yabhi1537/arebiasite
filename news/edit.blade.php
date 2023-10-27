@extends('admin.layouts.app')

@section('content')

<div class="card-body mt-5">
    <h4 class="card-title">Edit News</h4>
    <form id="baseForm" name="baseForm" class="forms-sample" method="POST"
        action="{{ route('news.update', $tnews->newsid) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" value="{{$tnews->bannerImage}}" name="image">

        <div class="form-group">
            <label for="title">News Title</label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="title"
                value="{{ $tnews->title }}">

            @error('title')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">News Title (AR)</label>
            <input type="text" value="{{ $tnews->title_ar}}" class="form-control required" id="title" placeholder="Name"
                name="title_ar">

            @error('title_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="newstype">News Type</label>
            <select class="form-control required" id="newstype" name="newstype">
                @if(!$newstype->isEmpty())
                @foreach($newstype as $nwsty)
                <option value="{{ $nwsty->newstypeid }}"
                    {{ $nwsty->newstypeid == $tnews->newstypeid ? 'selected' : '' }}>
                    {{ $nwsty->type }} </option>

                @endforeach
                @endif
            </select>
            @error('newstype')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>


        <div class="form-group">
            <label for="publish_date">News Publish Date</label>
            <input type="date" class="form-control required" id="publish_date" placeholder="Name" name="publish_date"
                value="{{ $tnews->publish_date }}">

            @error('publish_date')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>



        <div class="form-group">
            <label>Current Image</label><br>

            @if($tnews->bannerImage)
            <img class="img-thumbnail" src="{{ asset('uploads/news/'.$tnews->bannerImage) }}"
                style="height: 100px;width:100px;">
            @endif
        </div>
        <div class="form-group">
            <label>News Banner</label>
            <input type="file" name="bannerimage" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                </span>
            </div>
        </div>
        <div class="form-group">
            <label for="description">News Description</label>
            <textarea class="form-control required" id="description" name="description"
                rows="2"> {{ $tnews->description }}</textarea>

            @error('description')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">News Description (AR)</label>
            <textarea class="form-control required" id="description_ar" name="description_ar"
                rows="2">{{ $tnews->description_ar}}</textarea>
            @error('description_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>


        <button type="submit" class="btn btn-success mr-2">Submit</button>
        <a href="{{ route('news.index') }}" class="btn btn-outline-danger">Cancel</a>
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