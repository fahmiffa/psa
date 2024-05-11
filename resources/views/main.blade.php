@extends('layout.base')     
@section('main')
<div class="page-heading">
    @if(session('error'))
    <div class="alert alert-danger" id="timeoutAlert" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @include('notif')
</div>
<div class="page-content">
<section class="row">
    <div class="card card-body">
        <div id="calendar"></div>
    </div>
</section>
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

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
        views: {
            listMonth: { buttonText: 'list month' },
            listYear: { buttonText: 'list year' }
        },
        height:450,
        initialView: 'listYear',
        initialDate: '2023-01-12',
        selectable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        // multiMonthMaxColumns: 1, // guarantee single column
        // showNonCurrentDates: true,
        // fixedWeekCount: false,
        // businessHours: true,
        // weekends: false,
        events: [
            
            {
            title: 'Payment - PENDAFTARAN - Iman ',
            start: '2023-11-24'
            },
            
            {
            title: 'Payment - Biaya Daftar Ulang Kelas - Iman ',
            start: '2023-11-26'
            },
            
            {
            title: 'Payment - Biaya Pelatihan - Iman ',
            start: '2023-11-26'
            },
            
            {
            title: 'Payment - Job Matching - Iman ',
            start: '2023-11-26'
            },
            
            {
            title: 'Payment - Job Matching - Iman ',
            start: '2024-01-12'
            },
            
            {
            title: 'Payment - PENDAFTARAN - Sudayo',
            start: '2023-11-25'
            },
            
            {
            title: 'Payment - Biaya Daftar Ulang Kelas - Iman ',
            start: '2023-12-12'
            },
            
            {
            title: 'Interview - PT Surya Anugrah Esa',
            start: '2023-11-24 06:00:00'
            },
        ]
        });
    
        calendar.render();
    });
</script>
@endpush
