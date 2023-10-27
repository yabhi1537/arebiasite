@extends('admin.layouts.app')

@section('content') 
<div class="card-body mt-0"> 
                  <h4 class="card-title"> Add About</h4>
                  <form id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('about.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control required" id="achivement_type" placeholder="Name" name="title">
                    
                    @error('title')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="title">Description</label>
                      <input type="text" class="form-control required" id="description" placeholder="Name" name="description">
                    
                    @error('description')
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
                    <br>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{ route('about.index') }}" class="btn btn-light required">Cancel</a>
                  </form>
                </div>
                @endsection

