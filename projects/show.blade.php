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
                                <h4 class="card-title mb-0">Show Project</h4>
                                <ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a href="" class="nav-link active" id="info-tab" data-toggle="tab" href="#info"
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
                                            <label for="exampleInputEmail2" class="col-sm-5 col-form-label"><strong>
                                                    images </strong></label>
                                            <div class="col-sm-7">
                                                <td> <img src="{{ asset('uploads/projectimage/'.$projeId->image) }}"
                                                        style="height: 100px;width:135px;">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label">
                                                <strong>Project Name </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Name (AR) </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_name_ar  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Title</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->title  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Title (AR) </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->title_ar  }}
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <label for="exampleInputEmail2"
                                                class="col-sm-5 col-form-label"><strong>Project
                                                    Type</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->ProjTyp->type  }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Category </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->ProjCat->title }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Continents</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_continents  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Country</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_country   }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Price</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_price  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Donated</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->donated  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2"
                                                class="col-sm-5 col-form-label"><strong>Target
                                                    Amount</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->target_amount  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    qnty</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->qnty  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    From
                                                    Date</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->from_date  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    To
                                                    Date</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->to_date  }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    year</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->year  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Status</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->status  }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Donationtype Status </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->donationtype_status}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Description </strong></label>
                                            <div class="col-sm-7">
                                                {!! $projeId->description!!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Main
                                                    Project </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->main_project}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Target</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projeId->target}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Featured</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->featured}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2"
                                                class="col-sm-5 col-form-label"><strong>Url</strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->short_url}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Code </strong></label>
                                            <div class="col-sm-7">
                                                {{ $projeId->project_code  }}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Description (AR)</strong></label>
                                            <div class="col-sm-7">
                                                {!! $projeId->description_ar !!}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Created Date</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $projeId->created_date}}
                                            </div>
                                        </div>
                                    </div><!-- tab content ends -->
                                </div>
                            </div>
                            <a href="{{ route('project.index') }}" class="btn btn-outline-danger">Back</a>
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