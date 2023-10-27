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
                                <h4 class="card-title mb-0">Show Countries</h4>
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
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Country Title (AR)</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $country->title_ar}}
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Country Title</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $country->title}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Country (AR)</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $country->country_ar}}
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Country</strong> </label>
                                            <div class="col-sm-7">
                                                <strong></strong> {{ $country->country}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Country latitude</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $country->latitude}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Country longitude</strong> </label>
                                            <div class="col-sm-7">
                                                <strong></strong> {{ $country->longitude}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Country Short Name</strong> </label>
                                            <div class="col-sm-7">
                                                <strong></strong> {{ $country->short_name}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Status</strong> </label>
                                            <div class="col-sm-7">
                                                @if($country->status == 1)
                                                Active
                                                @elseif($country->status == 0)
                                                Deactive
                                                @endif
                                            </div>
                                        </div>
                                    </div><!-- tab content ends -->

                                </div>
                            </div>
                            <a href="{{ route('country.index') }}" class="btn btn-outline-danger">Back</a>
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