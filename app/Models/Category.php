<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function conference()
    {
        return $this->belongsTo('App\Models\Conference');
    }

    public function leader()
    {
        return $this->belongsTo('App\Models\User');
    }
}
