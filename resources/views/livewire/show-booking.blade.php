<div class="max-w-7xl mx-auto mt-8 bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded-lg">
    <div class="p-6">
        <div class="inline-block text-gray-700 text-xl mb-2">
            Booking Confirmation
        </div>

        <div class="mb-6">
            <div class="text-gray-700 font-bold mb-2">
                {{ $appointment->client_name }}, thanks for your booking.
            </div>

            <div class="border-t border-gray-300 py-2">
                <div class="font-semibold">
                    {{ $appointment->service->name }} ({{ $appointment->service->duration }} minutes) with {{ $appointment->employee->name }}
                </div>
                <div class="text-gray-700">
                    on {{ $appointment->date->format('D jS M Y') }} at {{ $appointment->start_time->format('g:i A') }}
                </div>
            </div>
        </div>

        @if (!$appointment->isCancelled())
            <button
                type="button"
                class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-red-500 text-white hover:bg-red-600 focus:outline-none focus:bg-red-600 disabled:opacity-50 disabled:pointer-events-none"
                x-data="{
                    confirmCancellation () {
                        if (window.confirm('Are you sure?')) {
                            @this.call('cancelBooking')
                        }
                    }
                }"
                x-on:click="confirmCancellation"
            >
                Cancel booking
            </button>
        @endif

        <a href="{{ route('bookings') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent text-slate-600 hover:text-slate-800 focus:outline-none focus:text-slate-800 active:text-slate-800 disabled:opacity-50 disabled:pointer-events-none dark:text-slate-500 dark:hover:text-slate-400 dark:focus:text-slate-400 dark:active:text-slate-400">Book again</a>

        @if ($appointment->isCancelled())
            <p>Your booking has been cancelled.</p>
        @endif
    </div>
</div>
