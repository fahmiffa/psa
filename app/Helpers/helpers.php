<?php 

use App\Models\Participant;
use App\Models\Log;
use App\Models\Third;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

function dateID($par)
{
    $date = Carbon::parse($par);
    $date->setLocale('id');
    $indonesianDate = $date->isoFormat('LL'); 
    return $indonesianDate;
}

function Hari($tanggal) {
    $date = Carbon::parse($tanggal)->locale('id');
    $date->settings(['formatFunction' => 'translatedFormat']);    
    return $date->format('l, j F Y'); 
}

function usia($val)
{
    return $usia = Carbon::parse($val)->age;
}

function activity()
{ 
    $lpk = Third::where('users_id',Auth::user()->id)->first();
    if($lpk)
    {
        $log = Log::where('par',$lpk->id)
        ->where('type','lpk')                    
        ->where('status',0)
        ->count();
    
        return ($log > 0) ? true : false;
    }
    else
    {
        return false;
    }
}

function gambar($val)
{
    $imagePath = public_path($val); // Replace with your image path
    $imageData = Image::make($imagePath)->encode('data-url')->encoded;
    return $imageData;
}


function typePayment($par)
{
    if($par == 'lunas')
    {
        return 'Full Payment (Bayar Penuh)';
    }

    if($par == 'cicil')
    {
        return 'Installment (Bayar Cicil)';
    }

    if($par == 'dana_talang')
    {
        return 'Dana Talang';
    }
}

function typeRole($par)
{
    if($par == 'lpk')
    {
        return strtoupper($par);
    }
    else
    {
        return ucfirst($par);
    }  
}

function nameDoc($par)
{
    if($par == 2)
    {
        return  'KTP';
    }

    if($par == 3)
    {
        return  '1-3 (Riwayat Hidup)';
    }

    if($par == 4)
    {
        return  '1-28';
    }

    if($par == 5)
    {
        return  '1-10';
    }

    if($par == 9)
    {
        return  '1-27';
    }

    if($par == 7)
    {
        return  '1-20';
    }

    if($par == 8)
    {
        return  '1-21';
    }

    if($par == 10)
    {
        // return  '実習生との協定書';
        return  '1-13';
    }

    if($par == 11)
    {
        return '1-13';
    }

    if($par == 12)
    {
        return '1-29';
    }

    if($par == 13)
    {
        return '4-8';
    }


    if($par == 14)
    {
        return  '1-39';
    }

    if($par == 15)
    {
        return  '1-23';
    }

    
}

function typeReligion($par)
{
    if($par ==  1)
    {
        return 'Islam';
    }

    if($par ==  2)
    {
        return 'Kristen';
    }

    if($par ==  3)
    {
        return 'Hindu';
    }

    if($par ==  4)
    {
        return 'Buddha';
    }

    if($par ==  5)
    {
        return 'Konghucu';
    }

    if(!is_numeric($par))
    {
        return $par;
    }

   
}
