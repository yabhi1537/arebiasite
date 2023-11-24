@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title">Edit Country</h4>
    <form autocomplete="off" id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('country.update',$country->id)}}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
         <div class="form-group">
            <label for="email">Country Title</label>
            <input type="text" value="{{ $country->title}}" class="form-control required" id="title" placeholder="Name" name="title">

            @error('title')
            <label id="	title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Country Title (AR)	</label>
            <input type="text" value="{{ $country->title_ar}}" class="form-control required" id="title_ar" placeholder="Name" name="title_ar">

            @error('title_ar')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
       
        <div class="form-group">
            <label for="title">Country</label>
            <input type="text" value="{{ $country->country}}" class="form-control required" id="country" placeholder="Name" name="country">

            @error('country')
            <label id="country-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Country (AR)</label>
            <input type="text" value="{{ $country->country_ar}}" class="form-control required" id="country_ar" placeholder="Name" name="country_ar">

            @error('country_ar')
            <label id="	country_ar-error" class="text-danger mt-2" for="country_ar"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Short Name</label>
            <input type="text" value="{{ $country->short_name}}" class="form-control required" id="short_name" placeholder="Name" name="short_name">

            @error('short_name')
            <label id="	short_name-error" class="text-danger mt-2" for="short_name"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="title">Latitude</label>
            <input type="text" value="{{ $country->latitude}}" class="form-control required" id="latitude" placeholder="Name" name="latitude">

            @error('latitude')
            <label id="latitude-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Longitude</label>
            <input type="text" value="{{ $country->longitude}}" class="form-control required" id="longitude" placeholder="Name" name="longitude">

            @error('longitude')
            <label id="	longitude-error" class="text-danger mt-2" for="longitude"> {{ $message }}</label>
            @enderror
        </div>
        <button type="submit" class="btn btn-success mr-2">Submit</button>
        <a href="{{ route('country.index') }}" class="btn btn-light required">Cancel</a>
    </form>
</div>

@endsection
