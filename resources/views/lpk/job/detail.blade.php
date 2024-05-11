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
    <h3 class="card-title">{{$data}}</h3>
</div>

<div class="page-content px-3">
    <div class="row">  
        <div class="col-md-12">
            <div class="card card-body">
                <div class="row p-2">
                    <div class="col-md-4">
                        <h6>Deskripsi</h6>
                    </div>
                    <div class="col-md-8">
                        {{$job->note}}
                    </div>               
                </div>
                <div class="row p-2">
                    <div class="col-md-4">
                        <h6>Salary</h6>
                    </div>
                    <div class="col-md-8">
                        {{number_format($job->salary,0,",",".")}}
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4">
                        <h6>PIC</h6>
                    </div>
                    <div class="col-md-8">
                       {{$job->pic_name}}
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-md-4">
                        <h6>Agency</h6>
                    </div>
                    <div class="col-md-8">
                       {{$job->agency_name}}
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-md-4">
                        <h6>Hiring</h6>
                    </div>
                    <div class="col-md-4">
                        <h6>Open</h6>
                       {{$job->open}}
                    </div>
                    <div class="col-md-4">
                        <h6>Close</h6>
                        {{$job->close}}
                    </div>           
                </div>

                <div class="row p-2">
                    <div class="col-md-4">
                        <h6>Work</h6>
                    </div>
                    <div class="col-md-4">
                        <h6>Start</h6>
                       {{$job->work_start}}
                    </div>           
                    <div class="col-md-4">
                        <h6>End</h6>
                       {{$job->work_end}}
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-md-4">
                        <h6>Kouta</h6>
                    </div>
                    <div class="col-md-8">
                       {{$job->kouta}}
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-md-4">
                        <h6>Interview Date</h6>
                    </div>
                    <div class="col-md-8">
                       {{$job->interview_date}}
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-md-4">
                        <h6>Interview Location</h6>
                    </div>
                    <div class="col-md-8">
                       {{$job->interview}}
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
<script>

</script>
@endpush
