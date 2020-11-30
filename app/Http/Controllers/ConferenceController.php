<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\Conference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ConferenceController extends Controller
{
    public function index()
    {
        $conferences = Conference::where('status', 1)->get();
        foreach ($conferences as $conference) {
            $conference->audience = Audience::find($conference->audience_id)->place_name;
            $conference->registered = count($conference->registration->where('status', 1));
        }
        return view('conference.list')->withConferences($conferences);
    }

    public function show($id) {
        $audiences = Audience::where('status', 1)->get();
        $conference = Conference::where([['id', $id],['status', 1]])->first();
        return view('conference.edit', ['id' => $id, 'audiences' => $audiences, 'conference' => $conference]);
    }

    public function edit(Request $request) {
        $request->validate([
            'audience_id' => ['required', 'gt:0'],
            'name' => ['required', 'string', 'max:255'],
            'start_time' => ['required', 'date_format:Y-m-d H:i:s'],
            'end_time' => ['required', 'date_format:Y-m-d H:i:s'],
            'capacity' => ['required', 'numeric'],
            'speech_capacity' => ['required', 'numeric'],
            'speech_time' => ['required', 'numeric', 'gt:0'],
            'break_time_start' => ['date_format:Y-m-d H:i:s'],
            'break_time_end' => ['date_format:Y-m-d H:i:s'],
            'cafe_time_start' => ['date_format:Y-m-d H:i:s'],
            'cafe_time_end' => ['date_format:Y-m-d H:i:s'],
        ]);

        $audience = Audience::where(['id' => $request->input('audience_id')])->first();
        if($request->input('capacity') > $audience->max_capacity) {
            return Redirect::back()->with('error', 'Įvestas konferencijos vietų skaičius turi būti mažesnis už maksimalų auditorijos vietų skaičių')->withInput();
        }

        if($request->input('id') == 0) {
            $conference = new Conference();
            $conference->created_by = Auth::id();
            $conference->audience_id = $request->input('audience_id');
            $conference->name = $request->input('name');
            $conference->start_time = $request->input('start_time');
            $conference->end_time = $request->input('end_time');
            $conference->capacity = $request->input('capacity');
            $conference->speech_capacity = $request->input('speech_capacity');
            $conference->speech_time = $request->input('speech_time');
            $conference->break_time_start = $request->input('break_time_start');
            $conference->break_time_end = $request->input('break_time_end');
            $conference->cafe_time_start = $request->input('cafe_time_start');
            $conference->cafe_time_end = $request->input('cafe_time_end');
            if($conference->save()) {
                return Redirect::intended('/editConference/'.$conference->id)->with('success', 'Konferencija sėkmingai pridėta');
            } else {
                return Redirect::intended('/editConference/'.$conference->id)->with('error', 'Nepavyko pridėti konferencijos')->withInput();
            }
        } else {
            if(Conference::where([['id', $request->input('id')], ['created_by', Auth::id()]])
                ->update([
                    'audience_id' => $request->input('audience_id'),
                    'name' => $request->input('name'),
                    'start_time' => $request->input('start_time'),
                    'end_time' => $request->input('end_time'),
                    'capacity' => $request->input('capacity'),
                    'speech_capacity' => $request->input('speech_capacity'),
                    'speech_time' => $request->input('speech_time'),
                    'break_time_start' => $request->input('break_time_start'),
                    'break_time_end' => $request->input('break_time_end'),
                    'cafe_time_start' => $request->input('cafe_time_start'),
                    'cafe_time_end' => $request->input('cafe_time_end'),
            ])) {
                return Redirect::back()->with('success', 'Konferencija sėkmingai atnaujinta');
            } else {
                return Redirect::back()->with('error', 'Nepavyko atnaujinti konferencijos informacijos')->withInput();
            }
        }
    }

    public function delete($id) {
        if(Conference::where('id', $id)->update([ 'status' => 0 ])) {
            return Redirect::back()->with('success', 'Konferencija sėkmingai ištrinta');
        } else {
            return Redirect::back()->with('error', 'Konferencijos nepavyko ištrinti');
        }
    }
}
