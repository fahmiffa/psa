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
                    <h5 class="card-title">Dokumen {{$type}}</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('coe.generate',['id'=>2])}}" method="post">            
                        @csrf       
                        @php
                            if($coe == 2)
                            {
                                $n = 7;
                            }
                        @endphp
                        <div class="form-group row my-3">
                            <div class="col-md-4">
                                <label class="mb-2">Item</label>
                                @for ($i = 0; $i < $n; $i++)
                                <input type="text" name="item[]" class="form-control mb-3" placeholder="Item {{$i+1}}" required>
                                @endfor                                
                            </div>
                            <div class="col-md-8">                        
                                <iframe src="{{asset('assets/doc/'.$type.'.pdf')}}" height="800" width="600"  frameborder="0"></iframe>
                            </div>
                        </div>                      
                        <button class="btn btn-dark rounded-pill w-25">Generate Dokumen</button>                                          
                    </form>          
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
