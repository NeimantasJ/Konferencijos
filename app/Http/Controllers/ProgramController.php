<?php

namespace App\Http\Controllers;

use App\Models\Conference;
use App\Models\Registration;
use App\Models\Speech;
use App\Models\User;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ProgramController extends Controller
{
    public function show($id) {
        $conference = Conference::where([['id', $id],['status', 1]])->first();
        $categories = $conference->category->where('status', 1);
        $speeches = $conference->speech->where('status', 1);
        $users = User::where([['status', 1], ['type', '>', '1']])->get();

        return view('program.edit', ['id' => $id, 'categories' => $categories, 'conference' => $conference, 'speeches' => $speeches, 'users' => $users]);
    }

    public function pdf($id) {
        $conference = Conference::where([['id', $id],['status', 1]])->first();
        $speeches = Speech::where([['conference_id', $id],['status', 1]])->orderBy('start_time', 'asc')->get();
        $participants = Registration::where([['conference_id', $id],['status', 1]])->get();
        $data = ['id' => $id, 'conference' => $conference, 'speeches' => $speeches, 'participants' => $participants];
        $pdf = PDF::loadView('pdf.program', $data);
        return $pdf->stream($conference->name);
    }
}
