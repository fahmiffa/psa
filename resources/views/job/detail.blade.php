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
        <h3 class="card-title">{{ $data }}</h3>
    </div>

    <div class="page-content px-3">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-body">
                    <div style="height:27rem">
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h6>Deskripsi</h6>
                            </div>
                            <div class="col-md-8">
                                {{ $job->note }}
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h6>Salary</h6>
                            </div>
                            <div class="col-md-8">
                                {{ number_format($job->salary, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h6>PIC</h6>
                            </div>
                            <div class="col-md-8">
                                {{ $job->pic_name }}
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-md-4">
                                <h6>Agency</h6>
                            </div>
                            <div class="col-md-8">
                                {{ $job->agency_name }}
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">
                                <h6>Open Hiring</h6>
                            </div>
                            <div class="col-md-3">
                                {{ $job->open }}
                            </div>
                            <div class="col-md-3">
                                <h6>Close Hiring</h6>
                            </div>
                            <div class="col-md-3">
                                {{ $job->close }}
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-3">
                                <h6>Work Start</h6>
                            </div>
                            <div class="col-md-3">
                                {{ $job->work_start }}
                            </div>
                            <div class="col-md-3">
                                <h6>Work End</h6>
                            </div>
                            <div class="col-md-3">
                                {{ $job->work_end }}
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-4">
                                <h6>Kouta</h6>
                            </div>
                            <div class="col-md-8">
                                {{ $job->kouta }}
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-4">
                                <h6>Interview Date</h6>
                            </div>
                            <div class="col-md-8">
                                {{ $job->interview_date }}
                            </div>
                        </div>

                        <div class="row p-2">
                            <div class="col-md-4">
                                <h6>Interview Location</h6>
                            </div>
                            <div class="col-md-8">
                                {{ $job->interview }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-body">
                    <div class="overflow-auto" style="height:27rem">
                        @foreach ($log as $item)
                            <div class="p-3">
                                <div class="d-flex">
                                    <div
                                        style="display: inline-block;align-self:stretch;width:0.3rem;background-color:#435ebe;">
                                    </div>
                                    <p class="ms-3 my-auto">
                                        <b>{{ $item->user->name }}</b><br>
                                        {{ $item->activity }}
                                        <br>
                                        {{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}
                                    </p>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Dokumen</th>
                                    <th>Kontrak</th>
                                    <th>Japan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($job->come as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <a href="{{ route('apply.company.doc', ['id' => md5($item->user->id)]) }}"
                                                class="btn btn-sm btn-secondary rounded-pill">Dokumen</a>
                                        </td>
                                        <td>
                                            @if ($item->spk)
                                                <a target="_blank" href="{{ asset('storage/' . $item->spk) }}"
                                                    class="btn btn-primary btn-sm rounded-pill">File</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->heads->japan)
                                            {{ date('Y-m-d',strtotime($item->heads->japan)) }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->heads->work == 1)
                                                @if ($item->heads->japan)
                                                    <button type="button" class="btn btn-sm btn-success rounded-pill">Done</button>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-success rounded-pill"
                                                        data-bs-toggle="modal"
                                                        href="#go{{ $item->id }}">Karantina</button>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-sm btn-primary rounded-pill"
                                                    data-bs-toggle="modal"
                                                    href="#ver{{ $item->id }}">Verifikasi</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex">
                        <a href="{{ route('company.coe', ['id' => md5($job->id)]) }}"
                            class="btn btn-sm btn-primary rounded-pill my-3 me-3 w-25">Dokumen COE Bersama</a>
                        <a target="_blank" href="{{ route('company.interview', ['id' => md5($job->id)]) }}"
                            class="btn btn-sm btn-primary rounded-pill my-3 w-25">Dokumen Interview</a>
                    </div>
                    @foreach ($job->come as $item)
                        <div class="modal fade" id="ver{{ $item->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Kontrak</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <form action="{{ route('job.approve', ['id' => md5($item->head)]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <p>Anda akan menerima kontrak & melanjutkan Karantina ?</p>
                                                <div class="d-flex justify-content-start">
                                                    <button class="btn btn-success rounded-pill">Setuju</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="go{{ $item->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Go to Japan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <form action="{{ route('job.approve', ['id' => md5($item->head)]) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <p>Anda akan melanjutkan keberangkatan ?</p>
                                                <div class="form-group">
                                                    <label>Tanggal Berangkat</label>
                                                    <input type="date" name="date" class="form-control" required>
                                                </div>
                                                <div class="d-flex justify-content-start">
                                                    <button class="btn btn-success rounded-pill">Setuju</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-body">
                    <div class="px-3">
                        <form action="{{ route('job.kontrak', ['id' => md5($job->id)]) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <h6>Kontrak</h6>
                            <input class="form-control" name="file" type="file" id="formFile"
                                accept=".pdf, .docx" required>
                            @error('file')
                                <div class='small text-danger text-left'>{{ $message }}</div>
                            @enderror
                            <br>
                            <button class="btn btn-primary btn-block btn-sm rounded-pill">Upload</button>
                    </div>
                    </form>

                    <h6 class="mt-3">Email & Apply Document</h6>
                    <button type="button" class="btn btn-primary btn-sm btn-block rounded-pill mt-3"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Send
                    </button>
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Send Email & Document</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('job.send', ['job' => $job]) }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="px-3">
                                            <p>{{ $job->perusahaan->email }}</p>
                                            <ol>
                                                <li>COE</li>
                                                <li>kontrak</li>
                                            </ol>
                                            <button class="btn btn-dark btn-sm rounded-pill w-25">Send</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('apply.company') }}" class="btn btn-sm btn-danger rounded-pill my-3">Back</a>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    <script></script>
@endpush
