<table class="table table-bordered">
                <thead>
                    <tr>
                        <th>P Type</th>
                        <th>P Name</th>
                        <th>Category</th>                     
                        <th>TransactionId</th>
                        <th>Donation</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

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
                            {{ $tran->transactionId }}
                        </td>
                         <td>
                            {{ number_format($tran->donate_amount,2) }} KD
                        </td>
                        <td>
                            {{ $tran->payment_status }}
                        </td>
                        <td>
                            {{ date('d-m-Y H:i:s', strtotime($tran->created_date)) }}
                        </td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('transaction.show',$tran->id)}}" class=""><i
                                    class="bi bi-eye-fill f-21"></i></a>

                            <span>
                                <form method="POST" action="{{ route('transaction.destroy',$tran->id) }}">
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
                    <td> Note : Transaction Is Empty ?.</td>
                    @endif
                </tbody>
            </table>
        {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
