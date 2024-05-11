<!DOCTYPE html>
<html>
<head>
    @php $title = str_replace("_"," ",env('APP_NAME')); @endphp
    <title>Lintas Negeri</title>      
</head>
<body>
    <h1>{{ $details['title'] }}</h1>
    <p>{{ $details['body'] }}</p>
    <p>{{ $details['par'] }}</p>
   
    <p>Terima kasih</p>
</body>
</html>