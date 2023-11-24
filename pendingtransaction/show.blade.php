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
                                <h4 class="card-title mb-0">Show Pending Transactions</h4>
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
                                        @if($data !='')
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Type </strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->p_type }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Category </strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->category }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Name </strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->p_name }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Code </strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->p_code }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Id</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $data->p_id }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Invoice Id</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $data->invoice_id }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project Transaction Id</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $data->transactionId }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project RefId </strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->refId }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Pay Type </strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->pay_type }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Donate Amount </strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->donate_amount }} kD
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Project qtyval </strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->qtyval }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Payment Status</strong> </label>
                                            <div class="col-sm-7">
                                                {{ $data->payment_status }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Payment Id</strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->paymentId }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Vat Amount</strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->VatAmount }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Transaction Status</strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->transactionStatus }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Total Service Charge</strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->TotalServiceCharge }}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputPassword2" class="col-sm-5 col-form-label"><strong>
                                                    Created Date </strong></label>
                                            <div class="col-sm-7">
                                                {{ $data->created_date }}
                                            </div>
                                        </div>
                                        @endif
                                    </div><!-- tab content ends -->
                                </div>
                            </div>
                            <div class="text-center mt-3 "> <a href="{{ route('pendingtransaction') }}" class="btn btn-outline-danger w-25">Back</a></div>
                            
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
