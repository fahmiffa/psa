@if($head)
@php
 $st = auth()->user()->stat;   
 $state = [1,2,3,4,5,6,7,8,9,10,11,12,13];
 $button = [3,5,6,7,9,11];
 @endphp
    @if(in_array($st,$state))
        <div class="alert alert-light-danger color-danger alert-dismissible show fade my-3">
            <i class="bi bi-exclamation-circle"></i> 
            {{Auth()->user()->state}}
            @if(in_array($st,$button))
                &nbsp;&nbsp;<a class="btn btn-danger btn-sm rounded-pill" href="{{route('daftar.index',['id'=>md5($head->id)])}}">Next</a>
            @endif
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @else
        <div class="alert alert-light-danger color-danger alert-dismissible show fade my-3">
            <i class="bi bi-exclamation-circle"></i>         
            Mohon Menunggu Verifikasi Kelas &nbsp;&nbsp;<a class="btn btn-danger btn-sm rounded-pill" href="{{route('daftar.index',['id'=>md5($head->id)])}}">Info Detail</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>  
    @endif
@else
    @if($paymentStudy)
        <div class="alert alert-light-danger color-danger alert-dismissible show fade my-3">
            <i class="bi bi-exclamation-circle"></i> 
            Silahkan melakukan pembayaran {{$paymentStudy->name}}&nbsp;&nbsp;<a class="btn btn-danger btn-sm rounded-pill" href="{{route('study')}}">Bayar</a>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endif