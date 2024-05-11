@extends('layout.base')     
@section('main')
<div class="page-heading px-3">
    @if(session('error'))
    <div class="alert alert-danger" id="timeoutAlert" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" id="timeoutAlert" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
        </div>
        @endif  
</div>
<div class="page-content px-3">
    <div class="row">
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon purple mb-2">
                                <i class="iconly-boldPaper"></i>                                
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted font-semibold">LPK Penyanggah</h6>
                                <h6 class="font-extrabold mb-0">{{$lpk}}</h6>
                            </div>
                        </div>                 
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card"> 
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon blue mb-2">
                                <i class="iconly-boldWork"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted font-semibold">Job Apply</h6>
                                <h6 class="font-extrabold mb-0">{{$apply}}</h6>
                            </div>
                        </div>              
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon green mb-2">
                                <i class="iconly-boldStar"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted font-semibold">Kelas</h6>
                                <h6 class="font-extrabold mb-0">{{$kelas}}</h6>
                            </div>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon red mb-2">
                                <i class="iconly-boldBookmark"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted font-semibold">Company</h6>
                                <h6 class="font-extrabold mb-0">{{$com}}</h6>
                            </div>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                            <div class="stats-icon green mb-2">
                                <i class="iconly-boldWallet"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted font-semibold">Paid</h6>
                                <h6 class="font-extrabold mb-0">{{number_format($paid,0,",",".")}}</h6>
                            </div>
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body px-4 py-4-5">
                    <div class="row">
                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                            <div class="stats-icon red mb-2">
                                <i class="iconly-boldWallet"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="text-muted font-semibold">Unpaid</h6>
                                <h6 class="font-extrabold mb-0">{{number_format($unpaid,0,",",".")}}</h6>
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-body">
        <div id="calendar"></div>
    </div>
</div>
@endsection

@push('js')    
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
        views: {
            listMonth: { buttonText: 'list month' },
            listYear: { buttonText: 'list year' }
        },
        height:300,
        initialView: 'listYear',
        initialDate: '2024-01-01',
        selectable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        // multiMonthMaxColumns: 1, // guarantee single column
        // showNonCurrentDates: true,
        // fixedWeekCount: false,
        // businessHours: true,
        // weekends: false,
        events:[    
            @foreach($log as $item)     
            {
                title: '{{ucfirst($item->user->name)}} - {{$item->activity}}',
                start: '{{date('Y-m-d',strtotime($item->created_at))}}'
            },                      
            @endforeach
        ]
        });
    
        calendar.render();
    });
</script>
@endpush

