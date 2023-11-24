<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
             <th>Title (AR)</th>
            <th>Country</th>
             <th>Country (AR)</th>
            <th class="text-center" colspan="">Action</th>
        </tr>
    </thead>
    <tbody id="projectlist">
        @if(!$country->isEmpty())
        @foreach($country as $new)
        <tr>

            <td>
                {{ $new->title }}
            </td>
            <td>
                {{ $new->title_ar }}
            </td>
            <td>
                {{ $new->country }}
            </td>
             <td>
                {{ $new->country_ar }}
            </td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('country.show',$new->id)}}" class=""><i class="bi bi-eye-fill f-21"></i></a>
            
                <a href="{{ route('country.edit',$new->id)}}" ><i class="bi bi-pencil-square f-21"></i></a>
            
                <span>
                    <form method="POST" action="{{ route('country.destroy',$new->id)}}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-trash"><i class="bi bi-trash f-21"></i></button>
                    </form>
                </span>
            </td>
            @endforeach
            @else
            <td> Note : Country Is Empty ?.</td> 
            @endif
        </tr>

    </tbody>
</table>

{!! $country->withQueryString()->links('pagination::bootstrap-5') !!}
