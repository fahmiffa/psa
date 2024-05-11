<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    public function exam()
    {
        return $this->HasOne(Exam::class, 'kelas_id', 'id');
    }

    public function guru()
    {
        return $this->HasOne(User::class, 'id', 'employee');
    }

    public function materi()
    {
        return $this->HasMany(Material::class, 'kelas', 'id');
    }

    public function siswa()
    {
        return $this->HasMany(Student::class, 'kelas', 'id');
    }

    public function paid()
    {
        return $this->belongsTo(Paid::class, 'id', 'par');
    }
}
