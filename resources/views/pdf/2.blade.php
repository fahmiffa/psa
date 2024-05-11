<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{$name}}</title>             
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

</head>

<style>
  body {         
    font-family: 'Noto Sans JP', sans-serif;
    font-size: 10px;
  }

  table {
    page-break-inside: auto;
  }

  tr {
    page-break-inside: avoid;
  }

</style>
<body>

  <center>
    <img src="{{'storage/'.$coe->user->files->ktp}}" width="25%"/>
  </center>
  <br>
  <table style="width: 100%; border-collapse:collapse; border: 1px solid black;">
    <tr>
      <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
        インドネシア国政府
      </td>
      <td style="border: 1px solid black;">
        在留カード
      </td>         
      <td style="border: 1px solid black;">
        番号: 
      </td>      
    </tr>   
    <tr>
      <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
      名前          :  {{$item[0]}}
      </td>
      <td style="border: 1px solid black;">
        {{$item[1]}}
      </td>         
      <td rowspan="8" width="50%" style="border: 1px solid black;vertical-align:top">
        <br>
        <img src="{{'storage/'.$coe->user->files->photo}}" width="25%" style="margin-left: 1rem;display:block"/>
        <br><br>
        <span style="margin-left: 1rem">{{$item[6]}}</span>
      </td>       
    </tr>   
    <tr>
      <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
        生年月日  : {{$item[0]}}
      </td>
      <td style="border: 1px solid black;">
        性別 : {{$item[1]}}
      </td>               
    </tr>   
    <tr>
      <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
        住所地 : {{$item[2]}}        
      </td>
      <td style="border: 1px solid black;">
        血液型  : {{$item[3]}}
      </td>              
    </tr>   
    <tr>
      <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
        宗教 : {{$item[4]}}
      </td>
      <td rowspan="6" style="border: 1px solid black;">        
      </td>           
    </tr>   
    <tr>
      <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
        婚姻 : {{$item[5]}}
      </td>         
    </tr>   
    <tr>
      <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
        職 : 
      </td>          
    </tr>   
    <tr>
      <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
        国箱            : インドネシア
      </td>         
    </tr>
    <tr>
      <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
        在留期間 (満了日) : 
        一生涯        
      </td>         
    </tr>   
  </table>

</body>
</html>