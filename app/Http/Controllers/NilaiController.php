<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\Head;
use Illuminate\Http\Request;
use Auth;
use Alert;
use App\Rules\Status;
use App\Models\Participant;

class NilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:nilai');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = Nilai::all();  
        $data = 'Data Nilai';
        return view('nilai.index',compact('data','da'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Tambah Nilai';
        $kelas = Kelas::where('employee',Auth::user()->id)->get();      
        // $kelas = Head::where('status',4)->latest()->get();  
        return view('nilai.create',compact('data','kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function siswa(Request $request)
    {
        $da = Student::doesnthave('nilai')->where('kelas',$request->id)->get(); 
        if($da->count() > 0)
        {
            foreach($da as $item)
            {
                $val []= ['label'=>$item->siswa->name. ' ('.$item->penyanggah->name.')', 'value'=>$item->siswa->id];
            }
        }
        else
        { 
            $val = [];
        }

        return response()->json($val);
    }

    public function store(Request $request)
    {
        $rule = [            
            'siswa' => 'required',
            'nilai' => 'required',                     
            'kelas' => 'required'                     
            ];

        $message = ['required'=>'Field ini harus disi'];
        $request->validate($rule,$message);   
        
        $head = Head::where('participant',$request->siswa)->where('status',4)->latest()->first();  
 
        $var = $head->user->stat + 1;      

        $item           = new Nilai;
        $item->head     = $head->id;
        $item->kelas    = $request->kelas;
        $item->student  = $request->siswa;
        $item->value    = $request->nilai;
        $item->save();
  
        Status::grade($head,'menambakan nilai peserta '.$head->user->name,$var);  
        Status::log('menambakan nilai peserta '.$head->user->name);  
        Alert::success('success', 'Insert Successfully');
        return redirect()->route('nilai.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $nilai)
    {
        $data = 'Edit Nilai';
        $kelas = Kelas::where('employee',Auth::user()->id)->get();        
        return view('nilai.create',compact('data','kelas','nilai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nilai $nilai)
    {
        $rule = [            
            'siswa' => 'required',
            'nilai' => 'required',                     
            'kelas' => 'required'                     
            ];

        $message = ['required'=>'Field ini harus disi'];
        $request->validate($rule,$message);       
               
        $item           = $nilai;
        $item->kelas    = $request->kelas;
        $item->student  = $request->siswa;
        $item->value    = $request->nilai;
        $item->save();


        Alert::success('success', 'Update Successfully');
        return redirect()->route('nilai.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nilai $nilai)
    {
        $par = Participant::where('users_id',$nilai->student)->latest()->first();
        $par->delete();
        $nilai->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
