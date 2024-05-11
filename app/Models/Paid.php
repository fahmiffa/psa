<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paid extends Model
{
    use HasFactory, SoftDeletes;

    public function kelas()
    {
        return $this->HasOne(Kelas::class, 'id', 'par');
    }

    public function getnomAttribute()
    {
        return $this->payment->nominal;
    }

    public function payment()
    {
        return $this->HasOne(Payment::class, 'id', 'par');
    }

    public function users()
    {
        return $this->HasOne(User::class, 'id', 'user');
    }
}
