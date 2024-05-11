@extends('layout.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable-jquery.css') }}">
@endpush
@section('main')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $data }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $data }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-body">

                    @isset($nilai)
                        <form action="{{ route('nilai.update', ['nilai' => $nilai]) }}" method="post"
                            enctype="multipart/form-data">
                            @method('PATCH')
                        @else
                            <form action="{{ route('nilai.store') }}" method="post" enctype="multipart/form-data">
                                @endif
                                @csrf
                                <div class="px-5">
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3">Nilai</label>
                                        <div class="col-md-6">
                                            <input type="number" name="nilai"
                                                value="{{ isset($nilai) ? $nilai->value : old('nilai') }}" class="form-control">
                                            @error('nilai')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-md-3">Kelas</label>
                                        <div class="col-md-6">
                                            <select class="choices form-select" name="kelas" id="kelas">
                                                <option value="">Pilih Kelas</option>
                                                @foreach ($kelas as $item)
                                                    <option value="{{ $item->id }}" @selected(isset($nilai) && $nilai->kelas == $item->id)>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('kelas')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-md-3">Siswa</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="siswa" id="siswa">
                                                <option value="">Pilih Siswa</option>
                                                @isset($nilai)
                                                    <option value="{{ $nilai->student }}" selected>{{ $nilai->siswa->name }}
                                                    </option>
                                                    @endif
                                                </select>
                                                @error('siswa')
                                                    <div class='small text-danger text-left'>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="mb-3 d-flex justify-content-start">
                                            <button class="btn btn-primary">{{ isset($nilai) ? 'Update' : 'Save' }}</button>
                                            <a class="btn btn-danger ms-3" href="{{ route('nilai.index') }}">Back</a>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>

                </section>

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
                $(document).ready(function() {

                    $('#kelas').on('change', function(e) {
                        e.preventDefault();
                        var val = $(this).val();


                        $("#siswa").empty();
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST',
                            url: "{{ route('siswa') }}",
                            data: {
                                id: val
                            },
                            success: function(data) {
                                $.each(data, function(i, field) {
                                    $('#siswa').append('<option value="' + field.value + '">' + field.label + '</option>');
                                });                 
                            }
                        });

                    });
                });
            </script>
        @endpush
