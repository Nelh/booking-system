<div class="relative">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form wire:submit.prevent="createBooking" class="mt-8 bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div>
                    <div class="p-6">
                        <div class="mb-6">
                            <label for="service" class="inline-block text-slate-700 text-xl mb-2">Select service</label>
                            <select name="service" id="service" class="mt-1.5 w-full rounded-lg border-slate-300 text-slate-700 sm:text-sm" wire:model="state.service">
                                <option value="">Select a service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->duration }} minutes)</option>
                                @endforeach
                            </select>
                        </div>

                        @if($employees->count() > 0)
                            <div>
                                <label for="employee" class="inline-block text-slate-700 text-xl mb-2">Select employee</label>
                            </div>
                            @foreach ($employees as $employee)
                                <button
                                    type="button"
                                    wire:click="selectEmployee({{ $employee->id }})"
                                    class="mt-2 inline-flex flex-nowrap items-center bg-white border border-slate-200 shadow-sm rounded-full p-1
                                        {{ $state['employee'] == $employee->id ? 'bg-slate-100 border-slate-300' : '' }}
                                        dark:bg-neutral-900 dark:border-neutral-700"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <div class="whitespace-nowrap text-sm px-2 text-slate-800 dark:text-white">
                                        {{ $employee->name }}
                                    </div>
                                </button>
                            @endforeach
                        @endif

                        {{-- <div class="mb-6 {{ !$employees->count() ? 'opacity-25' : '' }}">
                            <label for="employee" class="inline-block text-slate-700 font-bold mb-2">Select employee</label>
                            <select name="employee" id="employee" class="mt-1.5 w-full rounded-lg border-slate-300 text-slate-700 sm:text-sm" wire:model="state.employee" {{ !$employees->count() ? 'disabled="disabled"' : '' }}>
                                <option value="">Select a employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>

                    <div class="{{ !$this->selectedService || !$this->selectedEmployee ? 'opacity-25' : '' }}">
                        @if($this->selectedEmployee)
                        <div class="p-6">
                            <label for="employee" class="inline-block text-slate-700 text-xl mb-2">Select appointment time</label>
                        </div>
                        @endif

                        <livewire:booking-calendar :service="$this->selectedService" :employee="$this->selectedEmployee" :key="optional($this->selectedEmployee)->id" />
                    </div>
                </div>

                <div class="p-6 border-t border-slate-200 dark:border-slate-700 md:border-t-0 md:border-l">
                    @if ($this->hasDetailsToBook)
                        <div class="mb-6">
                            <div class="inline-block text-slate-700 text-xl mb-2">
                                Booking Details
                            </div>

                            <div class="text-slate-700 font-bold mb-2">
                                You're ready to book
                            </div>

                            <div class="border-t border-b border-slate-300 py-2">
                                {{ $this->selectedService->name }} ({{ $this->selectedService->duration }} minutes) with {{ $this->selectedEmployee->name }}
                                on {{ $this->timeObject->format('D jS M Y') }} at {{ $this->timeObject->format('g:i A') }}
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="mb-3">
                                <label for="name" class="inline-block text-slate-700 font-bold mb-2">Your name</label>
                                <input type="text" name="name" id="name" class="py-3 px-4 block w-full border-slate-200 rounded-lg text-sm focus:border-slate-500 focus:ring-slate-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" wire:model.defer="state.name">

                                @error('state.name')
                                    <div class="font-semibold text-red-500 text-sm mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="inline-block text-slate-700 font-bold mb-2">Your email</label>
                                <input type="text" name="email" id="email" class="py-3 px-4 block w-full border-slate-200 rounded-lg text-sm focus:border-slate-500 focus:ring-slate-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" wire:model.defer="state.email">

                                @error('state.email')
                                    <div class="font-semibold text-red-500 text-sm mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-gray-800 text-white hover:bg-gray-900 focus:outline-none focus:bg-gray-900 disabled:opacity-50 disabled:pointer-events-none dark:bg-white dark:text-neutral-800">
                            Book now
                        </button>

                    @else
                        {{-- No Slots selected --}}
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>