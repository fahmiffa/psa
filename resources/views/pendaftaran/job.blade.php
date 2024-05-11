<form action="{{route('daftar.next',['id'=>md5($user->id)])}}" method="post">                                                                       
  @csrf           
  <div class="px-3">      
      <div class="divider divider-center my-3">
        <div class="divider-text">Pekerjaan</div>
      </div>      
      <label class="my-3">Riwayat Pekerjaan</label>
      @if(old('job'))
        @php   $var = json_decode(old('job')); @endphp
        @for ($x = 0; $x < count($var); $x++)         
            <div class="form-group row mb-3" id="master">                  
                <div class="col-4">
                    <input type="text" name="job[]" class="form-control" value="{{$var[$x][0]}}" placeholder="Nama" required>
                </div>
                <div class="col-3">
                    <input type="month" name="first[]" class="form-control" value="{{$var[$x][1]}}" required>          
                </div>
                <div class="col-3 mb-3">
                    <input type="month" name="end[]" class="form-control mb-3" value="{{$var[$x][2]}}" required>            
                </div>
                <div class="col-4">
                    <input type="text" name="var[]" value="{{$var[$x][3]}}" class="form-control" placeholder="Pakerjaan" required>
                </div>           
            </div>
        @endfor
      @else
        <div class="form-group row mb-3" id="master">                  
                <div class="col-4">
                    <input type="text" name="job[]" class="form-control" placeholder="Nama">
                </div>
                <div class="col-3">
                    <input type="month" name="first[]" class="form-control">              
                </div>
                <div class="col-3 mb-3">                
                    <input type="month" name="end[]" class="form-control">  
                </div>
                <div class="col-4">
                    <input type="text" name="var[]" class="form-control" placeholder="Pakerjaan">
                </div>           
        </div>      
      @endif

    <div class="form-group row mb-3">
        <div class="col-md-12">                                     
            <div id="input-item" class="mt-3">                    
            </div>
            <button class="btn btn-success btn-sm rounded-pill" type="button" id="add-item">Tambah</button>      
        </div>
    </div>

    <div class="form-group row mb-3">
        <label class="my-3">Deskripsi Pekerjaan</label>
        <textarea class="form-control" rows="2" name="job_des">{{old('job_des')}}</textarea>              
          @error('job_des')<div class='small text-danger text-left'>{{$message}}</div>@enderror
    </div>

    <div class="mb-3 d-flex justify-content-between">
        <button class="btn btn-primary btn-block w-25 rounded-pill">Next</button>
        @if($data)
        <button type="button" class="btn btn-secondary btn-block w-25 rounded-pill" id="button-back">Back</button>     
        @endif
    </div>
  </div>             
</form>

@if($data)
<form action="{{route('daftar.back',['id'=>md5($user->id)])}}" id="back" method="post">                                                                       
    @csrf   
</form>
@endif

@push('js')
<script>

    function remove(e)
    {        
        e.parentNode.remove();
    }

    $('#add-item').on('click', function() {
        var originalDiv = $('#master');
        var clonedDiv = originalDiv.clone();
        clonedDiv.append('<button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)"  type="button"><i class="bi bi-trash"></i></button>');  
        $('#input-item').append(clonedDiv);
    });
</script>
@endpush