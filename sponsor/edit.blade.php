@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title">Edit Sponsorship</h4>
    <form id="baseForm" name="baseForm" class="forms-sample" method="POST"
        action="{{ route('sponsor.update',$data->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="links">Sponsor Type</label>
            <select class="form-control required" id="newstype" name="type_id">
                <option value="">select</option>
                @if(!$sponsortyp->isEmpty())
                @foreach($sponsortyp as $sportyp)
                <option value="{{ $sportyp->type_id}}" {{ $sportyp->type_id == $data->type_id  ? 'selected' : '' }}>
                    {{ $sportyp->sponser_type }}
                </option>
                @endforeach
                @endif
            </select>
            @error('type_id')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title"> Name</label>
            <input type="text" class="form-control required" value="{{$data->name}}" id="title" placeholder="Name"
                name="name">

            @error('name')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title"> Name (AR)</label>
            <input type="text" class="form-control required" value="{{$data->name_ar}}" id="title" placeholder="Name" name="name_ar">

            @error('name_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title"> Age </label>
            <input type="text" class="form-control required" value="{{$data->age}}" id="title" placeholder="Name"
                name="age">

            @error('age')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="links">Gender</label>
            <select class="form-control required" id="newstype" name="gender">
                <option value="">select</option>
                <option value="1" {{ $data->gender == 1 ? 'selected' : '' }}>Mail</option>
                <option value="2" {{ $data->gender == 2 ? 'selected' : '' }}>Femail</option>
            </select>

            @error('gender')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror

        <div class="form-group">
            <label for="links">Project Type</label>
            <select class="form-control required" id="country" name="project_types">
                <option value="">select</option>
                @if(!$projectyp->isEmpty())
                @foreach($projectyp as $typro)
                <option value="{{ $typro->id}}" {{ $typro->type == $data->project_types  ? 'selected' : '' }}>{{ $typro->type}}</option>
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
                @if(!$countryy->isEmpty())
                @foreach($countryy as $county)
                <option value="{{ $county->country}}" {{ $county->country == $data->country  ? 'selected' : '' }}>
                {{ $county->country }}
                </option>
                @endforeach
                @endif
            </select>
            @error('country')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="links">Status</label>
            <select class="form-control required" id="newstype" name="status">
                <option value="">select</option>
                <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>No</option>
            </select>
            @error('status')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <input type="hidden" value="{{$data->image}}" name="images">
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