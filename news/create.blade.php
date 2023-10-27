@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title">Add News</h4>
    <form id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{route('news.store')}}"
        enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">News Title</label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="title">

            @error('title')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">News Title (AR)</label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="title_ar">

            @error('title_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="publish_date">News Publish Date</label>
            <!-- <input type="date" class="form-control required" id="publish_date" placeholder="Name" name="publish_date"> -->
            <div id="datepicker-popup" class="input-group date datepicker">
                <input type="text" class="form-control" name="publish_date">
                <span class="input-group-addon input-group-append border-left">
                    <span class="mdi mdi-calendar input-group-text"></span>
                </span>
            </div>
            @error('publish_date')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
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
        @error('bannerimage')
        <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
        @enderror

        <div class="form-group">
            <label for="newstype required">News Type</label>

            <select class="form-control required" id="newstype" name="newstype">
                <option value="">select news type</option>
                @if(!$newstype->isEmpty())
                @foreach($newstype as $newst)
                <option value="{{$newst->newstypeid}}">{{$newst->type}}</option>
                @endforeach
                @endif
            </select>
            @error('newstype')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">News Description</label>
            <textarea class="form-control required" id="description" name="description" rows="2"></textarea>
            @error('description')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">News Description (AR)</label>
            <textarea class="form-control required" id="description_ar" name="description_ar" rows="2"></textarea>
            @error('description_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <button type="submit" class="btn btn-success mr-2">Submit</button>
        <a href="{{ route('news.index') }}" class="btn btn-outline-danger">Cancel</a>
    </form>
</div>
<script>
$(document).ready(function() {
    // $('#baseForm').validate();
    /*Tinymce editor*/
    
    if ($("#datepicker-popup".length)) {
        $('#datepicker-popup').datepicker({
            enableOnReadonly: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    }
  });
    
</script>
@endsection
