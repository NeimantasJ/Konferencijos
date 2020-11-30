<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    public function index() {
        $users = User::where('status', 1)->get();
        return view('users.list', ['users' => $users]);
    }

    public function edit($id, $status) {
        if(User::where('id', $id)->update([ 'type' => $status ])) {
            return Redirect::back()->with('success', 'Vartotojas sėkmingai perkeltas');
        } else {
            return Redirect::back()->with('error', 'Vartotojo nepavyko perkelti');
        }
    }
}
