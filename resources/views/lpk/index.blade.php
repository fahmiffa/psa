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
                {{-- <h3>{{$data}}</h3> --}}
                {{-- <p class="text-subtitle text-muted">Powerful interactive tables</p> --}}
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
                        <a href="{{route('third.create')}}" class="btn btn-primary btn-sm">Create LPK</a>
                    </div>
                </div>       
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Account</th>
                                <th>Name</th>        
                                <th>Kode</th>                                
                                <th width="20%">Alamat</th>  
                                <th width="20%">Deskripsi</th>                                                                              
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($da as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{strtoupper($item->kode)}}</td>
                                <td>{{$item->alamat}}</td>                                
                                <td class="text-justify">{{$item->note}}</td>                                      
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('third.destroy', $item->id) }}" method="POST">
                                        <a href="{{ route('third.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
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