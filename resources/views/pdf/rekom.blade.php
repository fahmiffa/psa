<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME')}}</title>
</head>
<style>
  body{
    font-size: 16px;
  }
    table {
    border-collapse: collapse;
    border-spacing: 0;
  }
  td {
    border: 1px solid black;    
    padding: 1px;
  }
</style>
<body> 
  <table style="width: 100%; border:none">
    <tr>
      <td width="10%" style="border:none;vertical-align:middle">
        <img width="100%" style="margin-left: 2rem;display:block" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/logo.jpg'))) }}"  />          
      </td>
      <td style="border:none; text-align:center">
        <p>
          <span style="font-size:20px;font-weight:bold">LPK LINTAS NEGERI</span><br>            
        Jln. Nusa Indah Raya No 57A Kel. Baler Bale Agung, Kec. Negara<br>
        Kabupaten Jembrana – Bali Telepon/Fax. (0365) 4501109<br>
        <i>email: lintas_negeri@yahoo.com, website: www.lintasnegeri.com</i><br>
        Kode Pos 82212
        </p>
      </td>     
    </tr>
  </table>             
  <div style="border-bottom: 3px solid black;width:100%;margin-bottom:0.1rem;margin-top:-0.7rem"></div>
  <div style="border-bottom: 1px solid black;width:100%"></div>
  <div style="margin: auto; display:block; width:600px; max-width:100%"> 

    <table style="width:100%; margin-top: 0.5rem">          
      <tr>
        <td width="10%" style="border:none">Nomor</td>
        <td width="1%" style="border:none;">:</td>
        <td style="border:none"> {{$item[0]}}</td>
        <td style="border:none;text-align:right;"> Negara, {{dateID(date('Y-m-d'))}}</td>     
      </tr>
      <tr>
        <td width="10%" style="border:none;vertical-align:top">Lampiran</td>
        <td width="1%" style="border:none;vertical-align:top">:</td>
        <td style="border:none;">-</td>         
      </tr>   
      <tr>
        <td width="10%" style="border:none;vertical-align:top">Perihal</td>
        <td width="1%" style="border:none;vertical-align:top">:</td>
        <td style="border:none;"> Rekomendasi Penerbitan Paspor</td>         
      </tr>                       
    </table>          

    <p style="text-align: left">
      Kepada Yth.<br>
      {{$item[1]}} <br>
      Seluruh Indonesia<br>
      di<br>
      Tempat        
    </p>
    <p style="text-align: justify">
      Sehubungan dengan akan dilaksanakannya Pemaganga ke Jepang dari LPK Lintas Negeri dengan tujuan Negara Jepang maka melalui surat ini memberikan rekomendasi kepada 
    </p>

    <table style="width:100%; margin:auto;padding:1px" align="center">          
      <tr>
        <td width="5%">&nbsp;No.</td>
        <td align="center">Nama</td>         
        <td width="25%">Tempat/Tanggal Lahir</td>              
        <td align="center">Alamat</td>         
      </tr> 
      <tr>
        <td>&nbsp;1.</td>
        <td width="15%">{{$data->fullname}}</td>          
        <td>{{$data->place_birth}}, {{date('d-m-Y',strtotime($data->date_birth))}}</td>          
        <td>{{$data->alamat}}, Kecmatan {{$data->kec}}, Provinsi {{$data->prov}}</td>          
      </tr> 
              
    </table>    
    
    <p style="text-align: justify">
      Demikian surat rekomendasi ini kami sampaikan untuk dapat dipergunakan sebagaimana mestinya.
    </p>
  
    <img width="40%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/ttd.png'))) }}"  />          
      
  </div>          
</body>
</html>