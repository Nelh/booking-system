<?php

namespace Nel\BookingSystem\Bookings\Filters;

use Nel\BookingSystem\Bookings\Filter;
use Carbon\CarbonPeriod;
use Nel\BookingSystem\Bookings\TimeSlotGenerator;

class SlotsPassedTodayFilter implements Filter
{
    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval)
    {
        $interval->addFilter(function ($slot) use ($generator) {
            if ($generator->schedule->date->isToday()) {
                if ($slot->lt(now())) {
                    return false;
                }
            }

            return true;
        });
    }
}
