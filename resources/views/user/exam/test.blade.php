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
                <form action="{{route('daftar.store',['id'=>md5($test->id)])}}" class="mx-3" method="post">
                    @csrf
                    @foreach($test->exam->question as $row)
                    <h6 class="text-capitalize">{{$loop->iteration}}. {{$row->name}}</h6>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="a" name="q[{{$row->id}}]">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <p>A. {{$row->opsi_a}}</p>
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="b" name="q[{{$row->id}}]">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <p>B. {{$row->opsi_b}}</p>
                        </label>
                    </div>


                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="c" name="q[{{$row->id}}]">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <p>C. {{$row->opsi_c}}</p>
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="d" name="q[{{$row->id}}]">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <p>D. {{$row->opsi_d}}</p>
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="e" name="q[{{$row->id}}]">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <p>E. {{$row->opsi_e}}</p>
                        </label>
                    </div>

                  @endforeach

                  <button class="btn btn-primary float-end rounded-pill">Save</button>
                </form>
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