<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Alert;
use App\Models\Head;
use App\Models\Paid;
use App\Models\Student;
use DB;
use App\Rules\Status;
use Auth;

class VerifController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:verif');
    }

    public function verif()
    {
        $da = Head::where('offline',1)->latest()->get();
        $kelas = Kelas::has('guru')->get();
        $data = 'Data Verifikasi Kelas';
        return view('class.verif',compact('data','da','kelas'));    
    }

    public function verfied(Request $request, $id)
    {
        $head = Head::where(DB::raw('md5(participant)'),$id)->latest()->first();       
        if($head)
        {
            $head->status = 4;
            $head->save();

            $student = Student::where('student',$head->participant)->first();
            if(!$student)
            {
                $student          = new Student; 
            }     
            
            $student->student = $head->participant;
            $student->kelas   = $request->kelas;
            $student->save();

            Status::log('Verifikasi kelas '.$student->class->name); 
            Alert::success('success', 'Update Successfully');
        }
        else
        {
            Alert::error('error', 'Invalid Data');
        }
        return back();
    }

}