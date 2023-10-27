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
                                <h4 class="card-title mb-0">Show Achivement</h4>
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
                                         <strong> Achivement Type</strong>      </label>
                                            <div class="col-sm-7">
                                                {{ $ntyp->achivement_type}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                               <strong>Title</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $ntyp->title}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                               <strong>Description</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $ntyp->description}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label">
                                                 <strong>Created At</strong></label>
                                            <div class="col-sm-7">
                                                {{ $ntyp->created_at}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2"
                                                class="col-sm-5 col-form-label"><strong>images</strong></label>
                                            <div class="col-sm-7">
                                                <img src="{{ asset('uploads/achivement/images/'.$ntyp->images) }}"
                                                    style="height: 100px;width:135px;">
                                            </div>
                                        </div>


                                    </div><!-- tab content ends -->

                                </div>
                            </div>
                            <a href="{{ route('achivement.index') }}" class="btn btn-outline-danger">Back</a>
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