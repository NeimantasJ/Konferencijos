<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Conference extends Model
{
    use HasFactory;

    protected $table = 'conference';

    protected $fillable = [
        'audience',
        'name',
        'start_time',
        'end_time',
        'capacity',
        'speech_time',
        'break_time_start',
        'break_time_end',
        'cafe_time_start',
        'cafe_time_end',
    ];

    /*protected function validator(array $data)
    {
        return Validator::make($data, [
            'audience' => ['required', 'gt:0'],
            'name' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'date_format:Y-m-d'],
            'end_time' => ['required', 'date_format:Y-m-d'],
            'capacity' => ['required', 'numeric'],
            'speech_time' => ['required', 'numeric', 'gt:0'],
            'break_time_start' => ['required', 'date_format:Y-m-d'],
            'break_time_end' => ['required', 'date_format:Y-m-d'],
            'cafe_time_start' => ['required', 'date_format:Y-m-d'],
            'cafe_time_end' => ['required', 'date_format:Y-m-d'],
        ]);
    }*/

    public function organisator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function audience()
    {
        return $this->belongsTo('App\Models\Audience');
    }

    public function registration()
    {
        return $this->hasMany('App\Models\Registration');
    }

    public function category()
    {
        return $this->hasMany('App\Models\Category');
    }

    public function speech()
    {
        return $this->hasMany('App\Models\Speech');
    }
}
