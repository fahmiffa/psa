<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Third extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->HasOne(User::class, 'id', 'users_id');
    }
}
