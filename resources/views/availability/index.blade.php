<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Availability
        </h2>
    </x-slot>

    <div class="bg-slate-50 min-h-screen">

        {{-- Page heading --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                    <div>
                        <p class="text-sm font-semibold text-indigo-600">
                            Tutor Schedule
                        </p>

                        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">
                            My Availability
                        </h1>

                        <p class="mt-2 text-slate-600 max-w-2xl">
                            Set the times when learners can book you for tutoring
                            sessions and keep your schedule up to date.
                        </p>
                    </div>

                    <a
                        href="{{ route('dashboard') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm hover:bg-gray-50 transition"
                    >
                        ← Dashboard
                    </a>

                </div>

            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

            {{-- Alerts --}}
            @if (session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-800">
                    <span class="text-lg">✓</span>

                    <div>
                        <p class="font-semibold">
                            Success
                        </p>

                        <p class="mt-1 text-sm">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-800">
                    <span class="text-lg">!</span>

                    <div>
                        <p class="font-semibold">
                            Something went wrong
                        </p>

                        <p class="mt-1 text-sm">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-800">
                    <p class="font-semibold">
                        Please check the following:
                    </p>

                    <ul class="mt-2 list-disc list-inside text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- Hero --}}
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-purple-600 shadow-xl">

                <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-32 right-24 h-80 w-80 rounded-full bg-purple-400/20"></div>

                <div class="relative z-10 p-8 sm:p-10 lg:p-12">

                    <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold text-white backdrop-blur">
                        <span>🗓️</span>
                        Your tutoring schedule
                    </div>

                    <div class="mt-6 max-w-2xl">

                        <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-white">
                            Make time for learning.
                        </h2>

                        <p class="mt-4 text-base sm:text-lg leading-8 text-indigo-100">
                            Let learners know when you're available to teach.
                            Add flexible time slots and keep your tutoring schedule organized.
                        </p>

                    </div>

                    <div class="mt-8 flex flex-wrap gap-4">

                        <div class="rounded-2xl border border-white/20 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-2xl font-bold text-white">
                                {{ $availabilities->count() }}
                            </p>

                            <p class="mt-1 text-sm text-indigo-100">
                                Active slots
                            </p>
                        </div>

                        <div class="rounded-2xl border border-white/20 bg-white/10 px-5 py-4 backdrop-blur">
                            <p class="text-2xl font-bold text-white">
                                7
                            </p>

                            <p class="mt-1 text-sm text-indigo-100">
                                Days available
                            </p>
                        </div>

                    </div>

                </div>
            </div>


            {{-- Main content --}}
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Add availability --}}
                <div class="lg:col-span-1">

                    <div class="rounded-3xl bg-white border border-gray-100 shadow-sm overflow-hidden">

                        <div class="border-b border-gray-100 px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-xl">
                                    ➕
                                </div>

                                <div>
                                    <h3 class="font-bold text-slate-900">
                                        Add Availability
                                    </h3>

                                    <p class="text-sm text-slate-500">
                                        Create a new time slot
                                    </p>
                                </div>

                            </div>

                        </div>

                        <div class="p-6">

                            <form
                                method="POST"
                                action="{{ route('availability.store') }}"
                                class="space-y-5"
                            >
                                @csrf

                                {{-- Day --}}
                                <div>

                                    <label
                                        for="day_of_week"
                                        class="block text-sm font-semibold text-slate-700"
                                    >
                                        Day
                                    </label>

                                    <select
                                        id="day_of_week"
                                        name="day_of_week"
                                        required
                                        class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >
                                        <option value="">Select a day</option>
                                        <option value="1">Monday</option>
                                        <option value="2">Tuesday</option>
                                        <option value="3">Wednesday</option>
                                        <option value="4">Thursday</option>
                                        <option value="5">Friday</option>
                                        <option value="6">Saturday</option>
                                        <option value="0">Sunday</option>
                                    </select>

                                </div>

                                {{-- Start --}}
                                <div>

                                    <label
                                        for="start_time"
                                        class="block text-sm font-semibold text-slate-700"
                                    >
                                        Start Time
                                    </label>

                                    <input
                                        id="start_time"
                                        name="start_time"
                                        type="time"
                                        required
                                        class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                </div>

                                {{-- End --}}
                                <div>

                                    <label
                                        for="end_time"
                                        class="block text-sm font-semibold text-slate-700"
                                    >
                                        End Time
                                    </label>

                                    <input
                                        id="end_time"
                                        name="end_time"
                                        type="time"
                                        required
                                        class="mt-2 block w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    >

                                </div>

                                <button
                                    type="submit"
                                    class="w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition"
                                >
                                    Add Availability
                                </button>

                            </form>

                        </div>

                    </div>

                    {{-- Helpful note --}}
                    <div class="mt-5 rounded-2xl border border-indigo-100 bg-indigo-50 p-5">

                        <div class="flex gap-3">

                            <span class="text-xl">
                                💡
                            </span>

                            <div>
                                <h4 class="font-semibold text-indigo-900">
                                    Keep your schedule updated
                                </h4>

                                <p class="mt-1 text-sm leading-6 text-indigo-700">
                                    Accurate availability helps learners find suitable
                                    tutoring times and improves your matching results.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- Current availability --}}
                <div class="lg:col-span-2">

                    <div class="rounded-3xl bg-white border border-gray-100 shadow-sm overflow-hidden">

                        <div class="border-b border-gray-100 px-6 py-5">

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                                <div>
                                    <h3 class="text-xl font-bold text-slate-900">
                                        Your Availability
                                    </h3>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Time slots currently visible to learners.
                                    </p>
                                </div>

                                <span class="inline-flex w-fit items-center rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700">
                                    {{ $availabilities->count() }}
                                    {{ Str::plural('slot', $availabilities->count()) }}
                                </span>

                            </div>

                        </div>

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

                            <div class="px-6 py-16 text-center">

                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-3xl">
                                    🗓️
                                </div>

                                <h3 class="mt-5 text-lg font-bold text-slate-900">
                                    No availability yet
                                </h3>

                                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                                    Add your first availability slot so learners can
                                    see when you're available for tutoring.
                                </p>

                            </div>

                        @else

                            <div class="divide-y divide-gray-100">

                                @foreach ($availabilities as $availability)

                                    <div class="p-5 sm:p-6 hover:bg-slate-50 transition">

                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                                            <div class="flex items-center gap-4">

                                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 font-bold">
                                                    {{ strtoupper(substr($days[$availability->day_of_week], 0, 1)) }}
                                                </div>

                                                <div>

                                                    <p class="font-bold text-slate-900">
                                                        {{ $days[$availability->day_of_week] }}
                                                    </p>

                                                    <p class="mt-1 text-sm text-slate-500">
                                                        {{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }}
                                                        <span class="mx-1">—</span>
                                                        {{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}
                                                    </p>

                                                </div>

                                            </div>

                                            <form
                                                method="POST"
                                                action="{{ route('availability.destroy', $availability) }}"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 transition"
                                                >
                                                    Remove
                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>