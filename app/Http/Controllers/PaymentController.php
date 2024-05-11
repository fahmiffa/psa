<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Third;
use Illuminate\Http\Request;
use Auth;
use Alert;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->middleware('IsPermission:payment');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = Payment::all();  
        $data = 'Data Payment';
        return view('payment.index',compact('data','da'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lpk = Third::all();
        $data = 'Create Payment';
        return view('payment.create',compact('data','lpk')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'name'       => 'required',    
            'type'       => 'required',   
            'time'       => 'required',   
            'periode'    => 'required',   
            'nominal'    => 'required',   
            ];
        $message = ['required'=>'field ini harus disi'];

        $request->validate($rule,$message);

        $nom = $request->nominal;
        $time = $request->time;
        $periode = $request->periode;
        $pay = new Payment;
        $pay->name = $request->name;
        $tot = 0;
        $lpk = $request->lpk; 
        $pay->grant = $lpk;
        for ($i=0; $i < count($nom) ; $i++) { 
            $val []= ['time'=>$time[$i], 'periode'=>$periode[$i], 'nominal'=>$nom[$i]];
            $tot +=$nom[$i];
        }

        $total = (double) $tot;
        $pay->method = json_encode($val);
        $pay->nominal = $total;
        $pay->count = count($nom);
        $pay->disc = ($request->nom) ? $request->disc : 0;
        $pay->value = $request->nom;
        $pay->type = $request->type;        
        $pay->save();


        Alert::success('success', 'Insert Successfully');
        return redirect()->route('payment.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(payment $payment)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(payment $payment)
    {
        $lpk = Third::all();
        $data = 'Edit Payment';
        return view('payment.create',compact('data','payment','lpk')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, payment $payment)
    {
        $rule = [            
            'name'       => 'required',    
            'type'       => 'required',   
            'time'       => 'required',   
            'periode'    => 'required',   
            'nominal'    => 'required',   
            ];
        $message = ['required'=>'field ini harus disi'];

        $request->validate($rule,$message);

        $nom = $request->nominal;
        $time = $request->time;
        $periode = $request->periode;

        $pay = $payment;
        $pay->name = $request->name;
        $lpk = $request->lpk;
        $pay->grant = $lpk;
        $tot = 0;
        for ($i=0; $i < count($nom) ; $i++) { 
            $val []= ['time'=>$time[$i], 'periode'=>$periode[$i], 'nominal'=>$nom[$i]];
            $tot +=$nom[$i];
        }

        $total = (double) $tot;     
        $pay->method = json_encode($val);
        $pay->nominal = $total;
        $pay->count = count($nom);
        $pay->disc = ($request->nom) ? $request->disc : 0;
        $pay->value = $request->nom;
        $pay->type = $request->type;        
        $pay->save();


        Alert::success('success', 'Insert Successfully');
        return redirect()->route('payment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(payment $payment)
    {
        $payment->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
