<form action="{{route('daftar.next',['id'=>md5($user->id)])}}" method="post">                                                                       
  @csrf           
  <div class="px-3">      
      <div class="divider divider-center my-3">
        <div class="divider-text">Lisensi</div>
      </div>      
      <label class="my-3">Data Lisensi</label>
      @If(old('lisensi'))
      @php $var = json_decode(old('lisensi')); 
      @endphp
        @for ($x = 0; $x < count($var); $x++)            
            <div class="form-group row mb-3" id="master">                  
                <div class="col-4">
                    <input type="text" name="lisensi[]" value="{{$var[$x][0]}}" class="form-control" placeholder="Lisensi" required>
                </div>   
                <div class="col-3">
                    <select class="form-control" name="waktu[]" required>
                        <option value="">Waktu</option>
                        @php $val = date('Y'); @endphp
                        @for ($i = 1; $i < 5; $i++)
                            <option value="{{$val-$i}}" @selected($var[$x][1] == $val-$i )>{{$val-$i}}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-3">
                    <input type="text" name="level[]" value="{{$var[$x][2]}}" class="form-control" placeholder="Level" required>
                </div>           
            </div>
        @endfor
      @else
        <div class="form-group row mb-3" id="master">                  
            <div class="col-4">
                <input type="text" name="lisensi[]" class="form-control" placeholder="Lisensi">
            </div>   
            <div class="col-3">
                <select class="form-control" name="waktu[]">
                    <option value="">Waktu</option>
                    @php $val = date('Y'); @endphp
                    @for ($i = 1; $i < 5; $i++)
                        <option value="{{$val-$i}}">{{$val-$i}}</option>
                    @endfor
                </select>
            </div>
            <div class="col-3">
                <input type="text" name="level[]" class="form-control" placeholder="Level">
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