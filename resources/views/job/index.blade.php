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
                        <a href="{{route('job.create')}}" class="btn btn-primary btn-sm">Create Job</a>
                    </div>
                </div>       
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Company</th>                 
                                <th>Name</th>                 
                                <th width="30%">Description</th>      
                                <th>Grant</th>                                                                              
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($job as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->perusahaan->name}}</td>   
                                <td>{{$item->section}}</td>                        
                                <td class="text-justify">{{$item->note}}</td>    
                                <td>
                                    @if($item->lpk)
                                        <p>{{ implode(", ",$item->lpk)}}</p>
                                    @endif
                                </td>                                          
                                <td>
                                    @if($item->status == 1)
                                    <span class="badge bg-success">Active</span>
                                    @else
                                    <span class="badge bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('job.destroy', $item->id) }}" method="POST">
                                        <a href="{{ route('job.edit', $item->id) }}" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                                        <a href="{{ route('job.show', $item->id) }}" class="btn btn-sm btn-secondary"><i class="bi bi-eye"></i></a>
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