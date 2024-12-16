<?php

namespace Nel\BookingSystem\Filters\Filters;

use Nel\BookingSystem\Filters\Filter;
use Carbon\CarbonPeriod;
use Nel\BookingSystem\Filters\TimeSlotGenerator;

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
