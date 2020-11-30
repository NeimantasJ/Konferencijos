<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(Auth::guest()) {
        return view('auth.login');
    } else {
        return Redirect::intended('/conference');
    }
});

Route::any('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'loggedin'], function () {
    // Konferencijų kūrimas, redagavimas, trinimas
    Route::get('/conference', 'ConferenceController@index')->name('conference.index');
    Route::get('/editConference/{id}', 'ConferenceController@show')->name('conference.show');
    Route::post('/editConference', 'ConferenceController@edit')->name('conference.edit');
    Route::get('/deleteConference/{id}', 'ConferenceController@delete')->name('conference.delete');

    // Auditorijų kūrimas, redagavimas, trinimas
    Route::get('/audience', 'AudienceController@index')->name('audience.index');
    Route::get('/editAudience/{id}', 'AudienceController@show')->name('audience.show');
    Route::post('/editAudience', 'AudienceController@edit')->name('audience.edit');
    Route::get('/deleteAudience/{id}', 'AudienceController@delete')->name('audience.delete');

    // Konferencijos papildoma informacija su programa
    Route::get('/editConferenceProgram/{id}', 'ProgramController@show')->name('program.show');
    Route::post('/editConferenceCategories', 'CategoriesController@edit')->name('categories.edit');
    Route::get('/deleteConferenceCategories/{id}', 'CategoriesController@delete')->name('categories.delete');
    Route::post('/editConferenceSpeech', 'SpeechController@edit')->name('speech.edit');
    Route::get('/deleteConferenceSpeech/{id}', 'SpeechController@delete')->name('speech.delete');
    Route::get('/printProgram/{id}', 'ProgramController@pdf')->name('program.pdf');

    // Registracija kaip dalyvis
    Route::get('/registerParticipant', 'RegistrationController@show')->name('register.show');
    Route::post('/registerParticipant', 'RegistrationController@store')->name('register.store');

    // Registracija kaip pranešėjas
    Route::get('/registerSpeech/{id}', 'SpeechController@show')->name('speech.show');
    Route::post('/registerSpeech', 'SpeechController@store')->name('speech.store');

    // Vartotojų redagavimas, atvaizdavimas
    Route::get('/users', 'UsersController@index')->name('users.index');
    Route::get('/editUser/{id}/{status}', 'UsersController@edit')->name('users.edit');

});

Auth::routes();
