<form action="{{route('lpk.next',['id'=>md5($user->id)])}}" method="post">                                                                       
  @csrf           
  <div class="px-3">

      <div class="divider divider-center my-3">
        <div class="divider-text">Keluarga</div>
      </div>

      <div class="form-group row mb-3">  
            <div class="col-md-3">
                <label>Status Keluarga</label>
                <div class="input-group">
                  <select class="form-control" name="stat" id="family" required>
                    <option value="">Status</option>
                    <option value="wali">Wali</option>
                    <option value="ayah">Ayah</option>
                    <option value="ibu">Ibu</option>
                    <option value="suami">Suami</option>
                    <option value="istri">Istri</option>
                    <option value="kakak">kakak</option>
                    <option value="adik">Adik</option>                  
                  </select>
                  <button class="btn btn-success btn-sm" type="button" id="add-item">Tambah</button>                   
                </div>
            </div>                     
            @error('wali')<div class='small text-danger text-left'>{{$message}}</div>@enderror
      </div> 

        <div id="input-item">
            @if(old('family'))
             @php 
                $item = json_decode(old('family'));                  
             @endphp       

             @isset($item->ibu)
                @php  $ibu = $item->ibu; @endphp       
              <div class="form-group row mb-3">
                    <label class="text-Captitalize">Ibu</label>
                    <input type="hidden" name="status[]" class="form-control" value="ibu">
                    @for($i=0; $i < count($ibu); $i++)
                    <div class="col-md-3">
                      <input type="text" name="ibu[]" class="form-control" value="{{$ibu[$i]}}" required>
                    </div>
                    @endfor      
                    <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>
                </div>
             @endisset

             @isset($item->kaka)
                @php  $kaka = $item->kaka; @endphp       
              <div class="form-group row mb-3">
                    <label class="text-Captitalize">kaka</label>
                    <input type="hidden" name="status[]" class="form-control" value="kaka">
                    @for($i=0; $i < count($kaka); $i++)
                    <div class="col-md-3">
                      <input type="text" name="kaka[]" class="form-control" value="{{$kaka[$i]}}" required>
                    </div>
                    @endfor      
                    <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>
                </div>
             @endisset

             @isset($item->adik)
                @php  $adik = $item->adik; @endphp       
              <div class="form-group row mb-3">
                    <label class="text-Captitalize">adik</label>
                    <input type="hidden" name="status[]" class="form-control" value="adik">
                    @for($i=0; $i < count($adik); $i++)
                    <div class="col-md-3">
                      <input type="text" name="'+adik+'[]" class="form-control" value="{{$adik[$i]}}" required>
                    </div>
                    @endfor      
                    <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>
                </div>
             @endisset

             @isset($item->ayah)
                @php  $ayah = $item->ayah; @endphp       
              <div class="form-group row mb-3">
                    <label class="text-Captitalize">ayah</label>
                    <input type="hidden" name="status[]" class="form-control" value="ayah">
                    @for($i=0; $i < count($ayah); $i++)
                    <div class="col-md-3">
                      <input type="text" name="ayah[]" class="form-control" value="{{$ayah[$i]}}" required>
                    </div>
                    @endfor      
                    <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>
                </div>
             @endisset


             @isset($item->wali)
                @php  $wali = $item->wali; @endphp       
              <div class="form-group row mb-3">
                    <label class="text-Captitalize">wali</label>
                    <input type="hidden" name="status[]" class="form-control" value="wali">
                    @for($i=0; $i < count($wali); $i++)
                    <div class="col-md-3">
                      <input type="text" name="wali[]" class="form-control" value="{{$wali[$i]}}" required>
                    </div>
                    @endfor      
                    <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>
                </div>
             @endisset

            @endif
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
        e.closest('.form-group').remove();  
    }

    function capitalizeFirstLetter(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    }


    $('#add-item').on('click', function() {
      var status = $('#family').val();        
      const st = ["wali", "ayah", "ibu"];

      if(status)
      {         
          var clonedDiv =  $('#input-item');                          
          if(st.includes(status))
          {
            clonedDiv.append('<div class="form-group row mb-3">\
                                <label class="text-Captitalize">'+capitalizeFirstLetter(status)+'</label>\
                                <input type="hidden" name="status[]" class="form-control" value="'+status+'">\
                                <div class="col-md-3">\
                                  <input type="text" name="'+status+'[]" class="form-control" placeholder="Nama" required>\
                                </div>\
                                <div class="col-md-3">\
                                  <input type="number" name="'+status+'[]" class="form-control" placeholder="Umur" required>\
                                </div> \
                                <div class="col-md-3">\
                                  <input type="number" name="'+status+'[]" class="form-control" placeholder="Nomor HP" required>\
                                </div>\
                                <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>\
                            </div>\
                          ');   
          }         
          else
          {
            clonedDiv.append('<div class="form-group row mb-3">\
                               <label class="text-Captitalize">'+capitalizeFirstLetter(status)+'</label>\
                                <input type="hidden" name="status[]" class="form-control" value="'+status+'">\
                                <div class="col-md-3">\
                                  <input type="text" name="'+status+'[]" class="form-control" placeholder="Nama" required>\
                                </div>\
                                <div class="col-md-3">\
                                  <input type="number" name="'+status+'[]" class="form-control" placeholder="Umur" required>\
                                </div> \
                                <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>\
                            </div>\
                          ');
          }
      }
      else
      {
        alert('Silahkan pilih status');
      }

    });

    document.getElementById('button-back').addEventListener('click',function(e){        
        document.getElementById('back').submit();
    });

</script>
@endpush