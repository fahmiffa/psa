<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Apply;
use App\Models\CV;
use App\Models\Data;
use App\Models\Dataj;
use App\Models\Files;
use App\Models\Head;
use App\Models\Job;
use App\Models\Log;
use App\Models\Nilai;
use App\Models\Paid;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Third;
use App\Models\User;
use App\Rules\Status;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class Lpk extends Controller
{
    public function __construct()
    {
        $this->middleware('IsRole:lpk');
    }

    public function log()
    {
        $lpk = Third::where('users_id', Auth::user()->id)->first();
        $log = Log::where('par', $lpk->id)
            ->where('type', 'lpk')
            ->update(['status' => 1]);

        $log = Log::where('par', $lpk->id)
            ->where('type', 'lpk')
            ->get();

        $data = 'Log aktifitas';
        return view('lpk.log', compact('data', 'log'));
    }

    public function kelas()
    {
        $job = Job::whereNotNull('grant')->where('status', 1)->get();
        $data = 'Pendaftaran Siswa';
        $student = Student::where('lpk', Auth::user()->id)->get();

        $head = Head::whereHas('murid', function ($query) {
            $query->where('lpk', Auth::user()->id);
        })->get();

        return view('lpk.job.index', compact('data', 'head', 'student'));
    }

    public function reg()
    {
        $paymentStudy = Payment::first();
        if ($paymentStudy) {
            $paymentDoc = Payment::where('id', 2)->first();
            $paymentJob = Payment::where('id', 3)->first();
            $data = 'Pendaftaran';
            $student = Student::whereHas('data', function ($q) {
                $q->where('status', 1);
            })->where('lpk', Auth::user()->id)->get();

            return view('lpk.reg', compact('data', 'student', 'paymentStudy'));

        } else {
            Alert::error('info', 'Pembayaran Belum Di setting');
            return back();
        }
    }

    public function status($id)
    {
        $head = Head::where(DB::raw('md5(participant)'), $id)->first();
        $heads = Head::where(DB::raw('md5(participant)'), $id)->get();
        $nilai = Nilai::where(DB::raw('md5(student)'), $id)->get();
        $data = $head->user->data->fullname;
        return view('lpk.job.status', compact('data', 'head', 'nilai', 'heads'));
    }

    public function daftar($id)
    {
        $head = Head::where(DB::raw('md5(participant)'), $id)->first();

        $data = 'Pendaftaran';
        $job = Job::whereNotNull('grant')->where('status', 1);
        if ($job->exists() == false) {
            Alert::error('error', 'Invalid Job');
            return back();
        } else {
            $job = $job->get();
        }
        $paymentDoc = Payment::where('grant', Third::where('users_id', Auth::user()->id)->pluck('id'))->first();
        if (!$paymentDoc) {
            Alert::error('error', 'Pembayaran LPK Belum di setting');
            return back();
        }
        return view('lpk.reg', compact('data', 'head', 'job', 'paymentDoc'));
    }

    public function apply($id, $head)
    {
        $head = Head::where(DB::raw('md5(id)'), $head)->first();
        $var = $head->user->stat;
        if ($var != 3) {
            Alert::error('error', 'Invalid Status');
            return redirect()->route('home');
        }
        $job = Job::where(DB::raw('md5(id)'), $id)->first();
        if (!$job) {
            Alert::error('error', 'Invalid Job');
            return redirect()->route('home');
        }
        $data = 'Pendaftaran di ' . $job->perusahaan->name;
        return view('lpk.apply', compact('data', 'head', 'job'));
    }

    public function store(Request $request, $id, $user)
    {
        $user = User::where(DB::raw('md5(id)'), $user)->first();

        if ($user == false) {
            $rule = [
                'siswa' => 'required',
            ];

            $message = [
                'required' => 'Field ini harus disi',
            ];
            $request->validate($rule, $message);
        }

        $head = Head::where('participant', $request->siswa)->whereIn('status', [5, 4, 3, 2])->first();
        if ($head) {
            Alert::error('info', 'Siswa dalam pendaftaran');
            return back();
        } else {
            if ($user) {
                $job = Job::where(DB::raw('md5(id)'), $id)->first();
                $head = Head::where('participant', $user->id)->whereIn('status', [5, 4, 3, 2])->first();
                $payment = Payment::where(DB::raw('md5(id)'), $id)->first();
                $st = $user->stat;
                $var = $st + 1;


                // apply job
                if ($st == 3) {
                    $rule = [
                        'vid' => 'required|file|mimes:mp4|max:51200',
                    ];
                    $message = [
                        'required' => 'File Transfer required',
                        'mimes' => 'Extension File invalid',
                        'max' => 'File size max 5Mb',
                    ];

                    $request->validate($rule, $message);

                    $apply = new Apply;
                    $apply->head = $head->id;
                    $apply->jobs_id = $job->id;
                    $apply->users_id = $user->id;

                    $vid = $request->file('vid');
                    $ext = $vid->getClientOriginalExtension();
                    $path = $vid->storeAs(
                        'assets/data/' . $user->id, $user->id . '_video.' . $ext, ['disk' => 'public']
                    );

                    $apply->video = $path;
                    $apply->status = 0;
                    $apply->save();

                    Status::grade($head, 'Apply Job', $var);
                    Status::log('Apply Job ' . $job->section. ' Peserta '.$head->user->name, $job->id, 'job');
                    return redirect()->route('kelas.lpk');

                }

                if ($st == 6) {
                    $rule = [
                        'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                    ];
                    $message = [
                        'required' => 'File Transfer required',
                        'mimes' => 'Extension File invalid',
                        'max' => 'File size max 2Mb',
                    ];

                    $request->validate($rule, $message);

                    $pile = $request->file('file');
                    $piles = 'tf_' . time() . '.' . $pile->getClientOriginalExtension();
                    $destinationPath = public_path('assets/image');
                    $pile->move($destinationPath, $piles);

                    $paid = new Paid;
                    $paid->head = $head->id;
                    $paid->user = $head->participant;
                    $paid->par = $payment->id;
                    $paid->img = $piles;
                    $paid->save();

                    Status::grade($head, 'Pembayaran ' . $payment->name, $var);
                    Status::log('Pembayaran ' . $payment->name, $payment->id, 'payment');

                    return redirect()->route('kelas.lpk');

                }

                if ($st == 9) {
                    $rule = [
                        'file' => 'required|file|mimes:pdf|max:2048',
                    ];
                    $message = [
                        'required' => 'File Transfer required',
                        'mimes' => 'Extension File invalid',
                        'max' => 'File size max 2Mb',
                    ];

                    $request->validate($rule, $message);

                    $apply = Apply::where(DB::raw('md5(id)'), $id)->first();
                    $head = Head::where('id', $apply->head)->where('status', 2)->first();
                    $st = $apply->user->stat;
                    $var = $st + 1;
                    Status::grade($head, 'Upload Kontrak ' . $apply->job->perusahaan->name, $var);
                    Status::log('Upload Kontrak ' . $apply->user->name . ' di ' . $apply->job->perusahaan->name, $apply->job->id, 'job');

                    $path = 'assets/dokumen/' . $apply->user->id;
                    $path = Storage::disk('public')->put($path, $request->file('file'));

                    $apply->spk = $path;
                    $apply->save();

                    Alert::success('success', 'Upload success');
                    return redirect()->route('kelas.lpk');
                }

                // job matching
                if ($st == 11) {
                    $rule = [
                        'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                    ];
                    $message = [
                        'required' => 'File Transfer required',
                        'mimes' => 'Extension File invalid',
                        'max' => 'File size max 2Mb',
                    ];

                    $request->validate($rule, $message);

                    $pile = $request->file('file');
                    $piles = 'tf_' . time() . '.' . $pile->getClientOriginalExtension();
                    $destinationPath = public_path('assets/image');
                    $pile->move($destinationPath, $piles);

                    $paid = new Paid;
                    $paid->head = $head->id;
                    $paid->user = $head->participant;
                    $paid->par = $payment->id;
                    $paid->img = $piles;
                    $paid->save();

                    Status::grade($head, 'Pembayaran ' . $payment->name, $var);
                    Status::log('Pembayaran ' . $payment->name, $payment->id, 'payment');

                    Alert::success('success', 'Upload success');
                    return redirect()->route('kelas.lpk');
                } else {
                    Alert::error('info', 'invalid Data');
                    return back();
                }
            } else {

                $user = User::where('id', $request->siswa)->first();
                $st = $user->stat;
                $var = $st + 2;

                $head = new Head;
                $head->participant = $request->siswa;
                $head->status = 5;
                $head->offline = 1;
                $head->lpk = Auth::user()->id;
                $head->save();

                Status::grade($head, 'Pendaftaran Siswa ' . $user->name, $var);
                Status::log('Pendaftaran Siswa ' . $user->name, $user->id, 'lpk');
                Status::log('Menunggu Verifiikasi kelas ' . $user->name, $user->id, 'kelas');

                return redirect()->route('kelas.lpk');
            }

        }
    }

    public function detail($id)
    {
        $job = Job::where(DB::raw('md5(id)'), $id)->first();
        $data = $job->perusahaan->name;
        return view('lpk.job.detail', compact('data', 'job'));
    }

    public function doc($id)
    {
        $head = Head::where(DB::raw('md5(participant)'), $id)->latest()->first();
        $apply = Apply::where(DB::raw('md5(users_id)'), $id)->where('status', 3)->first();
        $data = Data::where(DB::raw('md5(users_id)'), $id)->first();
        $dataj = DataJ::where(DB::raw('md5(users_id)'), $id)->first();
        $pile = Files::where(DB::raw('md5(users_id)'), $id)->first();
        $cv = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'cv')->first();
        $coe = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'coe')->where('status', 1)->first();
        $vis = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'visa')->where('status', 1)->first();
        $passport = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'passport')->where('status', 1)->first();

        $coed = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'coe')->where('status', 2)->pluck('doc')->toArray();
        $dcoe = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'coe')->where('status', 2)->get();

        if ($dataj) {
            $da = $data;
            return view('lpk.doc', compact('da', 'dataj', 'apply', 'cv', 'data', 'coe', 'coed', 'dcoe', 'head', 'vis', 'passport'));
        }

        if ($data) {
            $da = $data;
            return view('lpk.doc', compact('da', 'data', 'coed', 'dcoe', 'apply', 'head', 'vis', 'passport'));
        } else {
            Alert::error('error', 'Invalid Data');
        }
    }

    public function cvStore(Request $request, $id)
    {

        $user = User::where(DB::raw('md5(id)'), $id)->first();
        $dataj = DataJ::where(DB::raw('md5(users_id)'), $id)->first();
        $pile = Files::where(DB::raw('md5(users_id)'), $id)->first();

        if ($dataj) {
            $data = $dataj;
        } else {
            $data = new Dataj;
        }
        $data->users_id = $user->id;
        $data->alamat = $request->alamat;
        $data->fullname = $request->fullname;
        $data->email = $user->email;
        $data->hp = $user->hp;
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
        $data->smoker = $request->smoker;
        $data->alkohol = $request->alkohol;
        $data->skill = $request->skill;
        $data->learning = $request->learning;
        $data->power = $request->power;

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

        if ($request->istri) {
            $val['istri'] = $request->istri;
        }

        if ($request->suami) {
            $val['suami'] = $request->suami;
        }

        $data->family = json_encode($val, JSON_UNESCAPED_UNICODE);
        $data->study = json_encode([$request->study], JSON_UNESCAPED_UNICODE);
        if ($request->job) {
            $data->job = json_encode([$request->job], JSON_UNESCAPED_UNICODE);
        }
        $data->job_des = $request->job_des;
        if ($request->magang) {
            $data->magang = json_encode([$request->magang], JSON_UNESCAPED_UNICODE);
        }
        $data->magang_des = $request->magang_des;
        if ($request->lisensi) {
            $data->lisensi = json_encode([$request->lisensi], JSON_UNESCAPED_UNICODE);
        }
        $data->me = $request->me;
        $data->save();
        Alert::success('success', 'Generate Successfully');

        // generate pdf
        $name = 'CV' . $user->id . '' . date('Ymd') . '.pdf';
        $dir = 'assets/data/' . $user->id . '/';
        $path = $dir . $name;

        $doc = false;
        $data = $data;

        $da = compact('data', 'name', 'doc', 'pile');
        $pdf = Pdf::loadView('pdf.cv', $da);
        // return $pdf->stream();
        Storage::disk('public')->put($path, $pdf->output());

        $cv = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'cv')->first();
        if (!$cv) {
            $cv = new CV;
        }

        $cv->users_id = $user->id;
        $cv->type = 'cv';
        $cv->dokumen = $path;
        $cv->save();

        return back();
    }

    public function generateDoc(Request $request, $id, $par)
    {

        $user = User::where(DB::raw('md5(id)'), $id)->first();
        $data = Data::where(DB::raw('md5(users_id)'), $id)->first();
        $pile = Files::where(DB::raw('md5(users_id)'), $id)->first();
        $item = $request->item;

        if ($par == 'visa') {
            $name = 'visa_' . $user->id . '_' . date('Ymd') . '.pdf';
            $dir = 'assets/dokumen/' . $user->id . '/';
            $path = $dir . $name;

            $da = compact('data', 'pile', 'item');
            $pdf = Pdf::loadView('pdf.visa', $da);
            //   return view('pdf.visa',$da);
            //   return $pdf->stream();
            Storage::disk('public')->put($path, $pdf->output());

            $cv = new CV;
            $cv->users_id = $user->id;
            $cv->type = 'visa';
            $cv->count = 39;
            $cv->status = 1;
            $cv->item = json_encode($request->item, JSON_UNESCAPED_UNICODE);
            $cv->dokumen = $path;
            $cv->save();

            Alert::success('success', 'Generate Successfully');
            return back()->with('visa', true);
        }

        if ($par == 'rekom') {
            $name = 'passport_' . $user->id . '_' . date('Ymd') . '.pdf';
            $dir = 'assets/dokumen/' . $user->id . '/';
            $path = $dir . $name;

            $da = compact('data', 'pile', 'item');
            $pdf = Pdf::loadView('pdf.rekom', $da);
            //   return view('pdf.rekom',$da);
            //   return $pdf->stream();
            Storage::disk('public')->put($path, $pdf->output());

            $cv = new CV;
            $cv->users_id = $user->id;
            $cv->type = 'passport';
            $cv->count = 1;
            $cv->status = 1;
            $cv->item = json_encode($request->item, JSON_UNESCAPED_UNICODE);
            $cv->dokumen = $path;
            $cv->save();

            Alert::success('success', 'Generate Successfully');
            return back()->with('passport', true);
        }

    }

    public function destroyDoc(Request $request, $id)
    {
        $coe = CV::where(DB::raw('md5(id)'), $id)->first();

        $par = $coe->type;

        if ($coe) {
            $coe->delete();
            Alert::success('success', 'Success Delete Data');
            return back()->with($par, true);
        } else {
            Alert::error('error', 'Invalid Data');
            return back()->with($par, true);
        }

    }

}
