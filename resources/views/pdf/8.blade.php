<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$name}}</title>             
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

</head>

<style>
  body {         
    font-family: 'Noto Sans JP', sans-serif;
    font-size: 14px;
  }

  table {
    page-break-inside: auto;
  }

  tr {
    page-break-inside: avoid;
  }

  .page-break {
    page-break-after: always;
}

</style>
<body>

<table border="0" cellspacing="0" cellpadding="5" style="width: 100%">
    <tr>
        <td colspan="6" style="text-align: left;font-size:12px">
            参考様式第１-21号（規則第８条第19号関係）
            <br>
            Rujukan Formulir 1-21 (Berhubungan dengan Peraturan Pasal 8 Nomor 19)
            <br>      
            Ｄ・Ｅ・Ｆ
        </td>
        <td style="vertical-align: top;font-size:12px">
            （日本産業規格Ａ列４
            <br>
            (Standar Industri Jepang ukuran A4)
        </td>
    </tr>
    
    <tr>
        <td colspan="7" style="text-align: center">
            技能実習の準備に関し本国で支払った費用の明細書<br>
            Perincian Biaya untuk Persiapan Pemberangkatan Pemagangan Teknis ke Jepang           
        </td>
    </tr>
</table>
<p>１　送出の概要<br>Ringkasan pengiriman pemagangan teknis</p>
<table style="width: 100%; border-collapse:collapse; border: 1px solid black;">    
    <tr>       
        <td rowspan="2" width="3%" style="border: 1px solid black;">    
            1 技能実習生の氏名<br>Nama peserta pemagangan teknis
        </td>    
        <td style="border: 1px solid black;">   
            ローマ字<br>Huruf Romaw
        </td>        
        <td colspan="12" style="border: 1px solid black;">   
            {{$item[0]}}
        </td>                      
    </tr>  
    <tr>           
        <td style="border: 1px solid black;">   
            漢字<br>Kanji
        </td>        
        <td colspan="12" style="border: 1px solid black;">   
            {{$item[1]}}
        </td>                      
    </tr>  
    <tr>       
        <td rowspan="2" style="border: 1px solid black;">    
            2 取次送出機関の氏名又は名称
            （送出機関番号又は整理番号を記載すること。）
            <br>Nama atau nama sebutan lembaga pengirim
            
        </td>    
        <td colspan="13" style="border: 1px solid black;">   
            LPK LINTAS NEGERI
        </td>                                 
    </tr> 
    <tr>           
        <td style="border: 1px solid black;">   
            送出機関番号
        </td>           
        <td style="border: 1px solid black;">   
            1
        </td>                               
        <td style="border: 1px solid black;">   
           D
        </td>                               
        <td style="border: 1px solid black;">   
            0
        </td>                               
        <td style="border: 1px solid black;">   
            0
        </td>                               
        <td style="border: 1px solid black;">   
            0
        </td>                               
        <td style="border: 1px solid black;">   
            0
        </td>                               
        <td style="border: 1px solid black;">   
            2
        </td>                               
        <td style="border: 1px solid black;">   
            1
        </td>                               
        <td style="border: 1px solid black;">   
            整理番号
        </td>                               
        <td style="border: 1px solid black;">   
        
        </td>                               
        <td style="border: 1px solid black;">   
        
        </td>                               
        <td style="border: 1px solid black;">   
      
        </td>                                          
    </tr>   
    <tr>       
        <td style="border: 1px solid black;">    
        3 実習実施者の氏名又は名称<br>Nama atau nama sebutan lembaga pelaksana pemagangan teknis           
        </td>    
        <td colspan="13" style="border: 1px solid black;">   
            {{$item[2]}}
        </td>                                 
    </tr> 
    <tr>       
        <td style="border: 1px solid black;">    
        4 監理団体の名称<br>Nama asosiasi pengawasan
        </td>    
        <td colspan="13" style="border: 1px solid black;">   
            グローバルネットワーク協同組合
        </td>                                 
    </tr> 
  </table>
  (注意)<br>(Catatan)
  <p>
    ① は、ローマ字で旅券（未発給の場合、発給申請において用いるもの）と同一の氏名を記載するほか、<br>漢字の氏名がある場合にはローマ字の氏名と併せて、漢字の氏名も記載すること。
    <br>
    Harus diisi dengan huruf Romawi sesuai dengan Paspor. Selain itu, jika memiliki nama dengan Kanji, nama harus ditulis dengan Kanji disertai nama dengan huruf Romawi. 
  </p>

  <p>２　取次送出機関が徴収した費用の名目及び額<br>Perincian dan jumlah biaya yang dipungut oleh Lembaga Pengirim</p>
  <table style="width: 100%; border-collapse:collapse;">  
    <tr style="text-align:center">       
        <td style="border: 1px solid black;" width="5%">    
            
        </td>    
        <td style="border: 1px solid black;">   
            名目<br>Perincian
        </td>        
        <td style="border: 1px solid black;">   
            徴収年月日<br>Tanggal pemungutan
        </td>      
        <td style="border: 1px solid black;">   
            額<br>Jumlah biaya
        </td>                         
    </tr>  
    <tr>       
        <td style="border: 1px solid black;" align="center">    
            1
        </td>    
        <td style="border: 1px solid black;">   
            選考関連費用<br>Biaya kursus
        </td>        
        <td style="border: 1px solid black;">   
            入学時<br>
            Pada saat siswa masuk<br>
            技能実習採用決定後<br>
            Setelah siswa diterima
        </td>      
        <td style="border: 1px solid black;">   
            250万ルピア　（1万9千118.20　円）<br>
            2 juta 500 ribu rupiah (19.228,20 yen)   
        </td>                         
    </tr>  
    <tr>       
        <td style="border: 1px solid black;" align="center">    
            2
        </td>    
        <td style="border: 1px solid black;">   
            派遣手数料<br>Biaya pengiriman
        </td>        
        <td style="border: 1px solid black;">   
            技能実習出国決定後<br>Setelah siswa berangkat

        </td>      
        <td style="border: 1px solid black;">   
            3千万ルピア（22万9千418.35円）<br>30 juta rupiah (229.418,35 yen)  
        </td>                         
    </tr>      
    <tr>       
        <td>    
            
        </td>    
        <td>   
            
        </td>        
        <td>   
            
        </td>      
        <td style="border: 1px solid black;">   
            計3千250万ルピア（24万8千536.55　円）<br>
            Total 32 juta 250 ribu rupiah (248.536,55 yen)
        </td>                         
    </tr>  
  </table>
  <p>（注意）<br> (Catatan)</p>
    <div style="margin-left: 1rem">
        <div style="float: left">1.&nbsp;</div>
        <div style="margin-left:1rem">
            「その他」の徴収費用については、括弧書きで名目を記載すること。<br>
            Perincian untuk "Biaya lain" yang dipungut ditulis di dalam kurung.      
        </div>           
        <div style="float: left">2.&nbsp;</div>
        <div style="margin-left:1rem">
            額については、現地通貨又は米ドルで記載し、括弧書きで日本円に換算した金額を記載すること。<br>
            Jumlah biaya ditulis dengan mata uang rupiah (IDR) atau dolar Amerika (US$), dan biaya mata uang yen Jepang ditulis di dalam kurung.                  
        </div>           
    </div>   

  <p>３　外国の準備機関が徴収した費用の名目及び額<br>Perincian dan jumlah biaya yang dipungut oleh Lembaga Persiapan</p>
  <table style="width: 100%; border-collapse:collapse ;text-align:center">  
    <tr>       
        <td style="border: 1px solid black;">    
            
        </td>    
        <td style="border: 1px solid black;">   
            徴収した機関の名称（送出における役割）<br>Nama asosiasi yang memungut biaya<br>
            (peran dalam pengiriman pemagangan teknis)            
        </td>        
        <td style="border: 1px solid black;">   
            名目<br>Perincian
        </td>      
        <td style="border: 1px solid black;">   
            徴収年月日<br>Tanggal<br>pemungutan
        </td>    
        <td style="border: 1px solid black;">   
            額<br>Jumlah biaya
        </td>                         
    </tr>  
    <tr>       
        <td style="border: 1px solid black;" width="5%">    
            1
        </td>    
        <td style="border: 1px solid black;">   
            (
                @for ($i = 0; $i < 20; $i++)                    
                    &nbsp;
                @endfor
            )
        </td>        
        <td style="border: 1px solid black;" align="center">   
            教育費<br>
            Biaya<br>pendidikan        
        </td>      
        <td style="border: 1px solid black;" align="center">   
            年　月　日<br>
            Tahun Bulan Tanggal
        </td>    
        <td style="border: 1px solid black;">   
            （　　　　円）<br>
            <div style="text-align: right">Yen</div>
        </td>                         
    </tr>  
    <tr>       
        <td style="border: 1px solid black;">    
            2
        </td>    
        <td style="border: 1px solid black;">   
            (
                @for ($i = 0; $i < 20; $i++)                    
                    &nbsp;
                @endfor
            )
        </td>        
        <td style="border: 1px solid black;" align="center">   
            その他<br>
            Lainnya<br>
            (
                @for ($i = 0; $i < 10; $i++)                    
                    &nbsp;
                @endfor
            )
        </td>      
        <td style="border: 1px solid black;">   
            年　月　日<br>
            Tahun Bulan Tanggal
        </td>    
        <td style="border: 1px solid black;">   
            （　　　　円）<br>
            <div style="text-align: right">Yen</div>
        </td>                         
    </tr>  
    <tr>       
        <td>    
            
        </td>    
        <td>   
            
        </td>        
        <td>   
            
        <td></td>
        </td>      
        <td style="border: 1px solid black;">   
            計　　　　（　　　　円）
            Total                yen
        </td>                         
    </tr>  
  </table>
  (注意)<br>(Catatan)
  <div style="margin-left: 1rem">
    <div style="float: left">1.&nbsp;</div>
    <div style="margin-left:1rem">
        外国の準備機関には、技能実習生の本国での勤務先、入国前講習を実施する機関など技能実習の準備に関与す<br>る一切の機関が含まれる。
        <br>Lembaga Persiapan meliputi semua Lembaga yang terlibat dalam persiapan pemagangan teknis yaitu lembaga yang melaksanakan pelatihan sebelum tiba di Jepang dan tempat kerja di negara asal peserta pemagangan teknis.
    </div>           
    <div style="float: left">2.&nbsp;</div>
    <div style="margin-left:1rem">
        徴収した機関については、名称のほか、括弧書きで技能実習生の送出において果たした役割を記載すること。       
        <br>Untuk lembaga yang memungut biaya, selain nama, juga harus mencantumkan peran dalam pengiriman peserta pemagangan teknis di dalam kurung.        
    </div>   
    <div class="page-break"></div>
    <div style="float: left">3.&nbsp;</div>
    <div style="margin-left:1rem">
        「その他」の徴収費用については、括弧書きで名目を記載すること。<br>
        Perincian untuk "Biaya lain" yang dipungut ditulis di dalam kurung.   
    </div>           
    <div style="float: left">3.&nbsp;</div>
    <div style="margin-left:1rem">
        額については、現地通貨又は米ドルで記載し、括弧書きで日本円に換算した金額を記載すること。<br>
        Jumlah biaya ditulis dengan mata uang rupiah (IDR) atau dolar Amerika (US$), dan biaya mata uang yen Jepang ditulis di dalam kurung.    
    </div>           
</div>   


  <p style="text-align: justify">
    技能実習生から２に記載の金額の費用を徴収し、その内訳について技能実習生に十分に理解させるとともに、<br>
    送出に関与した他の機関が技能実習生から３に記載の金額の費用を徴収したことを把握しました。また、２及び３<br>
    に記載の費用以外の費用については、技能実習生が徴収されていないことを確認しました。
    <br>Bersama ini kami memungut biaya sejumlah yang tertulis pada uraian nomor 2 dari peserta pemagangan teknis, dan telah memberikan pemahaman yang memadai mengenai perincian biaya tersebut kepada peserta pemagangan teknis. Kami juga mengetahui adanya pemungutan biaya sejumlah yang tertulis pada uraian nomor 3 oleh lembaga lain yang terlibat dalam pengiriman pemagangan teknis. Selain itu, kami memastikan bahwa peserta pemagangan teknis tidak dipungut biaya selain yang tertulis pada uraian nomor 2 dan 3.
  </p>
  <p style="text-align: center">取次送出機関の氏名又は名称
    <br>Nama atau sebutan lembaga pengirim
    <br>作成責任者　役職・氏名 　　 
 </p>
 <p style="text-align: justify">Nama dan jabatan penanggung jawab pembuatan dokumen
    <br>
    取次送出機関及び送出に関与した他の機関に２及び３に記載の金額を支払い、その内訳につい<br>て理解しました。また、２及び３に記載の費用以外の費用については、徴収されていません。
    <br>
    Bersama ini saya memahami tentang pembayaran dan perincian sejumlah biaya yang tertulis pada uraian nomor 2 dan 3 kepada lembaga pengirim dan lembaga lain yang terlibat dalam pengiriman. Selain itu, saya tidak dipungut biaya selain yang tertulis pada uraian nomor 2 dan 3.
 </p>
  
  <p style="text-align: right;">{{$item[3]}}</p>
  <br>
  <p style="text-align: right;">技能実習生の署名 <u>{{$item[0]}}</u><br>
    Tanda tangan peserta pemagangan teknis</p>
</body>
</html>