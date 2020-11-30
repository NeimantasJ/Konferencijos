<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    use HasFactory;

    protected $table = 'audience';

    public function conference() {
        return $this->hasMany('App\Models\Conference');
    }
}
