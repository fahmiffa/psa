<?php

namespace App\Models;

use App\Models\Third;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

     // noted
    public function getlpkAttribute()
    {

        if ($this->grant) {
            $val = json_decode($this->grant);
            
            foreach ($val as $item) {
                $lpk = Third::where('id', $item)->first();
                if ($lpk) {
                    $name[] = $lpk->name;
                }
            }

            return $name;
        } else {
            return null;
        }
    }

    public function mitra()
    {
        return $this->HasOne(Third::class, 'id', 'grant');
    }

    public function getnomAttribute()
    {
        if ($this->disc == 2) {
            return $this->nominal - $this->value;
        } else {
            $disc = $this->value/100 * $this->nominal;
            return $this->nominal - $disc;
        }
    }

}
