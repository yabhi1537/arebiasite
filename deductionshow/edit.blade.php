@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title">Edit Deduction Header</h4>
    <form autocomplete="off" id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('deductionshow.update',$deductionshow->id)}}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control required" value="{{ $deductionshow->title}}" id="title" placeholder="Name" name="title">

            @error('title')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Title (AR)</label>
            <input type="text" class="form-control required" value="{{ $deductionshow->title_ar}}" id="title_ar" placeholder="Name" name="title_ar">

            @error('title_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Descrption</label>
            <input type="text" class="form-control required"   value="{{ $deductionshow->description}}" id="description" placeholder="Name" name="description">

            @error('description')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Descrption (AR)</label>
            <input type="text" class="form-control required" value="{{ $deductionshow->description_ar}}" id="title" placeholder="Name" name="description_ar">

            @error('description_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
         <div class="form-group">
            <label>Current Image</label><br>

            @if($deductionshow->image)
            <img class="img-thumbnail" src="{{ asset('uploads/deductiontitleimage/'.$deductionshow->image) }}"
                style="height: 100px;width:100px;">
            @endif
        </div>
        <input type="hidden" value="{{$deductionshow->image}}" name="images">
        <div class="form-group">
            <label>Image</label>
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
</div>

<button type="submit" class="btn btn-success mr-2">Submit</button>
<a href="{{ route('deductionshow.index') }}" class="btn btn-outline-danger">Cancel</a>
</form>
</div>
@endsection
