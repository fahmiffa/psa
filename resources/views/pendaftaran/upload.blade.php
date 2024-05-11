<form action="{{ route('daftar.next', ['id' => md5($user->id)]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="px-3">
        <div class="divider divider-center">
            <div class="divider-text">Upload FIle Dokumen</div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">Pas Photo background Putih <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input class="form-control" name="me" type="file" accept=".jpg, .jpeg, .png">
                @error('me')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">KTP <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input class="form-control" name="ktp" type="file" accept=".jpg, .jpeg, .png">
                @error('ktp')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">Akte Kelahiran <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input class="form-control" name="akte" type="file" accept=".jpg, .jpeg, .png">
                @error('akte')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">Kartu Keluarga <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input class="form-control" name="kk" type="file" accept=".jpg, .jpeg, .png">
                @error('kk')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">Surat Keterangan Sehat <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input class="form-control" name="sks" type="file" accept=".jpg, .jpeg, .png">
                @error('sks')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">Sertikat Vaksin COVID 19</label>
            <div class="col-md-8">
                <input class="form-control" name="covid" type="file" accept=".jpg, .jpeg, .png">
                @error('covid')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="divider divider-center">
            <div class="divider-text">Upload FIle Ijasah</div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">SD <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input class="form-control" name="sd" type="file" accept=".jpg, .jpeg, .png">
                @error('sd')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">SMP <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input class="form-control" name="smp" type="file" accept=".jpg, .jpeg, .png">
                @error('smp')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">SMA/SMK <span class="text-danger">*</span></label>
            <div class="col-md-8">
                <input class="form-control" name="sma" type="file" accept=".jpg, .jpeg, .png">
                @error('sma')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">S1</label>
            <div class="col-md-8">
                <input class="form-control" name="s1" type="file" accept=".jpg, .jpeg, .png">
                @error('s1')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="my-3">Promosi diri, harapan, pertanyaan, dll</label>
            <textarea class="form-control" rows="2" name="prom">{{ old('prom') }}</textarea>
            @error('prom')
                <div class='small text-danger text-left'>{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 d-flex justify-content-between">
            <button class="btn btn-primary btn-block w-25 rounded-pill">Next</button>
            @if ($data)
                <button type="button" class="btn btn-secondary btn-block w-25 rounded-pill"
                    id="button-back">Back</button>
            @endif
        </div>
    </div>
</form>

@if ($data)
    <form action="{{ route('daftar.back', ['id' => md5($user->id)]) }}" id="back" method="post">
        @csrf
    </form>
@endif
