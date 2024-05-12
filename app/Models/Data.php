<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Data extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->HasOne(User::class, 'id', 'users_id');
    }

    public function file()
    {
        return $this->HasOne(Files::class, 'data', 'id');
    }
}
