<h6>Nominal : {{number_format($payment->nominal,0,",",".")}}</h6>
@php 
$bank = [
          [
            'name'=>'BCA',
            'an'=> 'Lintas Negeri',
            'number'=> '121057991',
          ],
          [
            'name'=>'BNI',
            'an'=> 'Lintas Negeri',
            'number'=> '081057991',
          ]
        ];
@endphp
@foreach ($bank as $val => $item)
    <div class="d-flex justify-content-start">
        <div class="p-1">
            {{$item['name']}} :  
        </div>
        <div class="p-1">
            {{$item['number']}} a/n {{$item['an']}}
        </div>
    </div>
@endforeach
<form action="{{route('daftar.store', ['id'=>md5($payment->id)])}}" method="post" enctype="multipart/form-data">    
    @csrf
    <div class="my-3">
        <h6>File Transfer</h6>
        <small class="text-danger"> *Image Only (jpg,jpng,png)</small>
        <input class="form-control" name="file" type="file" id="formFile" accept=".jpg, .jpeg, .png" required>
        @error('file')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
    <button class="btn btn-primary btn-block w-25 rounded-pill">Send</button>
</form> 