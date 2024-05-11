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
        <div class="card mb-3">
            <div class="card-header">
                <div class="d-flex justify-content-between py-3">
                    <div class="p-2">
                        <h5 class="card-title">{{$data}}</h5>
                    </div>
                    <div class="p-2">
                        <a href="{{route('exam.create')}}" class="btn btn-primary btn-sm">Tambah Ujian</a>
                    </div>
                </div>       
            </div>
            <div class="card-body">   
                <div class="table-responsive">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Kelas</th> 
                                <th>Time</th> 
                                <th>Status</th>                    
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($da as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>         
                                <td>{{$item->kelas->name}}</td>         
                                <td>{{$item->time}} Minutes</td> 
                                <td>{!! ($item->status == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>' !!}</td>                                
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin Menghapus ?');" action="{{ route('exam.destroy', $item->id) }}" method="POST">
                                        <a href="{{ route('exam.edit', $item->id) }}" class="btn btn-sm btn-success"><i class="bi bi-pencil"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#myModal{{$item->id}}"><i class="bi bi-card-text"></i></button>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                            </td>                    
                            </tr>            
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    

        @foreach($da as $item)
        <div class="modal fade" id="myModal{{$item->id}}">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
          
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">{{$item->name}}</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
          
                <!-- Modal body -->
                <div class="modal-body">
                 <div class="container px-5">
                    @foreach($item->question as $row)
                    <h6 class="text-lowercase">{{$loop->iteration}}. {{$row->name}}</h6>
                    <p>A. {{$row->opsi_a}}</p>
                    <p>B. {{$row->opsi_b}}</p>
                    <p>C. {{$row->opsi_c}}</p>
                    <p>D. {{$row->opsi_d}}</p>
                    <p>E. {{$row->opsi_e}}</p>

                    <p>Key : {{$row->key}}</p>
                  @endforeach
                 </div>
                </div>
          
                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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