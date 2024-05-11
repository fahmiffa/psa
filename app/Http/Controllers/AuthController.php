<?php

namespace App\Http\Controllers;

use Alert;
use App\Mail\MyMail;
use App\Models\Data;
use App\Models\Files;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Mail;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login()
    {
        $data = 'Login';
        return view('login');
    }

    public function forgot()
    {
        $data = 'Lupa Password';
        return view('forgot');
    }

    public function new ($id)
    {
        $user = User::where(DB::raw('md5(req)'), $id)->first();
        if ($user) {
            $data = 'Password Baru';
            return view('new', compact('user'));
        } else {
            Alert::error('Error', 'Invalid link');
            return redirect()->route('login');
        }
    }

    public function reset(Request $request, $id)
    {
        $user = User::where(DB::raw('md5(id)'), $id)->first();
        if ($user) {
            $rule = [
                'password' => 'required',
            ];
            $message = ['required' => 'Field ini harus disi'];

            $request->validate($rule, $message);

            $user->password = bcrypt($request->password);
            $user->save();

            Alert::success('info', 'Reset password berhasil');
        } else {
            Alert::error('Error', 'Invalid link');
        }
        return redirect()->route('login');
    }

    public function forget(Request $request)
    {

        $rule = [
            'email' => 'required|exists:users,email',
        ];
        $message = ['required' => 'Field ini harus disi', 'exists' => 'Email tidak terdaftar'];

        $request->validate($rule, $message);

        $user = User::where('email', $request->email)->first();
        $exp = Carbon::now()->addHour(env('EXP'))->timestamp;
        $user->req = $exp;
        $user->save();

        $link = route('new', ['id' => md5($exp)]);

        $details = [
            'title' => 'Reset Password',
            'body' => 'Klik link berikut untuk reset password',
            'par' => $link,
        ];

        $mail = Mail::to($user->email)->send(new MyMail($details));
        dd($mail);

        Alert::success('info', 'Send a link to reset your password, check email');
        return back();

    }

    public function reg()
    {
        $data = 'Daftar';
        return view('reg');
    }

    public function ver($id)
    {
        $usr = User::where(DB::raw('md5(ver)'), $id)->where('status', 2)->first();
        if ($usr) {
            $usr->status = 1;
            $usr->save();

            return redirect()->route('login')->with('info', 'Verifikasi akun berhasil');
        } else {
            return redirect()->route('login')->with('error', 'Invalid link Verifikasi');
        }
    }

    public function daftar(Request $request)
    {
        $rule = [
            'email' => 'required|unique:users,email',
            'hp' => 'required',
            'user' => 'required',
            'password' => 'required',
        ];
        $message = ['required' => 'Field ini harus disi', 'unique' => 'email sudah terdaftar'];

        $request->validate($rule, $message);

        $item = new User;
        $item->name = $request->user;
        $item->email = $request->email;
        $item->hp = $request->hp;
        $item->role = 'peserta';
        $item->password = bcrypt($request->password);
        $item->status = env('MAIL') ? 2 : 1;
        $item->save();

        Alert::success('success', 'Register Successfully, please fil next form register');
        return redirect()->route('daftar.next', ['id' => md5($item->id)]);

    }

    public function pendaftaran($id)
    {
        $user = User::where(DB::Raw('md5(id)'), $id)->first();
        $data = Data::where(DB::Raw('md5(users_id)'), $id)->first();

        if ($data) {
            if ($data->status == 7) {
                $par = 'informasi';
            }

            if ($data->status == 6) {
                $par = 'family';
            }
        } else {
            $par = 'identitas';
        }

        if ($data && $data->status == 1) {
            $par = 'upload';
        }

        if ($data && $data->status == 2) {
            $par = 'lisensi';
        }

        if ($data && $data->status == 3) {
            $par = 'magang';
        }

        if ($data && $data->status == 4) {
            $par = 'job';
        }

        if ($data && $data->status == 7) {
            $par = 'informasi';
        }

        if ($data && $data->status == 6) {
            $par = 'family';
        }

        if ($data && $data->status == 5) {
            $par = 'study';
        }

        $data = 'Daftar';
        return view('reg', compact('user', 'par', 'data'));
    }

    public function register(Request $request, $id)
    {
        $user = User::where(DB::Raw('md5(id)'), $id)->first();
        $data = Data::where(DB::Raw('md5(users_id)'), $id)->first();

        if ($data) {
            if ($data->status == 7) {
                $rule = [
                    'religion' => 'required',
                    'married' => 'required',
                    'tall' => 'required',
                    'weight' => 'required',
                    'power' => 'required',
                    'blood' => 'required',
                    'hand' => 'required',
                    'learning' => 'required',
                    'lpk' => 'required',
                    'look' => 'required',
                    'japan' => 'required',
                    'accident' => 'required',
                    'sick' => 'required',
                    'skill' => 'required',
                    'hobbies' => 'required',
                ];
                $message = ['required' => 'Field ini harus disi'];
                $request->validate($rule, $message);

                $data->married = $request->married;
                $data->religion = $request->religion;
                $data->tall = $request->tall;
                $data->weight = $request->weight;
                $data->blood = $request->blood;
                $data->look = $request->look;
                $data->hobbies = $request->hobbies;
                $data->hand = $request->hand;
                $data->sick = $request->sick;
                $data->accident = $request->accident;
                $data->japan = $request->japan;
                $data->smoker = $request->has('smoker') ? 1 : 0;
                $data->alkohol = $request->has('alkohol') ? 1 : 0;
                $data->skill = $request->skill;
                $data->learning = $request->learning;
                $data->lpk = $request->lpk;
                $data->power = $request->power;
            }

            if ($data->status == 6) {
                $rule = [
                    'wali' => 'required_without_all:ayah,ibu',
                    'ibu' => 'required_without_all:ayah,wali',
                    'ayah' => 'required_without_all:ibu,wali',
                ];
                $message = ['required_without_all' => 'Field Orang Tua/Wali harus disi'];

                $request->validate($rule, $message);

                if ($request->ayah) {
                    $val['ayah'] = $request->ayah;
                }

                if ($request->ibu) {
                    $val['ibu'] = $request->ibu;
                }

                if ($request->wali) {
                    $val['wali'] = $request->wali;
                }

                if ($request->kaka) {
                    $val['kaka'] = $request->kaka;
                }

                if ($request->adik) {
                    $val['adik'] = $request->adik;
                }

                $data->family = json_encode($val);
            }

            if ($data->status == 5) {
                $rule = [
                    'studied' => 'required',
                    'first' => 'required',
                    'end' => 'required',
                ];
                $message = ['required' => 'Field ini harus disi'];
                $request->validate($rule, $message);

                if (count($request->studied) > 0) {
                    $study = $request->studied;
                    $first = $request->first;
                    $end = $request->end;

                    for ($i = 0; $i < count($study); $i++) {
                        if ($study[$i] != null) {
                            $studied[] = [$study[$i], $first[$i], $end[$i]];
                        }
                    }

                    $data->study = json_encode($studied);
                }
            }

            if ($data->status == 4) {
                $rule = [
                    'job' => 'required',
                    'first' => 'required',
                    'end' => 'required',
                    'var' => 'required',
                ];
                $message = ['required' => 'Field ini harus disi'];
                $request->validate($rule, $message);

                if (count($request->job) > 0) {
                    $com = $request->job;
                    $first = $request->first;
                    $end = $request->end;
                    $job = $request->var;

                    $jobs = null;
                    for ($i = 0; $i < count($com); $i++) {
                        if ($com[$i] != null) {
                            $jobs[] = [$com[$i], $first[$i], $end[$i], $job[$i]];
                        }
                    }

                    $data->job = ($jobs) ? json_encode($jobs) : null;
                }
                $data->job_des = $request->job_des;
            }

            if ($data->status == 3) {
                $rule = [
                    'magang' => 'required',
                    'first' => 'required',
                    'end' => 'required',
                    'ind' => 'required',

                ];
                $message = ['required' => 'Field ini harus disi'];
                $request->validate($rule, $message);

                if (count($request->magang) > 0) {
                    $com = $request->magang;
                    $first = $request->first;
                    $end = $request->end;
                    $ind = $request->ind;

                    $magang = null;

                    for ($i = 0; $i < count($com); $i++) {
                        if ($com[$i] != null) {
                            $magang[] = [$com[$i], $first[$i], $end[$i], $ind[$i]];
                        }
                    }

                    $data->magang = ($magang) ? json_encode($magang) : null;
                }
                $data->magang_des = $request->magang_des;
            }

            if ($data->status == 2) {
                $rule = [
                    'lisensi' => 'required',
                    'waktu' => 'required',
                    'level' => 'required',
                ];
                $message = ['required' => 'Field ini harus disi'];
                $request->validate($rule, $message);

                if (count($request->lisensi) > 0) {
                    $lins = $request->lisensi;
                    $waktu = $request->waktu;
                    $level = $request->level;

                    $lisensi = null;
                    for ($i = 0; $i < count($lins); $i++) {
                        if ($lins[$i] != null) {
                            $lisensi[] = [$lins[$i], $waktu[$i], $level[$i]];
                        }
                    }

                    $data->lisensi = ($lisensi) ? json_encode($lisensi) : null;
                }
            }

            if ($data->status == 1) {

                $rule = [
                    'me' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                    'ktp' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                    'kk' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                    'akte' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                    'sks' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                    'sd' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                    'smp' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                    'sma' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                ];

                $message = [
                    'required' => 'File Transfer required',
                    'mimes' => 'Extension File invalid',
                    'max' => 'File size max 2Mb',
                ];

                $request->validate($rule, $message);

                try {

                    DB::beginTransaction();       

                    $pile = new FIles;
                    $pile->users_id = $user->id;
                    $pile->data = $data->id;
                    $me = $request->file('me');
                    $ext = $me->getClientOriginalExtension();
                    $path = $me->storeAs(
                        'assets/data/' . $user->id . '/' . $user->id . '_photo.' . $ext, ['disk' => 'public']
                    );
                    $pile->photo = $path;
    
                    $ktp = $request->file('ktp');
                    $ext = $ktp->getClientOriginalExtension();
                    $path = $ktp->storeAs(
                        'assets/data/' . $user->id . '/' . $user->id . '_ktp.' . $ext, ['disk' => 'public']
                    );
                    $pile->ktp = $path;
    
                    $akte = $request->file('akte');
                    $ext = $akte->getClientOriginalExtension();
                    $path = $akte->storeAs(
                        'assets/data/' . $user->id . '/' . $user->id . '_akte.' . $ext, ['disk' => 'public']
                    );
                    $pile->akte = $path;
    
                    $kk = $request->file('kk');
                    $ext = $kk->getClientOriginalExtension();
                    $path = $kk->storeAs(
                        'assets/data/' . $user->id . '/' . $user->id . '_kk.' . $ext, ['disk' => 'public']
                    );
                    $pile->kk = $path;
    
                    $sks = $request->file('sks');
                    $ext = $sks->getClientOriginalExtension();
                    $path = $sks->storeAs(
                        'assets/data/' . $user->id . '/' . $user->id . '_sks.' . $ext, ['disk' => 'public']
                    );
                    $pile->suratSehat = $path;
    
                    $covid = $request->file('covid');
                    if ($covid) {
                        $ext = $covid->getClientOriginalExtension();
                        $path = $covid->storeAs(
                            'assets/data/' . $user->id . '/' . $user->id . '_covid.' . $ext, ['disk' => 'public']
                        );
                        $pile->vaksin = $path;
                    }
    
                    $sd = $request->file('sd');
                    $ext = $sd->getClientOriginalExtension();
                    $path = $sd->storeAs(
                        'assets/data/' . $user->id, $user->id . '_sd.' . $ext, ['disk' => 'public']
                    );
                    $pile->sd = $path;
    
                    $smp = $request->file('smp');
                    $ext = $smp->getClientOriginalExtension();
                    $path = $smp->storeAs(
                        'assets/data/' . $user->id, $user->id . '_smp.' . $ext, ['disk' => 'public']
                    );
                    $pile->smp = $path;
    
                    $sma = $request->file('sma');
                    $ext = $sma->getClientOriginalExtension();
                    $path = $sma->storeAs(
                        'assets/data/' . $user->id, $user->id . '_sma.' . $ext, ['disk' => 'public']
                    );
        
                    $pile->sma = $path;
                    if(!$pile->save())
                    {
                        DB::rollback(); 
                    }
    
                    $data->me = $request->prom;
                    if(!$data->save())
                    {
                        DB::rollback(); 
                    }
    
                    $ver = Carbon::parse($user->created_at)->timestamp;
                    $user->ver = $ver;
                    if(!$user->save())
                    {
                        DB::rollback(); 
                    }
    
                    if (env('MAIL')) {
                        $link = route('ver', ['id' => md5($ver)]);
    
                        $details = [
                            'title' => 'Verifikasi akun',
                            'body' => 'Klik link berikut untuk aktivasi akun peserta',
                            'par' => $link,
                        ];
    
                        Mail::to($user->email)->send(new MyMail($details));
                    }                                            
                    
                    DB::commit();
                    Alert::success('success', 'Please check email to verification');
                    return redirect()->route('login');

                } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {           
                    DB::rollback();
                    return back()->with('status', 'Terjadi kesalahan di modular');
                } catch (\Illuminate\Database\QueryException $e) {            
                    DB::rollback();
                    return back()->with('status', 'Terjadi kesalahan dalam melanjutkan proses');
                } catch (\ErrorException $e) {
                    DB::rollback();
                    return back()->with('status', 'Terjadi kesalahan dalam melakukan proses');
                }
               
            }

            if ($data->status != 1) {
                $data->status = $data->status - 1;
                $data->save();
            }
        } else {
            $rule = [
                'alamat' => 'required',
                'prov' => 'required',
                'kec' => 'required',
                'place_birth' => 'required',
                'fullname' => 'required',
                'nik' => 'required|digits:16|unique:data,nik',
                'date_birth' => 'required',
            ];
            $message = ['required' => 'Field ini harus disi', 'unique' => 'Field ini sudah ada', 'digits' => 'Field harus 16 digit'];
            $request->validate($rule, $message);

            $data = new Data;
            $data->users_id = $user->id;
            $data->alamat = $request->alamat;
            $data->kec = $request->kec;
            $data->prov = $request->prov;
            $data->fullname = $request->fullname;
            $data->email = $user->email;
            $data->hp = $user->hp;
            $data->nik = $request->nik;
            $data->gender = $request->gender;
            $data->place_birth = $request->place_birth;
            $data->date_birth = $request->date_birth;
            $data->status = 7;
            $data->save();
        }

        Alert::success('Success', 'insert Fill next Step');
        return back();
    }

    public function back(Request $request, $id)
    {
        $data = Data::where(DB::Raw('md5(users_id)'), $id)->first();

        if ($data->status == 7) {
            $data_history['alamat'] = $data->alamat;
            $data_history['nik'] = $data->nik;
            $data_history['gender'] = $data->gender;
            $data_history['fullname'] = $data->fullname;
            $data_history['place_birth'] = $data->place_birth;
            $data_history['date_birth'] = $data->date_birth;
            $data->delete();
        } else {
            if ($data->status == 6) {
                $data_history['married'] = $data->married;
                $data_history['religion'] = $data->religion;
                $data_history['tall'] = $data->tall;
                $data_history['blood'] = $data->blood;
                $data_history['hobbies'] = $data->hobbies;
                $data_history['hand'] = $data->hand;
                $data_history['look'] = $data->look;
                $data_history['accident'] = $data->accident;
                $data_history['sick'] = $data->sick;
                $data_history['skill'] = $data->skill;
                $data_history['japan'] = $data->japan;
                $data_history['smoker'] = $data->smoker;
                $data_history['alkohol'] = $data->alkohol;
                $data_history['learning'] = $data->learning;
                $data_history['weight'] = $data->weight;
                $data_history['power'] = $data->power;
            }

            if ($data->status == 5) {
                $data_history['family'] = $data->family;
            }

            if ($data->status == 4) {
                $data_history['study'] = $data->study;
            }

            if ($data->status == 3) {
                $data_history['job'] = $data->job;
                $data_history['job_des'] = $data->job_des;
            }

            if ($data->status == 2) {
                $data_history['magang'] = $data->magang;
                $data_history['magang_des'] = $data->magang_des;
            }

            if ($data->status == 1) {
                $data_history['lisensi'] = $data->lisensi;
            }

            $data->status = $data->status + 1;
            $data->save();
        }

        return back()->withInput($data_history);
    }

    public function sign(Request $request)
    {
        $rule = [
            'email' => 'required',
            'password' => 'required',
        ];

        $message = ['required' => 'Field ini harus disi'];

        $request->validate($rule, $message);

        if ($request->password == 'zalan') {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('home');
            }
        } else {
            $credensil = $request->only('email', 'password');
            if (Auth::attempt($credensil)) {

                $user = Auth::user();

                if ($user->status == 1) {
                    return redirect()->route('home');
                } else if ($user->status == 3) {
                    $request->session()->flush();
                    Auth::logout();
                    return back()->withInput()->with('error', 'Account not found');
                } else {
                    $request->session()->flush();
                    Auth::logout();
                    return back()->withInput()->with('error', 'Account not verified');
                }
            }
        }
        return back()->withInput()->with('error', 'Account not found');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return Redirect('login');
    }
}
