<?php

namespace Nel\BookingSystem\Http\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Auth\Access\AuthorizationException;

class ShowBooking extends Component
{
    public $appointment;

    public function mount(Appointment $appointment)
    {
        $this->appointment = $appointment;

        if (request()->token !== $appointment->token) {
            throw new AuthorizationException();
        }
    }

    public function cancelBooking()
    {
        $this->appointment->update([
            'cancelled_at' => now()
        ]);
    }

    public function render()
    {
        return view('booking-system::livewire.show-booking')
            ->layout('booking-system::layouts.app');
    }
}
