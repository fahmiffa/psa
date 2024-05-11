<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nilai extends Model
{
    use HasFactory, SoftDeletes;

    public function siswa()
    {
        return $this->HasOne(User::class, 'id', 'student');
    }

    public function class()
    {
        return $this->HasOne(Kelas::class, 'id', 'kelas');
    }
}
