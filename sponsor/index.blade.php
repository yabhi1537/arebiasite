@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All Sponsorship</h4>

                <a href="{{ route('sponsor.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Add Sponsor
                </a>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="namesearch" id="namesearch" class="form-select"
                                aria-label="Default select example">
                                <option value="">Name Search</option>
                                @if(!$spotyp->isEmpty())
                                @foreach($spotyp as $dat)
                                <option value="{{ $dat->name }}"
                                    {{ Request::get('namesearch') == $dat->name  ? 'selected="selected"' : '' }}>
                                    {{ $dat->name  }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="agesearch" id="agesearch" class="form-select"
                                aria-label="Default select example">
                                <option value="">Age Search</option>
                                @if(!$spotyp->isEmpty())
                                @foreach($spotyp as $dat)
                                <option value="{{ $dat->age }}"
                                    {{ Request::get('agesearch') == $dat->age  ? 'selected="selected"' : '' }}>
                                    {{ $dat->age }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="spontypsearch" id="spontypsearch" class="form-select"
                                aria-label="Default select example">
                                <option value="">Sponsor Type</option>
                                @if(!$spotyp->isEmpty())
                                @foreach($spotyp as $dat)
                                <option value="{{ $dat->type_id }}"
                                    {{ Request::get('spontypsearch') == $dat->type_id  ? 'selected="selected"' : '' }}>
                                    {{ $dat->sponsorTyp->sponser_type }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="citysearch" id="citysearch" class="form-select"
                                aria-label="Default select example">
                                <option value="">Country Search</option>
                                @if(!$spotyp->isEmpty())
                                @foreach($spotyp as $dat)
                                <option value="{{ $dat->country }}"
                                    {{ Request::get('citysearch') == $dat->country  ? 'selected="selected"' : '' }}>
                                    {{ $dat->country }}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-2 d-flex">
                            <button type="submit" class="btn btn-inverse-light btn-fw mr-2" onclick="serchajax()">Filter
                                results</button>
                            <a href="{{ route('sponsor.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>image</th>
                        <th>Name</th>
                        <th>Sponsor Type</th>
                        <th>Age</th>
                        <th>Country</th>
                        <th>Type</th>
                        <th>gender</th>
                        <!-- <th>Created_at</th> -->
                        <th>Status</th>
                        <th class="text-center" colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody id="listdata">
                    @if(!$data->isEmpty())
                    @foreach($data as $new)
                    <tr>
                        <td> <img src="{{ asset('uploads/sponsor/image/'.$new->image) }}"
                                style="height: 30px;width:30px;"></td>
                        <td>
                            {{ $new->name }}
                        </td>
                        <td>
                            {{ $new->sponsorTyp->sponser_type }}
                        </td>
                        <td>
                            {{ $new->age }}
                        </td>
                        <td>
                            {{ $new->country }}
                        </td>
                        <td>
                            {{ $new->type }}
                        </td>
                        <td>
                            @if( $new->gender == 1)
                            MaiL
                            @else
                            Femail
                            @endif
                        </td>
                        <!-- <td>
                            {{ $new->created_at }}
                        </td> -->
                        <td class="text-center">
                            @if($new->status =='0')
                            <span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
                                onclick="changeStatus('{{ $new->id }}',1)">Deactive</span>

                            @else
                            @if($new->status =='1')
                            <span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                                onclick="changeStatus('{{ $new->id }}',0 )">Active</span>
                            @endif
                            @endif

                        </td>

                        <td class="d-flex justify-content-center">
                            <a href="{{ route('sponsor.show',$new->id) }}" class="">
                                <i class="bi bi-eye-fill f-21"></i></a>

                            <a href="{{ route('sponsor.edit',$new->id) }}" class="">
                                <i class="bi bi-pencil-square f-21"></i></a>

                            <span>
                                <form method="POST" action="{{ route('sponsor.destroy',$new->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                                </form>

                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <p> Note : Sponsor Is Empty ?.</p>
                    @endif
                </tbody>
            </table>
        </div>
        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

<script type="text/javascript">
function serchajax() {
    var namesearch = $('#namesearch').val();
    var agesearch = $('#agesearch').val();
    var spontypsearch = $('#spontypsearch').val();
    var citysearch = $('#citysearch').val();

    $.ajax({

        url: "{{ route('sponsor.index') }}",
        type: 'GET',
        data: {
            'namesearch': namesearch,
            'agesearch': agesearch,
            'spontypsearch': spontypsearch,
            'citysearch': citysearch
        },
        dataType: 'html',
        success: function(data) {
            $('#listdata').html(data);
        }
    })

}

function changeStatus(id, status) {

    swal({
            title: "Are you sure?",
            text: "You want to change Status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: '{{ route("sponserStatus") }}',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);
                        window.location.reload();
                    }
                });
                swal("Status has Been changed Succesfully!", {
                    icon: "success",
                });

            }
        });

}
</script>
@endsection