<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Head extends Model
{
    use HasFactory, SoftDeletes;

    public function getregistrasiAttribute()
    {                
      $numb = str_pad($this->id, 3, "0", STR_PAD_LEFT);
      $month = date('m',strtotime($this->created_at));
      $year = date('y',strtotime($this->created_at));
      return 'REG'.$numb.''.$this->participant.''.$month.''.$year;
    }

    public function user()
    {
        return $this->HasOne(User::class, 'id', 'participant');
    }

    public function test()
    {
        return $this->HasOne(Test::class, 'head', 'id');
    }

    public function apply()
    {
        return $this->HasOne(Apply::class, 'head', 'id');
    }

    public function nilai()
    {
        return $this->HasOne(Nilai::class, 'head', 'id');
    }

    public function participants()
    {
        return $this->HasMany(Participant::class, 'head', 'id');
    }

    public function paid()
    {
        return $this->HasMany(Paid::class, 'head', 'id');
    }

    public function murid()
    {
        return $this->HasOne(Student::class, 'student', 'participant');        
    }
}
