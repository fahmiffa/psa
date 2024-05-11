<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Kelas;
use Alert;
use DB;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:materi');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = Material::all();  
        $data = 'Data Materi';
        return view('materi.index',compact('data','da'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Tambah Materi';
        $kelas = Kelas::all();
        return view('materi.create',compact('data','kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'pile'   => 'required|file|mimes:pdf|max:2048',  
            'name'   => 'required',
            'kelas'   => 'required'                                     
            ];

        $message = [
                    'required'=> 'File Transfer required',
                    'mimes'=> 'Extension File invalid',
                    'max'=> 'File size max 2Mb'
                    ];

        $request->validate($rule,$message);

        $status = ($request->has('status')) ? 1 : 0;

        $item = new Material;
        $item->name = $request->name;
        $item->kelas = $request->kelas;
        $item->status = $status;
        $pile = $request->file('pile');               
        $piles = 'materi_'.time().'.'.$pile->getClientOriginalExtension();
        $destinationPath = public_path('assets/materi/');
        $pile->move($destinationPath, $piles);  
        $path = 'assets/materi/'.$piles;
        $item->file = $path;
        $item->save();

        Alert::success('success', 'Insert Successfully');
        return redirect()->route('material.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $data = 'Edit Materi';
        $kelas = Kelas::all();
        return view('materi.create',compact('data','kelas','material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $rule = [            
            'pile'   => 'file|mimes:pdf|max:2048',  
            'name'   => 'required',
            'kelas'   => 'required'                                     
            ];

        $message = [
                    'required'=> 'File Transfer required',
                    'mimes'=> 'Extension File invalid',
                    'max'=> 'File size max 2Mb'
                    ];

        $request->validate($rule,$message);

        $status = ($request->has('status')) ? 1 : 0;

        $item = $material;
        $item->name = $request->name;
        $item->kelas = $request->kelas;
        $item->status = $status;
        $pile = $request->file('pile');      
        if($pile)
        {
            $piles = 'materi_'.time().'.'.$pile->getClientOriginalExtension();
            $destinationPath = public_path('assets/materi/');
            $pile->move($destinationPath, $piles);  
            $path = 'assets/materi/'.$piles;
            $item->file = $path;
        }         
        $item->save();

        Alert::success('success', 'Update Successfully');
        return redirect()->route('material.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
