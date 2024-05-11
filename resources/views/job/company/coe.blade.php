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
                                <h5 class="card-title">Data COE</h5>
                            </div>
                            <div class="p-2">
                                {{-- beta --}}
                                {{-- <a href="{{route('download',['id'=>md5(1)])}}" class="btn btn-dark rounded-pill btn-sm">Download</a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                            @if($be)
                                <div class="row my-3">
                                        <form action="{{ route('company.coe.generate', ['id' => md5($be->id)]) }}" method="post">
                                            @csrf
                                            @if ($be->doc == 4)
                                                <div class="row mb-3">
                                                    <label class="col-md-3">職種</label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="item" value="{{$job->section}}" class="form-control mb-3" >                                       
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3">Tanggal Dokumen</label>
                                                    <div class="col-md-6">
                                                        </label>
                                                        <input type="text" name="date" value="" class="form-control mb-3" >                                       
                                                    </div>                                     
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-md-3">作成責任者　役職・氏名</label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="bot" class="form-control mb-3" >                                       
                                                    </div>
                                                </div>
                                                <div class="justify-content-start">
                                                    <button class="btn btn-dark rounded-pill">Generate</button>
                                                    <button type="button" class="btn btn-danger rounded-pill ms-3"
                                                        onclick="goBack()">Back</button>
                                                </div>
                                            @endif

                                            @if ($be->doc == 5)                                 
                                                <div class="row mb-3">
                                                    <label class="col-md-3">Tanggal Dokumen</label>
                                                    <div class="col-md-6">
                                                        </label>
                                                        <input type="text" name="date" value="" class="form-control mb-3" >                                       
                                                    </div>                                     
                                                </div>
                                
                                                <div class="justify-content-start">
                                                    <button class="btn btn-dark rounded-pill">Generate</button>
                                                    <button type="button" class="btn btn-danger rounded-pill ms-3"
                                                        onclick="goBack()">Back</button>
                                                </div>
                                            @endif
                                         
                                            @if ($be->doc == 13)                                 
                                                <div class="row mb-3">
                                                    <label class="col-md-3">実施期間</label>
                                                    <div class="col-md-6">
                                                        </label>
                                                        <input type="text" name="bot" value="2023年12月19日から　　　　2023年02月28まで" class="form-control mb-3" >                                       
                                                    </div>                                     
                                                </div>

                                                <div class="row mb-3">
                                                    <label class="col-md-3">Tanggal Dokumen</label>
                                                    <div class="col-md-6">
                                                        </label>
                                                        <input type="text" value="2023/12/19" name="date" class="form-control mb-3" >                                       
                                                    </div>                                     
                                                </div>
                                
                                                <div class="justify-content-start">
                                                    <button class="btn btn-dark rounded-pill">Generate</button>
                                                    <button type="button" class="btn btn-danger rounded-pill ms-3"
                                                        onclick="goBack()">Back</button>
                                                </div>
                                            @endif
                                        </form>
                                </div>
                            @else
                            <div class="row my-3">
                                <div class="col-md-8">
                                    @php                  
                                        $role = [4, 5, 13];
                                        $role = array_diff($role, $coe);
                                    @endphp
                                    <form action="{{ route('company.coe.generate', ['id' => md5($job->id)]) }}" method="post">
                                        @csrf
                                        <div class="form-group my-3">
                                            <label class="mb-2">Dokumen</label>
                                            <select class="choices form-select" name="doc">
                                                @foreach ($role as $item)
                                                    <option value="{{ strtolower($item) }}"> {{ nameDoc($item) }}</option>
                                                @endforeach
                                            </select>
                                            @error('doc')
                                                <div class='small text-danger text-left'>{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="justify-content-start">
                                            <button class="btn btn-dark rounded-pill">Generate</button>
                                            <button type="button" class="btn btn-danger rounded-pill ms-3"
                                                onclick="goBack()">Back</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row my-3">
                                @foreach($doc as $val)
                                <div class="col-md-6 mb-5">                                            
                                    <div class="d-flex justify-content-between">
                                        <div class="p-1">
                                            <p class="text-wrap">Dokumen {{nameDoc($val->doc)}}</p>
                                        </div>
                                        <div class="p-1">
                                            <form action="{{route('coe.destroy',['id'=>md5($val->id)])}}" method="post">           
                                                @csrf  
                                                <button class="btn btn-danger btn-sm float-end"><i class="bi bi-trash"></i></button>   
                                            </form>
                                        </div>
                                    </div>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="no-scroll-iframe" width="100%" height="500" src="{{asset('storage/'.$val->dokumen)}}" allowfullscreen></iframe>
                                    </div>                                        
                                </div>
                                @endforeach
                            </div>
                            @endif
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
