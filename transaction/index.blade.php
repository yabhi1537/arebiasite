@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All Transaction</h4>

                <!-- <a href="" class="btn btn-primary  btn-roundedmt-5 float-right">Add
                    Sponsor Type </a> -->
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">

                    <div class="row">
                        <div class="col-md-2">
                            <select name="p_type" id="p_type" class="form-select" aria-label="Default select example">
                                <option value="">Project Type</option>
                                @if(!$alldate->isEmpty())
                                @foreach($alldate as $dat)
                                <option value="{{ $dat->p_type}}"
                                    {{ Request::get('p_type') == $dat->p_type  ? 'selected="selected"' : '' }}>
                                    {{ $dat->p_type}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="category" id="category" class="form-select"
                                aria-label="Default select example">
                                <option value="">Category Search</option>
                                @if(!$alldate->isEmpty())
                                @foreach($alldate as $dat)
                                <option value="{{ $dat->category}}"
                                    {{ Request::get('category') == $dat->category  ? 'selected="selected"' : '' }}>
                                    {{ $dat->category}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="p_name" id="p_name" class="form-select" aria-label="Default select example">
                                <option value="">Project Name</option>
                                @if(!$alldate->isEmpty())
                                @foreach($alldate as $dat)
                                <option value="{{ $dat->p_name}}"
                                    {{ Request::get('p_name') == $dat->p_name  ? 'selected="selected"' : '' }}>
                                    {{ $dat->p_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="transactionId" id="transactionId" class="form-select"
                                aria-label="Default select example">
                                <option value="">TransactionId</option>
                                @if(!$alldate->isEmpty())
                                @foreach($alldate as $dat)
                                <option value="{{ $dat->transactionId}}"
                                    {{ Request::get('transactionId') == $dat->transactionId  ? 'selected="selected"' : '' }}>
                                    {{ $dat->transactionId}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="payment_status" id="payment_status" class="form-select"
                                aria-label="Default select example">
                                <option value="">Payment Status</option>
                                @if(!$alldate->isEmpty())
                                @foreach($alldate as $dat)
                                <option value="{{ $dat->payment_status}}"
                                    {{ Request::get('payment_status') == $dat->payment_status  ? 'selected="selected"' : '' }}>
                                    {{ $dat->payment_status}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-3 mr-2">
                        <div class="col-md-2 p-1 ">
                            <button type="button" class="btn btn-inverse-light btn-fw w-100" onclick="getdata()">Filter
                                results</button>
                        </div>
                        <div class="col-md-2 p-1 ">
                            <a href="{{ route('transaction.index') }}"
                                class="btn btn-inverse-light btn-fw w-100">Clear</a>
                        </div>
                    </div>

                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>P Type</th>
                        <th>P Name</th>
                        <th>Category</th>
                        <th>P Code</th>
                        <!-- <th>p_id</th> -->
                        <!-- <th>Invoice Id</th> -->
                        <th>TransactionId</th>
                        <th>Status</th>
                        <!-- <th>Created_at</th> -->
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="projectlist">

                    @if(!$data->isEmpty())
                    @foreach($data as $tran)
                    <tr>
                        <td>
                            {{ $tran->p_type }}
                        </td>

                        <td>
                            {{ $tran->p_name }}
                        </td>
                        <td>
                            {{ $tran->category }}
                        </td>
                        <td>
                            {{ $tran->p_code }}
                        </td>
                        <!-- <td>
                            {{ $tran->p_id }}
                        </td> -->
                        <!-- <td>
                            {{ $tran->invoice_id }}
                        </td> -->
                        <td>
                            {{ $tran->transactionId }}
                        </td>
                        <td>
                            {{ $tran->payment_status }}
                        </td>
                        <!-- <td>
                            {{ $tran->created_date }}
                        </td> -->
                        <td>
                            <a href="{{ route('transaction.show',$tran->id)}}"
                                class="fa fa-eye">View</a>
                        </td>
                        <td>
                            <span>
                                <form method="POST" action="{{ route('transaction.destroy',$tran->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-outline-danger">delete</button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <p> Note : Transaction Is Empty ?.</p>
                    @endif
                </tbody>
            </table>
        </div>
        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

<script type="text/javascript"> 
function getdata() {
    var p_type = $('#p_type').val();
    var category = $('#category').val();
    var p_name = $('#p_name').val();
    var transactionId = $('#transactionId').val();
    var payment_status = $('#payment_status').val();

    $.ajax({
        url: "{{ route('transaction.index') }}",
        type: "GET",
        data: {
            'p_type': p_type,
            'category': category,
            'p_name': p_name,
            'transactionId': transactionId,
            'payment_status': payment_status
        },
        dataType: 'html',
        success: function(data) {
            $('#projectlist').html(data);
        }
    })
}
</script>
@endsection