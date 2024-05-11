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

                @isset($material)
                <form action="{{route('material.update',['material'=>$material])}}" method="post" enctype="multipart/form-data">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('material.store')}}" method="post" enctype="multipart/form-data">                               
                @endif                    
                    @csrf           
                    <div class="px-5">
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Name</label>
                            <div class="col-md-6">
                                <input type="text" name="name" value="{{isset($material) ? $material->name : old('name')}}"   class="form-control">
                                @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3">Kelas</label>                   
                            <div class="col-md-6">
                                <select class="choices form-select" name="kelas">
                                    @foreach($kelas as $item)
                                    <option value="{{$item->id}}"  @selected(isset($material) && $material->kelas == $item->id)>{{$item->name}}</option>
                                    @endforeach                       
                                </select>
                                @error('kelas')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3">File</label>
                            <div class="col-md-6">       
                              <input class="form-control" name="pile" type="file" accept=".pdf">
                              @error('pile')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3">Status</label>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="status" {{isset($material) && $material->status == 1 ? 'checked' : null}}>                                
                                </div>                            
                            </div>
                        </div>
                                                               
                        <div class="mb-3 d-flex justify-content-start">
                            <button class="btn btn-primary">{{isset($material) ? 'Update' : 'Save'}}</button>
                            <a class="btn btn-danger ms-3" href="{{route('material.index')}}">Back</a>
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