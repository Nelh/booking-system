<?php

namespace Nel\BookingSystem\Models;

use Carbon\Carbon;
use Nel\BookingSystem\Models\Service;
use Nel\BookingSystem\Models\Schedule;
use Nel\BookingSystem\Bookings\TimeSlotGenerator;
use Illuminate\Database\Eloquent\Model;
use Nel\BookingSystem\Bookings\Filters\AppointmentFilter;
use Nel\BookingSystem\Bookings\Filters\UnavailabilityFilter;
use Nel\BookingSystem\Bookings\Filters\SlotsPassedTodayFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    public function availableTimeSlots(Schedule $schedule, Service $service)
    {
        return (new TimeSlotGenerator($schedule, $service))
            ->applyFilters([
                new SlotsPassedTodayFilter(),
                new UnavailabilityFilter($schedule->unavailabilities),
                new AppointmentFilter($this->appointmentsForDate($schedule->date))
            ])
            ->get();
    }

    public function appointmentsForDate(Carbon $date)
    {
        return $this->appointments()->notCancelled()->whereDate('date', $date)->get();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
