@extends('admin.layouts.app')

@section('content')

<style type="text/css">
.container {
    width: 350px;
    height: 650px;
    background-color: white;

    border: 1px solid grey;
    border-radius: 50px;
    overflow: scroll;
}

.container::-webkit-scrollbar {
    display: none;
}

.setfont {
    font-size: 12px;
    text-align: center;
}

.aligntext {
    font-size: 10px;
    text-align: center;
}
</style>
<!-- partial -->


<div class="row user-profile">
    <div class="col-lg-12 side-left  align-items-stretch">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">

                    <div class="card">
                        <div class="card-body">
                            <div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
                                <h4 class="card-title mb-0">Show News Type</h4>
                                <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info"
                                            role="tab" aria-controls="info" aria-expanded="true">Info</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="wrapper">
                                <hr>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="info" role="tabpanel"
                                        aria-labelledby="info">

                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>Email</strong> 
                                            </label>
                                            <div class="col-sm-7">
                                                {{ $data->email}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                              <strong>Phone</strong>  </label>
                                            <div class="col-sm-7">
                                                {{ $data->phone}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                             <strong>Address</strong>   </label>
                                            <div class="col-sm-7">
                                                {{ $data->address}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>City</strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->city}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>
                                                Country</strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->country}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>
                                                Pincode</strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->	pincode}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>
                                                Created At</strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->	created_at}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>
                                                Updated At</strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->	updated_at}}
                                            </div>
                                        </div>



                                    </div><!-- tab content ends -->

                                </div>
                            </div>
                            <a href="{{ route('contect.index') }}" class="btn btn-outline-danger">Back</a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ==================================================mobail======================================== -->

</div>
</div>


@endsection