@extends('admin.layouts.app')

@section('content')



<!-- partial -->

<div class="row user-profile">
    <div class="col-lg-4 side-left d-flex align-items-stretch">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body avatar">
                        <h4 class="card-title">Info</h4>
                        <img src="{{ asset('uploads/admin/profile/'.$adminId->profile) }}" alt="">
                        <p class="name">{{$adminId->full_name}}</p>

                        <a class="d-block text-center text-dark" href="#">{{$adminId->email}}</a>
                        <a class="d-block text-center text-dark" href="#">{{$adminId->phone}}</a>
                    </div>
                </div>
            </div>
            <div class="col-12 stretch-card">
                <div class="card">
                    <div class="card-body overview">
                        <ul class="achivements">
                            <li>
                                <p>34</p>
                                <p>Projects</p>
                            </li>
                            <li>
                                <p>23</p>
                                <p>Task</p>
                            </li>
                            <li>
                                <p>29</p>
                                <p>Completed</p>
                            </li>
                        </ul>
                        <div class="wrapper about-user">
                            <h4 class="card-title mt-4 mb-3">About</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veniam consectetur ex quod.</p>
                        </div>
                        <div class="info-links">
                            <a class="website" href="http://bootstrapdash.com/">
                                <i class="mdi mdi-earth text-gray"></i>
                                <span>http://bootstrapdash.com/</span>
                            </a>
                            <a class="social-link" href="#">
                                <i class="mdi mdi-facebook text-gray"></i>
                                <span>https://www.facebook.com/johndoe</span>
                            </a>
                            <a class="social-link" href="#">
                                <i class="mdi mdi-linkedin text-gray"></i>
                                <span>https://www.linkedin.com/johndoe</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 side-right stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">Details</h4>
                    <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab"
                                aria-controls="info" aria-expanded="true">Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="avatar-tab" data-toggle="tab" href="#avatar" role="tab"
                                aria-controls="avatar">Avatar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab"
                                aria-controls="security">Security</a>
                        </li>
                    </ul>
                </div>
                <div class="wrapper">
                    <hr>
                    <div class="tab-content" id="myTabContent">
                        @if(Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                        @endif
                        <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info">
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                <div class="form-group">
                                    @csrf
                                    <!-- @method('PATCH') -->
                                    <input type="hidden" value="{{$adminId->adminuser_id}}" name="admiId">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="full_name"
                                        value="{{$adminId->full_name}}" name="full_name" placeholder="Change user name">
                                    @error('full_name')
                                    <label id="title-error" class="alert alert-danger" for="title">
                                        {{ $message }}</label>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" value="{{$adminId->email}}" id="email"
                                        name="email" placeholder="Change email address">
                                </div>
                                @error('email')
                                <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                                @enderror
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobile" value="{{$adminId->phone}}"
                                        name="phone" placeholder="Change mobile number">
                                </div>
                                @error('phone')
                                <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                                @enderror
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" rows="6" name="address" class="form-control"
                                        placeholder="Change address">{{$adminId->address}}</textarea>
                                </div>
                                @error('address')
                                <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                                @enderror
                                <div class="form-group">
                                    <label for="website">Website URL</label>
                                    <input type="text" class="form-control" value="{{$adminId->link}}" name="link"
                                        id="website" placeholder="Change website url">
                                </div>
                                @error('link')
                                <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                                @enderror
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-success mr-2">Update</button>
                                    <a href="{{ route('profile.index') }}" class="btn btn-outline-danger">Cancel</a>
                                </div>
                            </form>
                        </div><!-- tab content ends -->
                        <div class="tab-pane fade" id="avatar" role="tabpanel" aria-labelledby="avatar-tab">
                            <div class="wrapper mb-5 mt-4">
                                <span class="badge badge-warning text-white">Note : </span>
                                <p class="d-inline ml-3 text-muted">Image size is limited to not greater than 1MB .</p>
                            </div>
                            <form method="POST" action="{{ route('profile.imgupdate') }}" enctype="multipart/form-data">
                                @csrf
                                <!-- @method('PATCH') -->
                                <input type="hidden" value="{{$adminId->adminuser_id}}" name="adminId">
                                <input type="hidden" value="{{$adminId->profile}}" name="images">
                                <input type="file" class="dropify" name="profile" />
                                @error('profile')
                                <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                                @enderror
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-success mr-2">Update</button>
                                    <a href="{{ route('profile.index') }}" class="btn btn-outline-danger">Cancel</a>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                            <form action="{{ route('profile.passupdate') }}" method="POST">
                                <div class="form-group">
                                    @csrf
                                    <label for="change-password">Change password</label>
                                    <input type="hidden" value="{{$adminId->adminuser_id}}" name="admiId">
                                    <input type="password" value="" class="form-control" name="old_password"
                                        id="change-password" placeholder="Enter you current password">
                                </div>
                                @error('old_password')
                                <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                                @enderror
                                <div class="form-group">
                                    <input type="password" class="form-control" name="new_password" id="new-password"
                                        placeholder="Enter you new password">
                                </div>
                                @error('new_password')
                                <label id="title-error" class="text-danger mt-2" for="title"> {{ $message }}</label>
                                @enderror
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-success mr-2">Update</button>
                                    <a href="{{ route('profile.index') }}" class="btn btn-outline-danger">Cancel</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>