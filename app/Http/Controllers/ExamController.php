<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Kelas;
use Auth;
use Alert;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:exam');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = Exam::all();  
        $data = 'Data Ujian';
        return view('exam.index',compact('data','da'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Tambah Ujian';
        $kelas = Kelas::all();
        return view('exam.create',compact('data','kelas'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'name' => 'required',   
            'time' => 'required',    
            'q' => 'required',        
            'nquest' => 'required',                           
            ];

        $request->validate($rule);

        $status = ($request->has('status')) ? 1 : 0;

        $exam = new Exam;
        $exam->name = $request->name;
        $exam->time = $request->time;
        $exam->kelas_id = $request->kelas;
        $exam->status = $status;
        $exam->users_id = Auth::user()->id;
        $exam->save();

        $question = $request->q;
        
        for ($i=0; $i < count($question); $i++) { 
            $par = 'ans'.$i;
            $ans = $request->$par;
            $q = new Question;
            $q->exams_id = $exam->id;
            $q->name = $question[$i];
            $q->opsi_a = $ans[0];
            $q->opsi_b = $ans[1];
            $q->opsi_c = $ans[2];
            $q->opsi_d = $ans[3];
            $q->opsi_e = $ans[4];
            $q->key = $ans[5];
            $q->save(); 
        }



        Alert::success('success', 'Insert Successfully');
        return redirect()->route('exam.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(exam $exam)
    {     
        $data = 'Edit exam';
        $kelas = Kelas::all();
        return view('exam.create',compact('data','exam','kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, exam $exam)
    {
        $rule = [            
            'name' => 'required',   
            'time' => 'required',                           
            ];

        $request->validate($rule);
        
        $status = ($request->has('status')) ? 1 : 0;
        $exam->name = $request->name;
        $exam->time = $request->time;
        $exam->kelas_id = $request->kelas;
        $exam->status = $status;
        $exam->users_id = Auth::user()->id;
        $exam->save();


        $question = $request->q;

        $qs = Question::where('exams_id',$exam->id)->delete();   
        
        for ($i=0; $i < count($question); $i++) { 
            $par = 'ans'.$i;
            $ans = $request->$par;
            $q = new Question;
            $q->exams_id = $exam->id;
            $q->name = $question[$i];
            $q->opsi_a = $ans[0];
            $q->opsi_b = $ans[1];
            $q->opsi_c = $ans[2];
            $q->opsi_d = $ans[3];
            $q->opsi_e = $ans[4];
            $q->key = $ans[5];
            $q->save(); 
        }

        Alert::success('success', 'Update Successfully');
        return redirect()->route('exam.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(exam $exam)
    {
        $exam->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
