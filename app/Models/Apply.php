<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Paid;

class Apply extends Model
{
    use HasFactory, SoftDeletes;

    public function getpayAttribute()
    {           
        $st = [];     
        $pay = Paid::where('head',$this->head)->get();
        foreach($pay as $item)
        {
            if($item->status == 1)
            {
                $st []= 1;
            }
            else
            {
                $st []= 0;
            }
        }

        return in_array(0,$st) ? false : true;
    
    }

    public function job()
    {
        return $this->hasOne(Job::class, 'id', 'jobs_id');   
    }

    public function heads()
    {
        return $this->belongsTo(Head::class, 'head', 'id');   
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');   
    }

    public function doc()
    {
        return $this->hasMany(CV::class, 'users_id', 'users_id');   
    }
}
