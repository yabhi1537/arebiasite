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
                                <h4 class="card-title mb-0">Show Deduction Header</h4>
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
                                        @if( $data != '')

                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2"
                                                class="col-sm-5 col-form-label"><strong>image</strong>
                                            </label>
                                            <div class="col-sm-7">
                                                <img src="{{ asset('uploads/deductiontitleimage/'.$data->image) }}"
                                                    style="height: 130px;width:130px;"></td>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>
                                                    Title</strong>
                                            </label>
                                            <div class="col-sm-7">
                                                {{ $data->title}}
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2"
                                                class="col-sm-5 col-form-label"><strong>Description</strong>
                                            </label>
                                            <div class="col-sm-7">
                                                {{ $data->description}}

                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2"
                                                class="col-sm-5 col-form-label"><strong>Title (AR)</strong>
                                            </label>
                                            <div class="col-sm-7">
                                                {{ $data->title_ar}}

                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2"
                                                class="col-sm-5 col-form-label"><strong>Description (AR)</strong>
                                            </label>
                                            <div class="col-sm-7">
                                                {{ $data->description_ar}}

                                            </div>
                                        </div>


                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>
                                                    Created At</strong></label>
                                            <div class="col-sm-7">
                                                {{ date('d-m-Y', strtotime($data->created_at)) }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                                 <div class="text-center mt-3 "> <a href="{{ route('deductionshow.index') }}" class="btn btn-outline-danger w-25">Back</a></div>
                                
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
