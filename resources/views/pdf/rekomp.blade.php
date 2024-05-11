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
        <td style="border:none;text-align:right;"> Negara, {{dateID($item[1])}}</td>     
      </tr>
      <tr>
        <td width="10%" style="border:none;vertical-align:top">Lampiran</td>
        <td width="1%" style="border:none;vertical-align:top">:</td>
        <td style="border:none;">1 (satu) Gabung</td>         
      </tr>   
      <tr>
        <td width="10%" style="border:none;vertical-align:top">Perihal</td>
        <td width="1%" style="border:none;vertical-align:top">:</td>
        <td style="border:none;"> Permohonan Rekomendasi<br>Pemberangkatan</td>         
      </tr>                       
    </table>          

    <p style="text-align: left">
      Kepada Yth.<br>
      Direktur Jenderal Pembinaan Pelatihan  <br>
      Vokasi dan Produktivitas Kemnaker RI<br>
      Up. Direktur Bina Pelatihan Vokasi<br>
      dan Pemagangan<br>
      di<br>
      Jakarta        
    </p>
    <p style="text-align: justify">
      <span style="margin-left: 1.5rem">&nbsp;</span> Dalam upaya untuk meningkatkan kualitas Sumber Daya Manusia melalui kemitraan global dan sesuai dengan peraturan tentang pemagangan maka Bersama ini kami mengajukan permohonan rekomendasi pemagangan/trainee ke Jepang untuk siswa LPK Lintas Negeri. Siswa tersebut telah mengikuti proses seleksi pemagangan oleh LPK Lintas Negeri dan mitra kerja di Jepang. Adapun nama siswa yang kami mohonkan rekomendasinya sebagai berikut :
    </p>

    <table style="width:100%; margin:auto;padding:1px" align="center">          
      <tr>
        <td width="5%">&nbsp;No.</td>
        <td align="center">Nama</td>                              
        <td width="24%" align="center">Alamat</td>     
        <td align="center">Nama Perusahaan <br>Penerima</td>    
        <td align="center">Alamat <br>Perusahaan</td>    
        <td align="center">Jenis <br>Pekerjaan</td>
      </tr> 
      <tr>
        <td>&nbsp;1.</td>
        <td>{{$data->fullname}}</td>                       
        <td>{{$data->alamat}}<br> Kecmatan {{$data->kec}} <br>Provinsi {{$data->prov}}</td> 
        <td>{{$apply->job->perusahaan->name}}</td>         
        <td>{{$apply->job->perusahaan->addr}}</td>  
        <td>{{$apply->job->section}}</td>         
      </tr> 
              
    </table>    
    
    <p style="text-align: justify">
      Demikian surat rekomendasi ini kami sampaikan untuk dapat dipergunakan sebagaimana mestinya.
    </p>
  
    <img style="float: right" width="30%" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/ttd.png'))) }}"  />          
      
    <br><br><br><br><br>
    <p>Tembusan disampaikan kepada Yth.</p>
    <ol>
      <li>Kepala Dinas Penanaman Modal, Pelayanan Terpadu Satu Pintu dan 
        Tenaga Kerja Kab. Jembrana;
      </li>        
      <li>Arsip</li>      
    </ol>
  </div>          
</body>
</html>