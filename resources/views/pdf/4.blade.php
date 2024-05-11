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
        <td colspan="6" style="text-align: left">参考様式第１-28号（規則第８条第26号関係<br>          
            Ｄ・Ｅ・Ｆ（規則第10条第２項第３号ホに適合することを証する書面）
        </td>
        <td  style="vertical-align:top">（日本産業規格Ａ列４列４）</td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: center;">
            外国の所属機関による証明書<br>
            （団体監理型技能実習）                        
        </td>
    </tr>
</table>

<p style="text-align: left">
    技能実習生（候補者を含む。）について、下記の事項を証明します。
    <div style="text-align:center">記</div>
</p>    
  
  <table style="width: 100%; border-collapse:collapse; border: 1px solid black;">
    @foreach($apply as $item)
        @if($loop->first)
        <tr>
            <td rowspan="{{$apply->count()*2}}" width="2%" style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
                ① 技能実習生の氏名<br>
                ※　複数名について記載する場合に<br>
                は適宜欄を追加すること。記載しきれ<br>
                ない場合には、別紙に記載することも可とし、<br>
                当欄には「別紙のとおり」と記載すること。            
            </td>
            <td style="border: 1px solid black;">
                ローマ字
            </td>        
            <td style="border: 1px solid black;">
                {{$item->user->data->fullname}}
            </td>  
            <td style="border: 1px solid black;">
                所属事業<br>所<br>所属部署            
            </td>     
            <td style="border: 1px solid black;">
                {{$items}}
            </td>  
        </tr>  
        <tr>     
            <td style="border: 1px solid black;">
                漢字
            </td>        
            <td style="border: 1px solid black;">
                @if($item->user->dataj)
                {{$item->user->dataj->fullname}}
                @endif
            </td>  
            <td style="border: 1px solid black;">
                職種
            </td>     
            <td style="border: 1px solid black;">
                {{$items}}
            </td>  
        </tr>  
        @else
        <tr>     
            <td style="border: 1px solid black;">
                ローマ字
            </td>        
            <td style="border: 1px solid black;">
                {{$item->user->data->fullname}}
            </td>  
            <td style="border: 1px solid black;">
                所属事業<br>所<br>所属部署
            </td>     
            <td style="border: 1px solid black;">
                {{$items}}
            </td>  
        </tr>  
        <tr>     
            <td style="border: 1px solid black;">
                漢字
            </td>        
            <td style="border: 1px solid black;">
                @if($item->user->dataj)
                {{$item->user->dataj->fullname}}
                @endif
            </td>  
            <td style="border: 1px solid black;">
                職種
            </td>     
            <td style="border: 1px solid black;">
                {{$items}}
            </td>  
        </tr>         
        @endif
    @endforeach  
    <tr>       
        <td style="border: 1px solid black;">
            ③ 技能実習の終了後の措置予定
        </td>    
        <td colspan="4" style="border: 1px solid black;">            
            <p>&#x25A2;&nbsp;
                技能実習生との関係を継続（「現職にとどめる」、「休職とする」など）
            </p>
            <p>■　退職</p>                                
            <p>&#x25A2;&nbsp;その他（@for ($i = 0; $i < 50; $i++) &nbsp; @endfor）</p>
        </td>               
    </tr>    
    <tr>       
        <td style="border: 1px solid black;">
            ②技能実習の期間中の処遇
        </td>    
        <td colspan="4" style="border: 1px solid black;">
            <p>&#x25A2;&nbsp;
                復職　（事業所：　　　　　、部署：　　　、職種：　　　　　　）
            </p>
            <p>&#x25A2;&nbsp;
                復職予定なし
            </p>
            <p>■　未定</p>                                            
        </td>               
    </tr>        
  </table>
  <p>（注意）</p>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%">
    <tr>
        <td style="vertical-align: top">1.</td>
        <td>
            &nbsp;&nbsp;①は、ローマ字で旅券（未発給の場合、発給申請において用いるもの）と同一の氏名を記載するほか、<br>漢字の氏名がある場合にはローマ字の氏名と併せて、漢字の氏名も記載すること。
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">2.</td>
        <td>
           &nbsp;&nbsp; 個人農業者や家族経営の事業に従事していた者等の場合は、地方政府、業界団体等による証明でも差し<br>支えない。
        </td>
    </tr>
</table>

<p>上記の記載内容は、事実と相違ありません。また、団体監理型技能実習の準備に関し、<br>技能実習に関する法令に違反することは、決していたしません。</p>
<p style="text-align: right">
    {{$date}}<br><br>
    外国の所属機関の名称	<br><br><br>
    作成責任者　役職・氏名　　<u>{{$bot}}</u>
</p>
</body>
</html>