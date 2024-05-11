<!DOCTYPE html>
<html>
<head>
    <title>{{env('APP_NAME')}}</title>
</head>
<style>
  body{
    font-size: 13px;
  }
    table {
    border-collapse: collapse;
    border-spacing: 0;
  }
  td {
    border: 1px solid black;    
    padding: 1px;
  }

  .page-break {
    page-break-after: always;
}

</style>
<body> 
    <p style="text-align: center">
        VISA APPLICATION FORM TO ENTER JAPAN
    </p>
  <table style="width: 100%;">
    <tr>
        <td width="40%" style="border: none"></td>
        <td height="5%" width="20%" align="center">Official use only</td>
        <td style="border: none"></td>
        <td align="center" style="border: none">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/'.$pile->photo))) }}" width="60px"/>   
        </td>
    </tr>
  </table>         
  
  {{-- <br><br>
  <table style="width: 100%;">
    <tr>
        <td width="25%"  style="border: none">
            Surname (as shown in passport)
        </td>
        <td style="border-left:none;border-top:none;border-right:none">
            {{$item[0]}}
        </td>
        <td style="border-left:none;border-top:none;border-right:none">
        </td>        
    </tr>  
  </table>        
  <table style="width: 100%;">
    <tr>
        <td width="37%" style="border: none">
            Given and middle names (as shown in passport)
        </td>
        <td style="border-left:none;border-top:none;border-right:none">
            {{$item[1]}}
        </td>
        <td  style="border-left:none;border-top:none;border-right:none">
        </td>        
    </tr>
  </table>         --}}

  <p>Surname (as shown in passport) <u>{{$item[0]}}</u></p> 
  <p>Given and middle names (as shown in passport) <u>{{$item[1]}}</u></p> 
  <p><span style="margin-left: 2rem">&nbsp;</span>Other names (including any other names you are or have been known by)</p>  
  <p>Date of birth <u>{{$item[2]}}</u>	Place of birth <u>{{$item[3]}}</u></p>
  <p>Sex: {{$item[4]}}	Marital status: {{$item[5]}}</p>
  <p>Nationality or citizenship	<u>{{$item[6]}}</u></p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Former and/or other nationalities or citizenships  {{$item[7]}}</p>
  <p>ID No. issued to you by your government <u>{{$item[8]}}</u></p>
  <p>Passport type:{{$item[9]}}	Passport No. <u>{{$item[10]}}</u></p>
  <p>Place of issue <u>{{$item[11]}}</u>		Date of issue <u>{{$item[12]}}</u>	</p>
  <p>Issuing authority <u>{{$item[13]}}</u>		Date of expiry {{$item[14]}}</p>
  <p>Certifcate of Eligibility No. <u>{{$item[15]}}</u></p>
  <p>Purpose of visit to Japan/Status of residence <u>{{$item[16]}}</u></p>
  <p>Intended length of stay in Japan <u>{{$item[17]}}</u> Date of arrival in Japan <u>{{$item[18]}}</u></p>
  <p>Port of entry into Japan <u>{{$item[19]}}</u>	Name of ship or airline <u>{{$item[20]}}	</u>	                  </p>
  <p>Names and addresses of hotels or persons with whom applicant intends to stay</p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Name <u>{{$item[21]}}</u>	Tel. <u>{{$item[22]}}</u></p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Address <u>{{$item[23]}}</u></p>
  <p>Dates and duration of previous stays in Japan <u>{{$item[24]}}</u></p>
  <p>Your current residential address (if you have more than one address, please list them all)</p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Address <u>{{$item[25]}}</u></p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Tel <u style="word-spacing: 5em">&nbsp;&nbsp;</u>Mobile No. <u>{{$item[26]}}</u>	</p>
  <p>E-Mail <u>{{$item[27]}}/u><u style="word-spacing: 15em">&nbsp;&nbsp;</u></p>
  <p>Current profession or occupation and position <u>{{$item[28]}}</u><u style="word-spacing: 9.6em">&nbsp;&nbsp;</u></p>
  <p>Name and address of employer</p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Name <u>{{$item[29]}}</u>	Tel. <u>{{$item[30]}}</u></p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Address <u>{{$item[31]}}</u></p>
  <p>(Note)Partner's profession/occupation (or that of parents, if applicant is a minor):</p>
  <p><u>{{$item[32]}}</u><u style="word-spacing: 33em">&nbsp;</u></p>  
  <div class="page-break"></div>
  <p>Guarantor or reference in Japan Please provide details of the guarantor or the person to be visited in Japan</p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Name <u>{{$item[33]}}</u>	Tel. <u>{{$item[34]}}</u></p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Address <u>{{$item[35]}}</u></p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Date of birth <u style="word-spacing: 3em">&nbsp;</u>		Sex: Male	Female  </p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Relationship to applicant <u>{{$item[36]}}</u></p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Profession or occupation and position <u>{{$item[37]}}</u></p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Nationality and immigration status <u>{{$item[38]}}</u></p>
  <P style="font-size: 0.8rem">Inviter in Japan‹Please write ’same as above’ if the inviting person and the guarantor are the same)</P>
  <p><span style="margin-left: 2rem">&nbsp;</span>Name <u>{{$item[39]}}</u>	Tel. <u></u></p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Address <u style="word-spacing: 2em">&nbsp;</u></p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Date of birth <u style="word-spacing: 2em">&nbsp;</u>	Sex: Male	Female </p>
  <p><span style="margin-left: 2rem">&nbsp;</span>Relationship to applicant<u style="word-spacing: 30em">&nbsp;</u></p> 
  <p><span style="margin-left: 2rem">&nbsp;</span>Nationality and immigration status<u style="word-spacing: 26em">&nbsp;</u></p>  
  <p><span style="margin-left: 1rem">&nbsp;</span>(Note)Remarks/Special circumstances, if any<u style="word-spacing: 23em">&nbsp;</u></p>  
  <p style="margin-bottom: 0rem"><span style="margin-left: 1rem">&nbsp;</span>Have you ever:</p>  
  
  <table style="width: 100%;margin-left:1rem;margin-bottom: 0rem">
    <tr>
        <td style="border: none" width="90%">
            o been convicted of a crime or offence in any country?
        </td>   
        <td style="border: none">
            Yes
        </td>   
        <td style="border: none">
            No
        </td>      
    </tr>
    <tr>
        <td style="border: none">
            e been sentenced to imprisonment for 1 year or more in any country?(Note 2)
        </td>   
        <td style="border: none">
            Yes
        </td>   
        <td style="border: none">
            No
        </td>      
    </tr>
    <tr>
        <td style="border: none">
            o been convicted and sentenced for a drug offence in any country in violation of law concerning narcotics, marijuana, opium, stimulants or psychotropic substances*(Note 2)
        </td>   
        <td style="border: none">
            Yes
        </td>   
        <td style="border: none">
            No
        </td>      
    </tr>
    <tr>
        <td style="border: none">
            o engaged in prostitution, or in the intermediation or solicitation of a prostitute for other persons, or in the provision of a place for prostitution, or any other activity directly connected to prostitution?
        </td>   
        <td style="border: none">
            Yes
        </td>   
        <td style="border: none">
            No
        </td>      
    </tr>
    <tr>
        <td style="border: none">
            o committed trafficking in persons or incited or aided another to commit such an offence?
        </td>   
        <td style="border: none">
            Yes
        </td>   
        <td style="border: none">
            No
        </td>      
    </tr>
    <tr>
        <td style="border: none">
            o been deported or removed from Japan or any country for overstaying your visa or violating any law or regulation?
        </td>   
        <td style="border: none">
            Yes
        </td>   
        <td style="border: none">
            No
        </td>      
    </tr>
  </table>  
  <p><span style="margin-left: 1rem">&nbsp;</span>(Note 2) Please tick “Yes" if you have received any sentence, even if the sentence was suspended. </p> 
  <p><span style="margin-left: 1rem">&nbsp;</span>If you answered "Yes" to any of the above questions, please provide relevant details. </p> 
  <div style="width: 100%;height:5%;border: 1px solid black"></div>
  <p style="text-align: justify">
    “I hereby declare that the statement given above is true and correct. I understand that immigration status and period of stay to be granted are decided by the Japanese immigration authorities upon my arrival. I understand that possession of a visa does not entitle the bearer to enter Japan upon arrival at port of entry if he or she is found inadmissible.”
  </p>  
  <p style="text-align: justify">
    “I hereby consent to the provision of my personal information (by an accredited travel agent, within its capacity of representing my visa application) to the Japanese embassy/consulate-general and (entrust the agent with) the payment of my visa fee to the Japanese embassy/consulate-general, when such payment is necessary.”
 </p>
 <p>Date of application <u style="word-spacing: 5em">&nbsp;&nbsp;</u>	Signature of applicant  </p>
 <P style="font-size: 0.8rem">(Note)lt is not mandatory to complete these items.</P>
 <p>
    Any personal information filled in this application form as well as additional personal information submitted for the visa application (hereinafter referred to as "Retained Personal Information?) will be handled appropriately by the Ministry of Foreign Affairs of Japan (including Japanese overseas establishments) in accordance with the Act on the Protection of Personal Information (Act No. 57 of 2003, hereinafter, ?the Act?). Retained Personal Information will only be used to the extent necessary for the purpose of processing the visa application (including providing personal information to the transportation company which you are going to travel with, or the alternative transportation company which you are going to travel with due to unforeseen circumstances), immigration control, international cooperation and for other purposes in compliance with Article 69 of the Act.
 </p>
  
</body>
</html>