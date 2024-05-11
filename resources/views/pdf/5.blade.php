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
    font-size: 11px;
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
        <td colspan="6" style="text-align: left">参考様式第１-10号（規則第８条第８号関係）　<br>
            列４）<br>
            Ｄ・Ｅ・Ｆ
        </td>
        <td  style="vertical-align:top">（日本産業規格Ａ列</td>
    </tr>
    <tr>
        <td colspan="7" style="text-align: center;">
            技能実習計画の認定に関する取次送出機関の誓約書                       
        </td>
    </tr>
</table>

<p style="text-align: center">
    次の申請者の次の技能実習生に係る団体監理型技能実習を取り次ぐに当たり、下記の事項を誓約します。
</p>    
<table style="width: 100%; border-collapse:collapse; border: 1px solid black;">
    <tr>
        <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">申請者（実習実施者）の氏<br>名又は名称
        </td>
        <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
            LPK LINTAS NEGERI
        </td>
    </tr>
    <tr>
        <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">監理団体の名称
        </td>
        <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
            グローバルネットワーク協同組合
        </td>
    </tr>
    @foreach($apply as $item)
    @if($loop->first)
        <tr>
            <td rowspan="{{$apply->count()}}"  style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">技能実習生の氏名（国籍）
            </td>
            <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">
                {{$item->user->data->fullname}} 
                (@if($item->user->dataj)
                    {{$item->user->dataj->fullname}}
                @endif)
            </td>
        </tr>
    @else
        <tr>      
            <td style="border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">        
                {{$item->user->data->fullname}} 
                (@if($item->user->dataj)
                    {{$item->user->dataj->fullname}}
                @endif)    
            </td>
        </tr>
    @endif
    @endforeach 
</table>
  <p>　　※　複数名について記載する場合には適宜欄を追加すること。記載しきれない場合には別紙に記載する<br>ことも可とし、当欄には「別紙のとおり」と記載すること。</p>
  <center>記</center>
  <p>【誓約事項】</p>
<table border="0" cellspacing="0" cellpadding="0" style="width: 100%">
    <tr>
        <td style="vertical-align: top">1.</td>
        <td style="margin-left: 1rem">
           保証金の徴収その他名目のいかんを問わず、団体監理型技能実習生又はその親族その他の関係者の<br>財産を管理することは、決していたしません。
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">2.</td>
        <td style="margin-left: 1rem">
           団体監理型技能実習生が技能実習に係る契約を履行しなかった場合に備えて、団体監理型<br>技能実習生、団体監理型実習実施者、監理団体又は外国の準備機関との間で、違約金等の制<br>裁を定めることは、決していたしません
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">3.</td>
        <td style="margin-left: 1rem">
            団体監理型技能実習生等が団体監理型技能実習の申込みの取次ぎ又は外国における団体監<br>理型技能実習の準備に関して当機関に支払う費用について、団体監理型技能実習生等にその<br>額及び内訳を十分に理解させた上で合意しています。
        </td>
    </tr>
    <tr>
        <td style="vertical-align: top">4.</td>
        <td style="margin-left: 1rem">
            上記のほか、技能実習に関する法令に違反することは、決していたしません。
        </td>
    </tr>
</table>

<p style="text-align: right">
    {{$date}}
</p>

<table style="width: 70%; border-collapse:collapse; border: 1px solid black;margin-left:auto">    
    <tr>       
        <td colspan="6" style="border: 1px solid black;">    
            取次送出機関の氏名又は名称
        </td>    
        <td colspan="9" style="border: 1px solid black;">   
            LPK LINTAS NEGERI
        </td>                     
    </tr>  
    <tr style="text-align: center">       
        <td style="border: 1px solid black;">    
            送出機関番号
        </td>    
        <td style="border: 1px solid black;">   
            I
        </td>         
        <td style="border: 1px solid black;">   
            D
        </td>
        <td style="border: 1px solid black;">   
            N
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
            3
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
        <td style="border: 1px solid black;">   
            
        </td>                                                
    </tr>  
    <tr>       
        <td colspan="6" style="border: 1px solid black;">    
            作成責任者　役職・氏名        
        </td>    
        <td colspan="9" style="border: 1px solid black;">   
            I PUTU PANDE ARIADI
        </td>                     
    </tr> 
 </table>
</body>
</html>