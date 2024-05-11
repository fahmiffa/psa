<?php

namespace App\Http\Controllers;

use App\Models\Third;
use App\Models\User;
use Illuminate\Http\Request;
use Alert;

class ThirdController extends Controller
{

    public function __construct()
    {
        $this->middleware('IsPermission:master');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = Third::all();
        $data = 'Data LPK';
        return view('lpk.index',compact('data','da'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Create LPK';
        $user = User::where('role','lpk')->get();
        return view('lpk.create',compact('data','user'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'name' => 'required',
            'alamat' => 'required', 
            'kode' => 'required',         
            'account' => 'required',                                             
            ];

        $message = ['required'=>'Field ini harus disi'];
        $request->validate($rule,$message);       

       
        $item           = new Third;
        $item->name     = $request->name;
        $item->users_id = $request->account;
        $item->alamat   = $request->alamat;
        $item->note     = $request->note; 
        $item->kode     = $request->kode; 
        $item->save();


        Alert::success('success', 'Insert Successfully');
        return redirect()->route('third.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Third $third)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Third $third)
    {
        $data = 'Edit LPK';
        $user = User::where('role','lpk')->get();                
        return view('lpk.create',compact('data','user','third'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Third $third)
    {
        $rule = [            
            'name' => 'required',
            'alamat' => 'required',     
            'kode' => 'required',                                                             
            ];

        $message = ['required'=>'Field ini harus disi'];
        $request->validate($rule,$message);       

       
        $item           = $third;
        $item->name     = $request->name;
        $item->users_id = $request->account;
        $item->alamat   = $request->alamat;
        $item->note     = $request->note; 
        $item->kode     = $request->kode; 
        $item->save();


        Alert::success('success', 'Update Successfully');
        return redirect()->route('third.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Third $third)
    {        
        $third->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
