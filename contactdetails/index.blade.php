@extends('admin.layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="card-title mb-0">Manage Domain</h4>
                <!-- <a href="{{ route('contect.create') }}" class="btn btn-primary  btn-roundedmt-5 float-right">Add -->
                    <!-- Conteact </a> -->
            </div>
            @if(Session::has('message'))
            <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <!-- <div class="fillterDrpdown">
                <div class="">
                    <form action="{{ route('contect.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-2">
                                <select name="email" class="form-select" aria-label="Default select example">
                                    <option value="">Email Search</option>
                                    @if(!$Alldata->isEmpty())
                                    @foreach($Alldata as $link)
                                    <option value="{{ $link->email}}"
                                        {{ Request::get('email') == $link->email  ? 'selected="selected"' : '' }}>
                                        {{ $link->email}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="phone" class="form-select" aria-label="Default select example">
                                    <option value="">Phone Search</option>
                                    @if(!$Alldata->isEmpty())
                                    @foreach($Alldata as $link)
                                    <option value="{{ $link->phone}}"
                                        {{ Request::get('phone') == $link->phone  ? 'selected="selected"' : '' }}>
                                        {{ $link->phone}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="city" class="form-select" aria-label="Default select example">
                                    <option value="">City Search</option>
                                    @if(!$Alldata->isEmpty())
                                    @foreach($Alldata as $link)
                                    <option value="{{ $link->city}}"
                                        {{ Request::get('city') == $link->city  ? 'selected="selected"' : '' }}>
                                        {{ $link->city}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="country" class="form-select" aria-label="Default select example">
                                    <option value="">Country Search</option>
                                    @if(!$Alldata->isEmpty())
                                    @foreach($Alldata as $link)
                                    <option value="{{ $link->country}}"
                                        {{ Request::get('country') == $link->country  ? 'selected="selected"' : '' }}>
                                        {{ $link->country}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2 d-flex">
                                <button type="submit" class="btn btn-inverse-light btn-fw mr-2">Filter results</button>
                                <a href="{{ route('contect.index') }}" class="btn btn-inverse-light btn-fw">Clear</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th class="text-center" colspan="3">Action</th>
                    </tr>
                </thead>
                <tbody>
                   @if(!$data->isEmpty())
                    @foreach($data as $new)
                    <tr>
                    <td> <img src="{{ asset('uploads/contact/logo/'.$new->logo) }}"
                                style="height: 30px;width:30px;"></td>
                        <td>
                            {{ $new->email }}
                        </td>
                        <td>
                            {{ $new->phone }}
                        </td>
                        <td>
                            {{ $new->address }}
                        </td>
                        <td>
                            {{ $new->country }}
                        </td>
                        <td>
                            {{ $new->city }}
                        </td>
                        <td>
                            {{ $new->pincode }}
                        </td>
                        <td>
                            <a href="{{ route('contect.show', $new->id) }}"
                                class="fa fa-eye">View</a>
                        </td>
                        <td>
                            <a href="{{ route('contect.edit',$new->id) }}"
                                class="fa fa-edit">Edit</a>
                        </td>
                        <td>
                            <span>
                                <form method="POST" action="{{ route('contect.destroy',$new->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    {{ method_field('delete') }}
                                    <button type="submit" class="btn btn-outline-danger  ">delete</button>
                                </form>
                            </span>
                        </td>

                    </tr>
                    @endforeach
                   
                    @else
                  <p> Note : Conteacts Is Empty ?.</p>
                   @endif
                </tbody>
            </table>
        </div>
        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
@endsection