<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Apply;
use App\Models\CV;
use App\Models\Data;
use App\Models\Exam;
use App\Models\Head;
use App\Models\Job;
use App\Models\Kelas;
use App\Models\Paid;
use App\Models\Participant as Par;
use App\Models\Payment;
use App\Models\Question;
use App\Models\Student;
use App\Models\Test;
use App\Models\User;
use App\Rules\Status;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class Participant extends Controller
{
    public function __construct()
    {
        $this->middleware('IsRole:peserta');
    }

    public function study()
    {
        $head = Head::where('participant', Auth::user()->id)->where('status', '!=', 1)->first();
        if ($head) {
            return redirect()->route('daftar.index', ['id' => md5($head->id)]);
        } else {
            $payment = Payment::first();
            if (!$payment) {
                Alert::error('info', 'Pembayaran Belum Di setting');
                return back();
            }
            $kelas = Kelas::where('name', 'Online Class')->first();
            $class = Kelas::all();
            $da = Payment::all();
            $paymentStudy = Payment::first();
            $paymentDoc = Payment::where('id', 2)->first();
            $paymentJob = Payment::where('id', 3)->first();
            $exam = Exam::first();
            $data = 'Pembayaran Pendidikan';
            return view('participant.index', compact('data', 'class', 'kelas', 'da', 'head', 'payment', 'paymentStudy'));

        }
    }

    public function profile($id)
    {
        $user = User::where(DB::raw('md5(id)'), $id)->first();
        $da = Data::where(DB::raw('md5(users_id)'), $id)->latest()->first();
        $data = 'Profile ' . $user->name;
        return view('self', compact('user', 'da', 'data'));
    }

    public function daftar($id)
    {
        $users = Auth::user()->id;
        $head = Head::where('participant', $users)->whereNotIn('status', [0, 1])->first();
        $student = Student::where('student', $users)->latest()->first();

        $apply = Apply::where('users_id', $users)->latest()->first();
        $da = Payment::all();
        $exam = Exam::first();
        $job = Job::where('status', 1)->where('self', 1)->get();
        $st = (int) Auth::user()->stat;

        $paymentStudy = Payment::first();
        $paymentDoc = Payment::where('id', 2)->first();
        $paymentJob = Payment::where('id', 3)->first();
        $data = 'Status';
        return view('participant.index', compact('data', 'paymentDoc', 'paymentStudy', 'paymentJob', 'head', 'da', 'exam', 'job', 'apply', 'student'));

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

        $apply = Apply::where(DB::raw('md5(id)'), $id)->first();

        if ($apply) {
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
            return back();
        } else {
            Alert::error('info', 'invalid Data');
            return back();
        }

    }

    public function store(Request $request, $id)
    {
        $users = Auth::user()->id;
        $head = Head::where('participant', $users)->whereNotIn('status', [0, 1])->first();
        $cv = Cv::where('users_id', Auth::user()->id)->first();

        $payment = Payment::where(DB::raw('md5(id)'), $id)->first();

        $class = Kelas::where(DB::raw('md5(id)'), $id)->first();
        $exam = Exam::where(DB::raw('md5(id)'), $id)->first();
        $job = Job::where(DB::raw('md5(id)'), $id)->first();
        $st = (int) Auth::user()->stat;
        $var = $st + 1;

        if ($head) {
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
                $apply->users_id = $users;

                $vid = $request->file('vid');
                $ext = $vid->getClientOriginalExtension();
                $path = $vid->storeAs(
                    'assets/data/' . $users, $users . '_video.' . $ext, ['disk' => 'public']
                );
                $apply->video = $path;
                $apply->status = 0;
                $apply->save();

                Status::grade($head, 'Apply Job', $var);
                Status::log('Apply Job ' . $job->name, $job->id, 'job');
                return redirect()->route('daftar.index', ['id' => md5($head->id)]);

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

                return redirect()->route('daftar.index', ['id' => md5($head->id)]);

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

                return redirect()->route('daftar.index', ['id' => md5($head->id)]);
            } else {
                Alert::error('info', 'invalid Data');
                return back();
            }

        } else {
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

            $head = new Head;
            $head->participant = Auth::user()->id;
            $head->status = 5;
            $head->save();

            $paid = new Paid;
            $paid->head = $head->id;
            $paid->user = $head->participant;
            $paid->par = $payment->id;
            $paid->img = $piles;
            $paid->save();

            Status::grade($head, 'Pembayaran ' . $payment->name, $var);
            Status::log('Pembayaran ' . $payment->name, $payment->id, 'payment');

            return redirect()->route('daftar.index', ['id' => md5($head->id)]);
        }

    }

    private function step($request, $id)
    {
        $class = Kelas::where(DB::raw('md5(id)'), $id)->first();
        if ($class) {
            $st = Auth::user()->stat;
            $pile = $request->file('file');
            $piles = 'tf_' . time() . '.' . $pile->getClientOriginalExtension();
            $destinationPath = public_path('assets/image');
            $pile->move($destinationPath, $piles);

            $head = new Head;
            $head->participant = Auth::user()->id;
            $head->status = 4;
            $head->save();

            $paid = new Paid;
            $paid->head = $head->id;
            $paid->user = $head->participant;
            $paid->par = $class->id;
            $paid->img = $piles;
            $paid->save();

            $var = $st + 1;
            Status::grade($head, $class->name, $var);

            Alert::success('success', 'Upload Successfully');
            return redirect()->route('daftar.index', ['id' => md5($head->id)]);
        } else {
            Alert::error('info', 'invalid Request');
        }

    }

    public function apply($id, $head)
    {
        $cv = Cv::where('users_id', Auth::user()->id)->first();
        $head = Head::where(DB::raw('md5(id)'), $head)->first();
        $job = Job::where(DB::raw('md5(id)'), $id)->first();
        $data = 'Pendaftaran di ' . $job->perusahaan->name;
        return view('participant.apply', compact('data', 'head', 'job', 'cv'));
    }

    public function cv(Request $request)
    {
        $user = Auth::user()->id;
        $data = Data::where('users_id', $user)->latest()->first();
        $name = 'CV' . $user . '' . date('Ymd') . '.pdf';
        $path = 'assets/cv/' . $name;
        $cv = new CV;
        $cv->users_id = $user;
        $cv->pdf = $path;
        $cv->save();

        Status::log('Generate CV');

        $doc = false;
        $da = compact('data', 'name', 'doc');
        $pdf = Pdf::loadView('participant.doc', $da);
        // $pdf->save(public_path($path));
        return back();
        // return $pdf->stream();
        // return view('participant.doc',$da);
    }

    public function payment()
    {
        $data = 'Payment List';
        $da = Paid::where('user', Auth::user()->id)->get();
        return view('user.payment.index', compact('da', 'data'));
    }

    public function job()
    {
        $users = Auth::user()->id;
        $da = Apply::where('users_id', $users)->get();
        $data = 'Job List';
        return view('user.job.index', compact('da', 'data'));
    }

    public function exam()
    {
        $test = Test::where('users_id', Auth::user()->id)->where('status', 0)->first();
        if ($test) {
            return redirect()->route('testing', ['id' => md5($test->id)]);
        } else {
            $stat = Auth::user()->stat;
            $exam = Exam::first();
            $data = 'Exam';
            $da = Test::where('users_id', Auth::user()->id)->get();
            return view('user.exam.index', compact('da', 'data', 'exam'));
        }

    }

    public function testing($id)
    {
        $test = Test::where(DB::raw('md5(id)'), $id)->first();
        $data = 'Test ' . $test->exam->kelas->name;
        return view('user.exam.test', compact('test', 'data'));
    }

    public function test(Request $request, $id)
    {
        $exam = Exam::where(DB::raw('md5(id)'), $id)->first();

        if ($exam) {
            $test = new Test;
            $test->users_id = Auth::user()->id;
            $test->exams_id = $exam->id;
            $test->start = date('Y-m-d H:i:s');
            $test->save();

            Status::grade($test->users_id, 'Exam start', 4);
            return redirect()->route('testing', ['id' => md5($test->id)]);
        } else {
            Alert::error('info', 'invalid Request');
            return back();
        }

    }

    public function tested(Request $request, $id)
    {
        $test = Test::where(DB::raw('md5(id)'), $id)->first();

        if ($test) {
            $point = 0;
            $q = $request->input('q');
            foreach ($q as $key => $item) {
                $cc = Question::where('id', $key)->where('key', $item)->exists();
                if ($cc) {
                    $point += 1;
                }
            }

            $test->val = $point;
            $test->log = json_encode($q);
            $test->end = date('Y-m-d H:i:s');
            $test->status = 1;
            $test->save();

            Status::grade($test->users_id, 'Exam Tested', 5);

            return redirect()->route('xam');
        } else {
            Alert::error('info', 'invalid Request');
            return back();
        }

    }

    public function data(Request $request, $id)
    {

        $rule = [
            'alamat' => 'required',
            'place_birth' => 'required',
            'date_birth' => 'required',
            'date_birth' => 'required',
            'date_birth' => 'required',
            'date_birth' => 'required',
        ];

        $request->validate($rule);

        $head = Head::where(DB::raw('md5(id)'), $id)->first();

        if ($head) {
            $data = new Data;
            $data->users_id = $head->participant;
            $data->alamat = $request->alamat;
            $data->gender = $request->gender;
            $data->place_birth = $request->place_birth;
            $data->date_birth = $request->date_birth;
            $data->married = $request->married;
            $data->religion = $request->religion;
            $data->tall = $request->tall;
            $data->weight = $request->weight;
            $data->blood = $request->blood;
            $data->hobbies = $request->hobbies;
            $data->dad = json_encode([$request->dad, $request->ageDad]);
            $data->mom = json_encode([$request->mom, $request->ageMom]);
            $data->sis = json_encode([$request->sis, $request->ageSis]);
            $data->bro = json_encode([$request->bro, $request->ageBro]);

            if (count($request->job) > 0) {
                $job = $request->job;
                $period = $request->jobPeriod;
                $var = $request->var;

                for ($i = 0; $i < count($job); $i++) {
                    if ($job[$i] != null) {
                        $jobs = [$job[$i], $period[$i], $var[$i]];
                    }
                }

                $data->job = json_encode($jobs);
            }

            if (count($request->studied) > 0) {
                $study = $request->studied;
                $perioded = $request->perioded;

                for ($i = 0; $i < count($study); $i++) {
                    if ($study[$i] != null) {
                        $studied = [$study[$i], $perioded[$i]];
                    }
                }

                $data->study = json_encode($studied);
            }
            $data->save();

            Status::grade($head, 'Inserted Indentity', 3);
            Alert::success('info', 'insert Fill Data Success');
            return back();
        } else {
            Alert::error('info', 'invalid Request');
            return back();
        }

    }
}
