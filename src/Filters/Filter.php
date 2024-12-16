<?php

namespace Nel\BookingSystem\Filters;

use Carbon\CarbonPeriod;
use Nel\BookingSystem\Filters\TimeSlotGenerator;

interface Filter
{
    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval);
}
