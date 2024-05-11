@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">
<style>
    .imgs{
        object-fit: cover;
    height: 50px;
    width: 80px;
    }
    </style>
@endpush
@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">    
                <h4>{{$data}}</h4>    
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
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>                          
                                <th>Company</th>                                                    
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($da as $item)            
                            <tr>
                                <td>{{$loop->iteration}}</td>                   
                                <td>{{$item->job->name}}</td>                                                                                      
                                <td>                                    
                                    @if($item->status == 0)
                                        <button type="button" class="btn btn-sm btn-warning rounded-pill">Pending</button>                     
                                    @elseif($item->status == 1)
                                        <button type="button" class="btn btn-sm btn-success rounded-pill">Approve</button>                                               
                                    @elseif($item->status == 2)                                  
                                        <button type="button" class="btn btn-sm btn-danger rounded-pill">Reject</button>   
                                    @else
                                        <button type="button" class="btn btn-sm btn-success rounded-pill">Interviewed</button>   
                                    @endif                                                    
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