<?php

namespace App\Http\Controllers;

use App\Models\Head;
use App\Models\Paid;
use App\Models\Payment;
use Illuminate\Http\Request;
use Auth;
use Alert;
use DB;
use App\Models\Participant;
use App\Models\User;
use App\Rules\Status;

class HeadController extends Controller
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
        $data = 'Payment List';
        $payment = Payment::all();
        $da = Paid::withTrashed()->latest()->get();
        return view('paid.index',compact('da','data','payment'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Display the specified resource.
     */
    public function show(Head $head)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Head $head)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Head $head, $id)
    {
        
        $paid = Paid::where(DB::raw('md5(id)'),$id)->first();
        $head = Head::where('id',$paid->head)->first();
        if($head && $paid)
        {            
            $st = $head->user->stat;           
            if($st == 1)
            {
                $head->offline = 1;
            }            
          
            $head->save();

            $paid->status = 1;
            $paid->employee = Auth::user()->id;
            $paid->save();
            
            $var = 1 + $st;
            Status::grade($head,'verified payment '.$paid->payment->name,$var);   
            Status::log('verified payment '.$paid->payment->name);                             
            Alert::success('success', 'Verif Successfully');
        }
        else
        {
            Alert::error('info', 'invalid Request');
        }

        return back();
    }

    public function reject(Request $request, $id)
    { 
        if($request->ket == null)
        {
            Alert::error('info', 'Keterangan wajib disi, jika di tolak');
            return back()->withInput();
        }
        
        $paid = Paid::where(DB::raw('md5(id)'),$id)->first();
        $head = Head::where('id',$paid->head)->first();    

        if($head && $paid)
        {                 
            $st = $head->user->stat;   
            
            $paid->status   = 2;
            $paid->ket       = $request->ket;
            $paid->employee = Auth::user()->id;
            $paid->save();

            if($head->status == 3)
            {
                $var = 6;
                Status::grade($head,'reject payment '.$paid->payment->name,$var);   
                Status::log('reject payment '.$paid->payment->name); 
            }
            
            
            if($head->offline == null)
            {
                $par = Participant::where('head',$paid->head)->first();
                $head->delete();      
                $par->delete();                
                Status::log('reject payment '.$paid->payment->name);   
            }      
            Alert::success('success', 'Reject Successfully');
        }
        else
        {
            Alert::error('info', 'invalid Request');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Head $head)
    {
        //
    }
}
