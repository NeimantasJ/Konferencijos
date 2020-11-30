<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Registration;
use App\Models\Speech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SpeechController extends Controller
{
    public function show($id) {
        $conference = Conference::where([['id', $id],['status', 1]])->first();
        $categories = $conference->category;
        $time = array();
        $current_time = $conference->start_time;
        while($current_time < $conference->end_time) {
            $exists = Speech::where('start_time', $current_time)->first();
            if(($current_time < $conference->break_time_start || $current_time >= $conference->break_time_end &&
                        $current_time < $conference->cafe_time_start || $current_time >= $conference->cafe_time_end) && !$exists) {
                $temp = new \stdClass();
                $temp->start_time = $current_time;
                $temp->end_time = date("Y-m-d H:i:s", strtotime('+'.$conference->speech_time.' minutes', strtotime($current_time)));
                array_push($time, $temp);
            }
            $current_time = date("Y-m-d H:i:s", strtotime('+'.$conference->speech_time.' minutes', strtotime($current_time)));
        }

        return view('speech.edit', ['id' => $id, 'conference' => $conference, 'times' => $time, 'categories' => $categories]);
    }

    public function store(Request $request) {
        $request->validate([
            'id' => ['required'],
            'time' => ['required', 'regex:/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[1-9]|1[0-9]|2[0-4]):(0[0-9]|[1-5][0-9]):(0[0-9]|[1-5][0-9])\|[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (0[1-9]|1[0-9]|2[0-4]):(0[0-9]|[1-5][0-9]):(0[0-9]|[1-5][0-9])$/'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'gt:0']
        ]);

        if(count(Speech::where([['conference_id', $request->input('id')],['status', 1]])->get()) >= Conference::where('id', $request->input('id'))->first()->speech_capacity) {
            return Redirect::back()->with('error', 'Vietų pranešimams nebeliko');
        }

        if(Speech::where([['speaker_id', Auth::id()], ['conference_id', $request->input('id')], ['status', 1]])->first()) {
            return Redirect::back()->with('error', 'Jūs jau esate užsiregistravęs šiam renginiui kaip pranešėjas')->withInput();
        }

        $split = explode('|', $request->input('time'));
        $speech = new Speech();
        $speech->speaker_id = Auth::id();
        $speech->category_id = $request->input('category');
        $speech->conference_id = $request->input('id');
        $speech->title = $request->input('title');
        $speech->start_time = $split[0];
        $speech->end_time = $split[1];
        if($speech->save()) {
            return Redirect::back()->with('success', 'Sėkmingai užregistruota');
        } else {
            return Redirect::back()->with('error', 'Nepavyko užregistruoti į konferenciją')->withInput();
        }
    }

    public function edit(Request $request) {
        $request->validate([
            'conference_id' => ['required'],
            'category_id' => ['required'],
            'speech_id' => ['required'],
            'title' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_time' => ['required', 'date_format:Y-m-d H:i:s']
        ]);

        if(Speech::where('id', $request->input('speech_id'))
            ->update([
                'category_id' => $request->input('category_id'),
                'title' => $request->input('title'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time')
            ])) {
            return Redirect::back()->with('success', 'Pranešimas sėkmingai atnaujintas');
        } else {
            return Redirect::back()->with('error', 'Nepavyko atnaujinti pranešimo informacijos')->withInput();
        }
    }

    public function delete($id) {
        if(Speech::where('id', $id)->update(['status' => 0])) {
            return Redirect::back()->with('success', 'Pranešimas sėkmingai ištrintas');
        } else {
            return Redirect::back()->with('error', 'Nepavyko ištrinti pranešimo')->withInput();
        }
    }
}
