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

</style>
<body>

<table border="0" cellspacing="0" cellpadding="5" style="width: 100%">
    <tr>
        <td colspan="6" style="text-align: left">
            参考様式第１-23号（規則第８条第21号関係）
            <br>      
            Ｄ・Ｅ・Ｆ
        </td>
        <td style="vertical-align: top">
            （日本産業規格Ａ列４）
        </td>
    </tr>     
</table>
<p style="text-align: center">
    技能実習生の推薦状 
</p>
<p>
    我が国の送出機関である　LPK  PUSPA  SETYA  ABADI　　　　が送り出す、技能実習生
</p>
<p><u>{{$item[0]}}</u></p>
<p>複数名について記載する場合には適宜欄を追加すること。記載しきれない場合には別紙に記載する<br>ことも可とし、当欄には「別紙のとおり」と記載すること。<br>
    について、日本国の監理団体である　<u>{{$item[1]}}</u></p>
<p>を通じて、実習実施者である{{$item[2]}}に受け入れられて、　<u>{{$item[3]}}</u></p>
<p>から、　<u>{{$item[4]}}</u>　に係る技能実習を行うことについて推薦します。</p>
<p>　なお、本推薦状の効力は作成日以降１年間とします。</p>
<p style="text-align: right">
  {{$item[5]}}<br>
    <br>
    <span style="margin-right: 10rem">公的機関の名称</span>
    <br>
    {{$item[6]}}
<br>
<br>
{{$item[7]}}
</p>


</body>
</html>