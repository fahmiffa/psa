<form action="{{route('kontrak.store', ['id'=>md5($apply->id)])}}" method="post" enctype="multipart/form-data">    
    @csrf
    <div class="my-3">
        <h6>File Kontrak</h6>
        <input class="form-control" name="file" type="file" id="formFile" accept=".pdf" required>
        @error('file')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
    <button class="btn btn-primary btn-block w-25 rounded-pill">Upload</button>
</form> 