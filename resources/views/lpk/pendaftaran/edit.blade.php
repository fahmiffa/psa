<form action="{{ route('lpk.update', ['id' => md5($da->id)]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="px-3">
        <div class="divider divider-center">
            <div class="divider-text">Identitas</div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Nama Lengkap</label>
            <div class="col-md-6">
                <input type="text" name="fullname" value="{{ $da->fullname }}" class="form-control">
                @error('fullname')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">Email</label>
            <div class="col-md-6">
                <input type="email" name="email" value="{{ $da->email }}" class="form-control">
                @error('email')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">Nomor HP</label>
            <div class="col-md-6">
                <input type="number" name="hp" value="{{ $da->hp }}" class="form-control">
                @error('hp')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">NIK</label>
            <div class="col-md-6">
                <input type="number" name="nik" value="{{ $da->nik }}" class="form-control">
                @error('nik')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Alamat</label>
            <div class="col-md-6">
                <textarea class="form-control" rows="3" name="alamat">{{ $da->alamat }}</textarea>
                @error('alamat')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">Provinsi</label>
            <div class="col-md-6">
                <input type="text" name="prov" value="{{ $da->prov }}" class="form-control">
                @error('prov')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">Kecamatan</label>
            <div class="col-md-6">
                <input type="text" name="kec" value="{{ $da->kec }}" class="form-control">
                @error('kec')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">Jenis Kelamin</label>
            <div class="col-md-6">
                <select class="form-control" name="gender">
                    <option value="1" @selected($da->gender == '1')>Perempuan</option>
                    <option value="2" @selected($da->gender == '2')>Laki-laki</option>
                </select>
                @error('gender')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">Tempat lahir</label>
            <div class="col-md-6">
                <input type="text" name="place_birth" value="{{ $da->place_birth }}" class="form-control">
                @error('place_birth')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">Tanggal lahir</label>
            <div class="col-md-6">
                <input type="date" name="date_birth" value="{{ $da->date_birth }}" class="form-control">
                @error('date_birth')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="divider divider-center">
            <div class="divider-text">Informasi</div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">Agama</label>
            <div class="col-md-6">
                <select class="form-control" name="religion">
                    <option value="1" @selected($da->religion == '1')>Islam</option>
                    <option value="2" @selected($da->religion == '2')>Kristen</option>
                    <option value="3" @selected($da->religion == '3')>Hindu</option>
                    <option value="4" @selected($da->religion == '4')>Buddha</option>
                    <option value="5" @selected($da->religion == '5')>Konghucu</option>
                </select>
                @error('gender')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">Status</label>
            <div class="col-md-6">
                <select class="form-control" name="married">
                    <option value="1" @selected($da->married == '1')>Menikah</option>
                    <option value="0" @selected($da->married == '0')>Belum Menikah</option>
                </select>
                @error('married')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-md-3">Tinggi Badan</label>
            <div class="col-md-6">
                <input type="number" name="tall" value="{{ $da->tall }}" class="form-control">
                @error('tall')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <div class="input-group">
                <label class="col-md-3">Berat Badan</label>
                <div class="col-md-6">
                    <input type="number" name="weight" value="{{ $da->weight }}" class="form-control">
                    @error('weight')
                        <div class='small text-danger text-left'>{{ $message }}</div>
                    @enderror
                </div>
                <span class="input-group-text">Kg</span>
            </div>
        </div>

        <div class="form-group row mb-3">
            <div class="input-group">
                <label class="col-md-3 text-wrap">Kekuatan Cengkraman</label>
                <div class="col-md-6">
                    <input type="number" name="power" value="{{ $da->power }}" class="form-control">
                    @error('power')
                        <div class='small text-danger text-left'>{{ $message }}</div>
                    @enderror
                </div>
                <span class="input-group-text">Kg</span>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Merokok</label>
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="smoker" type="checkbox"
                        {{ $da->smoker == 1 ? 'checked' : null }}>
                </div>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Meminum Alkohol</label>
            <div class="col-md-6">
                <div class="form-check form-switch">
                    <input class="form-check-input" name="alkohol" type="checkbox"
                        {{ $da->alkohol == 1 ? 'checked' : null }}>
                </div>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Golongan Darah</label>
            <div class="col-md-6">
                <input type="text" name="blood" value="{{ $da->blood }}" class="form-control">
                @error('blood')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Tangan Dominan</label>
            <div class="col-md-6">
                <select class="form-control" name="hand">
                    <option value="1" @selected($da->hand == '1')>Kanan</option>
                    <option value="2" @selected($da->hand == '2')>Kiri</option>
                </select>
                @error('hand')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Pembelajaran LPK</label>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="lpk" value="{{ $da->lpk }}" class="form-control">
                    @error('lpk')
                        <div class='small text-danger text-left'>{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="number" name="learning" value="{{ $da->learning }}" class="form-control">
                        <span class="input-group-text">Bulan</span>
                    </div>
                    @error('learning')
                        <div class='small text-danger text-left'>{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Daya Penglihatan</label>
            <div class="col-md-6">
                <select class="form-control" name="look">
                    <option value="1" @selected($da->look == '1')>Normal</option>
                    <option value="2" @selected($da->look == '2')>Tidak</option>
                </select>
                @error('look')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Pernah Ke jepang</label>
            <div class="col-md-6">
                <select class="form-control" name="japan">
                    <option value="1" @selected($da->japan == '1')>Ya</option>
                    <option value="2" @selected($da->japan == '2')>Tidak</option>
                </select>
                @error('japan')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Pernah Kecelakaan</label>
            <div class="col-md-6">
                <select class="form-control" name="accident">
                    <option value="1" @selected($da->accident == '1')>Ya</option>
                    <option value="2" @selected($da->accident == '2')>Tidak</option>
                </select>
                @error('accident')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Pernah Sakit Keras</label>
            <div class="col-md-6">
                <select class="form-control" name="sick">
                    <option value="1" @selected($da->sick == '1')>Ya</option>
                    <option value="2" @selected($da->sick == '2')>Tidak</option>
                </select>
                @error('sick')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Keahlian Khusus</label>
            <div class="col-md-6">
                <input type="text" name="skill" value="{{ $da->skill }}" class="form-control">
                @error('skill')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-3">Hobbi</label>
            <div class="col-md-6">
                <input type="text" name="hobbies" value="{{ $da->hobbies }}" class="form-control">
                @error('hobbies')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- family --}}
        <div class="divider divider-center my-3">
            <div class="divider-text">Keluarga</div>
        </div>
        <div id="input-item">
            @php
                $item = json_decode($da->family);
            @endphp

            @isset($item->ibu)
                @php  $ibu = $item->ibu; @endphp
                <div class="form-group row mb-3">
                    <label class="text-Captitalize">Ibu</label>
                    <input type="hidden" name="status[]" class="form-control" value="ibu">
                    @for ($i = 0; $i < count($ibu); $i++)
                        <div class="col-md-3">
                            <input type="text" name="ibu[]" class="form-control" value="{{ $ibu[$i] }}"
                                required>
                        </div>
                    @endfor
                    <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content"
                        onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>
                </div>
            @endisset

            @isset($item->kaka)
                @php  $kaka = $item->kaka; @endphp
                <div class="form-group row mb-3">
                    <label class="text-Captitalize">kaka</label>
                    <input type="hidden" name="status[]" class="form-control" value="kaka">
                    @for ($i = 0; $i < count($kaka); $i++)
                        <div class="col-md-3">
                            <input type="text" name="kaka[]" class="form-control" value="{{ $kaka[$i] }}"
                                required>
                        </div>
                    @endfor
                    <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content"
                        onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>
                </div>
            @endisset

            @isset($item->adik)
                @php  $adik = $item->adik; @endphp
                <div class="form-group row mb-3">
                    <label class="text-Captitalize">adik</label>
                    <input type="hidden" name="status[]" class="form-control" value="adik">
                    @for ($i = 0; $i < count($adik); $i++)
                        <div class="col-md-3">
                            <input type="text" name="'+adik+'[]" class="form-control" value="{{ $adik[$i] }}"
                                required>
                        </div>
                    @endfor
                    <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content"
                        onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>
                </div>
            @endisset

            @isset($item->ayah)
                @php  $ayah = $item->ayah; @endphp
                <div class="form-group row mb-3">
                    <label class="text-Captitalize">ayah</label>
                    <input type="hidden" name="status[]" class="form-control" value="ayah">
                    @for ($i = 0; $i < count($ayah); $i++)
                        <div class="col-md-3">
                            <input type="text" name="ayah[]" class="form-control" value="{{ $ayah[$i] }}"
                                required>
                        </div>
                    @endfor
                    <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content"
                        onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>
                </div>
            @endisset

            @isset($item->wali)
                @php  $wali = $item->wali; @endphp
                <div class="form-group row mb-3">
                    <label class="text-Captitalize">wali</label>
                    <input type="hidden" name="status[]" class="form-control" value="wali">
                    @for ($i = 0; $i < count($wali); $i++)
                        <div class="col-md-3">
                            <input type="text" name="wali[]" class="form-control" value="{{ $wali[$i] }}"
                                required>
                        </div>
                    @endfor
                    <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content"
                        onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>
                </div>
            @endisset
        </div>

        <div class="form-group row mb-3">
            <div class="col-md-6">
                <label>Status Keluarga</label>
                <div class="input-group">
                    <select class="form-control" name="stat" id="family">
                        <option value="">Status</option>
                        <option value="wali">Wali</option>
                        <option value="ayah">Ayah</option>
                        <option value="ibu">Ibu</option>
                        <option value="kaka">kaka</option>
                        <option value="adik">Adik</option>
                    </select>
                    <button class="btn btn-success btn-sm" type="button" id="add-item">Tambah</button>
                </div>
            </div>
            @error('wali')
                <div class='small text-danger text-left'>{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group row mb-3">
            <label class="my-3">Promosi diri, harapan, pertanyaan, dll</label>
            <textarea class="form-control" rows="2" name="prom">{{ $da->me }}</textarea>
            @error('me')
                <div class='small text-danger text-left'>{{ $message }}</div>
            @enderror
        </div>

        <div class="divider divider-center my-3">
            <div class="divider-text">Pendidikan</div>
        </div>
        <label class="my-3">Riwayat Pendiikan</label>
        @if ($da->study)
            @php   $var = json_decode($da->study); @endphp
            @for ($x = 0; $x < count($var); $x++)
                <div class="form-group row mb-3" id="master">
                    <div class="col-3">
                        <input type="text" name="studied[]" value="{{ $var[$x][0] }}" class="form-control"
                            placeholder="Nama Pendidikan">
                    </div>
                    <div class="col-3">
                        <input type="month" name="first[]" class="form-control" value="{{ $var[$x][1] }}">
                    </div>
                    <div class="col-3">
                        <input type="month" name="end[]" class="form-control" value="{{ $var[$x][2] }}">
                    </div>

                </div>
            @endfor
        @else
            <div class="form-group row mb-3" id="master">
                <div class="col-3">
                    <input type="text" name="studied[]" class="form-control" placeholder="Nama Pendidikan">
                </div>
                <div class="col-3">
                    <input type="month" name="first[]" class="form-control">
                </div>
                <div class="col-3">
                    <input type="month" name="end[]" class="form-control">
                </div>
            </div>
        @endif

        <div class="form-group row mb-3">
            <div class="col-md-12">
                <div id="input-study" class="mt-3">
                </div>
                <button class="btn btn-success btn-sm rounded-pill" type="button" id="add-study">Tambah</button>
            </div>
        </div>

        <div class="divider divider-center">
            <div class="divider-text">Pekerjaan</div>
        </div>
        <label class="my-3">Riwayat Pekerjaan</label>
        @if ($da->job)
            @php
                $var = json_decode($da->job);
            @endphp
            @for ($x = 0; $x < count($var); $x++)
                <div class="form-group row mb-3" id="master-job">
                    <div class="col-4">
                        <input type="text" name="job[]" class="form-control" value="{{ $var[$x][0] }}"
                            placeholder="Nama Perusahaan">
                    </div>
                    <div class="col-4">
                        <input type="month" name="firstJob[]" class="form-control" value="{{ $var[$x][1] }}">
                    </div>
                    <div class="col-4">
                        <input type="month" name="endJob[]" class="form-control" value="{{ $var[$x][2] }}">
                    </div>
                    <div class="col-4 mt-3">
                        <input type="text" name="var[]" value="{{ $var[$x][3] }}" class="form-control"
                            placeholder="Pakerjaan">
                    </div>
                </div>
            @endfor
        @else
            <div class="form-group row mb-3" id="master-job">
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
                <div id="input-job" class="mt-3">
                </div>
                <button class="btn btn-success btn-sm rounded-pill" type="button" id="add-job">Tambah</button>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="my-3">Deskripsi Pekerjaan</label>
            <textarea class="form-control" rows="2" name="job_des">{{ $da->job_des }}</textarea>
            @error('job_des')
                <div class='small text-danger text-left'>{{ $message }}</div>
            @enderror
        </div>

        <div class="divider divider-center">
            <div class="divider-text">Magang</div>
        </div>
        <label class="my-3">Riwayat Magang</label>
        @if ($da->magang)
            @php  $var = json_decode($da->magang); @endphp
            @for ($x = 0; $x < count($var); $x++)
                <div class="form-group row mb-3" id="master-magang">
                    <div class="col-4">
                        <input type="text" name="magang[]" value="{{ $var[$x][0] }}" class="form-control"
                            placeholder="Magang">
                    </div>
                    <div class="col-3">
                        <input type="month" name="firstMagang[]" class="form-control"
                            value="{{ $var[$x][1] }}">
                    </div>
                    <div class="col-3 mb-3">
                        <input type="month" name="endMagang[]" class="form-control mb-3"
                            value="{{ $var[$x][2] }}">
                    </div>
                    <div class="col-4">
                        <input type="text" name="ind[]" value="{{ $var[$x][3] }}" class="form-control"
                            placeholder="Industri">
                    </div>
                </div>
            @endfor
        @else
            <div class="form-group row mb-3" id="master-magang">
                <div class="col-4">
                    <input type="text" name="magang[]" class="form-control" placeholder="Nama Perusahaan">
                </div>
                <div class="col-3">
                    <input type="month" name="firstMagang[]" class="form-control">
                </div>
                <div class="col-3 mb-3">
                    <input type="month" name="endMagang[]" class="form-control">
                </div>
                <div class="col-4">
                    <input type="text" name="ind[]" class="form-control" placeholder="Industri">
                </div>
            </div>
        @endif


        <div class="form-group row mb-3">
            <div class="col-md-12">
                <div id="input-magang" class="mt-3">
                </div>
                <button class="btn btn-success btn-sm rounded-pill" type="button" id="add-magang">Tambah</button>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="my-3">Hal yang Dipelajari saat magang</label>
            <textarea class="form-control" rows="2" name="magang_des">{{ $da->magang_des }}</textarea>
            @error('magang_des')
                <div class='small text-danger text-left'>{{ $message }}</div>
            @enderror
        </div>

        <div class="divider divider-center">
            <div class="divider-text">Lisensi</div>
        </div>
        <label class="my-3">Riwayat Lisensi</label>
        @if ($da->lisensi)
            @php $var = json_decode($da->lisensi);  @endphp
            @for ($x = 0; $x < count($var); $x++)
                <div class="form-group row mb-3" id="master-lins">
                    <div class="col-4">
                        <input type="text" name="lisensi[]" value="{{ $var[$x][0] }}" class="form-control"
                            placeholder="Lisensi">
                    </div>
                    <div class="col-3">
                        <select class="form-control" name="waktu[]">
                            <option value="">Waktu</option>
                            @php $val = date('Y'); @endphp
                            @for ($i = 1; $i < 5; $i++)
                                <option value="{{ $val - $i }}" @selected($var[$x][1] == $val - $i)>
                                    {{ $val - $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="text" name="level[]" value="{{ $var[$x][2] }}" class="form-control"
                            placeholder="Level">
                    </div>
                </div>
            @endfor
        @else
            <div class="form-group row mb-3" id="master-lins">
                <div class="col-4">
                    <input type="text" name="lisensi[]" class="form-control" placeholder="Lisensi">
                </div>
                <div class="col-3">
                    <select class="form-control" name="waktu[]">
                        <option value="">Waktu</option>
                        @php $val = date('Y'); @endphp
                        @for ($i = 1; $i < 5; $i++)
                            <option value="{{ $val - $i }}">{{ $val - $i }}</option>
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
                <div id="input-lins" class="mt-3">
                </div>
                <button class="btn btn-success btn-sm rounded-pill" type="button" id="add-lins">Tambah</button>
            </div>
        </div>

        <div class="divider divider-center">
            <div class="divider-text">Upload FIle Dokumen</div>
        </div>


        <div class="form-group row mb-3">
            <label class="col-md-4">Pas Photo background Putih</label>
            <div class="col-md-4">
                <input class="form-control" name="me" type="file" accept=".jpg, .jpeg, .png">
                @error('me')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                @if ($da->file->photo)
                    <img src="{{ asset('storage/' . $da->file->photo) }}" class="w-25">
                @endif
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">KTP</label>
            <div class="col-md-4">
                <input class="form-control" name="ktp" type="file" accept=".jpg, .jpeg, .png">
                @error('ktp')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                @if ($da->file->ktp)
                    <img src="{{ asset('storage/' . $da->file->ktp) }}" class="w-25">
                @endif
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">Akte Kelahiran</label>
            <div class="col-md-4">
                <input class="form-control" name="akte" type="file" accept=".jpg, .jpeg, .png">
                @error('akte')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                @if ($da->file->akte)
                    <img src="{{ asset('storage/' . $da->file->akte) }}" class="w-25">
                @endif
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">Kartu Keluarga</label>
            <div class="col-md-4">
                <input class="form-control" name="kk" type="file" accept=".jpg, .jpeg, .png">
                @error('kk')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                @if ($da->file->kk)
                    <img src="{{ asset('storage/' . $da->file->kk) }}" class="w-25">
                @endif
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">Surat Keterangan Sehat</label>
            <div class="col-md-4">
                <input class="form-control" name="sks" type="file" accept=".jpg, .jpeg, .png">
                @error('sks')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                @if ($da->file->suratSehat)
                    <img src="{{ asset('storage/' . $da->file->suratSehat) }}" class="w-25">
                @endif
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">Sertikat Vaksin COVID 19</label>
            <div class="col-md-4">
                <input class="form-control" name="covid" type="file" accept=".jpg, .jpeg, .png">
                @error('covid')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                @if ($da->file->vaksin)
                    <img src="{{ asset('storage/' . $da->file->vaksin) }}" class="w-25">
                @endif
            </div>
        </div>

        <div class="divider divider-center">
            <div class="divider-text">Upload FIle Ijasah</div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">SD</label>
            <div class="col-md-4">
                <input class="form-control" name="sd" type="file" accept=".jpg, .jpeg, .png">
                @error('sd')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                @if ($da->file->sd)
                    <img src="{{ asset('storage/' . $da->file->sd) }}" class="w-25">
                @endif
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">SMP</label>
            <div class="col-md-4">
                <input class="form-control" name="smp" type="file" accept=".jpg, .jpeg, .png">
                @error('smp')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                @if ($da->file->smp)
                    <img src="{{ asset('storage/' . $da->file->smp) }}" class="w-25">
                @endif
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">SMA/SMK</label>
            <div class="col-md-4">
                <input class="form-control" name="sma" type="file" accept=".jpg, .jpeg, .png">
                @error('sma')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                @if ($da->file->sma)
                    <img src="{{ asset('storage/' . $da->file->sma) }}" class="w-25">
                @endif
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-md-4">S1</label>
            <div class="col-md-4">
                <input class="form-control" name="s1" type="file" accept=".jpg, .jpeg, .png">
                @error('s1')
                    <div class='small text-danger text-left'>{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4">
                @if ($da->file->s1)
                    <img src="{{ asset('storage/' . $da->file->s1) }}" class="w-25">
                @endif
            </div>
        </div>

        <div class="my-3 d-flex justify-content-start">
            <button class="btn btn-primary btn-block w-25 rounded-pill">Save</button>
        </div>
    </div>
</form>


@push('js')
    <script>
        function remove(e) {
            e.closest('.form-group').remove();
        }

        function capitalizeFirstLetter(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }



        $('#add-item').on('click', function() {
            var status = $('#family').val();
            const st = ["wali", "ayah", "ibu"];

            if (status) {
                var clonedDiv = $('#input-item');
                if (st.includes(status)) {
                    clonedDiv.append('<div class="form-group row mb-3">\
                                                <label class="text-Captitalize">' + capitalizeFirstLetter(status) + '</label>\
                                                <input type="hidden" name="status[]" class="form-control" value="' +
                        status + '">\
                                                <div class="col-md-3">\
                                                  <input type="text" name="' + status + '[]" class="form-control" placeholder="Nama" required>\
                                                </div>\
                                                <div class="col-md-3">\
                                                  <input type="number" name="' + status + '[]" class="form-control" placeholder="Umur" required>\
                                                </div> \
                                                <div class="col-md-3">\
                                                  <input type="number" name="' + status + '[]" class="form-control" placeholder="Nomor HP" required>\
                                                </div>\
                                                <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>\
                                            </div>\
                                          ');
                } else {
                    clonedDiv.append('<div class="form-group row mb-3">\
                                               <label class="text-Captitalize">' + capitalizeFirstLetter(status) + '</label>\
                                                <input type="hidden" name="status[]" class="form-control" value="' +
                        status + '">\
                                                <div class="col-md-3">\
                                                  <input type="text" name="' + status + '[]" class="form-control" placeholder="Nama" required>\
                                                </div>\
                                                <div class="col-md-3">\
                                                  <input type="number" name="' + status + '[]" class="form-control" placeholder="Umur" required>\
                                                </div> \
                                                <button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)" type="button"><i class="bi bi-trash"></i></button>\
                                            </div>\
                                          ');
                }
            } else {
                alert('Silahkan pilih status');
            }

        });

        function remove(e) {
            e.parentNode.remove();
        }

        $('#add-study').on('click', function() {
            var originalDiv = $('#master');
            var clonedDiv = originalDiv.clone();
            $('#input-study').append(clonedDiv);
        });

        $('#add-magang').on('click', function() {
            var originalDiv = $('#master-magang');
            var clonedDiv = originalDiv.clone();
            $('#input-magang').append(clonedDiv);
        });

        $('#add-lins').on('click', function() {
            var originalDiv = $('#master-lins');
            var clonedDiv = originalDiv.clone();
            $('#input-lins').append(clonedDiv);
        });

        $('#add-job').on('click', function() {
            var originalDiv = $('#master-job');
            var clonedDiv = originalDiv.clone();
            $('#input-job').append(clonedDiv);
        });
    </script>
@endpush
