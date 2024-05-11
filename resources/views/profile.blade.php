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
                {{-- <p class="text-subtitle text-muted">Powerful interactive tables</p> --}}
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
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center flex-column">
                            <div class="avatar avatar-2xl">
                                <img src="{{asset('assets/compiled/jpg/1.jpg')}}" alt="Avatar">
                            </div>

                            <h3 class="mt-3">{{auth()->user()->name}}</h3>                         
                            <p class="text-small text-capitalize">{{strtoupper(auth()->user()->role)}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('account')}}" method="post">                                                                       
                            @csrf           
                            <div class="px-5">
                                <div class="form-group row mb-3">
                                    <label class="col-md-3">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" value="{{isset($user) ? $user->name : old('name')}}"   class="form-control">
                                        @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3">Email</label>
                                    <div class="col-md-6">
                                        <input type="email" name="email" value="{{isset($user) ? $user->email : old('email')}}"   class="form-control">
                                        @error('email')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <label class="col-md-3">Hp</label>
                                    <div class="col-md-6">
                                        <input type="number" name="hp" value="{{isset($user) ? $user->hp : old('hp')}}"   class="form-control">
                                        @error('hp')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                    </div>
                                </div>            
                                <div class="form-group row mb-3">
                                    <label class="col-md-3">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" name="password" value="{{isset($user) ? null : old('password')}}"   class="form-control">
                                        @error('password')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                    </div>
                                </div>
        
                                <div class="mb-3 d-flex justify-content-start">
                                    <button class="btn btn-primary">Save Changes</button>
                                    <a class="btn btn-danger ms-3" href="{{route('home')}}">Back</a>
                                </div>
                            </div>             
                        </form>
                    </div>
                </div>
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