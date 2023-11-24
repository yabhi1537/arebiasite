<table class="table table-bordered">
                <thead>
                    <tr>

                        <th>Image</th>
                        <th>Name </th>
                        <th>Type</th> 
                        <th>Category</th>
                        <th>Continents</th>
                        <th>Country</th>
                        <!-- <th>Price</th> -->
                        <th>Publish Status</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$project->isEmpty())
                    @foreach($project as $new)
                    <tr>
                        <td> <img src="{{ asset('uploads/projectimage/'.$new->image) }}"
                                style="height: 30px;width:30px;"></td>

                        <td>{{ $new->project_name }}</td>
                        <td>{{ $new->ProjTyp->type }}</td>
                        <td>{{ $new->ProjCat->title  }}</td>
                        <td>{{ $new->project_continents }}</td>
                        <td>{{ $new->project_country }}</td>
                        <!-- <td>{{ $new->project_price }}</td> -->

                        <td class="text-center">
                            @if($new->publish_status =='2')
                            <span id="bookForms" class="btn btn-info btn-rounded btn-sm"
                                onclick="ProPublisStatus('{{ $new->project_id }}',1)">Public</span>
                            @else
                            @if($new->publish_status =='1')
                            <span id="bookForms" class="btn btn-primary btn-rounded btn-sm"
                                onclick="ProPublisStatus('{{ $new->project_id }}',2 )">Private</span>
                            @endif
                            @endif
                        </td>

                        <td class="text-center">
                            @if($new->donationtype_status =='0')
                            <span id="bookForm" class="btn btn-danger btn-rounded btn-sm"
                                onclick="changeStatus('{{ $new->project_id }}',1)">Deactive</span>

                            @else
                            @if($new->donationtype_status =='1')
                            <span id="bookForm" class="btn btn-success btn-rounded btn-sm"
                                onclick="changeStatus('{{ $new->project_id }}',0 )">Active</span>
                            @endif
                            @endif
                        </td>
                     
                        <td class="d-flex justify-content-center">

                            <a href="{{ route('project.show',$new->project_id) }}" class=""><i
                                    class="bi bi-eye-fill f-21"></i></a>

                            <a href="{{ route('project.edit',$new->project_id) }}" class="">
                                <i class="bi bi-pencil-square f-21"></i></a>

                            <span>
                                <form method="POST" action="{{ route('project.destroy',$new->project_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <td> Note : Projects Is Empty ?.</td>
                    @endif
                </tbody>
            </table> 
            {!! $project->withQueryString()->links('pagination::bootstrap-5') !!}
