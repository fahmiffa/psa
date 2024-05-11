@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
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

</div>

<div class="page-content px-3">
    <div class="row">  
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ucfirst($data)}}</h5>
                </div>
                <div class="card-body">
                    <div class="row px-3">
                        <div class="col-md-6 mb-3">
                            <h6>Deskripsi</h6>
                            {{$job->note}}
                        </div>                                
                        <div class="col-md-6 mb-3">
                            <h6>Salary</h6>
                            {{number_format($job->salary,0,",",".")}}
                        </div>            
                        <div class="col-md-6 mb-3">
                            <h6>PIC</h6>
                            {{$job->pic_name}}
                        </div>                
                        <div class="col-md-6 mb-3">
                            <h6>Agency</h6>
                            {{$job->agency_name}}
                        </div>                   
                        <div class="col-md-3 mb-3">
                            <h6>Open Hiring</h6>
                            {{$job->open}}
                        </div>                
                        <div class="col-md-3 mb-3">
                            <h6>Close Hiring</h6>
                            {{$job->close}}
                        </div>                 
                        <div class="col-md-3 mb-3">
                            <h6>Work Start</h6>
                            {{$job->work_start}}
                        </div>       
                        <div class="col-md-3 mb-3">
                            <h6>Work End</h6>
                            {{$job->work_end}}
                        </div>                    
                        <div class="col-md-3 mb-3">
                            <h6>Kouta</h6>
                            {{$job->kouta}}
                        </div>                 
                        <div class="col-md-3 mb-3">
                            <h6>Interview Date</h6>
                            {{$job->interview_date}}
                        </div>               
                        <div class="col-md-3 mb-3">
                            <h6>Interview Location</h6>
                            {{$job->interview}}
                        </div>                  
                        @if(auth()->user()->role == 'admin')
                        <form action="{{route('job.grant',['job'=>$job])}}" method="post">                                                                                  
                            @csrf                                            
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="grant" type="checkbox" id="flexSwitchCheckChecked" {{($job->status == 1) ? 'checked' : null }}>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Grant</label>
                            </div>
                  
                            <div class="form-group my-3">
                                <label>LPK Penyangggah</label>
                                <select class="choices form-select multiple-remove" name="grantTo[]"  multiple="multiple">
                                        @if($job->grant)
                                            @php $val = json_decode($job->grant);                                       
                                            @endphp
                                            @foreach ($lpk as $item)                                        
                                                <option value="{{$item->id}}" @selected(in_array($item->id,$val))>{{$item->name}}</option>      
                                            @endforeach                                     
                                                <option value="0" @selected(in_array(0,$val))>{{env('APP_NAME')}}</option>      
                                        @else
                                            @foreach ($lpk as $item)               
                                            <option value="{{$item->id}}">{{$item->name}}</option>   
                                            @endforeach
                                            <option value="0">{{env('APP_NAME')}}</option>           
                                        @endif                                                                

                                </select>
                                <small class="text-danger">Kosongkan pilihan LPK Penyangggah, jika ingin menggunakan {{env('APP_NAME')}} </small>
                            </div>
                            <div class="my-3 d-flex justify-content-start">
                                <button class="btn btn-primary rounded-pill">Save</button>                                                                                                            
                                <a href="{{route('job.index')}}" class="btn btn-danger rounded-pill ms-3">Back</a>
                            </div> 
                        </form>                          
                        @else
                        <div class="my-3 d-flex justify-content-start">                                                                                                                       
                            <a href="{{route('job.index')}}" class="btn btn-danger rounded-pill ms-3">Back</a>
                        </div>
                        @endif            
                    </div>                                       
                </div>
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
<script src="{{asset('assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset('assets/static/js/pages/form-element-select.js')}}"></script>

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
