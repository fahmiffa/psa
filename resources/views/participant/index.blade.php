@extends('layout.base')
@section('main')
    <div class="page-heading px-3">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h4>{{ $data }}</h4>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                @if ($head)
                    <p class="text-muted small float-end">Nomor Registrasi : {{ $head->registrasi }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="page-content">
        <div class="card">
            <div class="card-body px-5">
                @php
                    // varifikasi pembayaran
                    $st = auth()->user()->stat;
                    $pay = [1, 4];

                    // state
                    $state = [8, 9];
                @endphp
                @if ($head)
                    <div class="flex-row">
                        @if ($st == 2 && $head->status == 4)
                            <div class="divider divider-center">
                                <div class="divider-text h6">{{ auth()->user()->state }}</div>
                            </div>

                            <div class="row px-3">
                                <div class="col-md-8">
                                    <h6>Kelas</h6>
                                    <p class="form-control-static">{{ $student->class->name }}</p>
                                </div>

                                <div class="col-md-8">
                                    <h6>Guru</h6>
                                    <p class="form-control-static">{{ $student->class->guru->name }}</p>
                                </div>

                                <div class="col-md-8">
                                    <h6>Note</h6>
                                    <p class="form-control-static">{{ $student->class->note }}</p>
                                </div>

                            </div>
                        @elseif($st == 3)
                            <div class="divider divider-center">
                                <div class="divider-text h6">{{ auth()->user()->state }}</div>
                            </div>
                            @include('participant.job');
                        @elseif($st == 5)
                            <div class="divider divider-left">
                                <div class="divider-text h6">{{ auth()->user()->state }}</div>
                            </div>
                            @if ($apply)
                                <div class="table-responsive w-50">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <td>Tanggal</td>
                                                <td>: {{ date('d-M-Y', strtotime($apply->interview)) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tempat</td>
                                                <td>: {{ $apply->job->perusahaan->name }}, {{ $apply->job->interview }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @elseif($st == 6)
                            <div class="divider divider-left">
                                <div class="divider-text h6">{{ auth()->user()->state }} {{ $payment2->name }}</div>
                            </div>
                            @php $payment = $payment2; @endphp
                            @include('participant.payment');
                        @elseif($st == 11)
                            <div class="divider divider-left">
                                <div class="divider-text h6">{{ auth()->user()->state }}</div>
                            </div>
                            @php $payment = $payment3; @endphp
                            @include('participant.payment');
                        @elseif($st == 9)
                            <div class="divider divider-center">
                                <div class="divider-text h6">{{ auth()->user()->state }}</div>
                            </div>
                            @if ($apply)
                                <a target="_blank" href="{{ asset('storage/' . $apply->kontrak) }}"
                                    class="btn btn-primary btn-sm rounded-pill">Dokumen Kontrak</a>
                                @include('participant.kontrak');
                            @endif
                        @else
                            <div class="divider divider-center">
                                <div class="divider-text h6">{{ auth()->user()->state }}</div>
                            </div>
                        @endif
                    </div>
                @else
                    @php$payment = $payment1;
                    @endphp
                    @include('participant.payment');
                @endif
            </div>
        </div>
    </div>

@endsection
