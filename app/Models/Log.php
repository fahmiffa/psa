<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Third;
use App\Models\Job;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users');   
    }

    // public function gettosAttribute()    
    // {
        
    //     if($this->type)
    //     {
    //         if($this->type == 'lpk')
    //         {
    //             $name = ' LPK Penyanggah '. Third::where('id',$this->par)->first()->name;
    //         }
    
    //         if($this->type == 'job')
    //         {
    //             $name = Job::where('id',$this->par)->first()->perusahaan->name;
    //         }
    
    //         if($this->type == 'payment')
    //         {
    //             $name = Payment::where('id',$this->par)->first()->name;
    //         }

    //         if($this->type == 'reg')
    //         {
    //             $name = null;
    //         }
            
    //         return $name ? ucfirst($name) : null;
    //     }
    //     else
    //     {
    //         $par = null;
    //     }

    //     return $par;

    // }
}
