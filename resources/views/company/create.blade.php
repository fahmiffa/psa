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

                @isset($company)
                <form action="{{route('company.update',['company'=>$company])}}" method="post" enctype="multipart/form-data">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('company.store')}}" method="post" enctype="multipart/form-data">                               
                @endif                    
                    @csrf           
                    <div class="px-5">
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" name="name" value="{{isset($company) ? $company->name : old('name')}}"   class="form-control">
                                @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label>Phone</label>
                                <input type="number" name="phone" value="{{isset($company) ? $company->phone : old('phone')}}"   class="form-control">
                                @error('phone')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" value="{{isset($company) ? $company->email : old('email')}}"   class="form-control">
                                @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>        
                            <div class="col-md-6">
                                <label>Admin</label>
                                <input type="text" name="admin" value="{{isset($company) ? $company->admin : old('admin')}}"   class="form-control">
                                @error('admin')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>              
                        </div>

                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label>Director</label>
                                <input type="text" name="director" value="{{isset($company) ? $company->director : old('director')}}"   class="form-control">
                                @error('director')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label>Phone Director</label>
                                <input type="number" name="phone_director" value="{{isset($company) ? $company->phone_director : old('phone_director')}}"   class="form-control">
                                @error('phone_director')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">                  
                            <div class="col-md-6">                                
                                <label>Address</label>
                                <textarea class="form-control" name="addr" rows="2">{{isset($company) ? $company->addr : old('addr')}}</textarea>
                                @error('addr')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label>Map</label>
                                <input type="text" name="map" value="{{isset($company) ? $company->map : old('map')}}"   class="form-control">
                                @error('map')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>
                      

                       <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label>Section</label>
                                <select class="choices form-select" name="section">
                                    <option value="KAIGO" @selected(isset($company) && $company->section == 'KAIGO')>KAIGO</option>
                                    <option value="KONSTRUKSI" @selected(isset($company) && $company->section == 'KONSTRUKSI') >KONSTRUKSI</option>
                                    <option value="INDUSTRI" @selected(isset($company) && $company->section == 'INDUSTRI')>INDUSTRI</option>
                                    <option value="PETERNAKAN" @selected(isset($company) && $company->section == 'PETERNAKAN')>PETERNAKAN</option>
                                    <option value="PERTANIAN" @selected(isset($company) && $company->section == 'PERTANIAN')>PERTANIAN</option>
                                    <option value="HOSPITALITY" @selected(isset($company) && $company->section == 'HOSPITALITY')>HOSPITALITY</option>
                                    <option value="GROUND_HANDLING" @selected(isset($company) && $company->section == 'GROUND_HANDLING')>GROUND HANDLING</option>
                                </select>
                                @error('section')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>                                         

                        <div class="mb-3 d-flex justify-content-start">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger ms-3" href="{{route('company.index')}}">Back</a>
                        </div>
                    </div>             
                </form>
            </div>
        </div>

    </section>

</div>
@endsection

@push('js')    
<script src="{{asset('assets/extensions/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/static/js/pages/datatables.js')}}"></script>

<script src="{{asset('assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset('assets/static/js/pages/form-element-select.js')}}"></script>
@endpush