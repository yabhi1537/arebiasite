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
                                <h4 class="card-title mb-0">Show Project Request</h4>
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
                                        @if($projectrequest->projectimage)
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>
                                                    Project Image</strong></label>
                                            <div class="col-sm-7">
                                                <img src="{{ asset('uploads/project_request/'.$projectrequest->projectimage) }}"
                                                    style="height: 100px;width:135px;">
                                            </div>
                                        </div>
                                        @else
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>
                                                    Project Image</strong></label>
                                            <div class="col-sm-7">
                                                Empty Image
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if($projectrequest->segnatureimage)
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2"
                                                class="col-sm-5 col-form-label"><strong>
                                                    Segnature Image</strong></label>
                                            <div class="col-sm-7">
                                                <img src="{{ asset('storage/'.$projectrequest->segnatureimage) }}"
                                                    style="height: 100px;width:135px;">
                                            </div>
                                        </div>
                                        @else
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2"
                                                class="col-sm-5 col-form-label"><strong>
                                                    Segnature Image</strong></label>
                                            <div class="col-sm-7">
                                            Empty Image
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Donor Name</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projectrequest->donor_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Project Name</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projectrequest->project_name}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Phone Number</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projectrequest->phone_number}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Project Id</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projectrequest->project_id}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Id Number</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projectrequest->id_number}}
                                            </div>
                                        </div>


                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong> From Amount </strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projectrequest->from_amount }}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>To Amount</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projectrequest->to_amount}}
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Notes</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projectrequest->notes}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                <strong>Created</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projectrequest->created_date}}
                                            </div>
                                        </div>
                                    </div><!-- tab content ends -->
                                </div>
                            </div>
                            <a href="{{ route('projectrequest.index') }}" class="btn btn-outline-danger">Back</a>
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