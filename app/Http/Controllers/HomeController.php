<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Apply;
use App\Models\Company;
use App\Models\CV;
use App\Models\Data;
use App\Models\Files;
use App\Models\Head;
use App\Models\Job;
use App\Models\Kelas;
use App\Models\Log;
use App\Models\Nilai;
use App\Models\Paid;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Third;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use PDF;
use ZipArchive;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == 'lpk') {
            $lpk = Third::where('users_id', Auth::user()->id)->first();
            $log = Log::where('par', $lpk->id)
                ->where('type', 'lpk')
                ->where('status', 0)
                ->latest()->first();
            $job = Job::whereNotNull('grant')->where('status', 1)->get();
            $student = Student::where('lpk', Auth::user()->id)->get();
            $head = Head::where('lpk', Auth::user()->id)->get();
            return view('lpk', compact('log', 'job', 'student', 'head'));
        }

        if (Auth::user()->role == 'mandiri') {
            $head = Head::where('participant', Auth::user()->id)->latest()->first();
            $heads = Head::where('participant', Auth::user()->id)->whereNotIn('status', [0, 1])->where('job', 1)->get();
            $data = Data::where('users_id', Auth::user()->id)->first();
            $files = Files::where('users_id', Auth::user()->id)->first();
            $cv = CV::where('users_id', Auth::user()->id)->first();
            $paid = Paid::where('user', Auth::user()->id)->latest()->get();
            $student = Student::where('student', Auth::user()->id)->latest()->first();
            $nilai = Nilai::where('student', Auth::user()->id)->latest()->get();
            $paymentStudy = Payment::first();
            $paymentDoc = Payment::where('id', 2)->first();
            $paymentJob = Payment::where('id', 3)->first();
            return view('participant', compact('head', 'paymentStudy', 'paymentDoc', 'paymentJob', 'paid', 'student', 'data', 'nilai', 'heads'));
        }

        if (Auth::user()->role == 'pegawai') {
            $log = Log::latest('created_at')->get();
            return view('employee', compact('log'));
        }

        if (Auth::user()->role == 'keuangan') {
            $log = Log::where('type', 'payment')->latest()->get();
            $paid = Paid::where('status', 1)->count();
            $unpaid = Paid::where('status', 0)->count();
            return view('money', compact('log', 'paid', 'unpaid'));
        }

        if (Auth::user()->role == 'pengajar') {
            $log = Log::where('type', 'kelas')->latest('created_at')->get();
            $paid = Paid::where('status', 1)->count();
            $unpaid = Paid::where('status', 0)->count();
            return view('main', compact('log', 'paid', 'unpaid'));
        }

        if (Auth::user()->role == 'admin') {

            $pay = Paid::all();
            $paid = 0;
            $unpaid = 0;
            foreach ($pay as $value) {
                if ($value->status == 1) {
                    $paid += $value->payment->nominal;
                }

                if ($value->status == 0) {
                    $unpaid += $value->payment->nominal;
                }
            }
            $lpk = Third::get()->count();
            $apply = Apply::get()->count();
            $com = Company::get()->count();
            $kelas = Kelas::get()->count();
            $log = Log::latest('created_at')->get();
            return view('home', compact('lpk', 'apply', 'com', 'kelas', 'log', 'paid', 'unpaid'));
        } else {
            return view('main');
        }

    }

    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->first();

        $data = 'Profile';
        return view('profile', compact('data', 'user'));
    }

    public function editProfile()
    {
        $da = Data::where('users_id', Auth::user()->id)->first();
        $user = User::where('id', Auth::user()->id)->first();
        $data = 'Edit';
        return view('user.edit', compact('data', 'user', 'da'));
    }

    public function storeProfile(Request $request, $id)
    {
        $da = Data::where(DB::Raw('md5(users_id)'), $id)->first();
        $user = Auth::user();
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
            if ($me) {
                $ext = $me->getClientOriginalExtension();
                $path = $me->storeAs(
                    'assets/data/' . $user->id, $user->id . '_photo.' . $ext, ['disk' => 'public']
                );
                $pile->photo = $path;
            }

            $ktp = $request->file('ktp');
            if ($ktp) {
                $ext = $ktp->getClientOriginalExtension();
                $path = $ktp->storeAs(
                    'assets/data/' . $user->id, $user->id . '_ktp.' . $ext, ['disk' => 'public']
                );
                $pile->ktp = $path;
            }

            $akte = $request->file('akte');
            if ($akte) {
                $ext = $akte->getClientOriginalExtension();
                $path = $akte->storeAs(
                    'assets/data/' . $user->id, $user->id . '_akte.' . $ext, ['disk' => 'public']
                );
                $pile->akte = $path;
            }

            $kk = $request->file('kk');
            if ($kk) {
                $ext = $kk->getClientOriginalExtension();
                $path = $kk->storeAs(
                    'assets/data/' . $user->id, $user->id . '_kk.' . $ext, ['disk' => 'public']
                );
                $pile->kk = $path;

            }

            $sks = $request->file('sks');
            if ($sks) {
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
            if ($sd) {
                $ext = $sd->getClientOriginalExtension();
                $path = $sd->storeAs(
                    'assets/data/' . $user->id, $user->id . '_sd.' . $ext, ['disk' => 'public']
                );
                $pile->sd = $path;
            }

            $smp = $request->file('smp');
            if ($smp) {
                $ext = $smp->getClientOriginalExtension();
                $path = $smp->storeAs(
                    'assets/data/' . $user->id, $user->id . '_smp.' . $ext, ['disk' => 'public']
                );
                $pile->smp = $path;

            }

            $sma = $request->file('sma');
            if ($sma) {
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

            if ($val != null) {
                $data->family = json_encode($val);
            }

            if ($request->studied) {
                if (count($request->studied) > 0) {
                    $study = $request->studied;
                    $first = $request->firstStudy;
                    $end = $request->endStudy;

                    for ($i = 0; $i < count($study); $i++) {
                        if ($study[$i] != null) {
                            $studied[] = [$study[$i], $first[$i], $end[$i]];
                        } else {
                            $studied = null;
                        }
                    }

                    $data->study = ($studied) ? json_encode($studied) : null;
                }
            }

            if ($request->job) {
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
            }

            $data->job_des = $request->job_des;

            if ($request->magang) {
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

                    $data->magang = ($magang) ? json_encode($magang) : null;
                }

            }
            $data->magang_des = $request->magang_des;

            if ($request->lisensi) {
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

                    $data->lisensi = ($lisensi) ? json_encode($lisensi) : null;
                }
            }

            $data->me = $request->me;
            $data->save();

            Alert::success('success', 'Update Successfully');
            return redirect()->route('profile.index', ['id' => md5($data->users_id)]);
        } else {
            Alert::error('Error', 'Invalid Data');
            return back();
        }
    }

    public function account(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $rule = [
            'name' => 'required',
            'email' => 'required',
            'hp' => 'required',
        ];

        $request->validate($rule);

        $item = $user;
        $item->name = $request->name;
        $item->email = $request->email;
        $item->hp = $request->hp;
        if ($request->password) {
            $item->password = bcrypt($request->password);
        }
        // $item->status = 1;
        $item->save();

        Alert::success('success', 'Update Successfully');
        return back();
    }

    public function download($id)
    {
        $user = User::where(DB::raw('md5(id)'), $id)->first();
        $directory = public_path('storage/assets/data/' . $user->id);

        $zipFileName = 'all_documents.zip';

        $zip = new ZipArchive;

        if ($zip->open($zipFileName, ZipArchive::CREATE) === true) {

            $files = File::allFiles($directory);

            foreach ($files as $file) {
                $zip->addFile($file->getPathName(), $file->getRelativePathName());
            }

            $zip->close();
        }

        return Response::download($zipFileName)->deleteFileAfterSend(true);
    }

    public function report($par, $pile)
    {
        $xls = $pile == 'xls' ? true : false;

        if ($par == 'siswa') {
            $da = User::where('role', 'peserta')->get();

            $da = compact('da', 'par', 'xls');
            $pdf = Pdf::loadView('report', $da);
        }

        if ($par == 'payment') {
            $da = Paid::all();
            $da = compact('da', 'par', 'xls');
            $pdf = Pdf::loadView('report', $da);
        }

        if ($xls) {
            return view('report', $da);
        } else {
            return $pdf->download($par . '.pdf');
        }

    }
}
