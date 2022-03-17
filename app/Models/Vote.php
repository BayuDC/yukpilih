<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Division;

class Vote extends Model {
    use HasFactory;

    public function division() {
        return $this->belongsTo(Division::class);
    }
}
