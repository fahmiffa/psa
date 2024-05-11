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
            <div class="card-header">
                <div class="d-flex justify-content-between py-3">
                    <div class="p-2">
                        <h5 class="card-title">{{$data}}</h5>
                    </div>
                    <div class="p-2">                
                    </div>
                </div>       
            </div>
            <div class="card-body">
                <div class="row">                          
                    <div class="divider divider-center">
                        <div class="divider-text h6">Identitas</div>
                    </div>  
                    <div class="col-md-12 col-12 my-3">    
                        <div class="row px-3">
                            <div class="col-md-3">
                                <label for="disabledInput">Nama Lengkap</label>
                                <p class="form-control-static">{{$da->fullname}}</p>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="disabledInput">Username</label>
                                <p class="form-control-static">{{auth()->user()->name}}</p>
                            </div>
    
                            <div class="col-md-3">
                                <label for="disabledInput">Email</label>
                                <p class="form-control-static">{{auth()->user()->email}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Phone</label>
                                <p class="form-control-static">{{auth()->user()->hp}}</p>
                            </div>

                        </div>
                    </div>
                    
                    <div class="col-md-12 col-6 mb-3">    
                        <div class="row px-3">

                            <div class="col-md-3">
                                <label for="disabledInput">NIK</label>
                                <p class="form-control-static">{{$da->nik}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Tanggal Lahir</label>
                                <p class="form-control-static">{{date('d-m-Y',strtotime($da->date_birth))}}</p>
                            </div>
                                                                  

                            <div class="col-md-3">
                                <label for="disabledInput">Jenis Kelamin</label>
                                <p class="form-control-static">{{($da->gender == '1') ? 'Perempuan' : 'Laki-laki'}}</p>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="disabledInput">Tempat Lahir</label>
                                <p class="form-control-static">{{$da->place_birth}}</p>
                            </div>

                        </div>
                        <div class="row px-3">
    
                            <div class="col-md-6">
                                <label for="disabledInput">Alamat</label>
                                <p class="form-control-static">{{$da->alamat}}</p>
                            </div>

                        </div>                      
                    </div>

                    <div class="divider divider-center">
                        <div class="divider-text h6">Informasi</div>
                    </div>
                    <div class="col-md-12 col-6 mb-3">    
                        <div class="row px-3">

                            <div class="col-md-3">
                                <label for="disabledInput">Agama</label>
                                <p class="form-control-static">{{typeReligion($da->religion)}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Status</label>
                                <p class="form-control-static">{{($da->married == '1') ? 'Menikah' : 'Belum Menikah'}}</p>
                            </div>                                             

                            <div class="col-md-3">
                                <label for="disabledInput">Tinggi Badan</label>
                                <p class="form-control-static">{{$da->tall}} cm</p>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="disabledInput">Berat Badan</label>
                                <p class="form-control-static">{{$da->weight}} kg</p>
                            </div>

                        </div>                      
                    </div>
                    <div class="col-md-12 col-6 mb-3">    
                        <div class="row px-3">

                            <div class="col-md-3">
                                <label for="disabledInput">Kekuatan Cengkaraman</label>
                                <p class="form-control-static">{{$da->power}} kg</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Merokok</label>
                                <p class="form-control-static">{{($da->smoker == '1') ? 'Ya' : 'Tidak'}}</p>
                            </div>                                             

                            <div class="col-md-3">
                                <label for="disabledInput">Alkohol</label>
                                <p class="form-control-static">{{($da->alkohol == '1') ? 'Ya' : 'Tidak'}}</p>
                            </div>                     
                            
                            <div class="col-md-3">
                                <label for="disabledInput">Golongan Darah</label>
                                <p class="form-control-static">{{$da->blood}}</p>
                            </div>

                        </div>                      
                    </div>
                    <div class="col-md-12 col-6 mb-3">    
                        <div class="row px-3">

                            <div class="col-md-3">
                                <label for="disabledInput">Tangan Dominan</label>
                                <p class="form-control-static">{{$da->hand}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Lama Belajar</label>
                                <p class="form-control-static">{{$da->learning}} Bulan</p>
                            </div>                                             

                            <div class="col-md-3">
                                <label for="disabledInput">Alkohol</label>
                                <p class="form-control-static">{{($da->alkohol == '1') ? 'Ya' : 'Tidak'}}</p>
                            </div>                     
                            
                            <div class="col-md-3">
                                <label for="disabledInput">Daya Penglihatan</label>
                                <p class="form-control-static">{{($da->look == '1') ? 'Normal' : 'Tidak'}}</p>
                            </div>

                        </div>                      
                    </div>
                    <div class="col-md-12 col-6 mb-3">    
                        <div class="row px-3">

                            <div class="col-md-3">
                                <label for="disabledInput">Pernah Ke Jepang</label>
                                <p class="form-control-static">{{($da->japan == '1') ? 'Ya' : 'Tidak'}}</p>
                            </div>


                            <div class="col-md-3">
                                <label for="disabledInput">Pernah Kecelakaan</label>
                                <p class="form-control-static">{{($da->accident == '1') ? 'Ya' : 'Tidak'}}</p>
                            </div>


                            <div class="col-md-3">
                                <label for="disabledInput">Pernah Sakit Keras</label>
                                <p class="form-control-static">{{($da->sick == '1') ? 'Ya' : 'Tidak'}}</p>
                            </div>              

                        </div>                      
                    </div>
                    <div class="col-md-12 col-6 mb-3">    
                        <div class="row px-3">                          

                            <div class="col-md-3">
                                <label for="disabledInput">Keahlian</label>
                                <p class="form-control-static">{{$da->skill}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Hobbi</label>
                                <p class="form-control-static">{{$da->hobbies}}</p>
                            </div>
              

                        </div>                      
                    </div>
                    <div class="divider divider-center">
                        <div class="divider-text h6">Keluarga</div>
                    </div>
                    <div class="col-md-12 col-6 mb-3">    
                        <div class="row px-3">                          

                            @php $dad = json_decode($da->dad) @endphp
                            <div class="col-md-3">
                                <label for="disabledInput">Ayah</label>
                                <p class="form-control-static">{{$dad[0]}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Umur</label>
                                <p class="form-control-static">{{$dad[1]}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Nomor HP</label>
                                <p class="form-control-static">{{$dad[1]}}</p>
                            </div>
              

                        </div> 
                        <div class="row px-3">                          

                            @php $mom = json_decode($da->mom) @endphp
                            <div class="col-md-3">
                                <label for="disabledInput">Ibu</label>
                                <p class="form-control-static">{{$mom[0]}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Umur</label>
                                <p class="form-control-static">{{$mom[1]}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Nomor HP</label>
                                <p class="form-control-static">{{$mom[1]}}</p>
                            </div>
              

                        </div>
                        <div class="row px-3">                          

                            @php $bro = json_decode($da->bro) @endphp
                            <div class="col-md-3">
                                <label for="disabledInput">Kaka</label>
                                <p class="form-control-static">{{$bro[0]}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Umur</label>
                                <p class="form-control-static">{{$bro[1]}}</p>
                            </div>

                        </div>
                        <div class="row px-3">                          

                            @php $sis = json_decode($da->sis) @endphp
                            <div class="col-md-3">
                                <label for="disabledInput">Adik</label>
                                <p class="form-control-static">{{$sis[0]}}</p>
                            </div>

                            <div class="col-md-3">
                                <label for="disabledInput">Umur</label>
                                <p class="form-control-static">{{$sis[1]}}</p>
                            </div>            
              

                        </div>                      
                    </div>
                    <div class="divider divider-center">
                        <div class="divider-text h6">Pendidikan</div>
                    </div>
                    <div class="col-md-12 col-6 mb-3">    
                        @php $st = json_decode($da->study) @endphp
                        @for ($i = 0; $i < count($st); $i++)
                            <div class="row px-3">                          
                                <div class="col-md-3">
                                    <label for="disabledInput">Nama</label>
                                    <p class="form-control-static">{{$st[$i][0]}}</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="disabledInput">Periode Awal</label>
                                    <p class="form-control-static">{{$st[$i][1]}}</p>
                            </div>
                                <div class="col-md-3">
                                    <label for="disabledInput">Periode Akhir</label>
                                    <p class="form-control-static">{{$st[$i][2]}}</p>
                                </div>            
                            </div>                                                                 
                        @endfor
                    </div>

                    <div class="divider divider-center">
                        <div class="divider-text h6">Pekerjaan</div>
                    </div>
                    <div class="col-md-12 col-6 mb-3">    
                        @php $st = json_decode($da->job) @endphp
                        @for ($i = 0; $i < count($st); $i++)
                            <div class="row px-3">                          
                                <div class="col-md-3">
                                    <label for="disabledInput">Nama</label>
                                    <p class="form-control-static">{{$st[$i][0]}}</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="disabledInput">Periode Awal</label>
                                    <p class="form-control-static">{{$st[$i][1]}}</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="disabledInput">Periode Akhir</label>
                                    <p class="form-control-static">{{$st[$i][2]}}</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="disabledInput">Industri</label>
                                    <p class="form-control-static">{{$st[$i][3]}}</p>
                                </div>            
                            </div>                                                                 
                        @endfor

                        <div class="row px-3">                          
                            <div class="col-md-6">
                                <h6>Deskripsi Pekerjaan</h6>
                                <p class="form-control-static">{{$da->job_des}}</p>
                            </div>                           
                        </div>
                    </div>

                    <div class="divider divider-center">
                        <div class="divider-text h6">Magang</div>
                    </div>
                    <div class="col-md-12 col-6 mb-3">    
                        @php $st = json_decode($da->magang) @endphp
                        @for ($i = 0; $i < count($st); $i++)
                            <div class="row px-3">                          
                                <div class="col-md-3">
                                    <label for="disabledInput">Nama</label>
                                    <p class="form-control-static">{{$st[$i][0]}}</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="disabledInput">Periode Awal</label>
                                    <p class="form-control-static">{{$st[$i][1]}}</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="disabledInput">Periode Akhir</label>
                                    <p class="form-control-static">{{$st[$i][2]}}</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="disabledInput">Industri</label>
                                    <p class="form-control-static">{{$st[$i][3]}}</p>
                                </div>            
                            </div>                                                                 
                        @endfor

                        <div class="row px-3">                          
                            <div class="col-md-6">
                                <h6>Hal yang Dipelajari saat magang</h6>
                                <p class="form-control-static">{{$da->magang_des}}</p>
                            </div>                           
                        </div>
                    </div>

                    <div class="divider divider-center">
                        <div class="divider-text h6">Lisensi</div>
                    </div>
                    <div class="col-md-12 col-6 mb-3">    
                        @php $st = json_decode($da->lisensi) @endphp
                        @for ($i = 0; $i < count($st); $i++)
                            <div class="row px-3">                          
                                <div class="col-md-3">
                                    <label for="disabledInput">Nama</label>
                                    <p class="form-control-static">{{$st[$i][0]}}</p>
                                </div>
                                <div class="col-md-3">
                                    <label for="disabledInput">Waktu</label>
                                    <p class="form-control-static">{{$st[$i][1]}}</p>
                            </div>
                                <div class="col-md-3">
                                    <label for="disabledInput">level</label>
                                    <p class="form-control-static">{{$st[$i][2]}}</p>
                                </div>            
                            </div>                                                                 
                        @endfor

                        <div class="row px-3">                          
                            <div class="col-md-6">
                                <h6>Promosi diri, harapan, pertanyaan, dll</h6>
                                <p class="form-control-static">{{$da->me}}</p>
                            </div>                           
                        </div>
                    </div>

                </div> 
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