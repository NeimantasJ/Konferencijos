<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Registration;
use App\Models\Speech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RegistrationController extends Controller
{
    public function show() {
        $conferences = Conference::where('status', 1)->get();
        return view('registration.edit', ['conferences' => $conferences]);
    }

    public function store(Request $request) {
        if(count(Registration::where([['conference_id', $request->input('conference')],['status', 1]])->get()) >= Conference::where('id', $request->input('conference'))->first()->capacity) {
            return Redirect::back()->with('error', 'Vietų į šią konferenciją nebeliko');
        }

        if(Registration::where([['user_id', Auth::id()], ['conference_id', $request->input('id')], ['status', 1]])->first()) {
            return Redirect::back()->with('error', 'Jūs jau esate užsiregistravęs šiam renginiui kaip dalyvis');
        }

        $registration = new Registration();
        $registration->user_id = Auth::id();
        $registration->conference_id = $request->input('conference');
        if($registration->save()) {
            return Redirect::back()->with('success', 'Sėkmingai užregistruota');
        } else {
            return Redirect::back()->with('error', 'Nepavyko užregistruoti į konferenciją');
        }
    }
}
