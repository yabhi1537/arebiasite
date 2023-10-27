@extends('admin.layouts.app')

@section('content') 
<div class="card-body mt-0"> 
                  <h4 class="card-title">Add Contect Details</h4>
                  <form id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('contect.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="title"> Email</label>
                      <input type="email" class="form-control required" id="title" placeholder="Name" name="email">
                    
                    @error('email')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="links">Phone</label>
                      <input type="text" class="form-control required" id="title" placeholder="Name" name="phone">
                    @error('phone')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                      </div>
                      <div class="form-group">
                      <label for="links">Address</label>
                      <input type="text" class="form-control required" id="title" placeholder="Name" name="address">
                    @error('address')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                      </div>
                      <div class="form-group">
                      <label for="links">City</label>
                      <input type="text" class="form-control required" id="title" placeholder="Name" name="city">
                    @error('city')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                      </div>
                      <div class="form-group">
                      <label for="links">Country</label>
                      <input type="text" class="form-control required" id="title" placeholder="Name" name="country">
                    @error('country')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                      </div>
                      <div class="form-group">
                      <label for="links">Address (AR)</label>
                      <input type="text" class="form-control required" id="address_ar" placeholder="Name" name="address_ar">
                    @error('address_ar')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                      </div>
                      <div class="form-group">
                      <label for="links">City (AR)</label>
                      <input type="text" class="form-control required" id="city_ar" placeholder="Name" name="city_ar">
                    @error('city_ar')
                      <label id="title-error" class="text-danger mt-2" for="city_ar"> {{ $message }}</label>
                    @enderror
                      </div>
                      <div class="form-group">
                      <label for="links">Country (AR)</label>
                      <input type="text" class="form-control required" id="country_ar" placeholder="Name" name="country_ar">
                    @error('country_ar')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                      </div>
                      <div class="form-group">
                      <label for="links">Pincode</label>
                      <input type="text" class="form-control required" id="title" placeholder="Name" name="pincode">
                    @error('pincode')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                      </div>
                      <div class="form-group">
                        <label>Logo</label>
                        <input type="file" name="logo" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    @error('logo')
                    <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                      <br/><br/>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{ route('contect.index') }}" class="btn btn-outline-danger">Cancel</a>
                  </form>
                </div>
                @endsection
 
