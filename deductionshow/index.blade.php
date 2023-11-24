@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">Deduction Header</h4>


            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Created_at</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="listdata">
                    @if(!$data->isEmpty())
                    @foreach($data as $new)
                    <tr>
                        <td> <img src="{{ asset('uploads/deductiontitleimage/'.$new->image) }}"
                                style="height: 30px;width:30px;"></td>
                        <td>
                            {{ $new->title }}
                        </td>
                        <td>
                            {{ $new->description }}
                        </td>

                        <td>
                            {{ date('d-m-Y', strtotime($new->created_at)) }}
                        </td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('deductionshow.show',$new->id) }}"><i class="bi bi-eye-fill f-21"></i></a>

                            <a href="{{ route('deductionshow.edit',$new->id) }}"><i
                                    class="bi bi-pencil-square f-21"></i></a>

                        </td>
                        @endforeach
                        @else
                        <td> Note : Newsreports Is Empty ?.</td>
                        @endif
                    </tr>
                </tbody>
            </table>
            {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>


<script type="text/javascript">
function getdata() {
    var namesearch = $('#namesearch').val();
    $.ajax({
        url: "{{ route('deductionshow.index') }}",
        type: 'GET',
        data: {
            'namesearch': namesearch
        },
        dataType: 'html',
        success: function(response) {
            $('#listdata').html(response);
            // location.hash = page;
        }
    });

}
</script>

@endsection