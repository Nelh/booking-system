<?php

namespace Nel\BookingSystem\Bookings;

use Carbon\CarbonPeriod;
use Nel\BookingSystem\Bookings\TimeSlotGenerator;

interface Filter
{
    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval);
}
