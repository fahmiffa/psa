<h6>Nominal : {{number_format($payment->nominal,0,",",".")}}</h6>
@foreach ($da as $item)
    <div class="d-flex justify-content-start">
        <div class="p-1">
            {{$item->type}} :  
        </div>
        <div class="p-1">
            {{$item->numbers}} a/n {{$item->name}}
        </div>
    </div>
@endforeach
<form action="{{route('daftar.store', ['id'=>md5($kelas->id)])}}" method="post" enctype="multipart/form-data">    
    @csrf
    <div class="my-3">
        <h6>File Transfer</h6>
        <small class="text-danger"> *Image Only (jpg,jpng,png)</small>
        <input class="form-control" name="file" type="file" id="formFile" accept=".jpg, .jpeg, .png" required>
        @error('file')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
    <button class="btn btn-primary btn-block w-25 rounded-pill">Send</button>
</form> 