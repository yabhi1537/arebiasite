
    <h1>{{ $title }}</h1>
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
                      
                    </tr>
                </thead>
                <tbody>

                    @if(!$data->isEmpty())
                     @php $total=0; @endphp
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
                    </tr>
                     @php $total=number_format($total + $tran->donate_amount,2) ; @endphp
                    @endforeach
                    <tr><td></td><td></td><td></td><td><b>Total Donation</b></td><td><b>{{$total}} KD</b></td></tr>
                    @else
                    <td> Note : Transaction Is Empty ?.</td>
                    @endif
                </tbody>
            </table>
  
  
