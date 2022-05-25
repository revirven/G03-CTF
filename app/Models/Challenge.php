<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{   
    use HasFactory;

    public function solves() {
        return $this->hasMany(Solve::class);
    }
}