<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book a Learning Session') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h1 class="text-2xl font-bold text-gray-900">
                    Book a Session
                </h1>

                <p class="mt-2 text-gray-600">
                    Schedule a session with
                    <strong>{{ $requestOffer->tutor->name }}</strong>
                    for:
                    <strong>{{ $learningRequest->skill->name }}</strong>
                </p>

                {{-- Request information --}}
                <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                    <h3 class="font-semibold text-gray-900">
                        Learning Request
                    </h3>

                    <p class="mt-1 text-gray-700">
                        {{ $learningRequest->title }}
                    </p>

                    <p class="mt-2 text-sm text-gray-600">
                        {{ $learningRequest->description }}
                    </p>

                    <div class="mt-3 text-sm text-gray-600 space-y-1">
                        <p>
                            <strong>Location:</strong>
                            {{ $learningRequest->location }}
                        </p>

                        <p>
                            <strong>Session type:</strong>
                            {{ ucfirst(str_replace('_', ' ', $learningRequest->session_type)) }}
                        </p>

                        <p>
                            <strong>Duration:</strong>
                            {{ $learningRequest->duration }} minutes
                        </p>

                        @if ($learningRequest->preferred_date)
                            <p>
                                <strong>Preferred date:</strong>
                                {{ $learningRequest->preferred_date->format('M d, Y') }}
                            </p>
                        @endif

                        @if ($learningRequest->preferred_time)
                            <p>
                                <strong>Preferred time:</strong>
                                {{ \Carbon\Carbon::parse($learningRequest->preferred_time)->format('g:i A') }}
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Booking form --}}
                <form
                    method="POST"
                    action="{{ route('bookings.store', $requestOffer) }}"
                    class="mt-6 space-y-6"
                >
                    @csrf

                    {{-- Date --}}
                    <div>
                        <x-input-label
                            for="date"
                            :value="__('Session Date')"
                        />

                        <x-text-input
                            id="date"
                            class="block mt-1 w-full"
                            type="date"
                            name="date"
                            value="{{ old('date', optional($learningRequest->preferred_date)->format('Y-m-d')) }}"
                            required
                        />

                        <x-input-error
                            :messages="$errors->get('date')"
                            class="mt-2"
                        />
                    </div>

                    {{-- Start time --}}
                    <div>
                        <x-input-label
                            for="start_time"
                            :value="__('Start Time')"
                        />

                        <x-text-input
                            id="start_time"
                            class="block mt-1 w-full"
                            type="time"
                            name="start_time"
                           value="{{ old('start_time', $learningRequest->preferred_time ? \Carbon\Carbon::parse($learningRequest->preferred_time)->format('H:i') : '') }}"
                            required
                        />

                        <x-input-error
                            :messages="$errors->get('start_time')"
                            class="mt-2"
                        />
                    </div>

                    {{-- End time --}}
                    <div>
                        <x-input-label
                            for="end_time"
                            :value="__('End Time')"
                        />

                        <x-text-input
                            id="end_time"
                            class="block mt-1 w-full"
                            type="time"
                            name="end_time"
                            required
                        />

                        <p class="mt-1 text-sm text-gray-500">
                            Enter the expected ending time of the session.
                        </p>

                        <x-input-error
                            :messages="$errors->get('end_time')"
                            class="mt-2"
                        />
                    </div>

                    {{-- Session type --}}
                    <div>
                        <x-input-label
                            for="session_type"
                            :value="__('Session Type')"
                        />

                        <select
                            id="session_type"
                            name="session_type"
                            class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required
                        >
                            @if ($learningRequest->session_type === 'online' || $learningRequest->session_type === 'either')
                                <option
                                    value="online"
                                    @selected(old('session_type') === 'online')
                                >
                                    Online
                                </option>
                            @endif

                            @if ($learningRequest->session_type === 'in_person' || $learningRequest->session_type === 'either')
                                <option
                                    value="in_person"
                                    @selected(old('session_type') === 'in_person')
                                >
                                    In Person
                                </option>
                            @endif
                        </select>

                        <x-input-error
                            :messages="$errors->get('session_type')"
                            class="mt-2"
                        />
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-3">

                        <a
                            href="{{ route('requests.show', $learningRequest) }}"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300"
                        >
                            Cancel
                        </a>

                        <x-primary-button>
                            {{ __('Create Booking') }}
                        </x-primary-button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>