@extends('layout.base')     
@push('css')
<link rel="stylesheet" href="{{asset('assets/extensions/choices.js/public/assets/styles/choices.css')}}">
<link rel="stylesheet" href="{{asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/compiled/css/table-datatable-jquery.css')}}">

@endpush
@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{$data}}</h3>                
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
                <form action="{{route('student.store')}}" method="post">                                                                       
                    @csrf           
                    <div class="px-3">                   
                      <div class="form-group row mb-3">
                        <label class="col-md-3">Jenis Kelamin</label>
                        <div class="col-md-6">
                            <select class="form-control" name="gender">
                                <option value="1" @selected(old('gender') == '1')>Perempuan</option>
                                <option value="2" @selected(old('gender') == '2')>Laki-laki</option>
                            </select>
                            @error('gender')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                        </div>
                      </div>                
                      <div class="my-3 d-flex justify-content-start">
                          <button class="btn btn-primary rounded-pill">Next</button>
                          <div class="p-1"></div>
                          <button type="button" class="btn btn-danger  rounded-pill" onclick="goBack()"> Back</button>
                      </div>
                    </div>             
                  </form>   
            </div>
        </div>

    </section>

</div>
@endsection