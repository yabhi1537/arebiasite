@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title">Add Sponsorship</h4>
    <form id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('sponsor.store')}}"
        enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="links">Sponsor Type</label>
            <select class="form-control required" id="newstype" name="type_id">
                <option value="">select</option>
                @if(!$sponsortyp->isEmpty())
                @foreach($sponsortyp as $spotp)
                <option value="{{ $spotp->type_id}}">{{ $spotp->sponser_type}}</option>
                @endforeach
                @endif
            </select>
            @error('type_id')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title"> Name (AR)</label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="name_ar">

            @error('name_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title"> Name</label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="name">

            @error('name')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title"> Age </label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="age">

            @error('age')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="links">Gender</label>
            <select class="form-control required" id="newstype" name="gender">
                <option value="">select</option>
                <option value="1">Mail</option>
                <option value="2">Femail</option>
            </select>

            @error('gender')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="links">Project Type</label>
            <select class="form-control required" id="country" name="project_types">
                <option value="">select</option>
                @if(!$projectyp->isEmpty())
                @foreach($projectyp as $spotp)
                <option value="{{ $spotp->id}}">{{ $spotp->type}}</option>
                @endforeach
                @endif
            </select>
            @error('project_types')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="links">Country</label>
            <select class="form-control required" id="country" name="country">
                <option value="">select</option>
                @if(!$country->isEmpty())
                @foreach($country as $spotp)
                <option value="{{ $spotp->country}}">{{ $spotp->country}}</option>
                @endforeach
                @endif
            </select>
            @error('country')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
     
        <!-- <div class="form-group">
            <label for="title">Project Price </label>
            <input type="text" class="form-control required" id="title" placeholder="Name" name="project_price">

            @error('project_price')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div> -->
        <div class="form-group">
            <label for="links">Status</label>
            <select class="form-control required" id="newstype" name="status">
                <option value="">select</option>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            @error('status')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
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
<a href="{{ route('sponsor.index') }}" class="btn btn-outline-danger">Cancel</a>
</form>
</div>
@endsection