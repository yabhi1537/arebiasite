@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title">Edit Category</h4>

    <form id="baseForm1" name="baseForm1" method="post" class="forms-sample"
        action="{{ route('category.update',$categores->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Project Type</label>
            <select class="form-control required" id="newstype" name="project_type">
                <option value="">select</option>
                @if(!$projectId->isEmpty())
                @foreach($projectId as $projId)
                <option value="{{  $projId->id }}" {{ $projId->id == $categores->project_type  ? 'selected' : '' }}>
                    {{ $projId->type }}</option>
                @endforeach
                @endif
            </select>
            @error('project_type')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Status</label>
            <select class="form-control required" id="newstype" name="status">
                <option value="">select</option>
                <option value="1" {{ $categores->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $categores->status == 0 ? 'selected' : '' }}>deactiv</option>
            </select>
            @error('status')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" value="{{$categores->title}}" class="form-control required" id="title" placeholder="Name"
                name="title">
            @error('title')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Title (AR)</label>
            <input type="text" value="{{$categores->title_ar}}" class="form-control required" id="title" placeholder="Name" name="title_ar">

            @error('title_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Description</label>
            <textarea class="form-control required" id="description" name="description"
                rows="2">{{$categores->description}}</textarea>
            @error('description')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Description (AR)</label>
            <!-- <input type="text" class="form-control required" id="title" placeholder="Name" name="description"> -->
            <textarea class="form-control required" id="description_ar" name="description_ar" rows="2"> {{$categores->description_ar}}</textarea>
            @error('description_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <input type="hidden" value="{{$categores->image}}" name="images">
        <div class="form-group">
            <label>Category Image</label>
            <input type="file" name="image" class="file-upload-default">
            <div class="input-group col-xs-12">
                <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                <span class="input-group-append">
                    <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                </span>
            </div>
        </div>
        @error('image')
        <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
        @enderror

        <button type="submit" class="btn btn-success mr-2">Submit</button>
        <a href="{{ route('category.index') }}" class="btn btn-outline-danger">Cancel</a>
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