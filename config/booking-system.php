<?php

return [
    'layout' => [
        'timeslot-picker' => 'default',
        'employee-picker' => 'default',
    ],
    'booking_types' => [
        'hourly' => 'Hourly',
        'daily' => 'Daily',
        'weekly' => 'Weekly'
    ],

    'time_slots' => [
        'start_time' => '09:00',
        'end_time' => '17:00',
        'duration' => 60 // minutes
    ],

    'validation' => [
        'min_advance_time' => 24, // hours
        'max_advance_time' => 30  // days
    ],

    'notifications' => [
        'email' => [
            'enabled' => true,
            'templates' => [
                'confirmation' => 'booking-system::emails.confirmation',
                'reminder' => 'booking-system::emails.reminder'
            ]
        ]
    ],

    'database' => [
        'table_prefix' => 'booking_'
    ]
];
