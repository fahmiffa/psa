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
<div class="page-heading px-3">
    @if(session('error'))
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

    <h3 class="card-title">Selamat Datang, <span class="text-capitalize">{{auth()->user()->name}}</span></h3>

    @include('participant.notif')

</div>

<div class="page-content px-3">
    <div class="row">  
        <div class="col-md-12 col-12">
            <div class="card card-body">
                <div class="row">                          
                    <div class="divider divider-center">
                        <div class="divider-text h6">Informasi</div>
                    </div>  
                    <div class="col-md-12 col-12 my-3">    
                        <div class="row px-3">
                            <div class="col-md-3">
                                <label for="disabledInput">Nama Lengkap</label>
                                <p class="form-control-static">{{$data->fullname}}</p>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="disabledInput">Username</label>
                                <p class="form-control-static">{{auth()->user()->name}}</p>
                            </div>
    
                            <div class="col-md-3">
                                <label for="disabledInput">Email</label>
                                <p class="form-control-static">{{auth()->user()->email}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Phone</label>
                                <p class="form-control-static">{{auth()->user()->hp}}</p>
                            </div>

                        </div>
                    </div>
                    
                    <div class="col-md-12 col-6 mb-3">    
                        <div class="row px-3">
                            <div class="col-md-3">
                                <label for="disabledInput">Status</label>
                                <p class="form-control-static">
                                    @if($student)
                                    Kelas {{ucfirst($student->class->type)}} 
                                    @endif
                                </p>
                            </div>

                            <div class="col-md-6">
                                <label for="disabledInput">Alamat</label>
                                <p class="form-control-static">{{$data->alamat}}</p>
                            </div>                                         

                        </div>
                        <a class="btn btn-primary btn-sm rounded-pill float-end" href="{{route('profile.index',['id'=>md5(auth()->user()->id)])}}">Detail</a>   
                    </div>

                </div>            
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 col-12 p-1">        
            <div class="card card-body">
                <div class="d-flex justify-content-between">
                    <h6>Pembayaran</h6>   
                    <a class="btn btn-primary btn-sm rounded-pill" href="{{route('pay')}}">Detail</a>   
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>                              
                                <th>Nominal</th>      
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>               
                                @foreach($paid as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ucfirst($item->payment->name)}}</td>                            
                                    <td>{{number_format($item->payment->nom,0,",",".")}}</td>                                                                        
                                    <td>
                                        @if($item->status == 2)
                                            <span class="badge bg-danger">Reject</span>
                                        @else
                                            {!! ($item->status == 1) ? '<span class="badge bg-success">Success</span>' : '<span class="badge bg-warning text-dark">On progress</span>' !!}
                                        @endif
                                    </td>                                                  
                                </tr>            
                                @endforeach               
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="card card-body">
                <h6>Materi</h6>   
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>                              
                                <th>File</th>      
                            </tr>
                        </thead>
                        <tbody>     
                            @if($student)          
                                @foreach($student->materi as $item)
                                    @if($item->status ==1)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ucfirst($item->name)}}</td>   
                                            <td>
                                                <a target="_blank" href="{{ asset($item->file) }}" class="btn btn-sm btn-dark"><i class="bi bi-files"></i></a></td>   
                                            </td>                                                                                                                                                              
                                        </tr>            
                                    @endif
                                @endforeach       
                            @endif        
                        </tbody>
                    </table>
                </div> 
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 col-12">        
            <div class="card card-body">
                <h6>Nilai</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kelas</th>                              
                                <th>Nilai</th>      
                            </tr>
                        </thead>
                        <tbody>               
                            @foreach($nilai as $item)               
                            <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ucfirst($item->class->name)}}</td>   
                                    <td>{{$item->value}}</td>                                                                                                                                                                                    
                                </tr>                              
                                @endforeach               
                        </tbody>
                    </table>
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
                                <th>Perusahaan</th>                              
                                <th>Status</th>      
                            </tr>
                        </thead>
                        <tbody>               
                            @if($heads)
                            @foreach($heads as $item)               
                            <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->apply->job->perusahaan->name}}</td>   
                                    <td>{!! ($item->status == 1) ? '<span class="badge bg-success">Done</span>' : '<span class="badge bg-danger">On progress</span>' !!}</td>                                                                                                                                                                                                                                                             
                                </tr>                              
                                @endforeach               
                            @endif
                        </tbody>
                    </table>
                </div>  
            </div>
        </div>
    </div>   
</div>

@endsection

@push('js')    
<script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/datatables.js')}}"></script>
<script>
    @if(session('error'))
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
