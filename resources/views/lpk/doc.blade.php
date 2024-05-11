@extends('layout.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <style>
        .imgs {
            object-fit: cover;
            height: 50px;
            width: 80px;
        }
    </style>
@endpush
@section('main')
    <div class="page-heading px-3">
        @if (session('error'))
            <div class="alert alert-danger" id="timeoutAlert" role="alert">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" id="timeoutAlert" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

    </div>

    <div class="page-content px-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <div class="d-flex justify-content-between py-3">
                            <div class="p-2">
                                <h5 class="card-title">Data {{ $da->fullname }}</h5>
                            </div>
                            <div class="p-2">
                                <a href="{{ route('download', ['id' => md5($da->users_id)]) }}"
                                    class="btn btn-dark rounded-pill btn-sm">Download</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            $visa = session('visa');
                            $rekom = session('passport');
                        @endphp
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $visa || $rekom ? null : 'active' }}" id="cv-tab"
                                    data-bs-toggle="tab" href="#cv" role="tab">CV</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="vid-tab" data-bs-toggle="tab" href="#vid"
                                    role="tab">Video</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $visa ? 'active' : null }}" id="coe-tab" data-bs-toggle="tab"
                                    href="#coe" role="tab">VISA</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{ $rekom ? 'active' : null }}" id="rekom-tab" data-bs-toggle="tab"
                                    href="#rekom" role="tab">Passport Rekom</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade {{ $visa || $rekom ? null : 'active show' }}" id="cv"
                                role="tabpanel" aria-labelledby="cv-tab">
                                <div class="row my-3">
                                    <div class="col-md-12">
                                        <form action="{{ route('cv.store.lpk', ['id' => md5($da->user->id)]) }}"
                                            method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="divider divider-left-center">
                                                    <div class="divider-text h6">Identitas</div>
                                                </div>
                                                <div class="row px-3">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Nama Lengkap</label>
                                                                    <p class="form-control-static">{{ $da->fullname }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">NIK</label>
                                                                    <p class="form-control-static">{{ $da->nik }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Jenis Kelamin</label>
                                                                    <p class="form-control-static">
                                                                        {{ $da->gender == '1' ? 'Perempuan' : 'Laki-laki' }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Phone</label>
                                                                    <p class="form-control-static">{{ $da->hp }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Tempat Lahir</label>
                                                                    <p class="form-control-static">{{ $da->place_birth }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Tanggal Lahir</label>
                                                                    <p class="form-control-static">{{ $da->date_birth }}
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="disabledInput">Alamat</label>
                                                                    <p class="form-control-static">{{ $da->alamat }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                @isset($dataj)
                                                                    @php $da = $dataj; @endphp
                                                                @endisset
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Nama Lengkap</label>
                                                                    <input type="text" class="form-control"
                                                                        name="fullname" value="{{ $da->fullname }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">NIK</label>
                                                                    <input type="text" class="form-control"
                                                                        name="nik" value="{{ $da->nik }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Jenis Kelamin</label>
                                                                    <input type="text" class="form-control"
                                                                        name="gender"
                                                                        value="{{ $da->gender == '1' ? 'Perempuan' : 'Laki-laki' }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Phone</label>
                                                                    <input type="text" class="form-control"
                                                                        name="hp" value="{{ $da->hp }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Tempat Lahir</label>
                                                                    <input type="text" class="form-control"
                                                                        name="place_birth"
                                                                        value="{{ $da->place_birth }}">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Tanggal Lahir</label>
                                                                    <input type="date" class="form-control"
                                                                        name="date_birth" value="{{ $da->date_birth }}">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="disabledInput">Alamat</label>
                                                                    <input type="text" class="form-control"
                                                                        name="alamat" value="{{ $da->alamat }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row px-3">
                                                    <div class="row">
                                                        <div class="divider divider-left-center">
                                                            <div class="divider-text h6">Informasi</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            @php $da = $data; @endphp
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Agama</label>
                                                                    <p class="form-control-static">
                                                                        {{ typeReligion($da->religion) }}</p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Status</label>
                                                                    <p class="form-control-static">
                                                                        {{ $da->married == '1' ? 'Menikah' : 'Belum Menikah' }}
                                                                    </p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Tinggi Badan</label>
                                                                    <p class="form-control-static">{{ $da->tall }} cm
                                                                    </p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Berat Badan</label>
                                                                    <p class="form-control-static">{{ $da->weight }} kg
                                                                    </p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Kekuatan Cengkaraman</label>
                                                                    <p class="form-control-static">{{ $da->power }} kg
                                                                    </p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Merokok</label>
                                                                    <p class="form-control-static">
                                                                        {{ $da->smoker == '1' ? 'Ya' : 'Tidak' }}</p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Alkohol</label>
                                                                    <p class="form-control-static">
                                                                        {{ $da->alkohol == '1' ? 'Ya' : 'Tidak' }}</p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Golongan Darah</label>
                                                                    <p class="form-control-static">{{ $da->blood }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Tangan Dominan</label>
                                                                    <p class="form-control-static">
                                                                        {{ $da->hand == '1' ? 'Kanan' : 'Kiri' }}</p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Daya Penglihatan</label>
                                                                    <p class="form-control-static">
                                                                        {{ $da->look == '1' ? 'Normal' : 'Tidak' }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Pernah Ke Jepang</label>
                                                                    <p class="form-control-static">
                                                                        {{ $da->japan == '1' ? 'Ya' : 'Tidak' }}</p>
                                                                </div>


                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Pernah Kecelakaan</label>
                                                                    <p class="form-control-static">
                                                                        {{ $da->accident == '1' ? 'Ya' : 'Tidak' }}</p>
                                                                </div>


                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Pernah Sakit Keras</label>
                                                                    <p class="form-control-static">
                                                                        {{ $da->sick == '1' ? 'Ya' : 'Tidak' }}</p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Riwayat Pendidikan</label>
                                                                    <p class="form-control-static">{{ $da->learning }}</p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Keahlian</label>
                                                                    <p class="form-control-static">{{ $da->skill }}</p>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Hobbi</label>
                                                                    <p class="form-control-static">{{ $da->hobbies }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            @isset($dataj)
                                                                @php $da = $dataj; @endphp
                                                            @endisset
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Agama</label>
                                                                    <input type="text" class="form-control"
                                                                        name="religion"
                                                                        value="{{ typeReligion($da->religion) }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Status</label>
                                                                    <input type="text" class="form-control"
                                                                        name="married"
                                                                        value="{{ $da->married == '1' ? 'Menikah' : 'Belum Menikah' }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Tinggi Badan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="tall" value="{{ $da->tall }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Berat Badan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="weight" value="{{ $da->weight }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Kekuatan Cengkaraman</label>
                                                                    <input type="text" class="form-control"
                                                                        name="power" value="{{ $da->power }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Merokok</label>
                                                                    <input type="text" class="form-control"
                                                                        name="smoker"
                                                                        value="{{ $da->smoker == '1' ? 'Ya' : 'Tidak' }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Alkohol</label>
                                                                    <input type="text" class="form-control"
                                                                        name="alkohol"
                                                                        value="{{ $da->alkohol == '1' ? 'Ya' : 'Tidak' }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Golongan Darah</label>
                                                                    <input type="text" class="form-control"
                                                                        name="blood" value="{{ $da->blood }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Tangan Dominan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="hand"
                                                                        value="{{ $da->hand == '1' ? 'Kanan' : 'Kiri' }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Daya Penglihatan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="look"
                                                                        value="{{ $da->look == '1' ? 'Normal' : 'Tidak' }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Pernah Ke Jepang</label>
                                                                    <input type="text" class="form-control"
                                                                        name="japan"
                                                                        value="{{ $da->japan == '1' ? 'Ya' : 'Tidak' }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Pernah Kecelakaan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="accident"
                                                                        value="{{ $da->accident == '1' ? 'Ya' : 'Tidak' }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Pernah Sakit Keras</label>
                                                                    <input type="text" class="form-control"
                                                                        name="sick"
                                                                        value="{{ $da->sick == '1' ? 'Ya' : 'Tidak' }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Pendidikan</label>
                                                                    <input type="text" class="form-control"
                                                                        name="learning" value="{{ $da->learning }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Keahlian</label>
                                                                    <input type="text" class="form-control"
                                                                        name="skill" value="{{ $da->skill }}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disabledInput">Hobbi</label>
                                                                    <input type="text" class="form-control"
                                                                        name="hobbies" value="{{ $da->hobbies }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row px-3">
                                                    <div class="row">
                                                        <div class="divider divider-left-center">
                                                            <div class="divider-text h6">Keluarga</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            @php $da = $data; @endphp
                                                            <div class="row">
                                                                @php
                                                                    $val = json_decode($da->family);
                                                                    $index = ['Nama', 'Umur', 'Nomor HP'];
                                                                @endphp

                                                                @isset($val->wali)
                                                                    <div class="col-md-3">
                                                                        <p class="form-control-static">Wali</p>
                                                                    </div>
                                                                    @foreach ($val->wali as $item)
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                for="disabledInput">{{ $index[$loop->index] }}</label>
                                                                            <p class="form-control-static">{{ $item }}
                                                                            </p>
                                                                        </div>
                                                                    @endforeach
                                                                @endisset

                                                                @isset($val->ayah)
                                                                    <div class="col-md-3">
                                                                        <p class="form-control-static">Ayah</p>
                                                                    </div>
                                                                    @foreach ($val->ayah as $item)
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                for="disabledInput">{{ $index[$loop->index] }}</label>
                                                                            <p class="form-control-static">{{ $item }}
                                                                            </p>
                                                                        </div>
                                                                    @endforeach
                                                                @endisset

                                                                @isset($val->ibu)
                                                                    <div class="col-md-3">
                                                                        <p class="form-control-static">Ibu</p>
                                                                    </div>
                                                                    @foreach ($val->ibu as $item)
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                for="disabledInput">{{ $index[$loop->index] }}</label>
                                                                            <p class="form-control-static">{{ $item }}
                                                                            </p>
                                                                        </div>
                                                                    @endforeach
                                                                @endisset

                                                                @isset($val->kaka)
                                                                    <div class="col-md-3">
                                                                        <p class="form-control-static">Kaka</p>
                                                                    </div>
                                                                    @foreach ($val->kaka as $item)
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                for="disabledInput">{{ $index[$loop->index] }}</label>
                                                                            <p class="form-control-static">{{ $item }}
                                                                            </p>
                                                                        </div>
                                                                    @endforeach
                                                                @endisset

                                                                @isset($val->adik)
                                                                    <div class="col-md-3">
                                                                        <p class="form-control-static">Adik</p>
                                                                    </div>

                                                                    @foreach ($val->adik as $item)
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                for="disabledInput">{{ $index[$loop->index] }}</label>
                                                                            <p class="form-control-static">{{ $item }}
                                                                            </p>
                                                                        </div>
                                                                    @endforeach
                                                                @endisset
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            @isset($dataj)
                                                                @php $da = $dataj; @endphp
                                                            @endisset
                                                            <div class="row">
                                                                @php
                                                                    $val = json_decode($da->family);
                                                                    $index = ['Nama', 'Umur', 'Nomor HP'];
                                                                @endphp

                                                                @isset($val->wali)
                                                                    <div class="col-md-3">
                                                                        <p class="form-control-static">Wali</p>
                                                                        <input type="hidden" name="status[]"
                                                                            class="form-control" value="wali">
                                                                    </div>
                                                                    @foreach ($val->wali as $item)
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                for="disabledInput">{{ $index[$loop->index] }}</label>
                                                                            <input type="text" name="wali[]"
                                                                                class="form-control"
                                                                                value="{{ $item }}" required>
                                                                        </div>
                                                                    @endforeach
                                                                @endisset

                                                                @isset($val->ayah)
                                                                    <div class="col-md-3">
                                                                        <p class="form-control-static">Ayah</p>
                                                                        <input type="hidden" name="status[]"
                                                                            class="form-control" value="ayah">
                                                                    </div>
                                                                    @foreach ($val->ayah as $item)
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                for="disabledInput">{{ $index[$loop->index] }}</label>
                                                                            <input type="text" name="ayah[]"
                                                                                class="form-control"
                                                                                value="{{ $item }}" required>
                                                                        </div>
                                                                    @endforeach
                                                                @endisset

                                                                @isset($val->ibu)
                                                                    <div class="col-md-3">
                                                                        <p class="form-control-static">Ibu</p>
                                                                        <input type="hidden" name="status[]"
                                                                            class="form-control" value="ibu">
                                                                    </div>
                                                                    @foreach ($val->ibu as $item)
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                for="disabledInput">{{ $index[$loop->index] }}</label>
                                                                            <input type="text" name="ibu[]"
                                                                                class="form-control"
                                                                                value="{{ $item }}" required>
                                                                        </div>
                                                                    @endforeach
                                                                @endisset

                                                                @isset($val->kaka)
                                                                    <div class="col-md-3">
                                                                        <p class="form-control-static">kaka</p>
                                                                        <input type="hidden" name="status[]"
                                                                            class="form-control" value="kaka">
                                                                    </div>
                                                                    @foreach ($val->kaka as $item)
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                for="disabledInput">{{ $index[$loop->index] }}</label>
                                                                            <input type="text" name="kaka[]"
                                                                                class="form-control"
                                                                                value="{{ $item }}" required>
                                                                        </div>
                                                                    @endforeach
                                                                @endisset

                                                                @isset($val->adik)
                                                                    <div class="col-md-3">
                                                                        <p class="form-control-static">adik</p>
                                                                        <input type="hidden" name="status[]"
                                                                            class="form-control" value="adik">
                                                                    </div>
                                                                    @foreach ($val->adik as $item)
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                for="disabledInput">{{ $index[$loop->index] }}</label>
                                                                            <input type="text" name="adik[]"
                                                                                class="form-control"
                                                                                value="{{ $item }}" required>
                                                                        </div>
                                                                    @endforeach
                                                                @endisset

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                @if($da->study)
                                                    <div class="row px-3">
                                                        <div class="row">
                                                            <div class="divider divider-left-center">
                                                                <div class="divider-text h6">Riwayat Pendidikan</div>
                                                            </div>
                                                            @php $da = $data; @endphp
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    @php $st = json_decode($da->study) @endphp
                                                                    @for ($i = 0; $i < count($st); $i++)
                                                                        <div class="col-md-4">
                                                                            <label for="disabledInput">Nama</label>
                                                                            <p class="form-control-static">{{ $st[$i][0] }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="disabledInput">Awal</label>
                                                                            <p class="form-control-static">{{ $st[$i][1] }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="disabledInput">Akhir</label>
                                                                            <p class="form-control-static">{{ $st[$i][2] }}
                                                                            </p>
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            @isset($dataj)
                                                                @php $da = $dataj; @endphp
                                                            @endisset
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    @for ($i = 0; $i < count($st); $i++)
                                                                        <div class="col-md-4">
                                                                            <label for="disabledInput">Nama</label>
                                                                            <input type="text" name="study[]"
                                                                                value="{{ $st[$i][0] }}"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="disabledInput">Periode</label>
                                                                            <input type="text" name="study[]"
                                                                                value="{{ $st[$i][1] }}"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label for="disabledInput">Periode</label>
                                                                            <input type="text" name="study[]"
                                                                                value="{{ $st[$i][2] }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($da->job)
                                                    <div class="row px-3">
                                                        <div class="row">
                                                            <div class="divider divider-left-center">
                                                                <div class="divider-text h6">Riwayat Pekerjaan</div>
                                                            </div>
                                                            @php $da = $data; @endphp
                                                            <div class="col-md-6">
                                                                @if ($da->job)
                                                                    <div class="row">
                                                                        @php
                                                                        $st = json_decode($da->job); @endphp
                                                                        @for ($i = 0; $i < count($st); $i++)
                                                                            <div class="col-md-6">
                                                                                <label for="disabledInput">Nama</label>
                                                                                <p class="form-control-static">
                                                                                    {{ $st[$i][0] }}</p>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label for="disabledInput">Awal</label>
                                                                                <p class="form-control-static">
                                                                                    {{ $st[$i][1] }}</p>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label for="disabledInput">Akhir</label>
                                                                                <p class="form-control-static">
                                                                                    {{ $st[$i][2] }}</p>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="disabledInput">Industri</label>
                                                                                <p class="form-control-static">
                                                                                    {{ $st[$i][3] }}</p>
                                                                            </div>
                                                                        @endfor
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-12">
                                                                    <label for="disabledInput">Deskripsi Pekerjaan</label>
                                                                    <p class="form-control-static">{{ $da->job_des }}</p>
                                                                </div>
                                                            </div>
                                                            @isset($dataj)
                                                                @php $da = $dataj; @endphp
                                                            @endisset
                                                            <div class="col-md-6">
                                                                @if ($da->job)
                                                                    <div class="row">
                                                                        @for ($i = 0; $i < count($st); $i++)
                                                                            <div class="col-md-6">
                                                                                <label for="disabledInput">Nama</label>
                                                                                <input type="text" name="job[]"
                                                                                    value="{{ $st[$i][0] }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label for="disabledInput">Awal</label>
                                                                                <input type="text" name="job[]"
                                                                                    value="{{ $st[$i][1] }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <label for="disabledInput">Akhir</label>
                                                                                <input type="text" name="job[]"
                                                                                    value="{{ $st[$i][2] }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label for="disabledInput">Industri</label>
                                                                                <input type="text" name="job[]"
                                                                                    value="{{ $st[$i][3] }}"
                                                                                    class="form-control">
                                                                            </div>
                                                                        @endfor
                                                                    </div>
                                                                @endif
                                                                <div class="col-md-12">
                                                                    <label for="disabledInput">Deskripsi Pekerjaan</label>
                                                                    <textarea class="form-control" rows="3" name="job_des">{{ $da->job_des }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($da->magang)
                                                    <div class="row px-3">
                                                        <div class="row">
                                                            <div class="divider divider-left-center">
                                                                <div class="divider-text h6">Riwayat Magang</div>
                                                            </div>
                                                            @php $da = $data; @endphp
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    @php $st = json_decode($da->magang) @endphp
                                                                    @for ($i = 0; $i < count($st); $i++)
                                                                        <div class="col-md-6">
                                                                            <label for="disabledInput">Nama</label>
                                                                            <p class="form-control-static">
                                                                                {{ $st[$i][0] }}</p>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label for="disabledInput">Awal</label>
                                                                            <p class="form-control-static">
                                                                                {{ $st[$i][1] }}</p>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label for="disabledInput">Akhir</label>
                                                                            <p class="form-control-static">
                                                                                {{ $st[$i][2] }}</p>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="disabledInput">Industri</label>
                                                                            <p class="form-control-static">
                                                                                {{ $st[$i][3] }}</p>
                                                                        </div>
                                                                    @endfor
                                                                    <div class="col-md-12">
                                                                        <label for="disabledInput">Hal yang Dipelajari saat
                                                                            magang</label>
                                                                        <p class="form-control-static">
                                                                            {{ $da->magang_des }}</p>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="disabledInput">Promosi diri, harapan,
                                                                            pertanyaan, dll</label>
                                                                        <p class="form-control-static">{{ $da->me }}
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            @isset($dataj)
                                                                @php $da = $dataj; @endphp
                                                            @endisset
                                                            <div class="col-md-6">
                                                                <div class="row">
                                                                    @for ($i = 0; $i < count($st); $i++)
                                                                        <div class="col-md-6">
                                                                            <label for="disabledInput">Nama</label>
                                                                            <input type="text" name="magang[]"
                                                                                value="{{ $st[$i][0] }}"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label for="disabledInput">Awal</label>
                                                                            <input type="text" name="magang[]"
                                                                                value="{{ $st[$i][1] }}"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label for="disabledInput">Akhir</label>
                                                                            <input type="text" name="magang[]"
                                                                                value="{{ $st[$i][2] }}"
                                                                                class="form-control">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label for="disabledInput">Industri</label>
                                                                            <input type="text" name="magang[]"
                                                                                value="{{ $st[$i][3] }}"
                                                                                class="form-control">
                                                                        </div>
                                                                    @endfor
                                                                    <div class="col-md-12">
                                                                        <label for="disabledInput">Hal yang Dipelajari saat
                                                                            magang</label>
                                                                        <textarea class="form-control" rows="3" name="magang_des">{{ $da->magang_des }}</textarea>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="disabledInput">Promosi diri, harapan,
                                                                            pertanyaan, dll</label>
                                                                        <textarea class="form-control" rows="3" name="me">{{ $da->me }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if($da->lisensi)
                                                    <div class="row px-3">
                                                        <div class="divider divider-left-center">
                                                            <div class="divider-text h6">Lisensi</div>
                                                        </div>
                                                        @php $da = $data; @endphp
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                @php $st = json_decode($da->lisensi) @endphp
                                                                @for ($i = 0; $i < count($st); $i++)
                                                                    <div class="col-md-4">
                                                                        <label for="disabledInput">Nama</label>
                                                                        <p class="form-control-static">{{ $st[$i][0] }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="disabledInput">Waktu</label>
                                                                        <p class="form-control-static">{{ $st[$i][1] }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="disabledInput">level</label>
                                                                        <p class="form-control-static">{{ $st[$i][2] }}
                                                                        </p>
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        @isset($dataj)
                                                            @php $da = $dataj; @endphp
                                                        @endisset
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                @for ($i = 0; $i < count($st); $i++)
                                                                    <div class="col-md-4">
                                                                        <label for="disabledInput">Nama</label>
                                                                        <input type="text" name="lisensi[]"
                                                                            value="{{ $st[$i][0] }}"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="disabledInput">Waktu</label>
                                                                        <input type="text" name="lisensi[]"
                                                                            value="{{ $st[$i][1] }}"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="disabledInput">level</label>
                                                                        <input type="text" name="lisensi[]"
                                                                            value="{{ $st[$i][2] }}"
                                                                            class="form-control">
                                                                    </div>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="my-3 d-flex justify-content-start">
                                                    <button class="btn btn-primary rounded-pill">Generate</button>
                                                    @isset($dataj)
                                                        <a class="btn btn-success rounded-pill ms-3" target="_blank"
                                                            href="{{ asset('storage/' . $cv->dokumen) }}">Preview</a>
                                                    @endisset
                                                    <a class="btn btn-danger rounded-pill ms-3"
                                                        href="{{ route('kelas.lpk') }}">Back</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vid" role="tabpanel" aria-labelledby="vid-tab">
                                <div class="row my-3">
                                    <div class="col-md-12">
                                        @if ($head->job == 1)
                                            <div class="embed-responsive embed-responsive-21by9">
                                                <iframe class="embed-responsive-item"
                                                    src="{{ asset('storage/' . $head->apply->video) }}"></iframe>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade {{ $rekom ? 'active show' : null }}" id="rekom"
                                role="tabpanel" aria-labelledby="rekom-tab">
                                <div class="row my-3">
                                    <div class="col-md-12">
                                        @if ($passport)
                                            <div class="d-flex justify-content-between">
                                                <div class="p-1">
                                                    <p class="text-wrap">Dokumen Passport</p>
                                                </div>
                                                <div class="p-1">
                                                    <form
                                                        action="{{ route('doc.destroy.lpk', ['id' => md5($passport->id)]) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm float-end"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="no-scroll-iframe" width="100%" height="500"
                                                    src="{{ asset('storage/' . $passport->dokumen) }}"
                                                    allowfullscreen></iframe>
                                            </div>
                                        @else
                                            <form
                                                action="{{ route('doc.generate.lpk', ['id' => md5($da->user->id), 'par' => 'rekom']) }}"
                                                method="post">
                                                @csrf
                                                <h6>Dokumen Passport</h6>
                                                ` <div class="form-group">
                                                    <label class="mb-2">Nomor Surat</label>
                                                    <input type="text" name="item" class="form-control mb-3"
                                                        required>
                                                </div>
                                                <div class="justify-content-start">
                                                    <button class="btn btn-primary rounded-pill">Generate Passport</button>
                                                    <button type="button" class="btn btn-danger rounded-pill ms-3"
                                                        onclick="goBack()">Back</button>
                                                </div>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade  {{ $visa ? 'active show' : null }}" id="coe"
                                role="tabpanel" aria-labelledby="coe-tab">
                                <div class="row my-3">
                                    @if ($vis)
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between">
                                                <div class="p-1">
                                                    <p class="text-wrap">Dokumen Visa</p>
                                                </div>
                                                <div class="p-1">
                                                    <form action="{{ route('doc.destroy.lpk', ['id' => md5($vis->id)]) }}"
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm float-end"><i
                                                                class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <iframe class="no-scroll-iframe" width="100%" height="500"
                                                    src="{{ asset('storage/' . $vis->dokumen) }}" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <form
                                                action="{{ route('doc.generate.lpk', ['id' => md5($da->user->id), 'par' => 'visa']) }}"
                                                method="post">
                                                @csrf
                                                ` <div class="form-group my-3">
                                                    <h6>Dokumen Visa</h6>
                                                    @php
                                                        $pal = [
                                                            strtoupper($data->fullname),
                                                            strtoupper($data->fullname),
                                                            date('d/m/Y', strtotime($data->date_birth)),
                                                            strtoupper($data->place_birth),
                                                            $data->gender == 1 ? 'Male' : 'Female',
                                                            $data->married == 1 ? 'Married' : 'Single',
                                                            'INDONESIA',
                                                            'NONE',
                                                            $data->nik,
                                                            'OFFICIAL',
                                                            'E2788317',
                                                            'KEDIRI',
                                                            '06/03/2023',
                                                            'KEDIRI IMMIGRATION OFFICE',
                                                            '06/03/2033',
                                                            'Y23-091330',
                                                            'TECHNICAL INTERN TRAINING JAPAN OF CAREGIVER',
                                                            'ONE YEAR',
                                                            '27/02/2024',
                                                            'MATSUYAMA',
                                                            'ANA NH-872',
                                                            'INTERNATIONAL EXCHANGE ASSOCIATION JMA',
                                                            '+81 -89-909-9130',
                                                            '790-0921 695 FUKUJI-CHO, MATSUYAMA KU, EHIME KEN, JAPAN',
                                                            'NONE',
                                                            "$data->alamat, Kec. $data->kec, Prov. $data->prov",
                                                            $da->hp,
                                                            $da->email,
                                                            'TRAINING',
                                                            $head->murid->penyanggah->name,
                                                            $head->murid->penyanggah->alamat,
                                                            $head->murid->third->hp,
                                                            'PRIVAT EMPLOYESS',
                                                            'KAZUNORI TSUNEYOSHI',
                                                            '089-909-9130',
                                                            '695 FUKUJI CHO, MATSUYAMA KU, EHIME KEN',
                                                            'ACCEPTING ORGANIZATION DIRECTOR',
                                                            'COMPANY EMPLOYEE DIRECTOR',
                                                            'JAPANESE RESIDENT',
                                                            'SAMEAS ABOVE',
                                                        ];
                                                    @endphp
                                                    <label class="mb-2">Item</label>
                                                    @for ($i = 0; $i < count($pal); $i++)
                                                        <input type="text" name="item[]"
                                                            value="{{ isset($pal[$i]) ? $pal[$i] : null }}"
                                                            class="form-control mb-3"
                                                            placeholder="Item {{ $i + 1 }}" required>
                                                    @endfor
                                                    <div class="justify-content-start">
                                                        <button class="btn btn-primary rounded-pill">Generate Visa</button>
                                                        <button type="button" class="btn btn-danger rounded-pill ms-3"
                                                            onclick="goBack()">Back</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <iframe src="{{ asset('assets/doc/vis.pdf') }}" height="500"
                                                width="500" frameborder="0"></iframe>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/form-element-select.js') }}"></script>

    <script>
        @if (session('error'))
            var timeoutAlert = document.getElementById('timeoutAlert');
            setTimeout(function() {
                timeoutAlert.style.display = 'none';
            }, 3000);
        @endif

        @if ($errors->any())
            var timeoutAlert = document.getElementById('timeoutAlert');
            setTimeout(function() {
                timeoutAlert.style.display = 'none';
            }, 5000);
        @endif
    </script>
@endpush
