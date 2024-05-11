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
                <h5 class="card-title">{{$data}}</h5>
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
        <div class="row">
            <div class="col-md-6 col-12 d-none">        
                <div class="card card-body">
                    <h6>Status</h6>                                 
                    @php                    
                        $st = $head->user->stat               
                    @endphp

                    <div class="divider divider-center">
                        <div class="divider-text h6">{{$head->user->state}}</div>                    
                    </div> 

                    @if($st == 5)
                        <div class="table-responsive w-50">
                            <table class="table table-borderless">          
                                <tbody>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>: {{date('d-M-Y',strtotime($head->apply->interview))}}</td>             
                                </tr>
                                <tr>
                                    <td>Tempat</td>
                                    <td>: {{$head->apply->job->perusahaan->name}}, {{$head->apply->job->interview}}</td>   
                                </tr>         
                                </tbody>
                            </table>                          
                        </div>
                    @endif      

                </div>                
            </div>
            <div class="col-md-6 col-12">        
                <div class="card card-body">
                    <h6>Pembayaran</h6>                       
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
                                    @foreach($head->paid as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ucfirst($item->payment->name)}}</td>                            
                                        <td>{{number_format($item->payment->nominal,0,",",".")}}</td>                                                                        
                                        <td>{!! ($item->status == 1) ? '<span class="badge bg-success">Success</span>' : '<span class="badge bg-danger">On progress</span>' !!}</td>                                                  
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
                                @foreach($head->murid->materi as $item)
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
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
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
                                    @if($item->job)           
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->apply->job->perusahaan->name}}</td>   
                                        <td>{!! ($item->status == 1) ? '<span class="badge bg-success">Done</span>' : '<span class="badge bg-danger">On progress</span>' !!}</td>                                                                                                                                                                                                                                                                       
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