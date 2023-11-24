@extends('admin.layouts.app')

@section('content')
<div class="card-body mt-0">
    <h4 class="card-title">Edit Member</h4>
    <form autocomplete="off" id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('marketer.update',$marketer->id)}}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Name</label>
            <input type="text" class="form-control required" value="{{$marketer->name}}" id="name" placeholder="Name" name="name">

            @error('name')
            <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control required" value="{{$marketer->email}}" id="email" placeholder="Name" name="email">

            @error('email')
            <label id="email-error" class="text-danger mt-2" for="email"> {{ $message }}</label>
            @enderror
        </div>
        
       <div class="form-group">
		 <label for="email">Country</label>	 
         <select name="country" id="country" class="form-control" aria-label="Default select example">
				<option value="">Country Serach</option>
				@if(!$countries->isEmpty())
				@foreach($countries as $memard)
				<option value="{{ $memard->country}}"
					{{ $marketer->country == $memard->country  ? 'selected="selected"' : '' }}>
					{{ $memard->country}}</option>
				@endforeach
				@endif
			</select>
           @error('country')
            <label id="country-error" class="text-danger mt-2" for="country"> {{ $message }}</label>
            @enderror
        </div>
        
       

        <div class="form-group">
            <label for="title">Join Date</label>
            <div id="datepicker-popups" class="input-group date datepicker">
                <input type="text" class="form-control" value="{{$marketer->join_date}}" placeholder="date" name="join_date">
                <span class="input-group-addon input-group-append border-left">
                    <span class="mdi mdi-calendar input-group-text"></span>
                </span>
            @error('join_date')
            <label id="join_date-error" class="text-danger mt-2" for="join_date"> {{ $message }}</label>
            @enderror
        </div>
         </div>
        <button type="submit" class="btn btn-success mr-2">Submit</button>
        <a href="{{ route('marketer.index') }}" class="btn btn-light required">Cancel</a>
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
        $('#datepicker-popups').datepicker({
            enableOnReadonly: true,
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    }
});
</script>

@endsection
