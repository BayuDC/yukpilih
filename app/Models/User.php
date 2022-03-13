<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use App\Models\Poll;
use App\Models\Division;

class User extends Model {
    use HasFactory;

    public function polls() {
        return $this->hasMany(Poll::class);
    }
    public function division() {
        return $this->belongsTo(Division::class);
    }
}
