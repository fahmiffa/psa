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
    font-size: 15px;
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
<div style="width: 700px; max-width=100%">

    
    <table border="0" cellspacing="0" cellpadding="5" style="width: 100%">
        <tr>
            <td colspan="6" style="text-align: left;font-size:12px">
                参考様式第１-20号（規則第８条第18号関係
                <br>
                Formulir nomor 1-20 (Berhubungan dengan Peraturan pasal 8 nomor 18)
                <br>
                Ａ・Ｂ・Ｃ・Ｄ・Ｅ・Ｆ
            </td>
            <td style="font-size:12px">
                （日本工業規格Ａ列４<br>(Standar Industri Jepang ukuran A4)
            </td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: center;">
                技能実習生の申告書<br>
                Surat Pernyataan Peserta Pemagangan            
            </td>
        </tr>
    </table>
    
    <p>下記の事項を申告します。<br>Menyatakan hal-hal di bawah ini.</p>    
    
    <p style="text-align: center">Pernyataan</p>
    <p style="text-align: justify">日本国における技能実習制度の趣旨が、開発途上地域等への技能等の移転による国際協力の<br>推進であることを承知しています</p>
    <p style="text-align: justify">Saya memahami bahwa tujuan dari program pemagangan di negara Jepang adalah untuk mendorong dan menjalankan kerjasama internasional dengan memindahkan keterampilan ke negara-negara berkembang.</p>
    
    <p style="word-wrap: break-word">
        私の本国である<u>インドネシア</u>では修得等が困難である <u>{{$item[0]}}</u>に係る技能等について修得等をし、技能実習の終了後に帰国した際には、{{$item[1]}} することにより、本国への技能等の移転に努めたいと考えています。
    </p>
    <p style="text-align: justify">
        Saya ingin memperoleh keterampilan yang berhubungan dengan {{$item[2]}} yang mana di negara saya {{$item[3]}} sulit untuk memperolehnya, dan saat pulang ke negara asal setelah selesai pemagangan, saya akan mengupayakan untuk memindahkan keterampilan yang telah diperoleh ke negara saya. 
    </p>
    <p>
        日本国で技能実習を行うに当たり、私や私と関係のある人が、誰かに保証金を<br>預ける契約を結んでいません。また、今後結ぶ予定もありません。
    </p>  
    <p style="text-align: justify">
        Saat melakukan pemagangan di Jepang, saya dan orang yang memiliki hubungan dengan saya tidak menjalin kontrak dengan memberikan uang jaminan kepada seseorang. Selanjutnya pun saya tidak ada rencana untuk menjalin kontrak seperti itu.    
    </p>
    <p>
        日本国で技能実習を行うに当たり、私や私と関係のある人が、誰かに金銭などの財産を管理され<br>ることとはなっていません。また、今後管理される予定もありません。
    </p>
    <p style="text-align: justify">
    Saat melakukan pemagangan di Jepang, saya dan orang yang memiliki hubungan dengan saya tidak menyerahkan pengelolaan aset seperti uang dsb. kepada seseorang. Selanjutnya pun saya tidak ada rencana untuk menyerahkan pengelolaan aset seperti itu.
    </p>
    <p>
        日本国で技能実習を行うに当たり、私や私と関係のある人が、誰かと、所定の技能実習を計<br>画どおり修了しなかったなど技能実習に係る契約<br>の不履行があった場合に違約金を支払う契約を結んでいません。また、今後結ぶ予定もありません。
    </p>
    <p style="text-align: justify">
        Saat melakukan pemagangan di Jepang, saya dan orang yang memiliki hubungan dengan saya tidak menjalin kontrak kewajiban membayar uang denda kepada seseorang jika kontrak yang berhubungan dengan pemagangan tidak terlaksana seperti tidak selesai sesuai dengan perjanjian pemagangan yang telah ditentukan, Selanjutnya pun saya tidak ada rencana untuk menjalin kontrak seperti itu.
    </p>  
    <p>上記の記載内容は、事実と相違ありません。</p>
    <p>Isi pernyataan di atas sesuai dengan fakta dan tidak ada perbedaan dengan faktanya.</p>
    
    <table border="0" cellspacing="0" cellpadding="5" style="width: 100%">
        <tr>
            <td colspan="6" style="text-align: right">              
            </td>
            <td style="text-align: right">
                {{$item[4]}}<br>                
                <br><br><br>
                技能実習生の署名　　　<u>{{$item[5]}}</u>
                <br>
                Tanda tangan Peserta Pemagangan
            </td>
        </tr> 
    </table>
</div>

</body>
</html>