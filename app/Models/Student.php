<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;

    public function getfromAttribute()
    {                
        $lpk = $this->penyanggah()->first();
        $numb = str_pad($this->id, 3, "0", STR_PAD_LEFT);

        if($lpk)
        {
            return $lpk->kode.''.$numb;
        }
        else
        {
            return 'LN'.$numb;
        }
    }

    public function third()
    {
        return $this->HasOne(User::class, 'id', 'lpk');
    }

    public function head()
    {
        return $this->HasOne(Head::class, 'participant', 'student');
    }

    public function nilai()
    {
        return $this->HasOne(Nilai::class, 'student', 'student');
    }

    public function penyanggah()
    {
        return $this->HasOne(Third::class, 'users_id', 'lpk');
    }

    public function data()
    {
        return $this->HasOne(Data::class, 'users_id', 'student');
    }

    public function class()
    {
        return $this->HasOne(Kelas::class, 'id', 'kelas');
    }

    public function siswa()
    {
        return $this->HasOne(User::class, 'id', 'student');
    }

    public function materi()
    {
        return $this->HasMany(Material::class, 'kelas', 'kelas');
    }
}
