<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use App\Models\Invitee;
use App\Models\Meeting;
use App\Models\User;
use App\Notifications\EventRegistrationOtp;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class EventRegistration extends Component
{
    public $email = '';
    public $name = '';
    public $otp = '';
    public $otp_sent = false;
    public $eventUuid = '';
    public $response_message = '';
    public $otp_try = 0;
    public $error = false;

    public function mount()
    {
        $this->eventUuid = request('uuid');
    }

    public function render()
    {
        return view('livewire.event-registration');
    }

    public function register()
    {
        $this->validate([
            'email' => 'required|email',
            'name' => 'required|max:100',
        ]);

        $meeting = Meeting::where('meta->has_event', true)->where('meta->event_uuid', $this->eventUuid)->where('start_date_time', '>', now())->first();

        if (! $meeting) {
            $this->response_message = 'This is not a valid event.';
            $this->error = true;
            $this->resetData();
            return;
        }

        if (! $this->otp_sent) {
            $random_otp = rand(100000, 999999);

            (new User)->forceFill([
                'email' => $this->email,
            ])->notify(new EventRegistrationOtp($random_otp));

            cache(['otp_event_'.$this->email => $random_otp], config('config.auth.otp_lifetime') * 60);
            $this->otp_sent = true;

            return;
        }

        if ($this->otp_try >= 5) {
            $this->response_message = 'Your otp is expired due to max invalid attempt.';
            $this->error = true;
            $this->resetData();
            \Cache::forget('otp_event_'.$this->email);
            return;
        }

        $this->validate([
            'otp' => 'required|numeric|digits:6'
        ]);

        if ($this->otp != \Cache::get('otp_event_'.$this->email)) {
            $this->otp_try++;
            $this->response_message = 'Invalid OTP.';
            $this->error = true;
            return;
        }

        \Cache::forget('otp_event_'.$this->email);

        $contact = Contact::whereEmail($this->email)->first();

        if (! $contact) {
            $contact = Contact::forceCreate(['email' => $this->email, 'name' => $this->name]);
        }

        $invitee = Invitee::whereMeetingId($meeting->id)->whereContactId($contact->id)->first();

        if ($invitee) {
            $this->response_message = 'You are already registered for this event.';
            $this->error = true;
            $this->resetData();
            return;
        }

        Invitee::forceCreate([
            'contact_id' => $contact->id,
            'meeting_id' => $meeting->id,
            'meta' => array('is_moderator' => false)
        ]);

        $this->response_message = 'You are successfully registered for this event.';
        $this->error = false;
        $this->resetData();
    }

    public function resetData()
    {
        $this->otp_sent = false;
        $this->otp_try = 0;
        $this->email = '';
        $this->name = '';
        $this->otp = '';
    }
}
