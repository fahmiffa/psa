<form action="{{route('lpk.store',['id'=>md5($user->id)])}}" method="post">                                                                       
    @csrf           
    <div class="px-3">      
            <div class="divider divider-center">
                <div class="divider-text">Informasi</div>
            </div> 

            <div class="form-group row mb-3">
                <label class="col-md-3">Agama</label>
                <div class="col-md-6">
                    <select class="form-control" name="religion">
                        <option value="1" @selected(old('religion') == 1)>Islam</option>
                        <option value="2" @selected(old('religion') == 2)>Kristen</option>
                        <option value="3" @selected(old('religion') == 3)>Hindu</option>
                        <option value="4" @selected(old('religion') == 4)>Buddha</option>
                        <option value="5" @selected(old('religion') == 5)>Konghucu</option>
                    </select>
                    @error('gender')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-3">Status</label>
                <div class="col-md-6">
                    <select class="form-control" name="married">
                        <option value="1" @selected(old('married') == 1)>Menikah</option>
                        <option value="0" @selected(old('married') == 0)>Belum Menikah</option>
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
                <label class="col-md-3">Berat Badan</label>
                <div class="col-md-6">
                <div class="input-group">
                        <input type="number" name="weight" value="{{old('weight')}}"   class="form-control">
                        <span class="input-group-text">Kg</span>
                    </div>
                    @error('weight')<div class='small text-danger text-left'>{{$message}}</div>@enderror
            </div>
            </div>  
            <div class="form-group row mb-3">
                <label class="col-md-3 text-wrap">Kekuatan Cengkraman</label>
                <div class="col-md-6">
                        <div class="input-group">
                                <input type="number" name="power" value="{{old('power')}}"   class="form-control">
                                <span class="input-group-text">Kg</span>
                        </div>
                        @error('power')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                </div>
            </div>  
            <div class="form-group row mb-3">
                <label class="col-md-3">Merokok</label>
                <div class="col-md-6">
                    <div class="form-check form-switch">
                    <input class="form-check-input" name="smoker" type="checkbox" {{ (old('smoker') == 1) ? 'checked' : null }}>        
                </div>
            </div>
            </div>
            <div class="form-group row mb-3">
                <label class="col-md-3">Meminum Alkohol</label>
                <div class="col-md-6">
                    <div class="form-check form-switch">
                    <input class="form-check-input" name="alkohol" type="checkbox" {{ (old('alkohol') == 1) ? 'checked' : null }}>        
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
                        <option value="1" @selected(old('hand') == 1)>Kanan</option>
                        <option value="2" @selected(old('hand') == 2)>Kiri</option>
                    </select>
                    @error('hand')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                </div>
            </div>  
            <div class="form-group row mb-3">
                <label class="col-md-3">Pembelajaran LPK</label>
                <div class="col-md-6">
                    <div class="form-group">
                    <input type="text" name="lpk" value="{{ old('lpk') ? old('lpk') :  auth()->user()->name }}"  class="form-control">               
                    @error('lpk')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="number" name="learning" value="{{old('learning')}}"   class="form-control">
                            <span class="input-group-text">Bulan</span>
                        </div>
                        @error('learning')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                    </div>
            </div>    
            <div class="form-group row mb-3">
            <label class="col-md-3">Daya Penglihatan</label>
            <div class="col-md-6">
                <select class="form-control" name="look">
                    <option value="1" @selected(old('look') == 1)>Normal</option>
                    <option value="2" @selected(old('look') == 2)>Tidak</option>
                </select>
                @error('look')<div class='small text-danger text-left'>{{$message}}</div>@enderror
            </div>
            </div>  
            <div class="form-group row mb-3">
            <label class="col-md-3">Pernah Ke jepang</label>
            <div class="col-md-6">
                <select class="form-control" name="japan">
                    <option value="1" @selected(old('japan') == 1)>Ya</option>
                    <option value="2" @selected(old('japan') == 2)>Tidak</option>
                </select>
                @error('japan')<div class='small text-danger text-left'>{{$message}}</div>@enderror
            </div>
            </div>  
            <div class="form-group row mb-3">
            <label class="col-md-3">Pernah Kecelakaan</label>
            <div class="col-md-6">
                <select class="form-control" name="accident">
                    <option value="1"  @selected(old('accident') == 2)>Ya</option>
                    <option value="2"  @selected(old('accident') == 2)>Tidak</option>
                </select>
                @error('accident')<div class='small text-danger text-left'>{{$message}}</div>@enderror
            </div>
            </div>  
            <div class="form-group row mb-3">
            <label class="col-md-3">Pernah Sakit Keras</label>
            <div class="col-md-6">
                <select class="form-control" name="sick">
                    <option value="1"  @selected(old('sick') == 2)>Ya</option>
                    <option value="2"  @selected(old('sick') == 2)>Tidak</option>
                </select>
                @error('sick')<div class='small text-danger text-left'>{{$message}}</div>@enderror
            </div>
            </div>  
            <div class="form-group row mb-3">
            <label class="col-md-3">Keahlian Khusus</label>
            <div class="col-md-6">
                <input type="text" name="skill" value="{{old('skill')}}" class="form-control">
                @error('skill')<div class='small text-danger text-left'>{{$message}}</div>@enderror
            </div>
            </div>  
            <div class="form-group row mb-3">
            <label class="col-md-3">Hobbi</label>
            <div class="col-md-6">
                <input type="text" name="hobbies" value="{{old('hobbies')}}" class="form-control">
                @error('hobbies')<div class='small text-danger text-left'>{{$message}}</div>@enderror
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
<form action="{{route('lpk.back',['id'=>md5($user->id)])}}" id="back" method="post">                                                                       
    @csrf   
</form>
@endif

@push('js')
<script>    
    document.getElementById('button-back').addEventListener('click',function(e){        
        document.getElementById('back').submit();
    });
</script>
@endpush