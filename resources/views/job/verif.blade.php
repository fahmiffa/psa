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
                        <h4 class="card-title">{{$data}}</h4>
                    </div>
                    <div class="p-2">                
                    </div>
                </div>       
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User</th>   
                                <th>Company</th>   
                                <th>Job</th>       
                                <th>LPK</th>                                                    
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($da as $item)            
                            <tr">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->job->perusahaan->name}}</td>   
                                <td>{{$item->job->section}}</td>                                   
                                <td>
                                    @if($item->user->siswa->third)
                                        {{$item->user->siswa->third->name}}
                                    @else
                                    Lintas Negeri
                                    @endif                                
                                </td>                                                                                      
                                <td>                          
                                    @if($item->status == 0)
                                        <button type="button" class="btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal" href="#ver{{$item->id}}">Verifikasi</button>
                                    @else                                                 
                                        @if($item->status == 1)                                            
                                            <button type="button" class="btn btn-sm btn-success rounded-pill" data-bs-toggle="modal" href="#appr{{$item->id}}">Approve</button>                                           
                                        @elseif($item->status == 2)                                  
                                            <button type="button" class="btn btn-sm btn-danger rounded-pill">Reject</button>   
                                        @elseif($item->status == 3)                                  
                                        <button type="button" class="btn btn-sm btn-success rounded-pill">Success</button>                                         
                                        @endif                              
                                    @endif
                            </td>      
                            </tr>                        
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @foreach($da as $item) 
        <div class="modal fade" id="ver{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Pekerjaan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="{{route('apply.update',['id'=>md5($item->id)])}}" method="post" enctype="multipart/form-data">    
                            @csrf            
                        <p class="">Anda akan menerima verifikasi ini, dan melanjutkan ke interview ?</p>               
                        <div class="form-group">
                            <label>Tanggal interview</label>
                            <input type="date" name="date" class="form-control" required>                                                       
                        </div>           

                        <div class="d-flex justify-content-start">                                        
                                <button class="btn btn-success rounded-pill">Setuju</button>
                                <button type="button" class="btn btn-danger rounded-pill ms-3" data-bs-toggle="modal" href="#reject{{$item->id}}">Tolak</button>         
                            </div>
                        </form>                     
                    </div>
                </div>              
              </div>
            </div>
        </div>

        <div class="modal fade" id="appr{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Interview</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="{{route('apply.update',['id'=>md5($item->id)])}}" method="post" enctype="multipart/form-data">    
                            @csrf            
                        <p class="lead">Anda akan menerima interview, dan melanjutkan ke kontrak ?</p>                                         
                        <div class="d-flex justify-content-start">                                        
                                <button class="btn btn-success rounded-pill">Setuju</button>
                                <button type="button" class="btn btn-danger rounded-pill ms-3" data-bs-toggle="modal" href="#reject{{$item->id}}">Tolak</button>         
                            </div>
                        </form>                     
                    </div>
                </div>              
              </div>
            </div>
        </div>

        
        <div class="modal fade" id="reject{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Menolak Verifikasi Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p class="small">Anda akan menolak interview, dan mengembalikan ke Offline Class ?</p>
                        <form action="{{ route('apply.reject', ['id'=>md5($item->id)]) }}" method="POST">    
                            @csrf    
                            <div class="form-group row mb-3">
                                <label>Keterangan</label>
                                <textarea class="form-control" rows="2" name="ket" required>{{old('ket')}}</textarea>   
                                <small class="text-danger">Silahkan Masukan Keterangan, jika di tolak</small>                                                       
                            </div>
                            <button class="btn btn-primary rounded-pill">Simpan</button>
                        </form>           

                    </div>
                </div>              
            </div>
            </div>
        </div>
      
        @endforeach     
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