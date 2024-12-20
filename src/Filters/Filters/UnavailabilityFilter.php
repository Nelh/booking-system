<?php

namespace Nel\BookingSystem\Filters\Filters;

use Nel\BookingSystem\Filters\Filter;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use Nel\BookingSystem\Filters\TimeSlotGenerator;

class UnavailabilityFilter implements Filter
{
    public $unavailabilities;

    public function __construct(Collection $unavilabilities)
    {
        $this->unavailabilities = $unavilabilities;
    }

    public function apply(TimeSlotGenerator $generator, CarbonPeriod $interval)
    {
        $interval->addFilter(function ($slot) use ($generator) {
            foreach ($this->unavailabilities as $unavailability) {
                if (
                    $slot->between(
                        $unavailability->schedule->date->setTimeFrom(
                            $unavailability->start_time->subMinutes(
                                $generator->service->duration - $generator::INCREMENT
                            )
                        ),
                        $unavailability->schedule->date->setTimeFrom(
                            $unavailability->end_time->subMinutes($generator::INCREMENT)
                        )
                    )
                ) {
                    return false;
                }
            }

            return true;
        });
    }
}
