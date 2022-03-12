<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Choice;
use App\Models\User;

class Poll extends Model {
    use HasFactory;

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function choices() {
        return $this->hasMany(Choice::class);
    }
}
