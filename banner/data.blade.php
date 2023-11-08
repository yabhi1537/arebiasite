<table class="table table-bordered db">
    <thead>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <!-- <th>Links</th> -->
            <th>Description</th>
            <th>Status</th>
            <!-- <th>Created_at</th> -->
            <th class="text-center" colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!$banner->isEmpty())
        @foreach($banner as $new)
        <tr id="geeks_{{$new->id}}">
            <td> <img src="{{ asset('uploads/BannerImg/'.$new->bannerImg) }}" style="height: 30px;width:30px;"></td>
            <td>
                {{ $new->title }}
            </td>
            <td>
                {{ $new->description }}
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
                <a href="{{ route('banner.show', $new->id) }}" class=""><i class="bi bi-eye-fill f-21"></i></a>

                <a href="{{ route('banner.edit', $new->id) }}" class=""><i class="bi bi-pencil-square f-21"></i></a>

                <span>
                    <form method="POST" action="{{ route('banner.destroy', $new->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                    </form>
                </span>
            </td>
        </tr>
        @endforeach
        @else
        <p> Note : Banner Is Empty ?.</p>
        @endif
    </tbody>
</table>