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
                    <h5 class="card-title">{{$data}}</h5>                
                    <div class="d-flex justify-content-between">
                        <a href="{{route('user.create')}}" class="btn btn-primary rounded-pill">Create User</a>
                        &nbsp;&nbsp;&nbsp;
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle me-1 rounded-pill" type="button"
                                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Download
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{route('report',['par'=>'siswa','pile'=>'xls'])}}">Excel</a>
                                    <a class="dropdown-item" href="{{route('report',['par'=>'siswa','pile'=>'pdf'])}}" href="#">PDF</a>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>       
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>     
                                <th>Role</th>                                                        
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $item)
                            @if($item->status != 3)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->hp}}</td>  
                                    <td>{{typeRole($item->role)}}</td>                                         
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('user.destroy', $item->id) }}" method="POST">
                                            <a href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                </td>                    
                                </tr>            
                            @endif
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