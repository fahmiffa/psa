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

                @isset($payment)
                <form action="{{route('payment.update',['payment'=>$payment])}}" method="post" enctype="multipart/form-data">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('payment.store')}}" method="post" enctype="multipart/form-data">                               
                @endif                    
                    @csrf                    
                        <div class="form-group row mb-3">
                            <div class="col-md-6">
                                <label>Name</label>
                                <input type="text" name="name" value="{{isset($payment) ? $payment->name : old('name')}}"  class="form-control">
                                @error('name')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                            <div class="col-md-6">
                            <label>Method</label>
                            @php
                            $type = ['lunas','cicil','dana_talang'];
                            @endphp
                                <select class="choices form-select" name="type" id="type">
                                    <option value="">Pilih Tipe</option>
                                    @foreach($type as $item)
                                    <option value="{{strtolower($item)}}" @selected(isset($payment) && $payment->type == $item)>{{typePayment($item)}}</option>
                                    @endforeach                       
                                </select>
                                @error('type')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>                 
                        </div>     
                        
                        <div class="form-group row mb-3">
                            <div class="col-md-12">                                     
                                <div id="input-item" class="mt-3">
                                    @isset($payment)
                                        @php $items = json_decode($payment->method) ;                                        
                                        @endphp
                                        @for ($i = 0; $i < count($items); $i++)                                            
                                            <div class="form-group row mb-3">
                                                <div class="col-md-2">
                                                    Waktu
                                                    <input type="number" min="1" value="{{$items[$i]->time}}" name="time[]" class="form-control" required> 
                                                    @error('time')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                                </div>
                                                <div class="col-md-4">
                                                    Periode
                                                    <select class="form-control" name="periode[]" required>                                          
                                                        <option value="day" @selected($items[$i]->periode == 'day')>Day</option>
                                                        <option value="week" @selected($items[$i]->periode == 'week')>Week</option>
                                                        <option value="month" @selected($items[$i]->periode == 'month')>Month</option>
                                                    </select>
                                                    @error('periode')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                                </div>
                                                <div class="col-md-4">
                                                    Nominal
                                                    <input type="text" name="nominal[]"  value="{{$items[$i]->nominal}}"  class="form-control price" required> 
                                                    @error('nominal')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                                </div>                                     
                                            </div>                                   
                                        @endfor                               
                                    @else
                                        <div class="form-group row mb-3">
                                            <div class="col-md-2">
                                                Waktu
                                                <input type="number" min="1" name="time[]" class="form-control" required> 
                                                @error('time')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                            </div>
                                            <div class="col-md-4">
                                                Periode
                                                <select class="form-control" name="periode[]" required>                                          
                                                    <option value="day">Day</option>
                                                    <option value="week">Week</option>
                                                    <option value="month">Month</option>
                                                </select>
                                                @error('periode')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                            </div>
                                            <div class="col-md-4">
                                                Nominal
                                                <input type="text" name="nominal[]" class="form-control price" required> 
                                                @error('nominal')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                            </div>                                     
                                        </div>
                                    @endif
                                </div>
                                <button class="btn btn-success btn-sm rounded-pill d-none" type="button" id="add-item">Tambah</button> 
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <div class="divider">
                                <div class="divider-text">Diskon</div>
                            </div>                                      
                            <div class="col-md-12">
                                    <div class="row">
                                        <div class="col">
                                            <label>Nilai</label>
                                            <input type="number" name="nom" value="{{isset($payment) ? $payment->value : old('nom')}}" id="nom"  class="form-control">
                                            @error('nom')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                                        </div>   
                                        <div class="col">
                                            <label>Tipe</label>
                                            <div class="input-group mb-3">
                                                <select class="form-select" name="disc" id="disc">                                   
                                                    <option value="1" @selected(isset($payment) && $payment->type == 1)>% Percent</option>
                                                    <option value="2" @selected(isset($payment) && $payment->type == 2)>Nominal</option>                    
                                                </select>
                                                @error('disc')<div class='small text-danger text-left'>{{$message}}</div>@enderror                       
                                                <button class="btn btn-primary" onclick="calc()" type="button" id="cal">Hitung</button>                               
                                            </div>
                                        </div>                                   
                                </div>
                                <label class="my-2">Total</label>
                                <p class="form-control-static" id="res">0</p>
                            </div>
                        </div>

                        <div class="form-group my-3">
                            <label>LPK Penyangggah</label>
                            <select class="choices form-select" name="lpk">
                                <option value="">{{env('APP_NAME')}}</option>
                                @foreach ($lpk as $item)                                                                                                                                  
                                    <option value="{{$item->id}}" @selected(isset($payment) && $payment->grant == $item->id) >{{$item->name}}</option>        
                                @endforeach
                            </select>
                            <small class="text-danger">Kosongkan pilihan LPK Penyangggah, jika ingin menggunakan {{env('APP_NAME')}}I </small>
                        </div>

                        <div class="mb-3 d-flex justify-content-start">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger ms-3" href="{{route('payment.index')}}">Back</a>
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

    function calc()
    {
        var val = document.getElementById('disc').value;
        let tot = 0;
        var nominal = 0;

        $('.price').each(function() {
            var value = parseFloat($(this).val());
            if (!isNaN(value)) {
                nominal += value;
            }
        });
        let nom = document.getElementById('nom').value;      
        if(!nominal)
        {
            alert('field Nominal masih kosong');
            nominal = 0;
        }

        if(!nom)
        {
            alert('field Nilai Diskon masih kosong');
            nom = 0;
        }

        if(val == 1)
        {
            tot = nominal - (nom/100*nominal);
        }
        else
        {
            tot = nominal - nom;
        }      
        document.getElementById('res').innerHTML = tot.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }); 
    }

    $(document).ready(function(){
    
        $('#type').on('change',function(e){      
            if($(this).val() == 'cicil')
            {
                $('#add-item').removeClass('d-none');
            }
            else
            {
                $('#add-item').addClass('d-none');
            }
        });
    
        $("#add-item").on('click',function(){        
            var newInput = $(
            '<div class="form-group row mb-3">\
                <div class="col-md-2">\
                    <input type="number" min="1" name="time[]" class="form-control">\
                </div>\
                <div class="col-md-4">\
                    <select class="form-control" name="periode[]">\
                        <option value="day">Day</option>\
                        <option value="week">Week</option>\
                        <option value="month">Month</option>\
                    </select>\
                </div>\
                <div class="col-md-4">\
                    <input type="text" name="nominal[]" class="form-control price">\
                </div><button class="btn btn-danger my-auto" style="width:fit-content;height:fit-content" onclick="remove(this)"  type="button"><i class="bi bi-trash"></i></button>\
            </div>\
            ');
            $('#input-item').append(newInput);
        });  
        
    });
    
    function remove(e)
    {        
        e.parentNode.remove();
    }
</script>
@endpush