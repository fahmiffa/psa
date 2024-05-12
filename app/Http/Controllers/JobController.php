<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Participant;
use App\Models\Apply;
use App\Models\Coe;
use App\Models\Company;
use App\Models\CV;
use App\Models\Data;
use App\Models\Dataj;
use App\Models\Files;
use App\Models\Head;
use App\Models\Job;
use App\Models\Log;
use App\Models\Third;
use App\Models\User;
use App\Rules\Status;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mail;
use PDF;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('IsPermission:job');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $job = Job::all();
        $data = 'Data Pekerjaan';
        return view('job.index', compact('data', 'job'));
    }

    public function verif()
    {
        $da = Apply::latest()->get();
        $data = 'Verifikasi Pekerjaan';
        return view('job.verif', compact('data', 'da'));
    }

    public function company()
    {
        $job = Job::whereHas('come', function ($q) {
            $q->where('status', 3);
        })->get();

        $data = 'Job Management';
        return view('job.company', compact('data', 'job'));
    }

    public function detail($id)
    {
        $job = Job::where(DB::raw('md5(id)'), $id)->first();
        $data = $job->perusahaan->name;
        $log = Log::where('type', 'job')->where('par', $job->id)->latest()->get();
        return view('job.detail', compact('data', 'job', 'log'));
    }

    public function interview()
    {
        $da = Apply::withTrashed()->get();
        $data = 'Interview';
        return view('job.interview', compact('data', 'da'));
    }

    public function doc($id)
    {
        $head = Head::where(DB::raw('md5(participant)'), $id)->whereIn('status', [5, 4, 3, 2])->latest()->first();
        $apply = Apply::where(DB::raw('md5(users_id)'), $id)->where('status', 3)->first();
        $data = Data::where(DB::raw('md5(users_id)'), $id)->first();
        $dataj = DataJ::where(DB::raw('md5(users_id)'), $id)->first();
        $pile = Files::where(DB::raw('md5(users_id)'), $id)->first();
        $cv = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'cv')->first();
        $coe = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'coe')->where('status', 1)->first();
        $coed = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'coe')->where('status', 2)->pluck('doc')->toArray();
        $dcoe = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'coe')->where('status', 2)->get();

        $vis = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'visa')->where('status', 1)->first();
        $passport = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'passport')->where('status', 1)->first();
        $go = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'pemberangkatan')->where('status', 1)->first();

        if ($dataj) {
            $da = $data;
            return view('user.apply', compact('da', 'dataj', 'apply', 'cv', 'data', 'coe', 'coed', 'dcoe', 'head', 'vis', 'passport', 'pile', 'go'));
        }

        if ($data) {
            $da = $data;
            return view('user.apply', compact('da', 'data', 'coed', 'dcoe', 'apply', 'head', 'cv', 'vis', 'passport', 'pile', 'go'));
        } else {
            Alert::error('error', 'Invalid Data');
            return back();
        }
    }

    public function kontrak(Request $request, $id)
    {
        $rule = [
            'file' => 'required|file|mimes:pdf|max:2048',
        ];
        $message = [
            'required' => 'File Transfer required',
            'mimes' => 'Extension File invalid',
            'max' => 'File size max 2Mb',
        ];

        $request->validate($rule, $message);

        $job = Job::where(DB::raw('md5(id)'), $id)->first();

        $path = 'assets/kontrak';
        $path = Storage::disk('public')->put($path, $request->file('file'));

        foreach ($job->come->whereNull('kontrak')->values() as $value) {
            $apply = Apply::where('id', $value->id)->where('status', 3)->whereNull('kontrak')->first();
            if ($apply) {
                $head = Head::where('id', $apply->head)->first();
                if ($head) {
                    $st = $apply->user->stat;
                    $var = $st + 1;
                    Status::grade($head, 'Kontrak ' . $apply->job->perusahaan->name, $var);
                    Status::log('Kontrak ' . $apply->user->name . ' di ' . $apply->job->perusahaan->name, $apply->job->id, 'job');

                    if ($head) {
                        $head->status = 2;
                        $head->save();
                    }

                    $apply->kontrak = $path;
                    $apply->save();
                } else {
                    Alert::error('Error', 'Invalid Data');
                    return back();
                }
            } else {
                Alert::error('Error', 'Invalid Data');
                return back();
            }
        }

        Alert::success('success', 'Upload Kontrak success');
        return back();
    }

    public function kontrakApprove(Request $request, $id)
    {
        $head = Head::where(DB::raw('md5(id)'), $id)->first();
        if ($head->status == 2 && $head->apply->spk != null) {
            $st = $head->user->stat;
            $var = ($head->murid->lpk) ? 13 : $st + 1;

            Status::grade($head, 'Menerima Kontrak ' . $head->apply->job->perusahaan->name, $var);
            Status::log('Menerima Kontrak ' . $head->user->name . ' di ' . $head->apply->job->perusahaan->name, $head->apply->job->id, 'job');

            $head->work = 1;
            $head->status = 1;
            $head->save();
            Alert::success('success', 'Approve success');
        } 
        else if($head->status == 1)
        {
            $var = $head->user->stat + 1;

            $head->japan = $request->date;
            $head->save();

            Status::grade($head, 'Peserta ' . $head->user->name.' Berangkat ke Japan', $var);
            Status::log('Berangkat ke japan, Peserta ' . $head->user->name . ' di ' . $head->apply->job->perusahaan->name, $head->apply->job->id, 'go');
            Alert::success('success', 'Go To Japan success');
        }
        else {
            Alert::error('error', 'Dokumen Kontrak tidak Tersedia');
        }
        return back();
    }

    public function verfied(Request $request, $id)
    {
        $apply = Apply::where(DB::raw('md5(id)'), $id)->first();

        if ($apply) {
            $user = User::where('id', $apply->users_id)->first();
            $st = $user->stat;
            $var = $st + 1;

            $head = Head::where('id', $apply->head)->first();

            if ($st == 4) {
                $head->job = 1;
                $head->status = 3;
                $head->save();

                $apply->status = 1;
                $apply->interview = $request->date;
                $apply->save();
                Status::grade($head, 'Interview ' . $apply->job->perusahaan->name, $var);
                Status::log('Interview ' . $user->name . ' di ' . $apply->job->perusahaan->name);
            }

            if ($st == 5) {

                $apply->status = 3;
                $apply->save();
                Status::grade($head, 'Menerima Interview ' . $apply->job->perusahaan->name, $var);
                Status::log('Menerima ' . $user->name . ' di ' . $apply->job->perusahaan->name);
            }

            Alert::success('success', 'Update Successfully');
        } else {
            Alert::error('error', 'Invalid Data');
        }
        return back();
    }

    public function reject(Request $request, $id)
    {
        $apply = Apply::where(DB::raw('md5(id)'), $id)->first();

        if ($apply) {
            $user = User::where('id', $apply->users_id)->first();
            $st = $user->stat;
            $var = $st + 1;
            $head = Head::where('id', $apply->head)->first();
            $head->job = null;
            $head->save();

            $apply->status = 2;
            $apply->note = $request->ket;
            $apply->save();

            if ($st == 4) {
                Status::grade($head, 'Verfikasi Ditolak cv', 3);
                Status::log('Verfikasi Ditolak cv' . $user->name . ' di ' . $apply->job->perusahaan->name);
            }

            if ($st == 5) {
                Status::grade($head, 'Verfikasi Ditolak interview', 3);
                Status::log('Verfikasi Ditolak interview' . $user->name . ' di ' . $apply->job->perusahaan->name);
            }

            $apply->delete();
            Alert::success('success', 'Update Successfully');
        } else {
            Alert::error('error', 'Invalid Data');
        }
        return back();
    }

    public function apply($id)
    {
        $apply = Apply::where(DB::raw('md5(id)'), $id)->first();
        $da = $apply->user->data;

        return view('user.apply', compact('da', 'apply'));
    }

    public function generateCoe(Request $request, $id)
    {
        $job = Job::where(DB::raw('md5(id)'), $id)->first();
        $be = Coe::where(DB::raw('md5(id)'), $id)->where('status', 0)->first();

        if ($be) {
            $items = $request->item;
            $date = $request->date;
            $bot = $request->bot;
            $apply = Apply::where('jobs_id', $be->job)->get();
            $name = 'Dokumen COE ' . nameDoc($be->doc);

            $name = 'doc_' . nameDoc($be->doc) . '_' . $be->users_id . '_' . date('Ymd') . '.pdf';
            $dir = 'assets/data/' . $be->users_id . '/';
            $path = $dir . $name;

            $da = compact('name', 'job', 'items', 'be', 'apply', 'date', 'bot');
            if ($be->doc == 4) {
                $pdf = Pdf::loadView('pdf.4', $da)->setPaper('a4', 'potrait');
            }

            if ($be->doc == 5) {
                $pdf = Pdf::loadView('pdf.5', $da)->setPaper('a4', 'potrait');
            }

            if ($be->doc == 13) {
                $pdf = Pdf::loadView('pdf.13', $da)->setPaper('a4', 'potrait');
            }
            Storage::disk('public')->put($path, $pdf->output());
            // return view('pdf.4',$da);
            // return $pdf->stream();

            $be->dokumen = $path;
            $be->status = 1;
            $be->save();
            return back();

        } else {
            $coe = new Coe;
            $coe->head = 1;
            $coe->job = $job->come[0]->jobs_id;
            $coe->users_id = Auth::user()->id;
            $coe->doc = $request->doc;
            $coe->save();
            return back();
        }

    }

    public function coe($id)
    {
        $job = Job::where(DB::raw('md5(id)'), $id)->first();
        $be = Coe::where('status', 0)->first();
        $coe = Coe::where(DB::raw('md5(job)'), $id)->pluck('doc')->toArray();

        if ($be) {
            return view('job.company.coe', compact('job', 'coe', 'be'));
        } else {
            $doc = Coe::where(DB::raw('md5(job)'), $id)->get();
            return view('job.company.coe', compact('job', 'coe', 'be', 'doc'));
        }

    }

    public function destroyCoe(Request $request, $id)
    {
        $coe = Coe::where(DB::raw('md5(id)'), $id)->first();

        if ($coe) {
            $coe->delete();
            Alert::success('success', 'Success Delete Data');
            return back();
        } else {
            Alert::error('error', 'Invalid Data');
            return back();
        }

    }

    public function docInterview($id)
    {
        $job = Job::where(DB::raw('md5(id)'), $id)->first();
        foreach ($job->come as $item) {
            if ($item->user->dataj == null) {
                Alert::warning('Warning', 'Data cv siswa belum di generate to japan');
                return back();
            }
        }
        $name = 'Dokumen Interview';
        $da = compact('name', 'job');
        $pdf = Pdf::loadView('pdf.interview.index', $da)->setPaper('a4', 'landscape');
        return $pdf->stream();
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

        $data->family = json_encode($val, JSON_UNESCAPED_UNICODE);
        $data->study = json_encode([$request->study], JSON_UNESCAPED_UNICODE);
        $data->job = json_encode([$request->job], JSON_UNESCAPED_UNICODE);
        $data->job_des = $request->job_des;
        $data->magang = json_encode([$request->magang], JSON_UNESCAPED_UNICODE);
        $data->magang_des = $request->magang_des;
        $data->lisensi = json_encode([$request->lisensi], JSON_UNESCAPED_UNICODE);
        $data->me = $request->me;
        $data->save();
        Alert::success('success', 'Update Successfully');

        // generate pdf cv
        $name = 'CV' . $user->id . '' . date('Ymd') . '.pdf';
        $dir = 'assets/data/' . $user->id . '/';
        $path = $dir . $name;

        $doc = false;
        $data = $data;

        $da = compact('data', 'name', 'doc', 'pile');
        $pdf = Pdf::loadView('pdf.cv', $da);
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
        $cv = CV::where(DB::raw('md5(users_id)'), $id)->where('type', 'coe')->first();
        $coe = CV::where(DB::raw('md5(id)'), $id)->first();
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
            $apply = Apply::where(DB::raw('md5(users_id)'), $id)->first();
            $name = 'passport_' . $user->id . '_' . time() . '.pdf';
            $dir = 'assets/data/' . $user->id . '/';
            $path = $dir . $name;

            $da = compact('data', 'pile', 'item', 'apply');
            $pdf = Pdf::loadView('pdf.rekom', $da);
            //   return view('pdf.visa',$da);
            // return $pdf->stream();
            Storage::disk('public')->put($path, $pdf->output());

            $cv = new CV;
            $cv->users_id = $user->id;

            $cv->type = ($par == 'rekom') ? 'passport' : 'pemberangkatan';
            $cv->count = 1;
            $cv->status = 1;
            $cv->item = json_encode($request->item, JSON_UNESCAPED_UNICODE);
            $cv->dokumen = $path;
            $cv->save();

            Alert::success('success', 'Generate Successfully');
            return back()->with('passport', true);
        }

        if ($par == 'rekomp') {
            $apply = Apply::where(DB::raw('md5(users_id)'), $id)->first();
            $name = 'pemberangkatan_' . $user->id . '_' . time() . '.pdf';
            $dir = 'assets/data/' . $user->id . '/';
            $path = $dir . $name;

            $da = compact('data', 'pile', 'item', 'apply');
            $pdf = Pdf::loadView('pdf.rekomp', $da);
            //   return view('pdf.visa',$da);
            //   return $pdf->stream();
            Storage::disk('public')->put($path, $pdf->output());

            $cv = new CV;
            $cv->users_id = $user->id;

            $cv->type = ($par == 'rekom') ? 'passport' : 'pemberangkatan';
            $cv->count = 1;
            $cv->status = 1;
            $cv->item = json_encode($request->item, JSON_UNESCAPED_UNICODE);
            $cv->dokumen = $path;
            $cv->save();

            Alert::success('success', 'Generate Successfully');
            return back()->with('pemberangkatan', true);
        }

        if ($coe) {

            $name = 'doc_' . nameDoc($coe->doc) . '_' . $coe->users_id . '_' . date('Ymd') . '.pdf';
            $dir = 'assets/data/' . $coe->users_id . '/';
            $path = $dir . $name;

            $job = $request->job;
            $first = $request->first;
            $end = $request->end;
            $var = $request->var;

            $da = compact('item', 'name', 'coe', 'job', 'end', 'var', 'first');
            $view = 'pdf.' . $coe->doc;
            $pdf = Pdf::loadView($view, $da);
            Storage::disk('public')->put($path, $pdf->output());
            // return view($view,$da);
            //  return $pdf->stream();

            $coe->item = json_encode($request->item, JSON_UNESCAPED_UNICODE);
            $coe->status = 2;
            $coe->dokumen = $path;
            $coe->save();

            return back()->with('coe', true);

        } else {
            $user = User::where(DB::raw('md5(id)'), $id)->first();
            if ($user) {
                $cv = new CV;
                $cv->users_id = $user->id;
                $cv->type = 'coe';
                $cv->status = 1;
                if ($request->doc == 2) {
                    $cv->count = 9;
                }

                if ($request->doc == 3) {
                    $cv->count = 10;
                }

                if ($request->doc == 4) {
                    $cv->count = 4;
                }

                if ($request->doc == 5) {
                    $cv->count = 2;
                }

                if ($request->doc == 7) {
                    $cv->count = 6;
                }

                if ($request->doc == 8) {
                    $cv->count = 6;
                }

                if ($request->doc == 9) {
                    $cv->count = 2;
                }

                if ($request->doc == 10) {
                    $cv->count = 13;
                }

                if ($request->doc == 11) {
                    $cv->count = 1;
                }

                if ($request->doc == 12) {
                    $cv->count = 4;
                }

                if ($request->doc == 13) {
                    $cv->count = 2;
                }

                if ($request->doc == 14) {
                    $cv->count = 3;
                }

                if ($request->doc == 15) {
                    $cv->count = 8;
                }

                $cv->doc = $request->doc;
                $cv->save();
            }

            return back()->with('coe', true);
        }

    }

    public function destroyDoc(Request $request, $id)
    {
        $coe = CV::where(DB::raw('md5(id)'), $id)->first();

        $par = $coe->type;

        if ($coe) {
            $coe->delete();
            Alert::success('success', 'Success Delete Data');
            return back();
        } else {
            Alert::error('error', 'Invalid Data');
            return back()->with($par, true);
        }

    }

    private function viewCoe($id, $request)
    {
        $user = User::where(DB::raw('md5(id)'), $id)->first();
        $apply = Apply::where(DB::raw('md5(users_id)'), $id)->where('status', 1)->first();
        $user = User::where(DB::raw('md5(id)'), $id)->first();
        // $data    = Data::where(DB::raw('md5(users_id)'),$id)->first();
        $data = DataJ::where(DB::raw('md5(users_id)'), $id)->first();
        $pile = Files::where(DB::raw('md5(users_id)'), $id)->first();
        $cv = CV::where(DB::raw('md5(users_id)'), $id)->first();

        $name = 'doc2' . $user->id . '' . date('Ymd') . '.pdf';
        $da = compact('data', 'name', 'pile');
        $pdf = Pdf::loadView('pdf.2', $da);
        // Storage::disk('public')->put($path, $pdf->output());
        // return $pdf->stream();

        $type = $request->doc;
        $n = 1;
        return view('job.coe', compact('n', 'type'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = Company::all();
        $data = 'Create job';
        return view('job.create', compact('data', 'company'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rule = [
            'company' => 'required',
            'section' => 'required',
            'addr' => 'required',
            'salary' => 'required',
            'kouta' => 'required',
            'note' => 'required',
            'open' => 'required',
            'close' => 'required',
            'interview' => 'required',
            'interview_date' => 'required',
            'pic_name' => 'required',
            'pic_email' => 'required',
            'pic_phone' => 'required',
            'agency_name' => 'required',
            'agency_email' => 'required',
            'agency_phone' => 'required',
            'work_start' => 'required',
            'work_end' => 'required',
        ];

        $message = ['required' => 'Field ini harus disi'];

        $request->validate($rule, $message);

        $price = str_replace(['.'], null, $request->salary);

        $job = new Job;
        $job->section = $request->section;
        $job->status = 0;
        $job->interview = $request->interview;
        $job->interview_date = $request->interview_date;
        $job->address = $request->addr;
        $job->kouta = $request->kouta;
        $job->salary = $price;
        $job->open = $request->open;
        $job->close = $request->close;
        $job->company = $request->company;
        $job->note = $request->note;
        $job->pic_name = $request->pic_name;
        $job->pic_email = $request->pic_email;
        $job->pic_phone = $request->pic_phone;
        $job->agency_name = $request->agency_name;
        $job->agency_email = $request->agency_email;
        $job->agency_phone = $request->agency_phone;
        $job->work_start = $request->work_start;
        $job->work_end = $request->work_end;
        $job->save();

        Status::log('Submit Pekerjaan', $job->id, 'job');

        Alert::success('success', 'Insert Successfully');
        return redirect()->route('job.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $lpk = Third::all();
        $data = 'Data Pekerjaan ' . $job->perusahaan->name;
        return view('job.show', compact('data', 'job', 'lpk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        $company = Company::all();
        $data = 'Edit Pekerjaan ' . $job->perusahaan->name;
        return view('job.create', compact('data', 'job', 'company'));
    }

    public function sendEmail(Request $request, Job $job)
    {

        foreach ($job->come as $item) {

            $ready[] = ($item->heads->status == 1) ? 1 : 0;
            $data["email"] = $job->perusahaan->email;
            $data["title"] = "From Lintas-negeri.com";
            $data["body"] = "This Apply Job";

            $files[] = asset('storage/' . $item->kontrak);
            // $files[] =  public_path('storage/'.$item->kontrak);

            //coe
            foreach ($item->doc as $val) {
                if ($val->type == 'coe') {
                    $files[] = asset('storage/' . $val->dokumen);
                    // $files[] = public_path('storage/'.$val->dokumen);
                }
            }

        }

        if (in_array(0, $ready)) {
            Alert::error('Error', 'Pendaftaran Belum Lengkap');
        } else {

            Mail::send('attach', $data, function ($message) use ($data, $files) {
                $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);

                foreach ($files as $file) {
                    $message->attach($file);
                }

            });

            Alert::success('success', 'Send Successfully');
        }

        return back();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        $rule = [
            'company' => 'required',
            'section' => 'required',
            'addr' => 'required',
            'salary' => 'required',
            'kouta' => 'required',
            'note' => 'required',
            'open' => 'required',
            'close' => 'required',
            'interview' => 'required',
            'interview_date' => 'required',
            'pic_name' => 'required',
            'pic_email' => 'required',
            'pic_phone' => 'required',
            'agency_name' => 'required',
            'agency_email' => 'required',
            'agency_phone' => 'required',
            'work_start' => 'required',
            'work_end' => 'required',
        ];

        $message = ['required' => 'Field ini harus disi'];

        $price = str_replace(['.'], null, $request->salary);

        $job->section = $request->section;
        $job->interview = $request->interview;
        $job->interview_date = $request->interview_date;
        $job->address = $request->addr;
        $job->kouta = $request->kouta;
        $job->salary = $price;
        $job->open = $request->open;
        $job->close = $request->close;
        $job->company = $request->company;
        $job->note = $request->note;
        $job->pic_name = $request->pic_name;
        $job->pic_email = $request->pic_email;
        $job->pic_phone = $request->pic_phone;
        $job->agency_name = $request->agency_name;
        $job->agency_email = $request->agency_email;
        $job->agency_phone = $request->agency_phone;
        $job->work_start = $request->work_start;
        $job->work_end = $request->work_end;
        $job->save();

        Alert::success('success', 'Update Successfully');
        return redirect()->route('job.index');
    }

    public function grant(Request $request, Job $job)
    {

        $grant = $request->has('grant');
        $grantTo = $request->grantTo;
        $job->status = ($grant) ? 1 : 0;
        $job->grant = ($grantTo) ? json_encode($grantTo) : null;

        if ($grant) {
            Status::log('Grant active Job', $job->id, 'job');

            if ($grantTo) {
                for ($i = 0; $i < count($grantTo); $i++) {
                    if ($grantTo[$i] == 0) {
                        $job->self = 1;
                    }
                    Status::log('Job ' . $job->perusahaan->name, $grantTo[$i], 'lpk');

                }
            }
        } else {
            Status::log('Grant inactive Job', $job->id, 'job');
        }

        $job->save();

        Alert::success('success', 'Grant Acces Successfully');
        return redirect()->route('job.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(job $job)
    {
        foreach ($job->come as $val) {

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

        $job->delete();
        Alert::success('success', 'Delete Successfully');
        return back();
    }
}
