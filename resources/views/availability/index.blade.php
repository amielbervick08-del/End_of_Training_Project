<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Availability
            </h2>

            <a
                href="{{ route('dashboard') }}"
                class="text-sm text-indigo-600 hover:text-indigo-800"
            >
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error message --}}
            @if (session('error'))
                <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-800">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Add availability --}}
            <div class="bg-white rounded-xl shadow-sm p-6">

                <h3 class="text-lg font-semibold text-gray-800">
                    Add Availability
                </h3>

                <p class="mt-1 text-sm text-gray-600">
                    Tell learners when you are available for tutoring sessions.
                </p>

                <form
                    method="POST"
                    action="{{ route('availability.store') }}"
                    class="mt-6"
                >
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        {{-- Day --}}
                        <div>
                            <label
                                for="day_of_week"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Day
                            </label>

                            <select
                                id="day_of_week"
                                name="day_of_week"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >
                                <option value="">Select day</option>
                                <option value="1">Monday</option>
                                <option value="2">Tuesday</option>
                                <option value="3">Wednesday</option>
                                <option value="4">Thursday</option>
                                <option value="5">Friday</option>
                                <option value="6">Saturday</option>
                                <option value="0">Sunday</option>
                            </select>
                        </div>

                        {{-- Start time --}}
                        <div>
                            <label
                                for="start_time"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Start Time
                            </label>

                            <input
                                id="start_time"
                                name="start_time"
                                type="time"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >
                        </div>

                        {{-- End time --}}
                        <div>
                            <label
                                for="end_time"
                                class="block text-sm font-medium text-gray-700"
                            >
                                End Time
                            </label>

                            <input
                                id="end_time"
                                name="end_time"
                                type="time"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >
                        </div>

                    </div>

                    <button
                        type="submit"
                        class="mt-5 rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-700"
                    >
                        Add Availability
                    </button>
                </form>

            </div>

            {{-- Current availability --}}
            <div class="mt-6 bg-white rounded-xl shadow-sm p-6">

                <h3 class="text-lg font-semibold text-gray-800">
                    My Availability
                </h3>

                @php
                    $days = [
                        0 => 'Sunday',
                        1 => 'Monday',
                        2 => 'Tuesday',
                        3 => 'Wednesday',
                        4 => 'Thursday',
                        5 => 'Friday',
                        6 => 'Saturday',
                    ];
                @endphp

                @if ($availabilities->isEmpty())

                    <p class="mt-4 text-gray-500">
                        No availability slots added yet.
                    </p>

                @else

                    <div class="mt-4 space-y-3">

                        @foreach ($availabilities as $availability)

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border border-gray-200 rounded-lg p-4">

                                <div>
                                    <p class="font-medium text-gray-800">
                                        {{ $days[$availability->day_of_week] }}
                                    </p>

                                    <p class="text-sm text-gray-600">
                                        {{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}
                                    </p>
                                </div>

                                <form
                                    method="POST"
                                    action="{{ route('availability.destroy', $availability) }}"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-lg border border-red-300 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50"
                                    >
                                        Remove
                                    </button>
                                </form>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>
    </div>
</x-app-layout>