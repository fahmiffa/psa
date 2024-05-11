@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">
@endpush
@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">            
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
            <div class="card-header">
                <div class="d-flex justify-content-between py-3">
                    <div class="p-2">
                        <h5 class="card-title">{{$data}}</h5>
                    </div>
                    <div class="p-2">
                        <a href="{{route('reg.lpk')}}" class="btn btn-primary btn-sm rounded-pill">Daftar Siswa</a>
                    </div>
                </div>       
            </div>
            <div class="card-body">    
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Dokumen</th>
                                <th>Status</th>                                
                                <th>Detail</th>                                
                            </tr>
                        </thead>
                        <tbody>                                            
                            @foreach($head as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->user->name}}</td>
                                <td><a class="btn btn-primary btn-sm rounded-pill" href="{{route('doc.lpk',['id'=>md5($item->participant)])}}">Dokumen</a></td>
                                <td>{{$item->user->state}}

                                    @php                 
                                    $button = [3,6,9,11];
                                    @endphp  

                                    @if(in_array($item->user->stat,$button))
                                        &nbsp;<a href="{{ route('daftar.lpk', ['id'=>md5($item->user->id)]) }}" class="btn btn-sm btn-danger rounded-pill">Next</a>                             
                                    @endif                             
                                </td>    
                                <td>
                                    <a href="{{ route('detail.lpk', ['id'=>md5($item->user->id)]) }}" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i></a>                                                            
                                </td>                                        
                            </tr>                           
                            @endforeach      
                        </tbody>
                    </table>
                </div>                    
            </div>
        </div>

    </section>
    <!-- Basic Tables end -->

</div>
@endsection

@push('js')    
<script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/datatables.js')}}"></script>
@endpush