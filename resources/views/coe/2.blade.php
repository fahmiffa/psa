<div class="row my-3">
    <div class="col-md-9">
        
        <div class="form-group row mb-3">
            <label class="col-md-4">
                Nama<br>名前
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value="{{$da->fullname}}"   class="form-control">    
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-4">
                NIK
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value="{{$da->nik}}"   class="form-control">    
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-4">
                Tanggal Lahir<br>生年月日  
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value="{{$da->date_birth}}"   class="form-control">    
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-4">
                Alamat<br>住所地  
            </label>
            <div class="col-md-6">
                <textarea class="form-control" name="item[]">{{$da->alamat}}, {{$da->kec}}, {{$da->prov}}</textarea>        
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-4">
                Golongan Darah <br>血液型  
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value="{{$da->blood}}"   class="form-control">    
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-4">
                Agama <br>宗教
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value="{{typeReligion($da->religion)}}"   class="form-control">    
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-4">
                Status Kawin KTP <br>婚姻　       
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value=""   class="form-control">    
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-4">
                Status Kerja KTP <br>職                       
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value=""   class="form-control">    
            </div>
        </div>
        
        <div class="form-group row mb-3">
            <label class="col-md-4">
                Tempat,Tanggal Terbit KTP <br>職                       
            </label>
            <div class="col-md-6">
                <input type="text" name="item[]" value=""   class="form-control">    
            </div>
        </div>
        
    </div>
    <div class="col-md-3">
        <img src="{{asset('storage/'.$pile->ktp)}}" class="mx-auto d-block img-fluid">
    </div>
</div>