@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">
@endpush
@section('main')
<div class="page-heading">
    @if(session('error'))
    <div class="alert alert-danger" id="timeoutAlert" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @include('notif')
</div>
<div class="page-content">
    <div class="row">
        <div class="col-md-6 col-12">        
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-start mb-4">
                        <div class="stats-icon green mb-2">
                            <i class="iconly-boldUser"></i>                                
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted font-semibold">Bekerja</h6>
                            <h6 class="font-extrabold mb-0">{{$head->where('status',1)->count()}}</h6>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-start">
                        <div class="stats-icon red mb-2">
                            <i class="iconly-boldUser"></i>                                
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted font-semibold">Pendaftaran</h6>
                            <h6 class="font-extrabold mb-0">{{$head->where('status','!=',1)->count()}}</h6>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-start mb-4">
                        <div class="stats-icon blue mb-2">
                            <i class="iconly-boldUser"></i>                                
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted font-semibold">Peserta</h6>
                            <h6 class="font-extrabold mb-0">{{$student->count()}}</h6>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-start">
                        <div class="stats-icon purple mb-2">
                            <i class="iconly-boldUser"></i>                                
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted font-semibold">Total Siswa</h6>
                            <h6 class="font-extrabold mb-0">{{$student->count()}}</h6>
                        </div>
                    </div>                 
                </div>  
            </div>
        </div>
        <div class="col-md-6 col-12">        
            <div class="card card-body">
                <h6>Pekerjaan</h6>  
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Bagian</th>        
                                <th>Kouta</th>                                                                                                                                                          
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($job as $item)
                            @if($item->grants)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->perusahaan->name}}</td>
                                <td>{{$item->section}}</td>
                                <td>{{$item->kouta}}</td>                                                                                                           
                                <td>
                                    <a href="{{ route('detail.job.lpk', ['id'=>md5($item->id)]) }}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>                             
                            </td>                    
                            </tr>            
                            @endif
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-12">        
            <div class="card card-body">                
                <div class="d-flex justify-content-between py-3">
                    <div class="p-2">
                        <h5 class="card-title">Data Siswa</h5>
                    </div>
                    <div class="p-2">
                        <a href="{{route('student.create')}}" class="btn btn-primary btn-sm">Tambah Siswa</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>             
                                <th>Name</th>  
                                <th>No HP</th>  
                                <th>Email</th>                                                                                                                     
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @if($item->siswa)
                                        {{ $item->siswa->name }}
                                    @endif
                                </td>   
                                <td>
                                    @if($item->siswa)
                                        {{ $item->siswa->hp }}
                                    @endif
                                </td>   
                                <td>
                                    @if($item->siswa)
                                    {{ $item->siswa->email }}
                                    @endif
                                </td>                                                         
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('student.destroy', $item->id) }}" method="POST">                                       
                                        <a href="{{ route('lpk.edit', ['id'=>md5($item->siswa->id)]) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                            </td>                    
                            </tr>            
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')    
<script>
@if(session('error'))
    var timeoutAlert = document.getElementById('timeoutAlert');
    setTimeout(function() {
        timeoutAlert.style.display = 'none';
    }, 3000); 
@endif    
</script>

<script src="https://zuramai.github.io/mazer/demo/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="https://zuramai.github.io/mazer/demo/assets/static/js/pages/dashboard.js"></script>

<script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/datatables.js')}}"></script>
@endpush
