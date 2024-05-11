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

                    @isset($third)
                        <form action="{{ route('third.update', ['third' => $third]) }}" method="post"
                            enctype="multipart/form-data">
                            @method('PATCH')
                        @else
                            <form action="{{ route('third.store') }}" method="post" enctype="multipart/form-data">
                                @endif
                                @csrf
                                <div class="px-5">
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3">Account</label>
                                        <div class="col-md-6">
                                            <select class="choices form-select" name="account" id="account">
                                                <option value="">Pilih</option>
                                                @foreach ($user as $item)
                                                    <option value="{{ $item->id }}" @selected(isset($third) && $third->users_id == $item->id)>
                                                        {{ ucfirst($item->name) }}</option>
                                                @endforeach
                                            </select>
                                            @error('account')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3">Name</label>
                                        <div class="col-md-6">
                                            <input type="text" name="name"
                                                value="{{ isset($third) ? $third->name : old('name') }}" id="name"
                                                class="form-control">
                                            @error('name')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3">Kode</label>
                                        <div class="col-md-6">
                                            <input type="text" name="kode"
                                                value="{{ isset($third) ? $third->kode : old('kode') }}" class="form-control">
                                            @error('kode')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-md-3">Alamat</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="alamat" rows="3">{{ isset($third) ? $third->alamat : old('alamat') }}</textarea>
                                            @error('alamat')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-md-3">Deskripsi</label>
                                        <div class="col-md-6">
                                            <textarea class="form-control" name="note" rows="3">{{ isset($third) ? $third->note : old('note') }}</textarea>
                                            @error('note')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3 d-flex justify-content-start">
                                        <button class="btn btn-primary">Save</button>
                                        <a class="btn btn-danger ms-3" href="{{ route('third.index') }}">Back</a>
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
            $('#account').on('change', function() {
                var optionsText = this.options[this.selectedIndex].text;
                $('#name').val(optionsText);
            });
        </script>
    @endpush
