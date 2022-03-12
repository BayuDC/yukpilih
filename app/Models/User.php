<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use App\Models\Poll;

class User extends Model {
    use HasFactory;
    public function polls() {
        return $this->hasMany(Poll::class);
    }
}
