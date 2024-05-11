@if($xls)
    @php
      header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
       header("Content-Disposition: attachment; filename=".$par.".xls"); 
    @endphp
@endif
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding : 0.1rem;
}
</style>
</head>
<body>

<h2>Data {{ucfirst($par)}}</h2>
@if($par == 'siswa')
<table style="width:100%">
  <tr>
    <th>No</th>
    <th>Nama</th> 
    <th>Email</th>
  </tr>
  @foreach($da as $item)
    <tr>
      <td align="center">{{$loop->iteration}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->email}}</td>
    </tr>
  @endforeach
 
</table>
@endif

@if($par == 'payment')
<table style="width:100%">
  <tr>
    <th>No</th>
    <th>Siswa</th> 
    <th>Jenis</th>
    <th>Nominal</th>
  </tr>
  @foreach($da as $item)
  @php
    $paid = 0;
    $unpaid = 0;
    if($item->status == 1)
    {
        $paid += $item->payment->nominal;
    }

    if($item->status == 0)
    {
        $unpaid += $item->payment->nominal;
    }
  @endphp

    <tr>
      <td align="center">{{$loop->iteration}}</td>
      <td>{{ucfirst($item->users->name)}}</td>
      <td>{{ucfirst($item->payment->name)}}</td>   
      <td style="text-align:right;">{{number_format($item->payment->nominal,0,",",".")}}&nbsp;</td>   
    </tr>
    @endforeach
    <tr>
      <td colspan="3">Total Paid</td>
      <td style="text-align:right;">{{number_format($paid,0,",",".")}}&nbsp;</td> 
    </tr>
    <tr>
      <td colspan="3">Total Unpaid</td>
      <td style="text-align:right;">{{number_format($unpaid,0,",",".")}}&nbsp;</td> 
    </tr>
 
</table>
@endif

</body>
</html>

