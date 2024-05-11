<form action="{{route('student.store')}}" method="post">                                                                        
  @csrf           
  <div class="px-3">
      <div class="divider divider-center">
          <div class="divider-text">Identitas</div>
      </div>

      <div class="form-group row mb-3">
          <label class="col-md-3">Alamat</label>
          <div class="col-md-6">
            <textarea class="form-control" rows="3" name="alamat">{{old('alamat')}}</textarea>              
              @error('alamat')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-md-3">Jenis Kelamin</label>
        <div class="col-md-6">
            <select class="form-control" name="gender">
              <option value="1">Perempuan</option>
              <option value="2">Laki-laki</option>
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

      <div class="divider divider-center">
          <div class="divider-text">Informasi</div>
      </div> 

      <div class="form-group row mb-3">
        <label class="col-md-3">Agama</label>
        <div class="col-md-6">
            <select class="form-control" name="religion">
              <option value="1">Islam</option>
              <option value="2">Kristen</option>
              <option value="3">Hindu</option>
              <option value="4">Buddha</option>
              <option value="5">Konghucu</option>
            </select>
            @error('gender')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>
      <div class="form-group row mb-3">
        <label class="col-md-3">Status</label>
        <div class="col-md-6">
            <select class="form-control" name="married">
              <option value="1">Menikah</option>
              <option value="0">Belum Menikah</option>
            </select>
            @error('married')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>    
      <div class="form-group row mb-3">
          <label class="col-md-3">Tinggi Badan</label>
          <div class="col-md-6">
              <input type="number" name="tall" value="{{old('tall')}}"   class="form-control">
              @error('tall')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
      </div>

      <div class="form-group row mb-3">
        <div class="input-group">
          <label class="col-md-3">Berat Badan</label>
          <div class="col-md-6">
              <input type="number" name="weight" value="{{old('weight')}}"   class="form-control">
              @error('weight')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
          <span class="input-group-text">Kg</span>
        </div>
      </div>

      <div class="form-group row mb-3">
        <div class="input-group">
          <label class="col-md-3 text-wrap">Kekuatan Cengkraman</label>
          <div class="col-md-6">
              <input type="number" name="power" value="{{old('power')}}"   class="form-control">
              @error('power')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
          <span class="input-group-text">Kg</span>
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Merokok</label>
        <div class="col-md-6">
          <div class="form-check form-switch">
            <input class="form-check-input" name="smoker" type="checkbox" checked>        
        </div>
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Meminum Alkohol</label>
        <div class="col-md-6">
          <div class="form-check form-switch">
            <input class="form-check-input" name="alkohol" type="checkbox" checked>        
        </div>
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Golongan Darah</label>
        <div class="col-md-6">
            <input type="text" name="blood" value="{{old('blood')}}"   class="form-control">
            @error('blood')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Tangan Dominan</label>
        <div class="col-md-6">
            <select class="form-control" name="hand">
              <option value="1">Kanan</option>
              <option value="2">Kiri</option>
            </select>
            @error('hand')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      <div class="form-group row mb-3">
        <div class="input-group">
          <label class="col-md-3">Lama Belajar</label>
          <div class="col-md-6">
              <input type="number" name="learning" value="{{old('learning')}}"   class="form-control">
              @error('learning')<div class='small text-danger text-left'>{{$message}}</div>@enderror
          </div>
          <span class="input-group-text">Bulan</span>
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Daya Penglihatan</label>
        <div class="col-md-6">
            <select class="form-control" name="look">
              <option value="1">Kanan</option>
              <option value="2">Kiri</option>
            </select>
            @error('look')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Pernah Ke jepang</label>
        <div class="col-md-6">
            <select class="form-control" name="japan">
              <option value="1">Ya</option>
              <option value="2">Tidak</option>
            </select>
            @error('japan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Pernah Kecelakaan</label>
        <div class="col-md-6">
            <select class="form-control" name="accident">
              <option value="1">Ya</option>
              <option value="2">Tidak</option>
            </select>
            @error('accident')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Pernah Sakit Keras</label>
        <div class="col-md-6">
            <select class="form-control" name="sick">
              <option value="1">Ya</option>
              <option value="2">Tidak</option>
            </select>
            @error('sick')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Keahlian Khusus</label>
        <div class="col-md-6">
            <input type="text" name="skill" value="{{old('skill')}}"   class="form-control">
            @error('skill')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Hobbi</label>
        <div class="col-md-6">
            <input type="text" name="hobbies" value="{{old('hobbies')}}"   class="form-control">
            @error('hobbies')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
      </div>

      {{-- family --}}
      <div class="divider divider-center my-3">
        <div class="divider-text">Keluarga</div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Ayah</label>
        <div class="col-md-3">
            <input type="text" name="dad" value="{{old('dad')}}"   class="form-control" placeholder="Nama">
            @error('dad')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
        <div class="col-md-3">
          <input type="number" name="ageDad" value="{{old('ageDad')}}"   class="form-control" placeholder="Umur">
          @error('ageDad')<div class='small text-danger text-left'>{{$message}}</div>@enderror
      </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Ibu</label>
        <div class="col-md-3">
            <input type="text" name="mom" value="{{old('mom')}}"   class="form-control" placeholder="Nama">
            @error('mom')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
        <div class="col-md-3">
          <input type="number" name="ageMom" value="{{old('ageMom')}}"   class="form-control" placeholder="Umur">
          @error('ageMom')<div class='small text-danger text-left'>{{$message}}</div>@enderror
      </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Kakak</label>
        <div class="col-md-3">
            <input type="text" name="bro" value="{{old('bro')}}"   class="form-control" placeholder="Nama">
            @error('bro')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
        <div class="col-md-3">
          <input type="number" name="ageBro" value="{{old('ageBro')}}"   class="form-control" placeholder="Umur">
          @error('ageBro')<div class='small text-danger text-left'>{{$message}}</div>@enderror
      </div>
      </div>

      <div class="form-group row mb-3">
        <label class="col-md-3">Adik</label>
        <div class="col-md-3">
            <input type="text" name="sis" value="{{old('sis')}}"   class="form-control" placeholder="Nama">
            @error('sis')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
        <div class="col-md-3">
          <input type="number" name="ageSis" value="{{old('ageSis')}}"   class="form-control" placeholder="Umur">
          @error('ageSis')<div class='small text-danger text-left'>{{$message}}</div>@enderror
      </div>
      </div>

      <div class="form-group row mb-3">
        <label class="my-3">Promosi diri, harapan, pertanyaan, dll</label>
        <textarea class="form-control" rows="2" name="me">{{old('me')}}</textarea>              
          @error('me')<div class='small text-danger text-left'>{{$message}}</div>@enderror
      </div>


      <div class="divider divider-center my-3">
        <div class="divider-text">Pendidikan</div>
      </div>      
      <label class="my-3">Riwayat Pendiikan</label>
      @for ($i = 0; $i < 5; $i++)          
      <div class="form-group row mb-3">
        <label class="col-1">{{$i+1}}.</label>
        <div class="col-6">
            <input type="text" name="studied[{{$i}}]" class="form-control" placeholder="Nama Pendidikan">
            @error('studied')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>
        <div class="col-5">
          <input type="number" name="perioded[{{$i}}]" class="form-control" placeholder="Periode">
          @error('perioded')<div class='small text-danger text-left'>{{$message}}</div>@enderror
        </div>

      </div>
      @endfor

      <div class="divider divider-center">
        <div class="divider-text">Pekerjaan</div>
      </div>
      <label class="my-3">Riwayat Pekerjaan</label>
      @for ($i = 0; $i < 5; $i++)          
      <div class="form-group row mb-3">
        <label class="col-1">{{$i+1}}.</label>
        <div class="col-3">
            <input type="text" name="job[{{$i}}]"  class="form-control" placeholder="Nama Perusahaan">     
        </div>
        <div class="col-3">
          <input type="text" name="jobPeriod[{{$i}}]" class="form-control" placeholder="Periode">
        </div>

        <div class="col-2">
          <input type="text" name="var[{{$i}}]"  class="form-control" placeholder="Jenis Pakerjaan">      
        </div>

      </div>
      @endfor

    <div class="form-group row mb-3">
        <label class="my-3">Deskripsi Pekerjaan</label>
        <textarea class="form-control" rows="2" name="job_des">{{old('job_des')}}</textarea>              
          @error('job_des')<div class='small text-danger text-left'>{{$message}}</div>@enderror
    </div>

      <div class="divider divider-center">
        <div class="divider-text">Magang</div>
      </div>
      <label class="my-3">Riwayat Magang</label>
      @for ($i = 0; $i < 5; $i++)          
      <div class="form-group row mb-3">
        <label class="col-1">{{$i+1}}.</label>
        <div class="col-3">
            <input type="text" name="magang[{{$i}}]"  class="form-control" placeholder="Nama Fasilitas Pelatihan">     
        </div>
        <div class="col-3">
          <input type="text" name="magangPeriod[{{$i}}]" class="form-control" placeholder="Periode">
        </div>

        <div class="col-2">
          <input type="text" name="ind[{{$i}}]"  class="form-control" placeholder="Industri">      
        </div>

      </div>
      @endfor

    <div class="form-group row mb-3">
        <label class="my-3">Hal yang Dipelajari saat magang</label>
        <textarea class="form-control" rows="2" name="magang_des">{{old('magang_des')}}</textarea>              
          @error('magang_des')<div class='small text-danger text-left'>{{$message}}</div>@enderror
    </div>

      <div class="divider divider-center">
        <div class="divider-text">Lisensi</div>
      </div>
      <label class="my-3">Riwayat Lisensi</label>
      @for ($i = 0; $i < 5; $i++)          
      <div class="form-group row mb-3">
        <label class="col-1">{{$i+1}}.</label>
        <div class="col-3">
            <input type="text" name="lin[{{$i}}]"  class="form-control" placeholder="Lisensi">     
        </div>
        <div class="col-3">
          <input type="number" name="level[{{$i}}]" class="form-control" placeholder="Level">
        </div>

        <div class="col-2">
          <input type="number" name="time[{{$i}}]"  class="form-control" placeholder="Periode">      
        </div>

      </div>
      @endfor

      <div class="mb-3 d-flex justify-content-start">
          <button class="btn btn-primary btn-block w-25 rounded-pill">Next</button>
      </div>
  </div>             
</form>