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
        <div class="card">       
            <div class="card-body">

                @isset($job)
                <form action="{{route('job.update',['job'=>$job])}}" method="post" enctype="multipart/form-data">                            
                @method('PATCH')   
                @else                                      
                    <form action="{{route('job.store')}}" method="post" enctype="multipart/form-data">                               
                @endif                    
                    @csrf           
                    <div class="px-5">             
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Perusahaan</label>        
                            <div class="col-md-6">
                                <select class="choices form-select" name="company">
                                    <option value="">Pilih</option>
                                    @foreach($company as $item)
                                    <option value="{{$item->id}}"  @selected(isset($job) && $job->company_id == $item->id)>{{ucfirst($item->name)}}</option>
                                    @endforeach                       
                                </select>
                                @error('company')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3">Section Job</label>
                            <div class="col-md-6">
                                <input type="text" name="section" value="{{isset($job) ? $job->section : old('section')}}"   class="form-control">
                                @error('section')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Address</label>
                            <div class="col-md-6">                                
                                <textarea class="form-control" name="addr" rows="3">{{isset($job) ? $job->address : old('addr')}}</textarea>
                                @error('addr')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>     
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Salary</label>
                            <div class="col-md-6">
                                <input type="text"  id="salary" name="salary" value="{{isset($job) ? number_format($job->salary, 0, ",", ".") : old('salary')}}"   class="form-control">
                                @error('salary')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>    

                        <div class="divider divider-left">
                            <div class="divider-text h6">PIC</div>                    
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label>Name</label>
                                <input type="text"  name="pic_name" value="{{isset($job) ? $job->pic_name : old('pic_name')}}"   class="form-control">
                                @error('pic_name')<div class='small text-danger text-left'>{{$message}}</div>@enderror                         
                            </div>
                            <div class="col-4">
                                <label>Email</label>
                                <input type="text"  name="pic_email" value="{{isset($job) ? $job->pic_email : old('pic_email')}}"   class="form-control">
                                @error('pic_email')<div class='small text-danger text-left'>{{$message}}</div>@enderror                         
                            </div>
                            <div class="col-4">
                                <label>Phone</label>
                                <input type="text"  name="pic_phone" value="{{isset($job) ? $job->pic_phone : old('pic_phone')}}"   class="form-control">
                                @error('pic_phone')<div class='small text-danger text-left'>{{$message}}</div>@enderror                         
                            </div>
                        </div>
                        <div class="divider divider-left">
                            <div class="divider-text h6">Agency</div>                    
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label>Name</label>
                                <input type="text"  name="agency_name" value="{{isset($job) ? $job->agency_name : old('agency_name')}}"   class="form-control">
                                @error('agency_name')<div class='small text-danger text-left'>{{$message}}</div>@enderror                         
                            </div>
                            <div class="col-4">
                                <label>Email</label>
                                <input type="text"  name="agency_email" value="{{isset($job) ? $job->agency_email : old('agency_email')}}"   class="form-control">
                                @error('agency_email')<div class='small text-danger text-left'>{{$message}}</div>@enderror                         
                            </div>
                            <div class="col-4">
                                <label>Phone</label>
                                <input type="text"  name="agency_phone" value="{{isset($job) ? $job->agency_phone : old('agency_phone')}}"   class="form-control">
                                @error('agency_phone')<div class='small text-danger text-left'>{{$message}}</div>@enderror                         
                            </div>
                        </div>           
                        
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Kouta</label>
                            <div class="col-md-6">
                                <input type="number"  id="kouta" name="kouta" value="{{isset($job) ? $job->kouta : old('kouta')}}"   class="form-control">
                                @error('kouta')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>    

                        <div class="form-group row mb-3">
                            <label class="col-md-3">Deskripsi</label>
                            <div class="col-md-6">                                
                                <textarea class="form-control" name="note" rows="3">{{isset($job) ? $job->note : old('note')}}</textarea>
                                @error('note')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div> 
                                               
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Hiring</label>
                            <div class="col-md-3">
                                <label>Open</label>                        
                                <input type="date" placeholder="Open Date"  id="open" name="open" value="{{isset($job) ? $job->open: old('open')}}"   class="form-control">
                                @error('open')<div class='small text-danger text-left'>{{$message}}</div>@enderror       
                            </div>

                            <div class="col-md-3">     
                                <label>Close</label>
                                <input type="date"  id="close" name="close" value="{{isset($job) ? $job->close : old('close')}}"   class="form-control">
                                @error('close')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-3">
                            <label class="col-md-3">Work</label>
                            <div class="col-md-3">
                                <label>Start</label>                        
                                <input type="date" placeholder="Open Date"  name="work_start" value="{{isset($job) ? $job->work_start: old('work_start')}}"   class="form-control">
                                @error('work_start')<div class='small text-danger text-left'>{{$message}}</div>@enderror       
                            </div>

                            <div class="col-md-3">     
                                <label>End</label>
                                <input type="date"   name="work_end" value="{{isset($job) ? $job->work_end : old('work_end')}}"   class="form-control">
                                @error('work_end')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-md-3">Interview</label>
                            <div class="col-md-3">
                                <label>Tanggal</label>                        
                                <input type="date" placeholder="Open Date"  name="interview_date" value="{{isset($job) ? $job->interview_date: old('interview_date')}}"   class="form-control">
                                @error('interview_date')<div class='small text-danger text-left'>{{$message}}</div>@enderror       
                            </div>

                            <div class="col-md-3">     
                                <label>Location</label>
                                <textarea class="form-control" name="interview" rows="3">{{isset($job) ? $job->interview : old('interview')}}</textarea>
                                @error('interview')<div class='small text-danger text-left'>{{$message}}</div>@enderror
                            </div>
                        </div>                   

                        <div class="mb-3 d-flex justify-content-start">
                            <button class="btn btn-primary">Save</button>
                            <a class="btn btn-danger ms-3" href="{{route('job.index')}}">Back</a>
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
    var dengan_rupiah = document.getElementById('salary');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value);
    });
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? + rupiah : '');
    }
</script>
@endpush