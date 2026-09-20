<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Learning Request
            </h2>

            <a
                href="{{ route('requests.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900">
                ← Back to My Requests
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 sm:p-8">

                    {{-- Header --}}
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-indigo-600">
                                {{ $learningRequest->skill->name }}
                            </p>

                            <h1 class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $learningRequest->title }}
                            </h1>
                        </div>

                        <span
                            class="inline-flex w-fit px-3 py-1 text-sm font-semibold rounded-full
                            {{ $learningRequest->status === 'open'
                                ? 'bg-green-100 text-green-800'
                                : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($learningRequest->status) }}
                        </span>
                    </div>

                    {{-- Description --}}
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-900">
                            What I want to learn
                        </h3>

                        <p class="mt-3 text-gray-700 leading-relaxed">
                            {{ $learningRequest->description }}
                        </p>
                    </div>

                    {{-- Request Details --}}
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Request Details
                        </h3>

                        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-6">

                            <div>
                                <p class="text-sm text-gray-500">Skill</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $learningRequest->skill->name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Location</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $learningRequest->location }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Session Type</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ ucwords(str_replace('_', ' ', $learningRequest->session_type)) }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Duration</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $learningRequest->duration }} minutes
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Preferred Date</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    @if($learningRequest->preferred_date)
                                    {{ $learningRequest->preferred_date->format('F j, Y') }}
                                    @else
                                    Flexible
                                    @endif
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Preferred Time</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    @if($learningRequest->preferred_time)
                                    {{ \Carbon\Carbon::parse($learningRequest->preferred_time)->format('g:i A') }}
                                    @else
                                    Flexible
                                    @endif
                                </p>
                            </div>

                        </div>
                    </div>

                    {{-- Requester --}}
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Requester
                        </h3>

                        <div class="mt-4">
                            <p class="font-medium text-gray-900">
                                {{ $learningRequest->user->name }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $learningRequest->user->location }}
                            </p>
                        </div>
                    </div>

{{-- Tutor Matches --}}
<div class="mt-8 bg-white shadow-sm sm:rounded-lg p-6">

    <h2 class="text-xl font-semibold text-gray-800">
        Potential Tutor Matches
    </h2>

    <p class="mt-1 text-sm text-gray-600">
        Tutors who teach the skill requested in this learning request.
    </p>

    @if($matchingTutors->count())

        <div class="mt-4 space-y-4">

            @foreach($matchingTutors as $tutor)

                <div class="border rounded-lg p-4">

                    <div class="flex justify-between items-start">

                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $tutor->name }}
                            </h3>

                            @if($tutor->location)
                                <p class="text-sm text-gray-500">
                                    📍 {{ $tutor->location }}
                                </p>
                            @endif
                        </div>

                        <div class="text-right">
                            <p class="text-sm text-gray-500">
                                Match score
                            </p>

                            <p class="text-xl font-bold text-indigo-600">
                                {{ $tutor->match_score }}/95
                            </p>
                        </div>

                    </div>


                    {{-- Skills --}}
                    <div class="mt-3">

                        <p class="font-medium text-gray-800">
                            Skills I Teach
                        </p>

                        <div class="flex flex-wrap gap-2 mt-1">

                            @foreach($tutor->userSkills as $userSkill)

                                <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">
                                    {{ $userSkill->skill->name }}
                                    ·
                                    {{ ucfirst($userSkill->level) }}
                                </span>

                            @endforeach

                        </div>

                    </div>


                    {{-- Rating --}}
                    <div class="mt-3">

                        @if($tutor->reviewsReceived->count())

                            <p class="text-sm text-gray-700">
                                <span class="text-yellow-500">★</span>

                                {{ number_format($tutor->reviewsReceived->avg('rating'), 1) }}/5

                                <span class="text-gray-500">
                                    ({{ $tutor->reviewsReceived->count() }}
                                    {{ Str::plural('review', $tutor->reviewsReceived->count()) }})
                                </span>
                            </p>

                        @else

                            <p class="text-sm text-gray-500">
                                No reviews yet.
                            </p>

                        @endif

                    </div>


                    {{-- Availability --}}
                    @if($tutor->availabilities->count())

                        <div class="mt-3">

                            <p class="font-medium text-gray-800">
                                Availability
                            </p>

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

                            <div class="mt-1 space-y-1">

                                @foreach($tutor->availabilities as $availability)

                                    <p class="text-sm text-gray-600">
                                        🕐
                                        {{ $days[$availability->day_of_week] }}
                                        ·
                                        {{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}
                                    </p>

                                @endforeach

                            </div>

                        </div>

                    @endif


                    {{-- Tutor profile --}}
                    <div class="mt-4">

                        <a
                            href="{{ route('tutors.show', $tutor) }}"
                            class="inline-block px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-900"
                        >
                            View Tutor Profile
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <p class="mt-4 text-gray-500">
            No tutors currently match this skill.
        </p>

    @endif

</div>

                    {{-- Incoming Offers --}}
                    @if(
                    $learningRequest->user_id === auth()->id() &&
                    $learningRequest->offers->count() > 0
                    )
                    <div class="mt-6 rounded-lg border border-green-200 bg-green-50 p-6">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Offers to Help
                        </h3>

                        <div class="mt-4 space-y-4">

                            @foreach($learningRequest->offers as $offer)

                            <div class="rounded-lg bg-white p-5 shadow-sm">

                                <div class="flex items-center justify-between">

                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            {{ $offer->tutor->name }}
                                        </p>

                                        @if($offer->tutor->location)
                                        <p class="text-sm text-gray-500">
                                            {{ $offer->tutor->location }}
                                        </p>
                                        @endif
                                    </div>

                                    <span
                                        class="rounded-full px-3 py-1 text-xs font-semibold
                                                @if($offer->status === 'pending')
                                                    bg-yellow-100 text-yellow-800
                                                @elseif($offer->status === 'accepted')
                                                    bg-green-100 text-green-800
                                                @else
                                                    bg-red-100 text-red-800
                                                @endif">
                                        {{ ucfirst($offer->status) }}
                                    </span>

                                </div>


                                {{-- Offer message --}}
                                @if($offer->message)
                                <div class="mt-4 rounded-md bg-gray-50 p-3">
                                    <p class="text-sm text-gray-700">
                                        {{ $offer->message }}
                                    </p>
                                </div>
                                @endif


                                {{-- Accept / Decline Offer --}}
                                @if($offer->status === 'pending')

                                <div class="mt-4 flex gap-3">

                                    <form
                                        method="POST"
                                        action="{{ route('requests.offer.accept', $offer) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-500">
                                            Accept
                                        </button>
                                    </form>

                                    <form
                                        method="POST"
                                        action="{{ route('requests.offer.decline', $offer) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-500">
                                            Decline
                                        </button>
                                    </form>

                                </div>

                                @endif


                                {{-- Accepted Offer --}}
                                @if($offer->status === 'accepted')

                                <div class="mt-4">

                                    @if($learningRequest->bookings->count() > 0)

                                    <span
                                        class="inline-flex items-center rounded-md bg-yellow-100 px-4 py-2 text-sm font-semibold text-yellow-800">
                                        Booking Pending
                                    </span>

                                    @else

                                    <a
                                        href="{{ route('bookings.create', $offer) }}"
                                        class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                                        Book Session
                                    </a>

                                    @endif

                                </div>

                                @endif

                            </div>

                            @endforeach

                        </div>
                    </div>
                    @endif


                    {{-- Bookings --}}
                    @if($learningRequest->bookings->count() > 0)

                    <div class="mt-6 rounded-lg border border-indigo-200 bg-indigo-50 p-6">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Booking
                        </h3>

                        <div class="mt-4 space-y-4">

                            @foreach($learningRequest->bookings as $booking)

                            <div class="rounded-lg bg-white p-5 shadow-sm">

                                <div class="flex items-center justify-between">

                                    <div>
                                        <p class="font-semibold text-gray-900">
                                            Session with {{ $booking->tutor->name }}
                                        </p>

                                        <p class="text-sm text-gray-500">
                                            {{ $booking->date->format('M d, Y') }}
                                            ·
                                            {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}
                                            -
                                            {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                                        </p>
                                    </div>

                                    <span
                                        class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">
                                        {{ ucfirst($booking->status) }}
                                    </span>

                                </div>


                                {{-- Accept Booking --}}
                                @if(
                                $booking->status === 'pending' &&
                                $booking->tutor_id === auth()->id()
                                )

                                <form
                                    method="POST"
                                    action="{{ route('bookings.accept', $booking) }}"
                                    class="mt-4">
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-500">
                                        Accept Booking
                                    </button>
                                </form>

                                @endif
                                @if($booking->status === 'accepted' && auth()->id() === $booking->student_id)
                                <form method="POST" action="{{ route('bookings.confirm', $booking) }}" class="mt-3">
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                                        Confirm Booking
                                    </button>
                                </form>
                                @endif

                                @if($booking->status === 'confirmed' &&
    (auth()->id() === $booking->student_id || auth()->id() === $booking->tutor_id))
    <form method="POST" action="{{ route('bookings.complete', $booking) }}" class="mt-3">
        @csrf
        @method('PATCH')

        <button
            type="submit"
            class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700"
        >
            Complete Booking
        </button>
    </form>
@endif

                                <div class="mt-4 text-sm text-gray-600">

                                    <p>
                                        <strong>Session type:</strong>
                                        {{ ucfirst(str_replace('_', ' ', $booking->session_type)) }}
                                    </p>

                                    <p class="mt-1">
                                        <strong>Location:</strong>
                                        {{ $learningRequest->location }}
                                    </p>

                                </div>

                            </div>

                            @endforeach

                        </div>
                    </div>

                    @endif


                    {{-- Offer to Help --}}
                    @if(
                    $learningRequest->status === 'open' &&
                    $learningRequest->user_id !== auth()->id()
                    )

                    <div class="mt-6 rounded-lg border border-blue-200 bg-blue-50 p-6">

                        <h3 class="text-lg font-semibold text-gray-900">
                            Offer to Help
                        </h3>

                        @if($existingOffer)

                        <div class="mt-4 rounded-md bg-white p-4">

                            <p class="font-medium text-gray-900">
                                You already offered to help with this request.
                            </p>

                            <p class="mt-1 text-sm text-gray-600">
                                Status:
                                <span class="font-semibold capitalize">
                                    {{ $existingOffer->status }}
                                </span>
                            </p>

                            @if($existingOffer->message)
                            <p class="mt-3 text-sm text-gray-700">
                                "{{ $existingOffer->message }}"
                            </p>
                            @endif

                        </div>

                        @else

                        <p class="mt-2 text-sm text-gray-600">
                            Think you can help? Send an offer to the person who posted
                            this request.
                        </p>

                        <form
                            method="POST"
                            action="{{ route('requests.offer', $learningRequest) }}"
                            class="mt-4">
                            @csrf

                            <div>

                                <label
                                    for="message"
                                    class="block text-sm font-medium text-gray-700">
                                    Message (optional)
                                </label>

                                <textarea
                                    id="message"
                                    name="message"
                                    rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Tell the requester how you can help...">{{ old('message') }}</textarea>

                                @error('message')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                                @enderror

                            </div>

                            <button
                                type="submit"
                                class="mt-4 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500">
                                Offer to Help
                            </button>

                        </form>

                        @endif

                    </div>

                    @endif


                    {{-- Actions --}}
                    @if($learningRequest->status === 'open')

                    <div class="mt-8 border-t border-gray-200 pt-6 flex items-center gap-3">

                        {{-- Edit --}}
                        @if($learningRequest->user_id === auth()->id())

                        <a
                            href="{{ route('requests.edit', $learningRequest) }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Edit Request
                        </a>

                        {{-- Cancel --}}
                        <form
                            method="POST"
                            action="{{ route('requests.cancel', $learningRequest) }}"
                            onsubmit="return confirm('Are you sure you want to cancel this request?');">
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                Cancel Request
                            </button>

                        </form>

                        @endif

                    </div>

                    @endif


                    {{-- Back --}}
                    <div class="mt-6">

                        <a
                            href="{{ route('requests.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                            Back
                        </a>

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>