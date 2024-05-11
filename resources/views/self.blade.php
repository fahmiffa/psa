@extends('layout.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}">
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

        <h3 class="card-title">Profile <span class="text-capitalize">{{ auth()->user()->name }}</span></h3>

    </div>

    <div class="page-content px-3">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-body">
                    <div class="row">
                        <div class="divider divider-center">
                            <div class="divider-text h6">Identitas</div>
                        </div>
                        <div class="col-md-12 col-12 my-3">
                            <div class="row px-3">
                                <div class="col-md-3">
                                    <label for="disabledInput">Nama Lengkap</label>
                                    <p class="form-control-static">{{ $da->fullname }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Username</label>
                                    <p class="form-control-static">{{ auth()->user()->name }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Email</label>
                                    <p class="form-control-static">{{ auth()->user()->email }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Phone</label>
                                    <p class="form-control-static">{{ auth()->user()->hp }}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 col-6 mb-3">
                            <div class="row px-3">

                                <div class="col-md-3">
                                    <label for="disabledInput">NIK</label>
                                    <p class="form-control-static">{{ $da->nik }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Tanggal Lahir</label>
                                    <p class="form-control-static">{{ date('d-m-Y', strtotime($da->date_birth)) }}</p>
                                </div>


                                <div class="col-md-3">
                                    <label for="disabledInput">Jenis Kelamin</label>
                                    <p class="form-control-static">{{ $da->gender == '1' ? 'Perempuan' : 'Laki-laki' }}
                                    </p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Tempat Lahir</label>
                                    <p class="form-control-static">{{ $da->place_birth }}</p>
                                </div>

                            </div>
                            <div class="row px-3">

                                <div class="col-md-3">
                                    <label for="disabledInput">Alamat</label>
                                    <p class="form-control-static">{{ $da->alamat }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Kecamatan</label>
                                    <p class="form-control-static">{{ $da->kec }}</p>
                                </div>


                                <div class="col-md-3">
                                    <label for="disabledInput">Provinsi</label>
                                    <p class="form-control-static">{{ $da->prov }}</p>
                                </div>

                            </div>
                        </div>
                        <div class="divider divider-center">
                            <div class="divider-text h6">Informasi</div>
                        </div>
                        <div class="col-md-12 col-6 mb-3">
                            <div class="row px-3">

                                <div class="col-md-3">
                                    <label for="disabledInput">Agama</label>
                                    <p class="form-control-static">{{ typeReligion($da->religion) }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Status</label>
                                    <p class="form-control-static">
                                        {{ $da->married == '1' ? 'Menikah' : 'Belum Menikah' }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Tinggi Badan</label>
                                    <p class="form-control-static">{{ $da->tall }} cm</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Berat Badan</label>
                                    <p class="form-control-static">{{ $da->weight }} kg</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 col-6 mb-3">
                            <div class="row px-3">

                                <div class="col-md-3">
                                    <label for="disabledInput">Kekuatan Cengkaraman</label>
                                    <p class="form-control-static">{{ $da->power }} kg</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Merokok</label>
                                    <p class="form-control-static">{{ $da->smoker == '1' ? 'Ya' : 'Tidak' }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Alkohol</label>
                                    <p class="form-control-static">{{ $da->alkohol == '1' ? 'Ya' : 'Tidak' }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Golongan Darah</label>
                                    <p class="form-control-static">{{ $da->blood }}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 col-6 mb-3">
                            <div class="row px-3">

                                <div class="col-md-3">
                                    <label for="disabledInput">Tangan Dominan</label>
                                    <p class="form-control-static">{{ $da->hand == '1' ? 'Kanan' : 'Kiri' }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Lama Belajar</label>
                                    <p class="form-control-static">{{ $da->learning }} Bulan</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Daya Penglihatan</label>
                                    <p class="form-control-static">{{ $da->look == '1' ? 'Normal' : 'Tidak Normal' }}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 col-6 mb-3">
                            <div class="row px-3">

                                <div class="col-md-3">
                                    <label for="disabledInput">Pernah Ke Jepang</label>
                                    <p class="form-control-static">{{ $da->japan == '1' ? 'Ya' : 'Tidak' }}</p>
                                </div>


                                <div class="col-md-3">
                                    <label for="disabledInput">Pernah Kecelakaan</label>
                                    <p class="form-control-static">{{ $da->accident == '1' ? 'Ya' : 'Tidak' }}</p>
                                </div>


                                <div class="col-md-3">
                                    <label for="disabledInput">Pernah Sakit Keras</label>
                                    <p class="form-control-static">{{ $da->sick == '1' ? 'Ya' : 'Tidak' }}</p>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 col-6 mb-3">
                            <div class="row px-3">

                                <div class="col-md-3">
                                    <label for="disabledInput">Kehalian</label>
                                    <p class="form-control-static">{{ $da->skill }}</p>
                                </div>

                                <div class="col-md-3">
                                    <label for="disabledInput">Hobbi</label>
                                    <p class="form-control-static">{{ $da->hobbies }}</p>
                                </div>


                            </div>
                        </div>

                        @if ($da->family)
                            <div class="divider divider-center">
                                <div class="divider-text h6">Keluarga</div>
                            </div>
                            <div class="col-md-12 col-6 mb-3">
                                <div class="row px-3">

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
                                                <label for="disabledInput">{{ $index[$loop->index] }}</label>
                                                <p class="form-control-static">{{ $item }}</p>
                                            </div>
                                        @endforeach
                                    @endisset

                                    @isset($val->ayah)
                                        <div class="col-md-3 my-auto">
                                            <p class="form-control-static">Ayah</p>
                                        </div>

                                        @foreach ($val->ayah as $item)
                                            <div class="col-md-3">
                                                <label for="disabledInput">{{ $index[$loop->index] }}</label>
                                                <p class="form-control-static">{{ $item }}</p>
                                            </div>
                                        @endforeach
                                    @endisset

                                    @isset($val->ibu)
                                        <div class="col-md-3 my-auto">
                                            <p class="form-control-static">Ibu</p>
                                        </div>

                                        @foreach ($val->ibu as $item)
                                            <div class="col-md-3">
                                                <label for="disabledInput">{{ $index[$loop->index] }}</label>
                                                <p class="form-control-static">{{ $item }}</p>
                                            </div>
                                        @endforeach
                                    @endisset

                                    @isset($val->kaka)
                                        <div class="col-md-3 my-auto">
                                            <p class="form-control-static">Kaka</p>
                                        </div>

                                        @foreach ($val->kaka as $item)
                                            <div class="col-md-3">
                                                <label for="disabledInput">{{ $index[$loop->index] }}</label>
                                                <p class="form-control-static">{{ $item }}</p>
                                            </div>
                                        @endforeach
                                    @endisset

                                    @isset($val->adik)
                                        <div class="col-md-3 my-auto">
                                            <p class="form-control-static">Adik</p>
                                        </div>

                                        @foreach ($val->adik as $item)
                                            <div class="col-md-3">
                                                <label for="disabledInput">{{ $index[$loop->index] }}</label>
                                                <p class="form-control-static">{{ $item }}</p>
                                            </div>
                                        @endforeach
                                    @endisset

                                </div>
                            </div>
                        @endif
                        @if ($da->study)
                            <div class="divider divider-center">
                                <div class="divider-text h6">Pendidikan</div>
                            </div>
                            <div class="col-md-12 col-6 mb-3">
                                @php
                                    $st = json_decode($da->study);
                                @endphp
                                @for ($i = 0; $i < count($st); $i++)
                                    <div class="row px-3">
                                        <div class="col-md-3">
                                            <label for="disabledInput">Nama</label>
                                            <p class="form-control-static">{{ $st[$i][0] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="disabledInput">Periode Awal</label>
                                            <p class="form-control-static">{{ $st[$i][1] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="disabledInput">Periode Akhir</label>
                                            <p class="form-control-static">{{ $st[$i][2] }}</p>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        @endif

                        @if ($da->job)
                            <div class="divider divider-center">
                                <div class="divider-text h6">Pekerjaan</div>
                            </div>
                            <div class="col-md-12 col-6 mb-3">
                                @php $st = json_decode($da->job) @endphp
                                @for ($i = 0; $i < count($st); $i++)
                                    <div class="row px-3">
                                        <div class="col-md-3">
                                            <label for="disabledInput">Nama</label>
                                            <p class="form-control-static">{{ $st[$i][0] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="disabledInput">Periode Awal</label>
                                            <p class="form-control-static">{{ $st[$i][1] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="disabledInput">Periode Akhir</label>
                                            <p class="form-control-static">{{ $st[$i][2] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="disabledInput">Industri</label>
                                            <p class="form-control-static">{{ $st[$i][3] }}</p>
                                        </div>
                                    </div>
                                @endfor

                                <div class="row px-3">
                                    <div class="col-md-6">
                                        <h6>Deskripsi Pekerjaan</h6>
                                        <p class="form-control-static">{{ $da->job_des }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($da->magang)
                            <div class="divider divider-center">
                                <div class="divider-text h6">Magang</div>
                            </div>
                            <div class="col-md-12 col-6 mb-3">
                                @php $st = json_decode($da->magang) @endphp
                                @for ($i = 0; $i < count($st); $i++)
                                    <div class="row px-3">
                                        <div class="col-md-3">
                                            <label for="disabledInput">Nama</label>
                                            <p class="form-control-static">{{ $st[$i][0] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="disabledInput">Periode Awal</label>
                                            <p class="form-control-static">{{ $st[$i][1] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="disabledInput">Periode Akhir</label>
                                            <p class="form-control-static">{{ $st[$i][2] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="disabledInput">Industri</label>
                                            <p class="form-control-static">{{ $st[$i][3] }}</p>
                                        </div>
                                    </div>
                                @endfor

                                <div class="row px-3">
                                    <div class="col-md-6">
                                        <h6>Hal yang Dipelajari saat magang</h6>
                                        <p class="form-control-static">{{ $da->magang_des }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($da->lisensi)
                            <div class="divider divider-center">
                                <div class="divider-text h6">Lisensi</div>
                            </div>
                            <div class="col-md-12 col-6 mb-3">
                                @php $st = json_decode($da->lisensi) @endphp
                                @for ($i = 0; $i < count($st); $i++)
                                    <div class="row px-3">
                                        <div class="col-md-3">
                                            <label for="disabledInput">Nama</label>
                                            <p class="form-control-static">{{ $st[$i][0] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="disabledInput">Waktu</label>
                                            <p class="form-control-static">{{ $st[$i][1] }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="disabledInput">level</label>
                                            <p class="form-control-static">{{ $st[$i][2] }}</p>
                                        </div>
                                    </div>
                                @endfor

                                <div class="row px-3">
                                    <div class="col-md-6">
                                        <h6>Promosi diri, harapan, pertanyaan, dll</h6>
                                        <p class="form-control-static">{{ $da->me }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mb-3 d-flex justify-content-between">
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary rounded-pill">Edit</a>
                            <button type="button" class="btn btn-danger rounded-pill" onclick="goBack()">Back</button>
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
