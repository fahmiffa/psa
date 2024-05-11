@extends('layout.base')     
@section('main')
<div class="page-heading px-3">
    <h2 class="card-title">{{$data}}</h2>
</div>
<div class="page-content">
    <div class="card card-body px-5">
        <div class="row p-3">     
            <div class="col-lg-12 col-12 mb-3">
                <h6>Keterangan</h6>
                {{$job->note}} 
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Position</h6>
                {{$job->section}} 
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Kouta</h6>
                <small>{{$job->kouta}} </small>
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Salary</h6>
                {{number_format($job->salary,0,",",".")}}
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Alamat</h6>
                <small>{{$job->address}} </small>
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Tanggal</h6>
                <small>{{$job->open}} - {{$job->close}}</small>
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Interview</h6>
                <small>{{$job->interview}}</small>
            </div>    
        </div>       
        
        <form action="{{route('store.lpk', ['id'=>md5($job->id), 'user'=>md5($head->user->id)])}}" method="post" enctype="multipart/form-data">    
            @csrf

            <div class="form-group row mb-3">
                <div class="col-md-8">       
                  <label>Video</label>
                  <input class="form-control my-3" name="vid" type="file" accept=".mp4">
                  @error('vid')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                </div>
            </div>       
            <button class="btn btn-primary btn-sm w-25 rounded-pill">Apply</button>
        </form> 
    </div>
</div>

@endsection