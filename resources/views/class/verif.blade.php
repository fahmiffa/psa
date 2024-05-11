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
                                <th>Peserta</th>                        
                                <th>Kelas</th>                                                                                  
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($da as $item)                            
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->user->name}}</td>   
                                <td>                              
                                    @if($item->user->siswa && $item->user->siswa->class)
                                        {{$item->user->siswa->class->name}}                        
                                    @endif
                                </td>                                                                                                                                                                           
                                <td>
                                    @if($item->status == 5)
                                    <button type="button" class="btn btn-sm btn-primary rounded-pill" data-bs-toggle="modal" href="#ver{{$item->id}}">Verifikasi</button>
                                    @else 
                                    <button type="button" class="btn btn-sm btn-success rounded-pill">Telah Verifikasi</button>
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
                    <h5 class="modal-title" id="staticBackdropLabel">Verifikasi Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">            
                            <form action="{{route('kelas.update', md5($item->participant))}}" method="post">    
                                @csrf                    
                                <div class="form-group row mb-3">
                                    <label>Pilih Kelas</label>                               
                                    <div class="col-md-12">
                                        <select class="choices form-select" name="kelas" required>
                                            <option value="">Kelas</option>
                                            @foreach($kelas as $item)
                                            <option value="{{$item->id}}"  @selected(isset($user) && $user->role == $item)>{{ucfirst($item->name)}} ({{$item->guru->name}})</option>
                                            @endforeach                       
                                        </select>
                                        @error('kelas')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                    </div>
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