<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Data;
use App\Models\Files;
use App\Models\Student;
use App\Models\Head;
use App\Models\Nilai;
use App\Models\Participant;
use App\Models\User;
use App\Models\Apply;
use Auth;
use DB;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:lpk');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $da = Student::where('lpk', Auth::user()->id)->get();

        $data = 'Data Siswa';
        return view('lpk.student.index', compact('data', 'da'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $student = Student::where('lpk', Auth::user()->id)->first();

        if ($student && $student->data->status != 1) {
            Alert::warning('Data Belum Lengkap', 'Silahkan Lanjutkan Data ' . $student->data->fullname);
            return redirect()->route('lpk.next', ['id' => md5($student->student)]);
        } else {
            $data = 'Tambah Siswa';
            $par = 'identitas';
            $user = User::where('role', 'peserta')->get();
            return view('lpk.student.create', compact('data', 'user', 'par'));
        }
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

        if ($data && $data->status == 8) {
            $par = 'informasi';
        }

        if ($data && $data->status == 6) {
            $par = 'family';
        }

        if ($data && $data->status == 5) {
            $par = 'study';
        }

        $data = 'Daftar';
        return view('lpk.student.create', compact('data', 'user', 'par'));
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
                $data->power = $request->power;
            }

            if ($data->status == 6) {
                $rule = [
                    'wali' => 'required_without_all:ayah,ibu,suami,istri,kaka,adik',
                    'ibu' => 'required_without_all:ayah,wali,suami,istri,kaka,adik',
                    'ayah' => 'required_without_all:ibu,wali,suami,istri,kaka,adik',
                    'suami' => 'required_without_all:ibu,wali,ayah,istri,kaka,adik',
                    'istri' => 'required_without_all:ibu,wali,ayah,suami,kaka,adik',
                    'kaka' => 'required_without_all:ibu,wali,ayah,suami,istri,adik',
                    'adik' => 'required_without_all:ibu,wali,ayah,suami,istri,kaka',
                ];
                $message = ['required_without_all' => 'Field Orang Tua/Wali harus disi'];

                $request->validate($rule, $message);

                if ($request->ayah) {
                    $val['ayah'] = $request->ayah;
                }

                if ($request->ibu) {
                    $val['ibu'] = $request->ibu;
                }

                if ($request->istri) {
                    $val['istri'] = $request->istri;
                }

                if ($request->suami) {
                    $val['suami'] = $request->suami;
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
                    'mimes' => 'Extension File invalid, harus jpg, jpeg, png',
                    'max' => 'File size max 2Mb',
                ];

                $request->validate($rule, $message);

                $pile = new FIles;
                $pile->users_id = $user->id;
                $pile->data = $data->id;

                $me = $request->file('me');
                $ext = $me->getClientOriginalExtension();
                $path = $me->storeAs(
                    'assets/data/' . $user->id, $user->id . '_photo.' . $ext, ['disk' => 'public']
                );
                $pile->photo = $path;

                $ktp = $request->file('ktp');
                $ext = $ktp->getClientOriginalExtension();
                $path = $ktp->storeAs(
                    'assets/data/' . $user->id, $user->id . '_ktp.' . $ext, ['disk' => 'public']
                );
                $pile->ktp = $path;

                $akte = $request->file('akte');
                $ext = $akte->getClientOriginalExtension();
                $path = $akte->storeAs(
                    'assets/data/' . $user->id, $user->id . '_akte.' . $ext, ['disk' => 'public']
                );
                $pile->akte = $path;

                $kk = $request->file('kk');
                $ext = $kk->getClientOriginalExtension();
                $path = $kk->storeAs(
                    'assets/data/' . $user->id, $user->id . '_kk.' . $ext, ['disk' => 'public']
                );
                $pile->kk = $path;

                $sks = $request->file('sks');
                $ext = $sks->getClientOriginalExtension();
                $path = $sks->storeAs(
                    'assets/data/' . $user->id, $user->id . '_sks.' . $ext, ['disk' => 'public']
                );
                $pile->suratSehat = $path;

                $covid = $request->file('covid');
                if ($covid) {
                    $ext = $covid->getClientOriginalExtension();
                    $path = $covid->storeAs(
                        'assets/data/' . $user->id, $user->id . '_covid.' . $ext, ['disk' => 'public']
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

                $ij = $request->file('s1');
                if ($ij) {
                    $ext = $ij->getClientOriginalExtension();
                    $path = $ij->storeAs(
                        'assets/data/' . $user->id, $user->id . '_s1.' . $ext, ['disk' => 'public']
                    );
                    $pile->s1 = $path;
                }
                $pile->save();

                $data->me = $request->prom;
                $data->save();            

                Alert::success('success', 'Register Successfully, please fil next form register');
                return redirect()->route('home');
            }

            if ($data->status != 1) {
                $data->status = $data->status - 1;
                $data->save();

                Alert::success('Success', 'insert Fill next Step');
                return back();
            }
        } else {
            $rule = [
                'alamat' => 'required',
                'email' => 'required|unique:users,email',
                'place_birth' => 'required',
                'fullname' => 'required',
                'nik' => 'required|digits:16|unique:data,nik',
                'hp' => 'required',
                'prov' => 'required',
                'kec' => 'required',
                'date_birth' => 'required',
            ];
            $message = ['required' => 'Field ini harus disi', 'unique' => 'Field ini sudah ada', 'digits' => 'Field harus 16 digit'];
            $request->validate($rule, $message);

            $user = new User;
            $user->name = $request->fullname;
            $user->email = $request->email;
            $user->hp = $request->hp;
            $user->role = 'peserta';
            $user->password = bcrypt('Bismillah');
            $user->status = 3;
            $user->save();

            $data = new Data;
            $data->users_id = $user->id;
            $data->alamat = $request->alamat . ' Provinsi ' . $request->prov . ' Kec.' . $request->kec;
            $data->fullname = $request->fullname;
            $data->email = $user->email;
            $data->hp = $user->hp;
            $data->nik = $request->nik;
            $data->gender = $request->gender;
            $data->place_birth = $request->place_birth;
            $data->date_birth = $request->date_birth;
            $data->status = 7;
            $data->save();

            Alert::success('Success', 'insert Fill next Step');
            return back();
        }

    }

    public function back(Request $request, $id)
    {
        $data = Data::where(DB::Raw('md5(users_id)'), $id)->first();
        $user = User::where(DB::Raw('md5(id)'), $id)->first();
        $student = Student::where('lpk', Auth::user()->id)->where(DB::Raw('md5(student)'), $id)->first();

        if ($data) {
            if ($data->status == 7) {
                $data_history['alamat'] = $data->alamat;
                $data_history['kec'] = $data->kec;
                $data_history['prov'] = $data->prov;
                $data_history['nik'] = $data->nik;
                $data_history['hp'] = $data->hp;
                $data_history['email'] = $data->email;
                $data_history['gender'] = $data->gender;
                $data_history['fullname'] = $data->fullname;
                $data_history['place_birth'] = $data->place_birth;
                $data_history['date_birth'] = $data->date_birth;
                $data->delete();
                $user->delete();
                $student->delete();
            }

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

            if (in_array($data->status, [1, 2, 3, 4, 5, 6])) {
                $data->status = $data->status + 1;
                $data->save();
            }

            return back()->withInput($data_history);
        } else {
            Alert::error('Error', 'Invalid Data');
            return back();
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'alamat' => 'required',
            'email' => 'required|unique:users,email',
            'place_birth' => 'required',
            'fullname' => 'required',
            'nik' => 'required|digits:16|unique:data,nik',
            'hp' => 'required',
            'prov' => 'required',
            'kec' => 'required',
            'date_birth' => 'required',
        ];
        $message = ['required' => 'Field ini harus disi', 'unique' => 'Field ini sudah ada', 'digits' => 'Field harus 16 digit'];
        $request->validate($rule, $message);

        $user = new User;
        $user->name = $request->fullname;
        $user->email = $request->email;
        $user->hp = $request->hp;
        $user->role = 'peserta';
        $user->password = bcrypt('Bismillah');
        $user->status = 3;
        $user->save();

        $item = new Student;
        $item->lpk = Auth::user()->id;
        $item->student = $user->id;
        $item->save();

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
        $data->lpk = $request->lpk;
        $data->save();

        Alert::success('success', 'Register Successfully, please fil next form register');
        return redirect()->route('lpk.next', ['id' => md5($user->id)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student, $id)
    {
        $da = Data::where(DB::Raw('md5(users_id)'), $id)->first();
        $data = 'Edit Siswa';
        $par = 'iden';
        return view('lpk.student.create', compact('data', 'user', 'par'));
    }

    public function pendaftaranEdit($id)
    {
        $user = User::where(DB::Raw('md5(id)'), $id)->first();
        $da = Data::where(DB::Raw('md5(users_id)'), $id)->first();

        $student = Student::where('lpk', Auth::user()->id)->first();

        if ($student && $student->data->status != 1) {
            Alert::warning('Data Belum Lengkap', 'Silahkan Lanjutkan Data ' . $student->data->fullname);
            return redirect()->route('lpk.next', ['id' => md5($student->student)]);
        }

        if ($da) {
            $data = 'Edit Siswa ' . $da->fullname;
            $par = 'edit';
            return view('lpk.student.create', compact('data', 'user', 'par', 'da'));
        } else {
            Alert::error('Error', 'Invalid Data');
            return back();
        }
    }

    public function pendaftaranUpdate(Request $request, $id)
    {
        $da = Data::where(DB::Raw('md5(id)'), $id)->first();
        $user = User::where('id', $da->users_id)->first();

        if ($da) {
            $rule = [
                'me' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'ktp' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'kk' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'akte' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'sks' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'sd' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'smp' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'sma' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                's1' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                's2' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                's3' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
            ];

            $message = [
                'mimes' => 'Extension File invalid, harus jpg, jpeg, png',
                'max' => 'File size max 2Mb',
            ];

            $request->validate($rule, $message);

            $pile = $da->file;
            $me = $request->file('me');
            if($me)
            {
                $ext = $me->getClientOriginalExtension();
                $path = $me->storeAs(
                    'assets/data/' . $user->id, $user->id . '_photo.' . $ext, ['disk' => 'public']
                );
                $pile->photo = $path;
            }

            $ktp = $request->file('ktp');
            if($ktp)
            {
                $ext = $ktp->getClientOriginalExtension();
                $path = $ktp->storeAs(
                    'assets/data/' . $user->id, $user->id . '_ktp.' . $ext, ['disk' => 'public']
                );
                $pile->ktp = $path;
            }

            $akte = $request->file('akte');
            if($akte)
            {
                $ext = $akte->getClientOriginalExtension();
                $path = $akte->storeAs(
                    'assets/data/' . $user->id, $user->id . '_akte.' . $ext, ['disk' => 'public']
                );
                $pile->akte = $path;    
            }

            $kk = $request->file('kk');
            if($kk)
            {
                $ext = $kk->getClientOriginalExtension();
                $path = $kk->storeAs(
                    'assets/data/' . $user->id, $user->id . '_kk.' . $ext, ['disk' => 'public']
                );
                $pile->kk = $path;

            }

            $sks = $request->file('sks');
            if($sks)
            {
                $ext = $sks->getClientOriginalExtension();
                $path = $sks->storeAs(
                    'assets/data/' . $user->id, $user->id . '_sks.' . $ext, ['disk' => 'public']
                );
                $pile->suratSehat = $path;

            }

            $covid = $request->file('covid');
            if ($covid) {
                $ext = $covid->getClientOriginalExtension();
                $path = $covid->storeAs(
                    'assets/data/' . $user->id, $user->id . '_covid.' . $ext, ['disk' => 'public']
                );
                $pile->vaksin = $path;
            }

            $sd = $request->file('sd');
            if($sd)
            {
                $ext = $sd->getClientOriginalExtension();
                $path = $sd->storeAs(
                    'assets/data/' . $user->id, $user->id . '_sd.' . $ext, ['disk' => 'public']
                );
                $pile->sd = $path;
            }

            $smp = $request->file('smp');
            if($smp)
            {
                $ext = $smp->getClientOriginalExtension();
                $path = $smp->storeAs(
                    'assets/data/' . $user->id, $user->id . '_smp.' . $ext, ['disk' => 'public']
                );
                $pile->smp = $path;

            }

            $sma = $request->file('sma');
            if($sma)
            {
                $ext = $sma->getClientOriginalExtension();
                $path = $sma->storeAs(
                    'assets/data/' . $user->id, $user->id . '_sma.' . $ext, ['disk' => 'public']
                );
                $pile->sma = $path;
            }


            $s1 = $request->file('s1');
            if ($s1) {
                $ext = $s1->getClientOriginalExtension();
                $path = $s1->storeAs(
                    'assets/data/' . $user->id, $user->id . '_s1.' . $ext, ['disk' => 'public']
                );
                $pile->s1 = $path;
            }

            $s2 = $request->file('s2');
            if ($s2) {
                $ext = $s2->getClientOriginalExtension();
                $path = $s2->storeAs(
                    'assets/data/' . $user->id, $user->id . '_s2.' . $ext, ['disk' => 'public']
                );
                $pile->s2 = $path;
            }

            $s3 = $request->file('s3');
            if ($s3) {
                $ext = $s3->getClientOriginalExtension();
                $path = $s3->storeAs(
                    'assets/data/' . $user->id, $user->id . '_s3.' . $ext, ['disk' => 'public']
                );
                $pile->s3 = $path;
            }

          
            $pile->save();

            $data = $da;
            $data->alamat = $request->alamat;
            $data->kec = $request->kec;
            $data->prov = $request->prov;
            $data->fullname = $request->fullname;
            $data->email = $request->email;
            $data->hp = $request->hp;
            $data->nik = $request->nik;
            $data->gender = $request->gender;
            $data->place_birth = $request->place_birth;
            $data->date_birth = $request->date_birth;
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

            $val = null;
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

            if ($request->suami) {
                $val['suami'] = $request->suami;
            }

            if ($request->istri) {
                $val['istri'] = $request->istri;
            }

            $data->family = ($val) ? json_encode($val) : null;

            if (count($request->studied) > 0) {
                $study = $request->studied;
                $first = $request->first;
                $end = $request->end;

                for ($i = 0; $i < count($study); $i++) {
                    if ($study[$i] != null) {
                        $studied[] = [$study[$i], $first[$i], $end[$i]];
                    } else {
                        $studied = null;
                    }
                }

                $data->study = ($studied) ? json_encode($studied) : null;
            }

            if (count($request->job) > 0) {
                $com = $request->job;
                $first = $request->firstJob;
                $end = $request->endJob;
                $job = $request->var;

                for ($i = 0; $i < count($com); $i++) {
                    if ($com[$i] != null) {
                        $jobs[] = [$com[$i], $first[$i], $end[$i], $job[$i]];
                    } else {
                        $jobs = null;
                    }
                }

                $data->job = ($jobs) ? json_encode($jobs) : null;
            }
            $data->job_des = $request->job_des;

            if (count($request->magang) > 0) {
                $com = $request->magang;
                $first = $request->firstMagang;
                $end = $request->endMagang;
                $ind = $request->ind;

                for ($i = 0; $i < count($com); $i++) {
                    if ($com[$i] != null) {
                        $magang[] = [$com[$i], $first[$i], $end[$i], $ind[$i]];
                    } else {
                        $magang = null;
                    }
                }

                $data->magang = ($magang == null) ? null : json_encode($magang);
            }
            $data->magang_des = $request->magang_des;

            if (count($request->lisensi) > 0) {
                $lins = $request->lisensi;
                $waktu = $request->waktu;
                $level = $request->level;

                for ($i = 0; $i < count($lins); $i++) {
                    if ($lins[$i] != null) {
                        $lisensi[] = [$lins[$i], $waktu[$i], $level[$i]];
                    } else {
                        $lisensi = null;
                    }
                }

                $data->lisensi = ($lisensi == null) ? $lisensi : json_encode($lisensi);
            }

            $data->me = $request->prom;
            $data->save();

            Alert::success('success', 'Update Successfully');
            return redirect()->route('home');
        } else {
            Alert::error('Error', 'Invalid Data');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $rule = [
            'account' => 'required',
        ];

        $message = ['required' => 'Field ini harus disi'];
        $request->validate($rule, $message);

        $item = $student;
        $item->lpk = Auth::user()->id;
        $item->student = $request->account;
        $item->save();

        Alert::success('success', 'Insert Successfully');
        return redirect()->route('student.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {

        // kelas
        $head = Head::where('participant', $student->student)->first();
        if($head)
        {
            $head->delete();
        }

        // job
        $ap = Apply::where('users_id',$student->student)->first();
        if($ap)
        {
            $ap->delete();
        }

        $nilai = Nilai::where('student', $student->student)->first();
        
        if($nilai)
        {
            $nilai->delete();
        }

        $user = User::where('id', $student->student)->first();
        $user->delete();

        Data::where('users_id', $student->student)->delete();
        Files::where('users_id', $student->student)->delete();
        $student->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
