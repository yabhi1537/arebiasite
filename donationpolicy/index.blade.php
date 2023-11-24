@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">Donation Policy</h4>

                <!-- <a href="{{ route('donationpolicy.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Create donationpolicy
                </a> -->
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th class="text-center" colspan="">Action</th>
                    </tr>
                </thead>
                <tbody id="listdata">
                    @if(!$donationpolicy->isEmpty())
                    @foreach($donationpolicy as $new)
                    <tr>
                        <td>
                            {{ $new->title }}
                        </td>
                        <td>
                            {!! $new->description !!}
                        </td>

                        <td>
                            {{ date('d-m-Y', strtotime($new->created_at)) }}
                        </td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('donationpolicy.show',$new->id) }}"><i
                                    class="bi bi-eye-fill f-21"></i></a>

                            <a href="{{ route('donationpolicy.edit',$new->id) }}"><i
                                    class="bi bi-pencil-square f-21"></i></a>
                            <!-- <span>
                                <form method="POST" action="{{ route('donationpolicy.destroy',$new->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                                </form>
                            </span> -->
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <td> Note : Donation Policy Is Empty ?.</td>
                    @endif
                </tbody>
            </table>
        </div>
        {!! $donationpolicy->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
<script type="text/javascript">

</script>

@endsection