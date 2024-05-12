@extends('layout.base')
@section('main')
    <div class="page-heading">
        @if (session('error'))
            <div class="alert alert-danger" id="timeoutAlert" role="alert">
                {{ session('error') }}
            </div>
        @endif

    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-6 d-flex justify-content-start mb-4">
                            <div class="stats-icon green mb-2">
                                <i class="iconly-boldWallet"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted font-semibold">Pembayaran Telah di verifikasi</h6>
                                <h6 class="font-extrabold mb-0">{{ $paid }}</h6>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-start">
                            <div class="stats-icon red mb-2">
                                <i class="iconly-boldWallet"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted font-semibold">Pembayaran Belum di verifikasi</h6>
                                <h6 class="font-extrabold mb-0">{{ $unpaid }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card card-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection


@push('js')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <script>
        @if (session('error'))
            var timeoutAlert = document.getElementById('timeoutAlert');
            setTimeout(function() {
                timeoutAlert.style.display = 'none';
            }, 3000);
        @endif

        @include('cal')
    </script>
@endpush
