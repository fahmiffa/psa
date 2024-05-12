<div class="container">
<ul>                         
    <li class="menu-item">
        <a href="{{route('home')}}" class='menu-link'>
            <span><i class="bi bi-house-fill"></i> Home</span>
        </a>
    </li>                             

    @if(auth()->user()->hasPermission('master'))         
    <li class="menu-item {{ (Request::segment(2)) == 'user' ? 'active' : null }}">
        <a href="{{route('user.index')}}"
            class='menu-link'>Users   
        </a>                       
    </li>    
    <li class="menu-item {{ (Request::segment(2)) == 'third' ? 'active' : null }}">
        <a href="{{route('third.index')}}"
            class='menu-link'>LPK
        </a>                       
    </li>
    @endif

    @if(auth()->user()->hasPermission('job'))
    <li class="menu-item {{ (Request::segment(2)) == 'job' ? 'active' : null }}">
        <a href="{{route('job.index')}}"
            class='menu-link'>Job 
        </a>                       
    </li> 
    @endif

    @if(auth()->user()->hasPermission('company'))
    <li class="menu-item {{ (Request::segment(2)) == 'company' ? 'active' : null }}">
        <a href="{{route('company.index')}}"
            class='menu-link'>Company 
        </a>                       
    </li> 
    @endif

    @if(auth()->user()->hasPermission('payment'))
    <li class="menu-item {{ (request()->routeIs('payment.index')) ? 'active' : null }}">
        <a href="{{route('payment.index')}}"
            class='menu-link'>Method Payment
        </a>                       
    </li>   
    <li class="menu-item {{ (request()->routeIs('paid.index')) ? 'active' : null }}">
        <a href="{{route('paid.index')}}"
            class='menu-link'>Payment
        </a>                       
    </li>   
    @endif 
    
    @if(auth()->user()->hasPermission('VerifPayment'))
    <!-- <li class="menu-item {{ (request()->routeIs('paid.index')) ? 'active' : null }}">
        <a href="{{route('paid.index')}}"
            class='menu-link'>Pembayaran
        </a>                       
    </li>    -->
    @endif 

    
    @if(auth()->user()->hasPermission('lpk'))

        <li class="menu-item {{ (request()->routeIs('kelas.lpk')) ? 'active' : null }}">
            <a href="{{route('kelas.lpk')}}"
                class='menu-link'>Kelas
            </a>                       
        </li>
         
    @endif 

    @if(auth()->user()->hasPermission('kelas'))
    <li class="menu-item {{ (request()->routeIs('class.index')) ? 'active' : null }}">
        <a href="{{route('class.index')}}"
            class='menu-link'>Kelas
        </a>                       
    </li>   
    @endif 

    {{-- @if(auth()->user()->hasPermission('exam'))
    <li class="menu-item {{ (request()->routeIs('exam.index')) ? 'active' : null }}">
        <a href="{{route('exam.index')}}"
            class='menu-link'>Ujian
        </a>                       
    </li>   
    @endif  --}}

    @if(auth()->user()->hasPermission('materi'))
    <li class="menu-item {{ (request()->routeIs('material.index')) ? 'active' : null }}">
        <a href="{{route('material.index')}}"
            class='menu-link'>Materi
        </a>                       
    </li>   
    @endif 

    @if(auth()->user()->hasPermission('nilai'))
    <li class="menu-item {{ (request()->routeIs('nilai.index')) ? 'active' : null }}">
        <a href="{{route('nilai.index')}}"
            class='menu-link'>Nilai
        </a>                       
    </li>   
    @endif 

    @if(auth()->user()->hasPermission('verif'))
    <li class="menu-item {{ (request()->routeIs('kelas.index')) ? 'active' : null }}">
        <a href="{{route('kelas.index')}}"
            class='menu-link'>Kelas
        </a>                       
    </li>   
    @endif 

    @if(auth()->user()->hasRole('mandiri'))
    <li class="menu-item {{ (request()->routeIs('study')) ? 'active' : null }}">
        <a href="{{route('study')}}"
            class='menu-link'>Kelas
        </a>                       
    </li>   
    @endif 

    @if(auth()->user()->hasPermission('verif'))
        <li class="menu-item {{ (request()->routeIs('apply.index')) ? 'active' : null }}">
            <a href="{{route('apply.index')}}"
                class='menu-link'>Verifikasi
            </a>                       
        </li>   
    @endif 

    @if(auth()->user()->hasPermission('verif'))
    <li class="menu-item {{ (request()->routeIs('apply.company')) ? 'active' : null }}">
        <a href="{{route('apply.company')}}"
            class='menu-link'>Job Management
        </a>                       
    </li>   
@endif 

</ul>
</div>

