<form action="{{route('daftar.next',['id'=>md5($user->id)])}}" method="post">                                                                       
  @csrf           


  <div class="px-3">
      <div class="divider divider-center">
          <div class="divider-text">Identitas</div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Nama Lengkap</label>
        <div class="col-md-6">
            <input type="text" name="fullname" value="{{old('fullname')}}"   class="form-control">
            @error('fullname')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
    </div>
    <div class="form-group row mb-3">
        <label class="col-md-3">NIK</label>
        <div class="col-md-6">
            <input type="number" name="nik" value="{{old('nik')}}"   class="form-control">
            @error('nik')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
    </div>
      <div class="form-group row mb-3">
          <label class="col-md-3">Alamat</label>
          <div class="col-md-6">
            <textarea class="form-control" rows="3" name="alamat">{{old('alamat')}}</textarea>              
              @error('alamat')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
      </div>      

      <div class="form-group row mb-3">
        <label class="col-md-3">Provinsi</label>
        <div class="col-md-6">
            <input type="text" name="prov" value="{{old('prov')}}"   class="form-control">
            @error('prov')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
    </div>

    <div class="form-group row mb-3">
        <label class="col-md-3">Kecamatan</label>
        <div class="col-md-6">
            <input type="text" name="kec" value="{{old('kec')}}"   class="form-control">
            @error('kec')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
    </div>
    
      <div class="form-group row mb-3">
        <label class="col-md-3">Jenis Kelamin</label>
        <div class="col-md-6">
            <select class="form-control" name="gender">
              <option value="1" @selected(old('gender') == '1')>Perempuan</option>
              <option value="2" @selected(old('gender') == '2')>Laki-laki</option>
            </select>
            @error('gender')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>
      <div class="form-group row mb-3">
          <label class="col-md-3">Tempat lahir</label>
          <div class="col-md-6">
              <input type="text" name="place_birth" value="{{old('place_birth')}}"   class="form-control">
              @error('place_birth')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
      </div>
      <div class="form-group row mb-3">
          <label class="col-md-3">Tanggal lahir</label>
          <div class="col-md-6">
              <input type="date" name="date_birth" value="{{old('date_birth')}}"   class="form-control">
              @error('date_birth')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
      </div>

      <div class="mb-3 d-flex justify-content-start">
          <button class="btn btn-primary btn-block w-25 rounded-pill">Next</button>
      </div>
  </div>             
</form>