<div class="row my-3">
    <div class="col-md-8">
        
        <div class="form-group row mb-3">
            <label class="col-md-6">
                Tanggal Dokumen
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" class="form-control">    
            </div>          
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-6">
                ローマ字<br>Huruf Romawi
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value="{{strtoupper($da->fullname)}}"   class="form-control">    
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-6">
                性別<br>
                Jenis kelamin                
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value="{{($da->gender == 1) ? 'LAKI-LAKI' : 'WANITA' }}"   class="form-control">    
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-6">
                漢字<br>Kanji
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value=""   class="form-control">    
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-6">
                Tanggal Lahir<br>生年月日  
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value="{{$da->date_birth}}"   class="form-control">    
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-6">
                Alamat<br>住所地  
            </label>
            <div class="col-md-6">
                <textarea class="form-control" name="item[]">{{$da->alamat}}, {{$da->kec}}, {{$da->prov}}</textarea>        
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-6">
                修得等をしようとする技能等に係る職歴<br>
                Pengalaman kerja yang berhubungan dengan keterampilan yang akan diperoleh saat magang   
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value="縫製"   class="form-control"> 
                <br>
                <input type="text" name="item[]" value="1"   class="form-control"> 
                <br>
                <input type="text" name="item[]" value="Menjahit  1"   class="form-control" placeholder="Jenis pekerjaan ">    
            </div>
        </div>

        <div class="form-group row mb-3" id="master">        
            <div class="col-md-12">
                <label>Pengalaman Kerja</label>
                @for ($i = 0; $i < 3; $i++)                    
                <div class="row mb-3">
                    <div class="col-3">
                        <input type="text" name="job[]" class="form-control" placeholder="Nama Perusahaan">
                    </div>
                    <div class="col-3">
                        <input type="month" name="first[]" class="form-control">              
                    </div>
                    <div class="col-3">                
                        <input type="month" name="end[]" class="form-control">  
                    </div>
                    <div class="col-3">
                        <input type="text" name="var[]" class="form-control" placeholder="Jenis Pakerjaan">
                    </div>           
                </div>              
                @endfor
            </div>             
    </div>
                
        
    </div>   
</div>