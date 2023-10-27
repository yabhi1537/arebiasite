@extends('admin.layouts.app')

@section('content') 
<div class="card-body mt-0"> 
                  <h4 class="card-title text-center">Update About</h4>

                  <h5><strong>Header Section</strong></h5>
                  <form id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('about.update',$abotEdit->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control required" value="{{$abotEdit->title}}" id="achivement_type" placeholder="Name" name="title">
                    
                    @error('title')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="title">Description</label>
                      <input type="text" class="form-control required" value="{{$abotEdit->description}}" id="description" placeholder="Name" name="description">
                    
                    @error('description')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                    </div>
                    <input type="hidden" value="{{$abotEdit->image}}" name="images">
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

                    <h5><strong>Vision & Mission</strong></h5>
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control required" value="{{$abotEdit->titles}}" id="achivement_type" placeholder="Name" name="titles">
                    
                    @error('titles')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="vision">Vision</label>
                      <input type="text" class="form-control required" value="{{$abotEdit->vision}}" id="vision" placeholder="Name" name="vision">
                    
                    @error('vision')
                      <label id="vision-error" class="text-danger mt-2" for="vision"> {{ $message }}</label>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="mission">Mission</label>
                      <input type="text" class="form-control required" value="{{$abotEdit->mission}}" id="achivement_type" placeholder="Name" name="mission">
                    
                    @error('mission')
                      <label id="mission-error" class="text-danger mt-2" for="mission"> {{ $message }}</label>
                    @enderror
                    </div>
                    <input type="hidden" value="{{$abotEdit->photo}}" name="photos">
                    <div class="form-group">
                      <label>Photo</label>
                      <input type="file" name="photo" class="file-upload-default">
                      <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload photo">
                          <span class="input-group-append">
                              <button class="file-upload-browse btn btn-info" type="button">Upload</button>
                          </span>
                      </div>
                  </div>
                    @error('photo')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                    <br>
                    <h5><strong>Objective</strong></h5>
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control required" value="{{$abotEdit->obj_title}}" id="achivement_type" placeholder="Name" name="obj_title">
                    
                    @error('obj_title')
                      <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                    @enderror
                    </div>
                    <div class="form-group">
                      <label for="vision">Description</label>
                      <input type="text" class="form-control required" value="{{$abotEdit->obj_description}}" id="obj_description" placeholder="Name" name="obj_description">
                    
                    @error('obj_description')
                      <label id="vision-error" class="text-danger mt-2" for="vision"> {{ $message }}</label>
                    @enderror
                    </div>
                <br/>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <a href="{{ route('about.index') }}" class="btn btn-light required">Cancel</a>
                  </form>
                </div>
                @endsection

