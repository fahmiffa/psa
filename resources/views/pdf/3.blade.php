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
    font-size: 12px;
  }

  table {
    page-break-inside: auto;
  }

  tr {
    page-break-inside: avoid;
  }

</style>
<body>

<table border="0" cellspacing="0" cellpadding="5" style="width: 100%">
    <tr>
        <td colspan="6" style="text-align: left">参考様式第１-３号（規則第８条第４号関係
        <br>Rujukan Formulir Nomor 1-3 (Berhubungan dengan Peraturan Pasal 8 Nomor 4)
        <br>Ａ・Ｂ・Ｃ・Ｄ・Ｅ・Ｆ
        </td>
        <td  style="vertical-align:top">（日本産業規格Ａ列４<br>(Standar Industri Jepang ukuran A4)</td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: center;">
        技能実習生の履歴書<br>
        Riwayat Hidup Peserta Pemagangan Teknis
        </td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: right">
         {{$item[0]}}
        </td>
        </tr>
</table>
<table style="width: 100%; border-collapse:collapse; border: 1px solid black;">
    <tr>
        <td  rowspan="2" style="border: none" width="8%">
        ① 氏名<br>
        Nama<br>lengkap
        </td>
        <td  style="border: 1px solid black;">
        ローマ字<br>Huruf Romawi
        </td>        
        <td style="border: 1px solid black;">
            {{$item[1]}}
        </td>  
        <td style="border: 1px solid black;">
        ② 性別<br>Jenis kelamin
        </td>     
        <td style="border: 1px solid black;">
            ■男 ■女
        </td>  
    </tr>  
    <tr>          
        <td style="border: 1px solid black;">
            漢字<br>Kanji
        </td>        
        <td style="border: 1px solid black;">
            {{$item[3]}}
        </td>  
        <td style="border: 1px solid black;">
            ③ 生年月日<br>Tanggal lahir
        </td>     
        <td style="border: 1px solid black;">
            {{$item[4]}}
          </td>  
    </tr>  
    <tr>       
        <td colspan="2" style="border: 1px solid black;">
            ④ 国籍（国又は地域）<br>Kewarganegaraan (Negara/Wilayah)
        </td>    
        <td  style="border: 1px solid black;">
            インドネシア<br>INDONESIA
        </td>   
        <td style="border: 1px solid black;">
            ⑤ 母国語<br>Bahasa Ibu
        </td>         
        <td  style="border: 1px solid black;">
            インドネシア語<br>Bahasa Indonesia
        </td>       
    </tr> 
    <tr>       
        <td colspan="2" style="border: 1px solid black;">
            ⑥ 現住所<br>Alamat Sekarang
        </td>    
        <td colspan="3" style="border: 1px solid black;">
         {{$item[5]}}
        </td>        
    </tr> 
    <tr>       
        <td rowspan="4" colspan="2"  style="border: 1px solid black;">    
            ⑦ 学歴<br>Pendidikan
        </td>    
        <td  style="border: 1px solid black;text-align:center">  
            期間 Jangka Waktu
        </td>        
        <td colspan="2" style="border: 1px solid black;text-align:center">   
            学校名 Nama Sekolah
        </td>                    
    </tr>  
    @php
        $study = json_decode($coe->user->data->study);           
    @endphp              
    <tr style="text-align: center">    
        <td  style="border: 1px solid black;">     
            {{str_replace('-','.',$study[0][1])}} - {{str_replace('-','.',$study[0][2])}}       
        </td>        
        <td colspan="2" style="border: 1px solid black;">         
            {{$study[0][0]}}       
        </td>                    
    </tr>  
    <tr style="text-align: center">              
        <td  style="border: 1px solid black;">  
            ～
        </td>        
        <td colspan="2" style="border: 1px solid black;">               
        </td>                    
    </tr>  
    <tr style="text-align: center">              
        <td  style="border: 1px solid black;">  
            ～
        </td>        
        <td colspan="2" style="border: 1px solid black;">               
        </td>                    
    </tr>  
    <tr>       
        <td  rowspan="4" colspan="2"  style="border: 1px solid black;">    
            ⑧ 職歴 <br>Pengalaman Kerja
        </td>    
        <td style="border: 1px solid black;text-align:center">  
            期間 Jangka Waktu
        </td>        
        <td colspan="2" style="border: 1px solid black;text-align:center">   
            就職先名（職種） Nama Perusahaan (Jenis Pekerjaan)
        </td>                    
    </tr>  


    @for ($i = 0; $i < 3; $i++)        
      @if($job[$i])
            <tr style="text-align: center">                 
                <td  style="border: 1px solid black;">  
                    {{str_replace('-','.',$first[$i])}} - {{str_replace('-','.',$end[$i])}}       
                </td>          
                <td colspan="2" style="border: 1px solid black;">            
                    {{$job[$i]}} ({{$var[$i]}})
                </td>                                
            </tr>  
        @else
            <tr style="text-align: center">                 
                <td  style="border: 1px solid black;">  
                    ～     
                </td>          
                <td colspan="2" style="border: 1px solid black;">            
                    
                </td>                                
            </tr>  
        @endif
    @endfor 


    <tr>              
        <td colspan="2"  style="border: 1px solid black;">      
            ⑨ 修得等をしようとす<br>る技能等に係る職歴<br>
            Pengalaman kerja yang berhubungan dengan keterampilan yang akan diperoleh saat magang        
        </td>  
        <td  style="border: 1px solid black;">  
            {{$item[6]}} 職　　{{$item[7]}}月<br>
            Bangunan   {{$item[8]}} bulan
        </td>  
        <td  colspan="2" style="border: 1px solid black;">  
            <div>
                <div style="float: left"> 職<br>Jenis pekerjaan</div>
                <div style="margin-left:10rem">年<br>tahun</div>           
            </div>
        </td>                                
    </tr>    
    <tr>              
        <td colspan="2"  style="border: 1px solid black;">      
            ⑩ 訪日経験<br>Pengalaman kedatangan di Jepang            
        </td>      
        <td  colspan="3"  style="border: 1px solid black;">          
            <div>
                <div style="float: left;">&nbsp;&#x25A2;&nbsp;</div>
                <div style="margin-left: 1rem;">
                    有（　　～　　※在留資格：☐技能実習・☐技能実習以外）・        　 ■無
                    <br>Ada &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Status tinggal: pemagangan teknis・Selain pemagangan teknis   Tidak ada                          
                </div>
            </div>  
            <div>
                <div style="float: left;">&nbsp;&#x25A2;&nbsp;</div>
                <div style="margin-left: 1rem;">
                    外国人建設・造船就労者受入事業により本邦で就労したことがある場合<br>
                    Jika pernah bekerja di Jepang dalam program penerimaan pekerja asing untuk konstruksi dan pembuatan kapal.                    
                    <br>第２号技能実習終了後の帰国期間（　　年　　月　　日　～ 　年　　月　　日<br>
                    Masa pulang ke negara asal setelah selesai pemagangan teknis nomor 2 <br>
                    <div style="text-align: right">(Thn.      Bln.     Tgl.     s/d  Thn.      Bln.      Tgl.     )</div><br>
                    建設・造船就労終了後の帰国期間（　　年　　月　　日　～ 　年　　月　　日）<br>
                    Masa pulang ke negara asal setelah selesai bekerja di program konstruksi dan pembuatan kapal <br>
                    <div style="text-align: right">(Thn.      Bln.     Tgl.     s/d  Thn.      Bln.      Tgl.     )</div>
                </div>
            </div>        
            <div>
                <div style="float: left;">&nbsp;&#x25A2;&nbsp;</div>
                <div style="margin-left: 1rem;">
                    経済連携協定（ＥＰＡ）に基づく看護師候補者・介護福祉士候補者受入事業に<br>より本邦で就労したことがある場合<br>
                    Jika pernah bekerja di Jepang dalam program penerimaan kandidat perawat atau kandidat pekerja perawatan lansia berdasarkan Perjanjian Kemitraan Ekonomi (EPA)                    
                </div>
            </div>    
        </td>                                
    </tr>
    <tr>              
        <td colspan="2"  style="border: 1px solid black;" width="10px">      
            ⑪ 技能実習経験及びそ<br>の区分 
            <br>Pengalaman ikut program pemagangan teknis dan klasifikasinya
        </td>  
        <td  style="border: none; border-top: 1px solid black;padding:1rem">        
            <p style="text-align: center">&#x25A2; 有　(&nbsp;<br>
                Ada</p>       
             <p>&#x25A2;Ａ（第１号企業単独型技能実習）　　<br>Pemagangan teknis tipe perusahaan tunggal nomor 1 (Pemagangan yang secara langsung diterima perusahaan selama 1 tahun).</p>
             <p>&#x25A2;Ｂ（第２号企業単独型技能実習）　　 <br>
                 Pemagangan teknis tipe perusahaan tunggal nomor 2 (Pemagangan yang secara langsung diterima perusahaan selama 2 tahun).     
             </p>
             <p>&#x25A2;Ｃ（第３号企業単独型技能実習）　　<br>
                 Pemagangan teknis tipe perusahaan tunggal nomor 3 (Pemagangan yang secara langsung diterima perusahaan selama 3 tahun.
             </p>
        </td>
        <td align="center" style="border: none; border-top: 1px solid black;vertical-align:top">   
            <br>     
            ～
       </td>
        <td style="border: none; border-top: 1px solid black;padding:1rem">        
            <p style="text-align: center">)■ 無
                <br>Tidak ada</p>             
             <p>&#x25A2;Ｄ（第１号団体監理型技能実習）<br>Pemagangan teknis tipe lembaga pengawasan nomor 1 (Pemagangan melalui lembaga pengawasan selama 1 tahun).</p>
             <p>&#x25A2;Ｅ（第２号団体監理型技能実習）<br>
                 Pemagangan teknis tipe lembaga pengawasan nomor 2 (Pemagangan melalui lembaga pengawasan selama 2 tahun).
             </p>
             <p>&#x25A2;Ｆ（第３号団体監理型技能実習）<br>
                 Pemagangan teknis tipe lembaga pengawasan nomor 3 (Pemagangan melalui lembaga pengawasan selama 3 tahun). 
             </p>
        </td>                                
    </tr>    
    <tr>              
        <td colspan="2"  style="border: 1px solid black;">      
            ⑫ 過去の在留資格認定<br>証明書不交付の有無
            <br>Certificate of Eligibility pernah ditolak oleh imigrasi 
        </td>  
        <td  style="border: none; border-top: 1px solid black">        
            &#x25A2; 有　（              
        </td>        
        <td  style="border: none; border-top: 1px solid black">
                        
        </td>        
        <td  style="border: none; border-top: 1px solid black">
          　）　　・　　■無                  
        </td>                                
    </tr>
    <tr>              
        <td colspan="2"  style="border: 1px solid black;">      
            ⑬ その他<br>Lain-lain
        </td>  
        <td  colspan="3"  style="border: 1px solid black;">        
            特記事項なし                          
        </td>                                
    </tr>
    <tr>              
        <td colspan="2"  style="border: 1px solid black;">      
            ⑭ 技能実習生の署名<br>
            Tanda tangan Peserta Pemagangan Teknis
        </td>  
        <td  colspan="3"  style="border: 1px solid black;">        
                          
        </td>                                
    </tr>
</table>
<p>（注意）</p>
<p>① は、ローマ字で旅券（未発給の場合、発給申請において用いるもの）と同一の氏名を記載するほか、漢字の氏名がある場<br>合にはローマ字の氏名と併せて、漢字の氏名も記載すること。</p>
</body>
</html>