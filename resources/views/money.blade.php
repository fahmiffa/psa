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
        <div class="col-md-12 col-12">        
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-start mb-4">
                        <div class="stats-icon green mb-2">
                        <i class="iconly-boldWallet"></i>                           
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted font-semibold">Pembayaran Telah di verifikasi</h6>
                            <h6 class="font-extrabold mb-0">{{$paid}}</h6>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-start">
                        <div class="stats-icon red mb-2">
                        <i class="iconly-boldWallet"></i>                            
                        </div>
                        <div class="ms-3">
                            <h6 class="text-muted font-semibold">Pembayaran Belum di verifikasi</h6>
                            <h6 class="font-extrabold mb-0">{{$unpaid}}</h6>
                        </div>
                    </div>                    
                </div>  
            </div>
        </div>     
    </div>
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

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
        views: {
            listMonth: { buttonText: 'list month' },
            listYear: { buttonText: 'list year' }
        },
        height:450,
        initialView: 'listYear',
        initialDate: '2024-01-01',
        selectable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        // multiMonthMaxColumns: 1, // guarantee single column
        // showNonCurrentDates: true,
        // fixedWeekCount: false,
        // businessHours: true,
        // weekends: false,
        events: [
            @foreach($log as $item)     
            {
                title: '{{strtoupper($item->user->role)}} {{ucfirst($item->user->name)}} - {{$item->activity}} {{$item->tos}}',
                start: '{{date('Y-m-d',strtotime($item->created_at))}}'
            },                      
            @endforeach
        ]
        });
    
        calendar.render();
    });
</script>
@endpush
