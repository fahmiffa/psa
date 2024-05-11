<form action="{{route('lpk.next',['id'=>md5($user->id)])}}" method="post">                                                                       
  @csrf           
  <div class="px-3">      
      <div class="divider divider-center my-3">
        <div class="divider-text">Magang</div>
      </div>      
      <label class="my-3">Riwayat Magang</label>
  
      @If(old('magang'))      
      @php   
      $var = json_decode(old('magang')); 
      @endphp
      @for ($x = 0; $x < count($var); $x++)            
          <div class="form-group row mb-3" id="master">                  
              <div class="col-4">
                  <input type="text" name="magang[]" value="{{$var[$x][0]}}" class="form-control" placeholder="Magang" required>
              </div>   
              <div class="col-3">
                  <input type="month" name="first[]" class="form-control" value="{{$var[$x][1]}}" required>          
              </div>
              <div class="col-3 mb-3">
                  <input type="month" name="end[]" class="form-control mb-3" value="{{$var[$x][2]}}" required>            
              </div>
              <div class="col-4">
                  <input type="text" name="ind[]" value="{{$var[$x][3]}}" class="form-control" placeholder="Industri" required>
              </div>    
          </div>
      @endfor
    @else
      <div class="form-group row mb-3" id="master">                  
          <div class="col-4">
              <input type="text" name="magang[]" class="form-control" placeholder="Nama Perusahaan">
          </div>
          <div class="col-3">
              <input type="month" name="first[]" class="form-control">              
          </div>
          <div class="col-3 mb-3">                
              <input type="month" name="end[]" class="form-control">  
          </div>
          <div class="col-4">
              <input type="text" name="ind[]" class="form-control" placeholder="Industri">
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
        <label class="my-3">Hal yang Dipelajari saat magang</label>
        <textarea class="form-control" rows="2" name="magang_des">{{old('magang_des')}}</textarea>              
          @error('magang_des')<div class='small text-danger text-left'>{{$message}}</div>@enderror
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
<form action="{{route('lpk.back',['id'=>md5($user->id)])}}" id="back" method="post">                                                                       
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

    
    document.getElementById('button-back').addEventListener('click',function(e){        
        document.getElementById('back').submit();
    });
</script>
@endpush