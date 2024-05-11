@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">

@endpush
@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{$data}}</h3>                
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$data}}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section">
        <div class="card">       
            <div class="card-body">     
                @isset($head)
                @php 
                    $st = $head->user->stat;                 
                @endphp
                    @if($st == 6)
                        <form action="{{route('store.lpk',['id'=>md5($paymentDoc->id), 'user'=>md5($head->user->id)])}}" method="post" enctype="multipart/form-data">                                                   
                                @csrf           
                            <div class="px-5">                                                                        

                                <div class="form-group row mb-3">
                                    @php $payment = $paymentDoc; @endphp
                                    @include('lpk.payment.index');  
                                </div>
        
                                <div class="mb-3 d-flex justify-content-start">
                                    <button class="btn btn-primary rounded-pill">Send</button>
                                    <a class="btn btn-danger ms-3 rounded-pill" href="{{route('kelas.lpk')}}">Back</a>
                                </div>
                            </div>             
                        </form>
                    @endif

                    @if($st == 3)
                        @foreach ($job as $item)
                            @if($item->limit && $item->grants)
                                <a href="{{route('apply.lpk',['id'=>md5($item->id), 'head'=>md5($head->id)])}}">
                                    <div class="row bg-body shadow-sm p-3 mb-3">
                                        <div class="col-lg-3 col-6 mb-3">
                                            <h6>Nama</h6>
                                            {{$item->perusahaan->name}} 
                                        </div>
                                        <div class="col-lg-3 col-6 mb-3">
                                            <h6>Position</h6>
                                            {{$item->section}} 
                                        </div>
                                        <div class="col-lg-3 col-6 mb-3">
                                            <h6>Kouta</h6>
                                            <small>{{$item->kouta}} </small>
                                        </div>
                                        <div class="col-lg-3 col-6 mb-3">
                                            <h6>Salary</h6>
                                            {{number_format($item->salary,0,",",".")}}
                                        </div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @endif

                    @if($st == 9)
                        <div class="divider divider-center">
                            <div class="divider-text h6">{{$head->user->state}}</div>                    
                        </div>

                        <a target="_blank" href="{{asset('storage/'.$head->apply->kontrak)}}" class="btn btn-primary btn-sm rounded-pill">Dokumen Kontrak</a>            
                       
                        <form action="{{route('store.lpk', ['id'=>md5($head->apply->id), 'user'=>md5($head->user->id)])}}" method="post" enctype="multipart/form-data">    
                            @csrf
                            <div class="my-3 col-md-6">
                                <h6>File Kontrak</h6>
                                <input class="form-control" name="file" type="file" id="formFile" accept=".pdf" required>
                                @error('file')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                </div>
                            <button class="btn btn-primary rounded-pill">Upload</button>
                        </form> 
                    @endif

                    @if($st == 11)
                        <form action="{{route('store.lpk',['id'=>md5($paymentJob->id), 'user'=>md5($head->user->id)])}}" method="post" enctype="multipart/form-data">                                                   
                                @csrf           
                            <div class="px-5">                                                                        

                                <div class="form-group row mb-3">
                                    @php $payment = $paymentJob; @endphp
                                    @include('lpk.payment.index');  
                                </div>
        
                                <div class="mb-3 d-flex justify-content-start">
                                    <button class="btn btn-primary rounded-pill">Send</button>
                                    <a class="btn btn-danger ms-3 rounded-pill" href="{{route('kelas.lpk')}}">Back</a>
                                </div>
                            </div>             
                        </form>
                    @endif
                @else    
                <form action="{{route('store.lpk',['id'=>md5($paymentStudy->id), 'user'=>0])}}" method="post" enctype="multipart/form-data">                                                   
                     @csrf           
                    <div class="px-5">
                        <div class="form-group row mb-3">
                            <label>Siswa</label>                               
                            <div class="col-md-12">
                                <select class="choices form-select" name="siswa">
                                    <option value="">Pilih Siswa</option>
                                    @foreach($student as $item)
                                    <option value="{{$item->siswa->id}}">{{ucfirst($item->siswa->name)}}</option>
                                    @endforeach                       
                                </select>
                                @error('siswa')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>                                                   

                        <div class="mb-3 d-flex justify-content-start">
                            <button class="btn btn-primary rounded-pill">Submit</button>
                            <a class="btn btn-danger ms-3 rounded-pill" href="{{route('kelas.lpk')}}">Back</a>
                        </div>
                    </div>             
                </form>
                @endisset                                        
            </div>
        </div>

    </section>

</div>
@endsection

@push('js')    
<script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/datatables.js')}}"></script>

<script src="{{asset('assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset('assets/static/js/pages/form-element-select.js')}}"></script>

@endpush