@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">All Projects Request</h4>
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="fillterDrpdown">
                <div class="">
                    <div class="row">
                        <div class="col-md-2">
                            <select name="donor_name" id="donor_name" class="form-select" aria-label="Default s
                                elect example">
                                <option value="">Donor Name</option>
                                @if(!$projectrequest->isEmpty())
                                @foreach($projectrequest as $reqest)
                                <option value="{{ $reqest->donor_name}}"
                                    {{ Request::get('donor_name') == $reqest->donor_name  ? 'selected="selected"' : '' }}>
                                    {{ $reqest->donor_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="project_name" id="project_name" class="form-select" aria-label="Default s
                                elect example">
                                <option value="">Project Name</option>
                                @if(!$projectrequest->isEmpty())
                                @foreach($projectrequest as $reqest)
                                <option value="{{ $reqest->project_name}}"
                                    {{ Request::get('project_name') == $reqest->project_name  ? 'selected="selected"' : '' }}>
                                    {{ $reqest->project_name}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="phone_number" id="phone_number" class="form-select" aria-label="Default s
                                elect example">
                                <option value="">Phone Number</option>
                                @if(!$projectrequest->isEmpty())
                                @foreach($projectrequest as $reqest)
                                <option value="{{ $reqest->phone_number}}"
                                    {{ Request::get('phone_number') == $reqest->phone_number  ? 'selected="selected"' : '' }}>
                                    {{ $reqest->phone_number}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2 d-flex">
                            <button type="button" class="btn btn-inverse-light btn-fw mr-2"
                                onclick="getserdata()">Filter
                                results</button>

                            <a href="{{ route('projectrequest.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Donor Name</th>
                        <th>Project Name</th>
                        <th>Phone Number</th>
                        <th>To Amount</th>
                        <th>From Amount</th>
                        <th class="text-center" >Action</th>
                    </tr>
                </thead>
                <tbody id="projectlist">
                    @if(!$projectrequest->isEmpty())
                    @foreach($projectrequest as $new)
                    <tr>
                        <td>
                            {{ $new->donor_name }}
                        </td>

                        <td>
                            {{ $new->project_name }}
                        </td>
                        <td>
                            {{ $new->phone_number }}
                        </td>
                        <td>
                            {{ $new->to_amount }}
                        </td>
                        <td>
                            {{ $new->from_amount }}
                        </td>


                        <td class="d-flex justify-content-center">

                            <a href="{{ route('projectrequest.show',$new->request_id)}}" class=""><i
                                    class="bi bi-eye-fill f-21"></i></a>
                            <span>
                                <form method="POST" action="{{ route('projectrequest.destroy',$new->request_id)}}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p> Note : projectrequest Is Empty ?.</p>
            @endif
        </div>
        {!! $projectrequest->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

<script type="text/javascript">
function getserdata() {

    var donor_name = $('#donor_name').val();
    var project_name = $('#project_name').val();
    var phone_number = $('#phone_number').val();
    $.ajax({
        url: "{{ route('projectrequest.index') }}",
        type: "GET",
        data: {
            'donor_name': donor_name,
            'project_name': project_name,
            'phone_number': phone_number,

        },
        dataType: 'html',
        success: function(data) {
            $('#projectlist').html(data);
        }
    })
}
</script>
@endsection