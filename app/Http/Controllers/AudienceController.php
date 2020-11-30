<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AudienceController extends Controller
{
    public function index() {
        $audiences = Audience::where('status', 1)->get();
        return view('audience.list', ['audiences' => $audiences]);
    }

    public function show($id) {
        $audience = Audience::where('id', $id)->first();
        return view('audience.edit', ['id' => $id, 'audience' => $audience]);
    }

    public function edit(Request $request) {
        $request->validate([
            'place_name' => ['required', 'string', 'max:255'],
            'max_capacity' => ['required', 'numeric']
        ]);

        if($request->input('id') == 0) {
            $audience = new Audience();
            $audience->place_name = $request->input('place_name');
            $audience->max_capacity = $request->input('max_capacity');
            $audience->has_projector = ($request->has('has_projector') ? 1 : 0);
            $audience->has_speakers = ($request->has('has_speakers') ? 1 : 0);
            $audience->has_board = ($request->has('has_board') ? 1 : 0);
            if($audience->save()) {
                return Redirect::back()->with('success', 'Auditorija sėkmingai pridėta')->withInput();
            } else {
                return Redirect::back()->with('error', 'Nepavyko pridėti auditorijos')->withInput();
            }
        } else {
            if(Audience::where('id', $request->input('id'))
                ->update([
                    'place_name' => $request->input('place_name'),
                    'max_capacity' => $request->input('max_capacity'),
                    'has_projector' => ($request->has('has_projector') ? 1 : 0),
                    'has_speakers' => ($request->has('has_speakers') ? 1 : 0),
                    'has_board' => ($request->has('has_board') ? 1 : 0)
                ])) {
                return Redirect::back()->with('success', 'Auditorija sėkmingai atnaujinta')->withInput();
            } else {
                return Redirect::back()->with('error', 'Nepavyko atnaujinti auditorijos informacijos')->withInput();
            }
        }
    }

    public function delete($id) {
        if(Audience::where('id', $id)->update([ 'status' => 0 ])) {
            return Redirect::back()->with('success', 'Auditorija sėkmingai ištrinta');
        } else {
            return Redirect::back()->with('error', 'Auditorijos nepavyko ištrinti');
        }
    }
}
