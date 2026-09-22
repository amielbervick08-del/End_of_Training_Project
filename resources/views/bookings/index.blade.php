<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-600">
                    Learning Sessions
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    My Bookings
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Manage your upcoming and completed learning sessions.
                </p>
            </div>

            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
            >
                ← Dashboard
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10">

        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-800">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100">
                            ✓
                        </span>

                        {{ session('success') }}
                    </div>
                </div>
            @endif

            {{-- Error message --}}
            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-medium text-red-800">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100">
                            !
                        </span>

                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if ($bookings->isEmpty())

                {{-- Empty state --}}
                <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                    <div class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-600 to-purple-600 px-6 py-12 text-center sm:px-10">

                        <div class="absolute -right-16 -top-16 h-40 w-40 rounded-full bg-white/10"></div>
                        <div class="absolute -bottom-20 -left-16 h-48 w-48 rounded-full bg-white/10"></div>

                        <div class="relative mx-auto max-w-2xl">

                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white/15 text-3xl shadow-lg ring-1 ring-white/20">
                                📅
                            </div>

                            <h1 class="mt-6 text-3xl font-bold text-white">
                                No bookings yet
                            </h1>

                            <p class="mx-auto mt-3 max-w-xl text-base leading-7 text-indigo-100">
                                Your learning sessions and tutoring bookings will appear here once you connect with another SkillLink member.
                            </p>

                            <a
                                href="{{ route('requests.browse') }}"
                                class="mt-7 inline-flex items-center rounded-xl bg-white px-6 py-3 text-sm font-bold text-indigo-700 shadow-lg transition hover:bg-indigo-50"
                            >
                                Browse Learning Requests
                                <span class="ml-2">→</span>
                            </a>

                        </div>
                    </div>

                    <div class="grid gap-4 p-6 sm:grid-cols-3">

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <div class="text-2xl">🔎</div>
                            <h3 class="mt-3 font-semibold text-gray-900">
                                Find opportunities
                            </h3>
                            <p class="mt-1 text-sm leading-6 text-gray-500">
                                Browse students who are looking for help.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <div class="text-2xl">🤝</div>
                            <h3 class="mt-3 font-semibold text-gray-900">
                                Connect
                            </h3>
                            <p class="mt-1 text-sm leading-6 text-gray-500">
                                Offer your skills and connect with learners.
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-50 p-5">
                            <div class="text-2xl">📚</div>
                            <h3 class="mt-3 font-semibold text-gray-900">
                                Learn together
                            </h3>
                            <p class="mt-1 text-sm leading-6 text-gray-500">
                                Turn successful matches into learning sessions.
                            </p>
                        </div>

                    </div>
                </div>

            @else

                {{-- Page introduction --}}
                <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-purple-600 shadow-lg">

                    <div class="relative px-6 py-8 sm:px-8 sm:py-10">

                        <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-white/10"></div>
                        <div class="absolute -bottom-24 right-24 h-56 w-56 rounded-full bg-white/5"></div>

                        <div class="relative flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

                            <div class="max-w-2xl">

                                <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-white ring-1 ring-white/20">
                                    📅
                                    Your learning journey
                                </div>

                                <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                                    Manage your bookings.
                                </h1>

                                <p class="mt-3 text-base leading-7 text-indigo-100">
                                    Keep track of your tutoring sessions, learning appointments,
                                    and completed experiences in one place.
                                </p>

                            </div>

                            <div class="flex-shrink-0 rounded-2xl bg-white/10 px-6 py-5 text-center ring-1 ring-white/20 backdrop-blur-sm">

                                <p class="text-3xl font-bold text-white">
                                    {{ $bookings->count() }}
                                </p>

                                <p class="mt-1 text-sm font-medium text-indigo-100">
                                    {{ $bookings->count() === 1 ? 'Booking' : 'Bookings' }}
                                </p>

                            </div>

                        </div>
                    </div>
                </div>

                {{-- Booking list --}}
                <div class="space-y-6">

                    @foreach ($bookings as $booking)

                        @php
                            $isStudent = $booking->student_id === auth()->id();

                            $otherUser = $isStudent
                                ? $booking->tutor
                                : $booking->student;

                            $statusClasses = match ($booking->status) {
                                'pending' => 'bg-amber-50 text-amber-700 ring-amber-200',
                                'accepted' => 'bg-blue-50 text-blue-700 ring-blue-200',
                                'confirmed' => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
                                'completed' => 'bg-green-50 text-green-700 ring-green-200',
                                'cancelled' => 'bg-red-50 text-red-700 ring-red-200',
                                default => 'bg-gray-50 text-gray-700 ring-gray-200',
                            };

                            $statusIcon = match ($booking->status) {
                                'pending' => '⏳',
                                'accepted' => '✓',
                                'confirmed' => '📌',
                                'completed' => '✓',
                                'cancelled' => '×',
                                default => '•',
                            };
                        @endphp

                        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                            {{-- Card header --}}
                            <div class="border-b border-gray-100 px-6 py-6 sm:px-8">

                                <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

                                    <div class="min-w-0">

                                        <div class="flex flex-wrap items-center gap-3">

                                            <span class="rounded-lg bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-700">
                                                {{ $booking->request->skill->name }}
                                            </span>

                                            <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $statusClasses }}">
                                                <span>{{ $statusIcon }}</span>
                                                {{ ucfirst($booking->status) }}
                                            </span>

                                        </div>

                                        <h3 class="mt-4 text-xl font-bold text-gray-900">
                                            {{ $booking->request->title }}
                                        </h3>

                                        <p class="mt-2 text-sm text-gray-500">
                                            {{ $isStudent ? 'Your tutor' : 'Your learner' }}:
                                            <span class="font-semibold text-gray-800">
                                                {{ $otherUser->name }}
                                            </span>
                                        </p>

                                    </div>

                                    {{-- Date and time --}}
                                    <div class="flex-shrink-0 rounded-2xl bg-slate-50 px-5 py-4 lg:min-w-[210px]">

                                        <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                            Session
                                        </p>

                                        <p class="mt-1 text-lg font-bold text-gray-900">
                                            {{ $booking->date->format('M d, Y') }}
                                        </p>

                                        <p class="mt-1 text-sm font-medium text-gray-600">
                                            {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}
                                            –
                                            {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                                        </p>

                                    </div>

                                </div>
                            </div>

                            {{-- Booking details --}}
                            <div class="grid gap-4 px-6 py-6 sm:grid-cols-3 sm:px-8">

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                        Session Type
                                    </p>

                                    <p class="mt-2 font-semibold text-gray-900">
                                        {{ ucwords(str_replace('_', ' ', $booking->session_type)) }}
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                        Your Role
                                    </p>

                                    <p class="mt-2 font-semibold text-gray-900">
                                        {{ $isStudent ? 'Learner' : 'Tutor' }}
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-slate-50 p-4">
                                    <p class="text-xs font-bold uppercase tracking-wider text-gray-400">
                                        Reviews
                                    </p>

                                    <p class="mt-2 font-semibold text-gray-900">
                                        {{ $booking->reviews->count() }}
                                        {{ $booking->reviews->count() === 1 ? 'review' : 'reviews' }}
                                    </p>
                                </div>

                            </div>

                            {{-- Actions --}}
                            <div class="flex flex-wrap items-center gap-3 border-t border-gray-100 bg-gray-50/70 px-6 py-5 sm:px-8">

                                <a
                                    href="{{ route('requests.show', $booking->request_id) }}"
                                    class="inline-flex items-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                                >
                                    View Request
                                    <span class="ml-2">→</span>
                                </a>

                                {{-- Tutor accepts pending booking --}}
                                @if ($booking->status === 'pending' && !$isStudent)

                                    <form
                                        method="POST"
                                        action="{{ route('bookings.accept', $booking) }}"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-blue-700"
                                        >
                                            ✓ Accept Booking
                                        </button>
                                    </form>

                                @endif

                                {{-- Tutor confirms accepted booking --}}
                                @if ($booking->status === 'accepted' && !$isStudent)

                                    <form
                                        method="POST"
                                        action="{{ route('bookings.confirm', $booking) }}"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-700"
                                        >
                                            📌 Confirm Booking
                                        </button>
                                    </form>

                                @endif

                                {{-- Complete confirmed booking --}}
                                @if ($booking->status === 'confirmed')

                                    <form
                                        method="POST"
                                        action="{{ route('bookings.complete', $booking) }}"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center rounded-xl bg-green-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-green-700"
                                        >
                                            ✓ Mark as Completed
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
                                            class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-700"
                                        >
                                            ★ Leave Review
                                        </a>

                                    @else

                                        <span class="inline-flex items-center rounded-xl bg-green-100 px-4 py-2.5 text-sm font-bold text-green-800">
                                            ✓ Review Submitted
                                        </span>

                                    @endif

                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

                {{-- Bottom CTA --}}
                <div class="mt-10 rounded-3xl border border-indigo-100 bg-indigo-50 px-6 py-8 sm:px-8">

                    <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

                        <div>
                            <p class="text-sm font-bold uppercase tracking-wider text-indigo-600">
                                Keep learning
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-gray-900">
                                Looking for your next learning opportunity?
                            </h3>

                            <p class="mt-2 text-sm text-gray-600">
                                Browse open requests from students and find a session that matches your skills.
                            </p>
                        </div>

                        <a
                            href="{{ route('requests.browse') }}"
                            class="inline-flex flex-shrink-0 items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700"
                        >
                            Browse Requests
                            <span class="ml-2">→</span>
                        </a>

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>