<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Report PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
body{
  font-family: DejaVu Sans, sans-serif;
}
</style>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
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
  
  
</body>
</html>
