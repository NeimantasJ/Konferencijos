<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speech extends Model
{
    use HasFactory;

    public function conference() {
        return $this->hasOne('App\Models\Conference');
    }

    public function speaker() {
        return $this->belongsTo('App\Models\User');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
}
