<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Alert;
use App\Models\Head;
use App\Models\Paid;
use DB;
use App\Rules\Status;
use Auth;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:kelas');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class = Kelas::where('employee',Auth::user()->id)->get();
        $data = 'Data Kelas';
        return view('class.index',compact('data','class'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Tambah kelas';
        return view('class.create',compact('data'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'name' => 'required',   
            'type' => 'required',                                 
            ];

        $message = ['required'=>'Field ini harus disi'];

        $request->validate($rule,$message);       
 
        $item = new Kelas;
        $item->name = $request->name;
        $item->employee = Auth::user()->id;
        $item->type = $request->type;
        $item->note = $request->note;
        $item->status = 1;
        $item->save();


        Alert::success('success', 'Insert Successfully');
        return redirect()->route('class.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $class = $kelas;
        $data = 'Edit Kelas';
        return view('class.create',compact('data','class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas, $id)
    {
        $item = Kelas::findOrFail($id);
        $rule = [            
            'name' => 'required',   
            'type' => 'required',                                 
            ];

        $request->validate($rule);

        $item->name = $request->name;
        $item->type = $request->type;
        $item->note = $request->note;
        $item->status = 1;
        $item->save();


        Alert::success('success', 'Update Successfully');
        return redirect()->route('class.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas, $id)
    {        
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
