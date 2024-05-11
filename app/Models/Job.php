<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Third;
use App\Models\Apply;
use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;


    public function getlpkAttribute()
    {                

       if($this->grant)
       {
           $val = json_decode($this->grant);
           foreach($val as $item)
           {
                if($item == '0')
                {
                     $name[] = env('APP_NAME');
                }

                $lpk = Third::where('id',$item)->first();
                if($lpk)
                {
                    $name []= $lpk->name;
                }
            }           
            return $name;
       } 
       else
       {
            return null;
       }
    }

    public function getlimitAttribute()
    {                

        $apply = Apply::where('jobs_id',$this->id)->count();
        if($apply < $this->kouta)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getgrantsAttribute()
    {
        $lpk = Third::where('users_id',Auth::user()->id)->first();

        if($this->grant)
        {
            $val = json_decode($this->grant);

            // if(in_array($val,$lpk->id))
            if(in_array($lpk->id,$val))
            {
                return true;
            }
            else
            {
                return false;
            } 
        } 
        else
        {
            return false;
        }
    }

    public function perusahaan()
    {
        return $this->hasOne(Company::class, 'id', 'company');   
    }

    public function come()
    {
        return $this->hasMany(Apply::class, 'jobs_id', 'id');   
    }
}
