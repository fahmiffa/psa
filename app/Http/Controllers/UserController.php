<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Status;
use App\Models\Participant;
use Illuminate\Http\Request;
use Alert;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Student;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsRole:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        $data = 'Data User';
        return view('user.index',compact('data','user'));     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = 'Create user';
        return view('user.create',compact('data'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [            
            'name' => 'required',
            'email' => 'required',
            'hp' => 'required',                    
            'role' => 'required',    
            'password' => 'required',                                    
            ];

        $request->validate($rule);

        $item = new User;
        $item->name = $request->name;
        $item->email = $request->email;
        $item->hp = $request->hp;
        $item->role = $request->role;
        $item->password = bcrypt($request->password);
        $item->status =1;
        $item->save();

        Alert::success('success', 'Insert Successfully');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = 'Edit user';
        return view('user.create',compact('data','user')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rule = [            
            'name' => 'required',
            'email' => 'required',
            'hp' => 'required',                    
            'role' => 'required',                                        
            ];

        $request->validate($rule);

        $item = $user;
        $item->name = $request->name;
        $item->email = $request->email;
        $item->hp = $request->hp;
        $item->role = $request->role;
        if($request->password)
        {
            $item->password = bcrypt($request->password);
        }
        // $item->status = 1;
        $item->save();

        Alert::success('success', 'Update Successfully');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if($user->id == 1)
        {
            Alert::error('Error', 'Invalid Data');
        }
        else
        {
            // guru 
            if($user->role == 'pengajar')
            {
                $kelas = Kelas::where('employee',$user->id)->first();

                // materi 
                foreach($kelas->materi as $item)
                {
                    $item->delete();
                }

                // murid
                foreach($kelas->siswa as $item)
                {
                    // nilai
                    if($item->nilai)
                    {                        
                        $item->nilai->delete();
                    }

                    // kelas
                    if($item->head)
                    {
                        $item->head->delete();
                    }

                    // participant
                    $par = Participant::where('users_id',$item->student)->delete();               

                    $item->kelas = null;
                    $item->save();
                }

                $kelas->delete();

            }


            $user->delete();
            Alert::success('success', 'Delete Successfully');
        }
        return back();
    }
}
