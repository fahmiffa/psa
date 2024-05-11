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

                @isset($exam)
                <form action="{{route('exam.update',['exam'=>$exam])}}" method="post" enctype="multipart/form-data">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('exam.store')}}" method="post" enctype="multipart/form-data">                               
                @endif                    
                    @csrf           
                    <div class="px-5">
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Name</label>
                            <div class="col-md-6">
                                <input type="text" name="name" value="{{isset($exam) ? $exam->name : old('name')}}"   class="form-control">
                                @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3">Kelas</label>                   
                            <div class="col-md-6">
                                <select class="choices form-select" name="kelas">
                                    @foreach($kelas as $item)
                                    <option value="{{$item->id}}"  @selected(isset($exam) && $exam->kelas_id == $item->id)>{{$item->name}}</option>
                                    @endforeach                       
                                </select>
                                @error('kelas')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Time</label>
                            <div class="col-md-6">
                                <input type="number" name="time" value="{{isset($exam) ? $exam->time : old('time')}}"   class="form-control">
                                <small class="text-danger">In Minutes</small>
                                @error('time')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3">Status</label>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="status" {{isset($exam) && $exam->status == 1 ? 'checked' : null}}>                                
                                </div>                            
                            </div>
                        </div>
                                             
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Question</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="number" value="{{isset($exam) ? count($exam->question) : null}}"  min="1" class="form-control" id="nquest" name="nquest" required>    
                                    <button class="btn btn-primary" onclick="question()" type="button">Tambah</button>         
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="q">
                                            @isset($exam)                
                                              @foreach($exam->question as $row)   
                                                <div class="my-3">
                                                    <label class="form-label">Number {{$loop->iteration}} : </label>
                                                    <input type="text" class="form-control" value="{{$row->name}}" name="q[{{$loop->index}}]" placeholder="Question {{$loop->iteration}}" required="">
                                                    <div class="my-3 form-group">
                                                        @for($i=0; $i < 5; $i++)
                                                        <div class="my-3 input-group">
                                                            <span class="input-group-text">{{chr(65 + $i)}}</span>
                                                            @php $opsi = 'opsi_'.strtolower(chr(65 + $i)); @endphp
                                                            <input class="form-control" name="ans{{$loop->index}}[{{$i}}]" value="{{$row->$opsi}}" required="">
                                                        </div>                 
                                                        @endfor                                  
                                                        <div class="my-3 input-group">
                                                            <span class="input-group-text">Key</span>
                                                            <input class="form-control" name="ans{{$loop->index}}[{{$i}}]" value="{{$row->key}}" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                              @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div> 
                            </div>                         
                        </div>  
                        <div class="mb-3 d-flex justify-content-start">
                            <button class="btn btn-primary">{{isset($exam) ? 'Update' : 'Save'}}</button>
                            <a class="btn btn-danger ms-3" href="{{route('exam.index')}}">Back</a>
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

<script>    
    function question() {      
      var n = document.getElementById('nquest').value;      
      document.getElementById('q').innerHTML = '';
      
      for (let i = 0; i <= n-1; i++) {

        var numb = 1+i;

        let soalDiv = document.createElement('div');
        soalDiv.className = 'my-3';
          
        let labelSoal = document.createElement('label');
        labelSoal.className = 'form-label';
        labelSoal.textContent = 'Number '+numb+' : ';
        soalDiv.appendChild(labelSoal);
          
        let inputText = document.createElement('input');
        inputText.type = 'text';
        inputText.className = 'form-control';
        inputText.name = 'q['+i+']';
        inputText.placeholder = 'Question '+numb;
        inputText.required = true;
        soalDiv.appendChild(inputText);

        
        let formGroup = document.createElement('div');
        formGroup.className = 'my-3 form-group';
        
        var abjad = ['A','B','C','D','E','Key']; 

        for (let x = 0; x < abjad.length; x++) {            
                 
            let inputGroup = document.createElement('div');
            inputGroup.className = 'my-3 input-group';      
            let opsiA = document.createElement('span');        
            opsiA.className = 'input-group-text';
            opsiA.textContent = abjad[x];
            inputGroup.appendChild(opsiA);
            let inputA = document.createElement('input');
            inputA.className = 'form-control';
            inputA.name = 'ans'+i+'['+x+']';
            inputA.required = true;        
            inputGroup.appendChild(inputA);  

            formGroup.appendChild(inputGroup);
        }
                     
        soalDiv.appendChild(formGroup);           
        document.getElementById('q').appendChild(soalDiv);
      }
    }
</script>

@endpush