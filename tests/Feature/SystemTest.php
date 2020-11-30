<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class SystemTest extends TestCase
{
    public function testIsLoginPageReachable() {
        $response = $this->call('GET', '/');
        $this->assertEquals(200, $response->status());
    }

    public function testIsConferenceShowReachable() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/conference')
            ->see('Vykstančios Konferencijos');
    }

    public function testIsConferenceAddReachable() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editConference/0')
            ->see('Registruoti');
    }

    public function testIsConferenceEditReachable() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editConference/1')
            ->see('Redaguoti');
    }

    public function testIsConferenceEditProgramReachable() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editConferenceProgram/1')
            ->see('Konferencijos Sekcijos');
    }

    public function testIsRegisterAsParticipantReachable() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/registerParticipant')
            ->see('Registruotis į konferenciją');
    }

    public function testIsRegisterAsSpeakerReachable() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/registerSpeech/1')
            ->see('Registracija į konferenciją kaip pranešėjas');
    }

    public function testIsAudienceShowReachable() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/audience')
            ->see('Galimos auditorijos');
    }

    public function testIsAudienceAddReachable() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editAudience/0')
            ->see('Pridėti');
    }

    public function testIsAudienceEditReachable() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editAudience/1')
            ->see( 'Redaguoti');
    }

    public function testIsUsersShowReachable() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/users')
            ->see( 'Visi vartotojai');
    }

    public function testCreatingNewConference() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editConference/0')
            ->select('1', 'audience_id')
            ->type('aaa', 'name')
            ->type('2020-10-05 12:00:00', 'start_time')
            ->type('2020-10-06 12:00:00', 'end_time')
            ->type('5', 'capacity')
            ->type('5', 'speech_capacity')
            ->type('60', 'speech_time')
            ->type('2020-10-05 12:00:00', 'break_time_start')
            ->type('2020-10-06 12:00:00', 'break_time_end')
            ->type('2020-10-05 12:00:00', 'cafe_time_start')
            ->type('2020-10-06 12:00:00', 'cafe_time_end')
            ->press('Sukurti')
            ->assertResponseOk();
    }

    public function testCreatingNewCategory() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editConferenceProgram/1')
            ->select('1', 'leader_id')
            ->type('aaa', 'name')
            ->type('2020-10-05 12:00:00', 'start_time')
            ->type('2020-10-06 12:00:00', 'end_time')
            ->press('Pridėti / Keisti')
            ->assertResponseOk();
    }

    public function testCreatingNewAudience() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editAudience/0')
            ->type('aaa', 'place_name')
            ->type('100', 'max_capacity')
            ->press('Pridėti')
            ->assertResponseOk();
    }

    public function testEditAudience() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editAudience/1')
            ->type('VDU Kauno filialas 100 auditorija', 'place_name')
            ->type('100', 'max_capacity')
            ->press('Redaguoti')
            ->assertResponseOk();
    }

    public function testEditCategory() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editConferenceProgram/1')
            ->type('1', 'category_id')
            ->select('1', 'leader_id')
            ->type('Verslas', 'name')
            ->type('2020-11-29 12:00:00', 'start_time')
            ->type('2020-11-29 20:00:00', 'end_time')
            ->press('Pridėti / Keisti')
            ->assertResponseOk();
    }

    public function testEditSpeech() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editConferenceProgram/1')
            ->type('1', 'speech_id')
            ->select('1', 'category_id')
            ->type('Testas 2', 'title')
            ->type('2020-11-29 16:00:00', 'start_time')
            ->type('2020-11-29 17:00:00', 'end_time')
            ->press('Redaguoti')
            ->assertResponseOk();
    }

    public function testEditConference() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/editConference/1')
            ->select('1', 'audience_id')
            ->type('Pirmoji konferencija', 'name')
            ->type('2020-11-29 12:00:00', 'start_time')
            ->type('2020-11-29 20:00:00', 'end_time')
            ->type('3', 'capacity')
            ->type('5', 'speech_capacity')
            ->type('60', 'speech_time')
            ->type('2020-11-29 15:00:00', 'break_time_start')
            ->type('2020-11-29 16:00:00', 'break_time_end')
            ->type('2020-11-29 18:00:00', 'cafe_time_start')
            ->type('2020-11-29 19:00:00', 'cafe_time_end')
            ->press('Redaguoti')
            ->assertResponseOk();
    }

    public function testRegisterAsParticipant() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/registerParticipant')
            ->select('1', 'conference')
            ->press('Registruotis')
            ->assertResponseOk();
    }

    public function testRegisterAsSpeaker() {
        $user = User::find(1);

        $this->actingAs($user)
            ->visit('/registerSpeech/1')
            ->select('2020-11-29 13:00:00|2020-11-29 14:00:00', 'time')
            ->select('1', 'category')
            ->type('aaa', 'title')
            ->press('Registruotis')
            ->assertResponseOk();
    }

    public function testChangingUserTypeToParticipant() {
        $response = $this->call('POST', '/editUser/2/1');
        $response->assertSessionMissing('error');
    }

    public function testChangingUserTypeToSpeaker() {
        $response = $this->call('POST', '/editUser/2/2');
        $response->assertSessionMissing('error');
    }

    public function testChangingUserTypeToOrganisator() {
        $response = $this->call('POST', '/editUser/2/3');
        $response->assertSessionMissing('error');
    }

    public function testChangingUserTypeToAdministrator() {
        $response = $this->call('POST', '/editUser/2/4');
        $response->assertSessionMissing('error');
    }

    public function testAudienceDelete() {
        $audience = DB::table('audience')->where('status', '1')->get();
        $countAudience = count($audience);
        if($countAudience > 0) {
            $chosenAudience = $audience->first();

            $response = $this->call('POST', '/deleteAudience/'.$chosenAudience->id);
            $response->assertSessionMissing('error');
        }
    }

    public function testConferenceDelete() {
        $conference = DB::table('conference')->where('status', '1')->get();
        $countConference = count($conference);
        if($countConference > 0) {
            $chosenConference = $conference->first();

            $response = $this->call('POST', '/deleteConference/'.$chosenConference->id);
            $response->assertSessionMissing('error');
        }
    }

    public function testCategoryDelete() {
        $category = DB::table('categories')->where('status', '1')->get();
        $countCategory = count($category);
        if($countCategory > 0) {
            $chosenCategory = $category->last();

            $response = $this->call('POST', '/deleteConferenceCategories/'.$chosenCategory->id);
            $response->assertSessionMissing('error');
        }
    }

    public function testSpeechDelete() {
        $speech = DB::table('speeches')->where('status', '1')->get();
        $countSpeech = count($speech);
        if($countSpeech > 0) {
            $chosenSpeech = $speech->first();

            $response = $this->call('POST', '/deleteConferenceSpeech/'.$chosenSpeech->id);
            $response->assertSessionMissing('error');
        }
    }
}
