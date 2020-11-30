<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Registration extends Model
{
    use HasFactory;

    protected $table = "registration";

    protected $fillable = [
        'conference',
    ];

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'conference' => ['required', 'gt:1'],
        ]);
    }

    public function conference() {
        return $this->belongsTo('App\Models\Conference');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
