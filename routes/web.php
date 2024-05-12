<?php

use Illuminate\Support\Facades\Route;

// $getHost = request()->getHost();

// if ($getHost != 'lintasnegeri.co.id') {
//     abort(404);
// }

// if ($getHost != 'psacareerjapan.co.id') {
//     abort(404);
// }

Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'sign'])->name('sign');
Route::get('/', [App\Http\Controllers\AuthController::class, 'login'])->name('home');
Route::get('/daftar', [App\Http\Controllers\AuthController::class, 'reg'])->name('daftar');
Route::post('/daftar', [App\Http\Controllers\AuthController::class, 'daftar'])->name('reg');
Route::get('/pendaftaran/{id}', [App\Http\Controllers\AuthController::class, 'pendaftaran'])->name('daftar.next');
Route::post('/pendaftaran/{id}', [App\Http\Controllers\AuthController::class, 'register'])->name('daftar.store');
Route::post('/pendaftaran-back/{id}', [App\Http\Controllers\AuthController::class, 'back'])->name('daftar.back');
Route::get('/verifikasi/{id}', [App\Http\Controllers\AuthController::class, 'ver'])->name('ver');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/forgot', [App\Http\Controllers\AuthController::class, 'forgot'])->name('forgot');
Route::get('/new-password/{id}', [App\Http\Controllers\AuthController::class, 'new'])->name('new');
Route::post('/new-password/{id}', [App\Http\Controllers\AuthController::class, 'reset'])->name('reset');
Route::post('/forget', [App\Http\Controllers\AuthController::class, 'forget'])->name('forget');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('log', App\Http\Controllers\LogController::class);
    Route::get('profile/{id}', [App\Http\Controllers\Participant::class, 'profile'])->name('profile.index');
    Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::get('profile-edit/', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('profile.edit');
    Route::post('profile-edit/{id}', [App\Http\Controllers\HomeController::class, 'storeProfile'])->name('profile.store');
    Route::get('download/{id}', [App\Http\Controllers\HomeController::class, 'download'])->name('download');
    Route::post('download/{par}/{pile}', [App\Http\Controllers\HomeController::class, 'report'])->name('report');
    Route::get('download/{par}/{pile}', [App\Http\Controllers\HomeController::class, 'report'])->name('report');

    // lpk
    Route::group(['prefix' => 'lpk'], function () {
        Route::get('log', [App\Http\Controllers\Lpk::class, 'log'])->name('log.lpk');
        Route::get('kelas', [App\Http\Controllers\Lpk::class, 'kelas'])->name('kelas.lpk');
        Route::get('pendaftaran-kelas', [App\Http\Controllers\Lpk::class, 'reg'])->name('reg.lpk');
        Route::get('pendaftaran/{id}', [App\Http\Controllers\Lpk::class, 'daftar'])->name('daftar.lpk');
        Route::post('pendaftaran/{id}/{user}', [App\Http\Controllers\Lpk::class, 'store'])->name('store.lpk');
        Route::get('detail/{id}', [App\Http\Controllers\Lpk::class, 'status'])->name('detail.lpk');
        Route::get('apply-job/{id}/{head}', [App\Http\Controllers\Lpk::class, 'apply'])->name('apply.lpk');
        Route::get('doc/{id}', [App\Http\Controllers\Lpk::class, 'doc'])->name('doc.lpk');
        Route::get('job/{id}', [App\Http\Controllers\Lpk::class, 'detail'])->name('detail.job.lpk');
        Route::post('cv-store/{id}', [App\Http\Controllers\Lpk::class, 'cvStore'])->name('cv.store.lpk');
        Route::post('generate-doc/{id}/{par}', [App\Http\Controllers\Lpk::class, 'generateDoc'])->name('doc.generate.lpk');
        Route::post('delete-doc/{id}', [App\Http\Controllers\Lpk::class, 'destroyDoc'])->name('doc.destroy.lpk');
    });

    Route::group(['prefix' => 'home'], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::post('account', [App\Http\Controllers\HomeController::class, 'account'])->name('account');
        Route::resource('user', App\Http\Controllers\UserController::class);
        Route::resource('class', App\Http\Controllers\KelasController::class);
        Route::get('kelas', [App\Http\Controllers\VerifController::class, 'verif'])->name('kelas.index');
        Route::post('kelas/{id}', [App\Http\Controllers\VerifController::class, 'verfied'])->name('kelas.update');
        Route::resource('third', App\Http\Controllers\ThirdController::class);
        Route::resource('student', App\Http\Controllers\StudentController::class);

        Route::get('/pendaftaran-lpk/{id}', [App\Http\Controllers\StudentController::class, 'pendaftaran'])->name('lpk.next');
        Route::get('/pendaftaran-edit/{id}', [App\Http\Controllers\StudentController::class, 'pendaftaranEdit'])->name('lpk.edit');
        Route::post('/pendaftaran-update/{id}', [App\Http\Controllers\StudentController::class, 'pendaftaranUpdate'])->name('lpk.update');
        Route::post('/pendaftaran-lpk/{id}', [App\Http\Controllers\StudentController::class, 'register'])->name('lpk.store');
        Route::post('/pendaftaran-lpk-back/{id}', [App\Http\Controllers\StudentController::class, 'back'])->name('lpk.back');

        Route::resource('material', App\Http\Controllers\MaterialController::class);
        Route::resource('nilai', App\Http\Controllers\NilaiController::class);
        Route::post('siswa', [App\Http\Controllers\NilaiController::class, 'siswa'])->name('siswa');
        Route::resource('exam', App\Http\Controllers\ExamController::class);
        Route::resource('payment', App\Http\Controllers\PaymentController::class);
        Route::resource('paid', App\Http\Controllers\HeadController::class);
        Route::post('paid-reject/{id}', [App\Http\Controllers\HeadController::class, 'reject'])->name('paid.reject');
        Route::resource('job', App\Http\Controllers\JobController::class);
        Route::post('grant-job/{job}', [App\Http\Controllers\JobController::class, 'grant'])->name('job.grant');

        Route::get('pekerjaan-verif', [App\Http\Controllers\JobController::class, 'verif'])->name('apply.index');
        Route::post('pekerjaan-approve/{id}', [App\Http\Controllers\JobController::class, 'verfied'])->name('apply.update');
        Route::post('pekerjaan-reject/{id}', [App\Http\Controllers\JobController::class, 'reject'])->name('apply.reject');
        Route::get('interview', [App\Http\Controllers\JobController::class, 'interview'])->name('interview.index');
        Route::get('preview/{id}/{par}', [App\Http\Controllers\JobController::class, 'preview'])->name('preview');
        Route::get('doc', [App\Http\Controllers\JobController::class, 'doc'])->name('doc');
        Route::get('company-job', [App\Http\Controllers\JobController::class, 'company'])->name('apply.company');
        Route::get('company-job-detail/{id}', [App\Http\Controllers\JobController::class, 'detail'])->name('apply.company.detail');
        Route::get('company-job-doc/{id}', [App\Http\Controllers\JobController::class, 'doc'])->name('apply.company.doc');

        Route::get('company-coe/{id}', [App\Http\Controllers\JobController::class, 'coe'])->name('company.coe');
        Route::post('company-coe/{id}', [App\Http\Controllers\JobController::class, 'generateCoe'])->name('company.coe.generate');
        Route::get('company-interview/{id}', [App\Http\Controllers\JobController::class, 'docInterview'])->name('company.interview');
        Route::post('delete-coe/{id}', [App\Http\Controllers\JobController::class, 'destroyCoe'])->name('coe.destroy');

        Route::get('apply-job/{id}', [App\Http\Controllers\JobController::class, 'apply'])->name('cv.edit');
        Route::post('apply-job/{id}', [App\Http\Controllers\JobController::class, 'cvStore'])->name('cv.store');
        Route::post('generate-doc/{id}', [App\Http\Controllers\JobController::class, 'generate'])->name('cv.generate');
        // coe
        Route::post('generate-doc/{id}/{par}', [App\Http\Controllers\JobController::class, 'generateDoc'])->name('doc.generate');
        Route::post('delete-doc/{id}', [App\Http\Controllers\JobController::class, 'destroyDoc'])->name('doc.destroy');
        Route::post('kontrak/{id}', [App\Http\Controllers\JobController::class, 'kontrak'])->name('job.kontrak');
        Route::post('kontrak-approve/{id}', [App\Http\Controllers\JobController::class, 'kontrakApprove'])->name('job.approve');
        Route::post('send-email/{job}', [App\Http\Controllers\JobController::class, 'sendEmail'])->name('job.send');

        Route::resource('company', App\Http\Controllers\CompanyController::class);

        // participant
        Route::post('dokumen-kontrak/{id}', [App\Http\Controllers\Participant::class, 'kontrak'])->name('kontrak.store');
        Route::get('pembayaran-pendidikan', [App\Http\Controllers\Participant::class, 'study'])->name('study');
        Route::post('pendaftaran-kelas/{id}', [App\Http\Controllers\Participant::class, 'store'])->name('daftar.store');
        Route::get('status/{id}', [App\Http\Controllers\Participant::class, 'daftar'])->name('daftar.index');
        Route::get('exam-participant', [App\Http\Controllers\Participant::class, 'exam'])->name('xam');
        Route::post('test/{id}', [App\Http\Controllers\Participant::class, 'test'])->name('test');
        Route::post('data/{id}', [App\Http\Controllers\Participant::class, 'data'])->name('data');
        Route::post('tested/{id}', [App\Http\Controllers\Participant::class, 'tested'])->name('tested');
        Route::get('testing/{id}', [App\Http\Controllers\Participant::class, 'testing'])->name('testing');
        Route::post('file-transfer/{id}', [App\Http\Controllers\Participant::class, 'pile'])->name('pile');
        Route::get('payment-participant', [App\Http\Controllers\Participant::class, 'payment'])->name('pay');
        Route::get('job-participant', [App\Http\Controllers\Participant::class, 'job'])->name('jobs');
        Route::get('apply-job/{id}/{head}', [App\Http\Controllers\Participant::class, 'apply'])->name('apply');
        Route::post('cv', [App\Http\Controllers\Participant::class, 'cv'])->name('cv');
    });
});
