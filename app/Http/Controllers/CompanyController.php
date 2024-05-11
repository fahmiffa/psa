<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Apply;
use Illuminate\Http\Request;
use Alert;
Use DB;
use App\Models\Participant;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:company');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $da = Company::all();
        $data = 'Data Perusahaan';
        return view('company.index',compact('data','da'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Create Company';
        return view('company.create',compact('data'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'name' => 'required',   
            'section' => 'required',    
            'addr' => 'required',        
            'director' => 'required',     
            'phone_director' => 'required',     
            'phone' => 'required',     
            'email' => 'required',                           
            'admin' => 'required',                           
            'map' => 'required',                           
            ];

            $message = ['required'=>'Field Is required'];
            $request->validate($rule,$message);

           $company = new Company;
           $company->name = $request->name;
           $company->phone = $request->phone;
           $company->email = $request->email;
           $company->addr = $request->addr;
           $company->map = $request->map;
           $company->name = $request->name;
           $company->director = $request->director;
           $company->phone_director= $request->phone_director;
           $company->admin = $request->admin;
           $company->section = $request->section;
           $company->map = $request->map;
           $company->save();

            Alert::success('success', 'Insert Successfully');
            return redirect()->route('company.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $data = 'Edit Company';
        return view('company.create',compact('data','company'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $rule = [            
            'name' => 'required',   
            'section' => 'required',    
            'addr' => 'required',        
            'director' => 'required',     
            'phone_director' => 'required',     
            'phone' => 'required',     
            'email' => 'required',                           
            'admin' => 'required',                           
            'map' => 'required',                           
            ];

            $message = ['required'=>'Field Is required'];
            $request->validate($rule,$message);
            
           $company->name = $request->name;
           $company->phone = $request->phone;
           $company->email = $request->email;
           $company->addr = $request->addr;
           $company->map = $request->map;
           $company->name = $request->name;
           $company->director = $request->director;
           $company->phone_director= $request->phone_director;
           $company->admin = $request->admin;
           $company->section = $request->section;
           $company->map = $request->map;
           $company->save();

            Alert::success('success', 'Insert Successfully');
            return redirect()->route('company.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        foreach($company->job as $item)
        {
            foreach ($item->come as $val) {
                
                // kelas
                if ($val->heads) {
                    $val->heads->murid->kelas = null;
                    $val->heads->murid->save();
                    $val->heads->nilai->delete();
                    $val->heads->delete();
                }
    
                // participant
                $par = Participant::where('users_id', $val->users_id)->delete();
    
                $val->delete();
    
            }

            $item->delete();
        }
        $company->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
