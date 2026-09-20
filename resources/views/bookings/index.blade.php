<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Bookings
            </h2>

            <a
                href="{{ route('dashboard') }}"
                class="text-sm text-indigo-600 hover:text-indigo-800">
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

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

            @if ($bookings->isEmpty())

            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <h3 class="text-lg font-semibold text-gray-800">
                    No bookings yet
                </h3>

                <p class="mt-2 text-gray-600">
                    Your learning sessions and tutoring bookings will appear here.
                </p>

                <a
                    href="{{ route('requests.browse') }}"
                    class="inline-block mt-5 rounded-lg bg-indigo-600 px-5 py-2.5 text-white hover:bg-indigo-700">
                    Browse Learning Requests
                </a>
            </div>

            @else

            <div class="space-y-6">

                @foreach ($bookings as $booking)

                @php
                $isStudent = $booking->student_id === auth()->id();
                $otherUser = $isStudent
                ? $booking->tutor
                : $booking->student;
                @endphp

                <div class="bg-white rounded-xl shadow-sm p-6">

                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">

                        {{-- Booking information --}}
                        <div>
                            <div class="flex items-center gap-3">
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ $booking->request->title }}
                                </h3>

                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                            @if($booking->status === 'pending')
                                                bg-yellow-100 text-yellow-800
                                            @elseif($booking->status === 'accepted')
                                                bg-blue-100 text-blue-800
                                            @elseif($booking->status === 'confirmed')
                                                bg-indigo-100 text-indigo-800
                                            @elseif($booking->status === 'completed')
                                                bg-green-100 text-green-800
                                            @elseif($booking->status === 'cancelled')
                                                bg-red-100 text-red-800
                                            @endif
                                        ">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>

                            <p class="mt-2 text-sm text-gray-600">
                                Skill:
                                <span class="font-medium text-gray-800">
                                    {{ $booking->request->skill->name }}
                                </span>
                            </p>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ $isStudent ? 'Tutor' : 'Student' }}:
                                <span class="font-medium text-gray-800">
                                    {{ $otherUser->name }}
                                </span>
                            </p>
                        </div>

                        {{-- Date --}}
                        <div class="text-left md:text-right">
                            <p class="text-sm text-gray-500">
                                Session date
                            </p>

                            <p class="font-semibold text-gray-800">
                                {{ $booking->date->format('M d, Y') }}
                            </p>

                            <p class="text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}
                                -
                                {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                            </p>
                        </div>

                    </div>

                    {{-- Details --}}
                    <div class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-4 border-t pt-5">

                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-500">
                                Session Type
                            </p>

                            <p class="mt-1 font-medium text-gray-800">
                                {{ ucwords(str_replace('_', ' ', $booking->session_type)) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-500">
                                Role
                            </p>

                            <p class="mt-1 font-medium text-gray-800">
                                {{ $isStudent ? 'Learner' : 'Tutor' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide text-gray-500">
                                Reviews
                            </p>

                            <p class="mt-1 font-medium text-gray-800">
                                {{ $booking->reviews->count() }}
                            </p>
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="mt-5 flex flex-wrap gap-3">

                        <a
                            href="{{ route('requests.show', $booking->request_id) }}"
                            class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            View Request
                        </a>

                        {{-- Tutor accepts a pending booking --}}
                        @if ($booking->status === 'pending' && !$isStudent)
                        <form
                            method="POST"
                            action="{{ route('bookings.accept', $booking) }}">
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                                Accept Booking
                            </button>
                        </form>
                        @endif

                        {{-- Tutor confirms an accepted booking --}}
                        @if ($booking->status === 'accepted' && !$isStudent)
                        <form
                            method="POST"
                            action="{{ route('bookings.confirm', $booking) }}">
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                                Confirm Booking
                            </button>
                        </form>
                        @endif

                        {{-- Either participant can complete a confirmed booking --}}
                        @if ($booking->status === 'confirmed')
                        <form
                            method="POST"
                            action="{{ route('bookings.complete', $booking) }}">
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700">
                                Mark as Completed
                            </button>
                        </form>
                        @endif

                        {{-- Review completed booking --}}
                        @if ($booking->status === 'completed')
                        @php
                        $alreadyReviewed = $booking->reviews
                        ->where('reviewer_id', auth()->id())
                        ->isNotEmpty();
                        @endphp

                        @if (!$alreadyReviewed)
                        <a
                            href="{{ route('reviews.create', $booking) }}"
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                            Leave Review
                        </a>
                        @else
                        <span class="rounded-lg bg-green-100 px-4 py-2 text-sm font-medium text-green-800">
                            Review Submitted
                        </span>
                        @endif
                        @endif

                    </div>

                </div>

                @endforeach

            </div>

            @endif

        </div>
    </div>
</x-app-layout>