<?php

namespace App\Rules;

use App\Models\Participant;
use App\Models\Log;
use App\Models\Lpk;
use Auth;
use App\Models\Student;

class Status 
{
   public static function grade($head,$state,$status)
   {    
        $par = new Participant;
        $par->users_id = $head->participant; 
        $par->head = $head->id;
        $par->state = $state; 
        $par->status = $status;           
        $par->save();
   }

   public static function state($id, $state,$user)
   {   
        $auth = Auth::user()->role;

        $student = Student::where('student',$user)->first();    

        $payment = [1,7];

        if($id == 0)
        {
            return 'Peserta Baru';
        }

        if(in_array($id,$payment))
        {
            return 'Menunggu verifikasi '.$state;
        }

        // lintas negeri
        if($id == 2 && !$student)
        {
            return 'Mohon menunggu verifikasi kelas';
        }
        // lpk
        if($id == 2 && $student && $student->kelas == null)
        {
            return 'Mohon menunggu verifikasi kelas';
        }

        if($id == 2 && $student && $student->kelas)
        {
            return 'Anda Berada di kelas '.ucfirst($student->class->type);
        }

        if($id == 3)
        {
            return 'Silahkan Pilih Pekerjaan';
        }    

        if($id == 4)
        {
            return 'Mohon menunggu verifikasi Pekerjaan';
        }   
        
        if($id == 5)
        {
            return 'Silahkan Melakukan Interview';
        }   

        if($id == 6)
        {
            return 'Silahkan Melakukan Pembayaran';
        }   

        if($id == 8)
        {
            return 'Anda Berada di kelas pemantapan';
        }   

        if($id == 9)
        {                 
            return 'Silahkan Melakukan pengurusan dokumen Kontrak';
        }   

        if($id == 10)
        {
            return 'Mohon menunggu verifikasi Kontrak';
        }   
   

        if($id == 11)
        {  
            return 'Silahkan Melakukan Pembayaran Keberangkatan';
        }   

        if($id == 12)
        {
            return 'Mohon menunggu verifikasi Keberangkatan';
        }   

        if($id == 13)
        {
            return 'Anda dalam karantina';
        }  
        
        if($id == 14)
        {
            return 'Anda Beragkat Ke jepang';
        }  
   

   }

   public static function log($logs,$par=null,$type=null)
   {
        $log            = New Log;
        $log->users     = Auth::user()->id;
        $log->activity  = $logs;
        $log->par       = $par;
        $log->type      = $type;
        $log->save();
   }

  public static function gambar($val)
  {
        $imagePath = public_path($val); // Replace with your image path
        $imageData = Image::make($imagePath)->encode('data-url')->encoded;
        return $imageData;
  }

  public static function lpk($lpk,$val,$state,$set)
  {
        $par = new Lpk;
        $par->users_id = Auth::user()->id;
        $par->lpk = $lpk; 
        $par->state = $state; 
        $par->par  = $set;
        $par->val  = $val;
        $par->status = 0;           
        $par->save();
  }

}
