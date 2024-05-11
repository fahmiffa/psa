@isset($log)    
<div class="alert alert-light-danger color-danger alert-dismissible show fade my-3">
    <i class="bi bi-exclamation-circle"></i> 
    {{$log->activity}} &nbsp;&nbsp;<a class="btn btn-danger btn-sm rounded-pill" href="{{route('log.lpk')}}">Detail</a>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endisset
