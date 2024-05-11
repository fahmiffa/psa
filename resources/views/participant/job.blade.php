@foreach ($job as $item)
@if($item->limit)
    <a href="{{route('apply',['id'=>md5($item->id), 'head'=>md5($head->id)])}}">
        <div class="row bg-body shadow-sm p-3 mb-3">
            <div class="col-lg-3 col-6 mb-3">
                <h6>Nama</h6>
                {{$item->perusahaan->name}} 
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Position</h6>
                {{$item->section}} 
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Kouta</h6>
                <small>{{$item->kouta}} </small>
            </div>
            <div class="col-lg-3 col-6 mb-3">
                <h6>Salary</h6>
                {{number_format($item->salary,0,",",".")}}
            </div>
        </div>
    </a>
@endif
@endforeach
{{-- <form action="{{route('daftar.store', ['id'=>md5($kelas->id)])}}" method="post" enctype="multipart/form-data">    
    @csrf
    <button class="btn btn-primary btn-block w-25 rounded-pill">Send</button>
</form>  --}}