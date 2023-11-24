<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>email</th>
            <th>country</th>
            <th>join_date</th>
            <th class="text-center" colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!$marketer->isEmpty())
        @foreach($marketer as $new)
        <tr>
            <td>
                {{ $new->name }}
            </td>
            <td>
                {{ $new->email }}
            </td>
            <td>
                {{ $new->country }}
            </td>
            <td>
                {{ $new->join_date }}
            </td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('marketer.show',$new->id)}}" class=""><i class="bi bi-eye-fill f-21"></i></a>

                <a href="{{ route('marketer.edit',$new->id)}}" class=""><i class="bi bi-pencil-square f-21"></i></a>

                <span>
                    <form method="POST" action="{{ route('marketer.destroy',$new->id)}}">
                        @csrf
                        @method('DELETE')
                        <!-- {{ method_field('delete') }} -->
                        <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                    </form>
                </span>
            </td>
        </tr>
        @endforeach
        @else
        <td> Note : Marketers Is Empty ?.</td>
        @endif
    </tbody>
</table>
{!! $marketer->withQueryString()->links('pagination::bootstrap-5') !!}
