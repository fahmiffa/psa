@extends('layout.base')     
@section('main')
<div class="page-heading">
    @if(session('error'))
    <div class="alert alert-danger" id="timeoutAlert" role="alert">
            {{ session('error') }}
        </div>
    @endif

</div>
<div class="page-content">
    <div class="row">
        <div class="card card-body">
            <div id="calendar"></div>
        </div>
    </div>   
</div>
@endsection

@push('js')    
<script>
@if(session('error'))
    var timeoutAlert = document.getElementById('timeoutAlert');
    setTimeout(function() {
        timeoutAlert.style.display = 'none';
    }, 3000); 
@endif    
</script>

<script src="https://zuramai.github.io/mazer/demo/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="https://zuramai.github.io/mazer/demo/assets/static/js/pages/dashboard.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
 @include('cal')
</script>
@endpush
