<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-indigo-600">
                    Tutor Marketplace
                </p>

                <h2 class="text-xl font-bold leading-tight text-gray-900">
                    Tutor Profile
                </h2>
            </div>

            <a
                href="{{ route('tutors.index') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-gray-600 transition hover:text-indigo-600"
            >
                ← Back to Tutors
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8 sm:py-10">

        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- Profile Hero --}}
            <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-gray-100">

                {{-- Cover --}}
                <div class="relative h-36 bg-gradient-to-r from-indigo-700 via-indigo-600 to-violet-600 sm:h-44">

                    <div class="absolute inset-0 opacity-20">
                        <div class="absolute -right-10 -top-16 h-48 w-48 rounded-full bg-white blur-3xl"></div>
                        <div class="absolute -bottom-20 left-20 h-48 w-48 rounded-full bg-violet-300 blur-3xl"></div>
                    </div>

                </div>

                {{-- Profile information --}}
                <div class="relative px-5 pb-6 sm:px-8">

                    <div class="-mt-14 flex flex-col gap-6 sm:-mt-16 md:flex-row md:items-end md:justify-between">

                        {{-- Identity --}}
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-end">

                            {{-- Avatar --}}
                            <div class="shrink-0">

                                @if ($tutor->profile_image)

                                    <img
                                        src="{{ asset('storage/' . $tutor->profile_image) }}"
                                        alt="{{ $tutor->name }}"
                                        class="h-28 w-28 rounded-3xl object-cover shadow-lg ring-4 ring-white sm:h-32 sm:w-32"
                                    >

                                @else

                                    <div class="flex h-28 w-28 items-center justify-center rounded-3xl bg-white shadow-lg ring-4 ring-white sm:h-32 sm:w-32">
                                        <span class="text-4xl font-bold text-indigo-600">
                                            {{ strtoupper(substr($tutor->name, 0, 1)) }}
                                        </span>
                                    </div>

                                @endif

                            </div>

                            {{-- Name --}}
                            <div class="pb-1">

                                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                                    {{ $tutor->name }}
                                </h1>

                                <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-gray-500">

                                    <span class="inline-flex items-center gap-1.5">
                                        📍
                                        {{ $tutor->location ?: 'Location not provided' }}
                                    </span>

                                    <span class="inline-flex items-center gap-1.5">
                                        🎓
                                        Tutor
                                    </span>

                                </div>

                            </div>

                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-wrap gap-3">

                            @if ($tutor->id !== auth()->id())

                                <a
                                    href="{{ route('messages.show', $tutor) }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 hover:shadow-md"
                                >
                                    💬 Message Tutor
                                </a>

                            @endif

                            <a
                                href="{{ route('tutors.index') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-50"
                            >
                                Browse Tutors
                            </a>

                        </div>

                    </div>

                    {{-- Rating --}}
                    <div class="mt-7 flex flex-wrap items-center gap-4 border-t border-gray-100 pt-5">

                        @if ($averageRating)

                            <div class="flex items-center gap-2">

                                <div class="flex items-center gap-1 rounded-full bg-amber-50 px-3 py-1.5">
                                    <span class="text-lg text-amber-500">★</span>

                                    <span class="font-bold text-gray-900">
                                        {{ number_format($averageRating, 1) }}
                                    </span>

                                    <span class="text-sm text-gray-500">
                                        / 5
                                    </span>
                                </div>

                                <span class="text-sm text-gray-500">
                                    {{ $tutor->reviewsReceived->count() }}
                                    {{ Str::plural('review', $tutor->reviewsReceived->count()) }}
                                </span>

                            </div>

                        @else

                            <div class="flex items-center gap-2">

                                <div class="rounded-full bg-gray-100 px-3 py-1.5">
                                    <span class="text-sm font-semibold text-gray-500">
                                        No rating yet
                                    </span>
                                </div>

                                <span class="text-sm text-gray-500">
                                    Be the first to leave a review
                                </span>

                            </div>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Main content --}}
            <div class="mt-6 grid gap-6 lg:grid-cols-3">

                {{-- Left column --}}
                <div class="space-y-6 lg:col-span-2">

                    {{-- About --}}
                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 sm:p-7">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                                👋
                            </div>

                            <div>
                                <h2 class="text-lg font-bold text-gray-900">
                                    About {{ $tutor->name }}
                                </h2>

                                <p class="text-sm text-gray-500">
                                    Get to know your potential tutor
                                </p>
                            </div>

                        </div>

                        @if ($tutor->bio)

                            <p class="mt-5 leading-7 text-gray-600">
                                {{ $tutor->bio }}
                            </p>

                        @else

                            <p class="mt-5 italic text-gray-500">
                                This tutor has not added a bio yet.
                            </p>

                        @endif

                    </div>


                    {{-- Teaching Skills --}}
                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 sm:p-7">

                        <div class="flex items-center justify-between">

                            <div>
                                <h2 class="text-lg font-bold text-gray-900">
                                    Skills I Teach
                                </h2>

                                <p class="mt-1 text-sm text-gray-500">
                                    Areas where {{ $tutor->name }} can help you learn
                                </p>
                            </div>

                            <div class="hidden rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 sm:block">
                                {{ $tutor->userSkills->count() }}
                                {{ Str::plural('skill', $tutor->userSkills->count()) }}
                            </div>

                        </div>


                        @if ($tutor->userSkills->isEmpty())

                            <div class="mt-5 rounded-xl border border-dashed border-gray-200 bg-gray-50 p-5 text-center">
                                <p class="text-sm text-gray-500">
                                    No teaching skills added yet.
                                </p>
                            </div>

                        @else

                            <div class="mt-5 grid gap-4 sm:grid-cols-2">

                                @foreach ($tutor->userSkills as $userSkill)

                                    <div class="rounded-xl border border-gray-200 bg-gray-50 p-4 transition hover:border-indigo-200 hover:bg-indigo-50/40">

                                        <div class="flex items-start justify-between gap-3">

                                            <div class="min-w-0">

                                                <h3 class="font-semibold text-gray-900">
                                                    {{ $userSkill->skill->name }}
                                                </h3>

                                                @if ($userSkill->skill->category)

                                                    <p class="mt-1 text-xs text-gray-500">
                                                        {{ $userSkill->skill->category }}
                                                    </p>

                                                @endif

                                            </div>

                                            <span class="shrink-0 rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">
                                                {{ ucfirst($userSkill->level) }}
                                            </span>

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>


                    {{-- Reviews --}}
                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100 sm:p-7">

                        <div class="flex items-center justify-between">

                            <div>
                                <h2 class="text-lg font-bold text-gray-900">
                                    Community Reviews
                                </h2>

                                <p class="mt-1 text-sm text-gray-500">
                                    What learners say about this tutor
                                </p>
                            </div>

                            @if ($averageRating)

                                <div class="hidden items-center gap-1 sm:flex">
                                    <span class="text-xl text-amber-500">★</span>

                                    <span class="font-bold text-gray-900">
                                        {{ number_format($averageRating, 1) }}
                                    </span>
                                </div>

                            @endif

                        </div>


                        @if ($tutor->reviewsReceived->isEmpty())

                            <div class="mt-6 rounded-xl border border-dashed border-gray-200 bg-gray-50 p-6 text-center">

                                <div class="text-3xl">
                                    ⭐
                                </div>

                                <p class="mt-2 font-medium text-gray-700">
                                    No reviews yet
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Reviews will appear here after completed sessions.
                                </p>

                            </div>

                        @else

                            <div class="mt-6 space-y-5">

                                @foreach ($tutor->reviewsReceived as $review)

                                    <div class="rounded-xl border border-gray-100 bg-gray-50 p-5">

                                        <div class="flex items-start justify-between gap-4">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-700">
                                                    {{ strtoupper(substr($review->reviewer->name, 0, 1)) }}
                                                </div>

                                                <div>

                                                    <p class="font-semibold text-gray-900">
                                                        {{ $review->reviewer->name }}
                                                    </p>

                                                    <p class="text-xs text-gray-500">
                                                        {{ $review->created_at->format('M d, Y') }}
                                                    </p>

                                                </div>

                                            </div>

                                            <div class="shrink-0 rounded-full bg-amber-50 px-3 py-1 text-sm font-semibold text-amber-600">
                                                ★ {{ $review->rating }}/5
                                            </div>

                                        </div>

                                        @if ($review->comment)

                                            <p class="mt-4 leading-6 text-gray-600">
                                                "{{ $review->comment }}"
                                            </p>

                                        @endif

                                    </div>

                                @endforeach

                            </div>

                        @endif

                    </div>

                </div>


                {{-- Right column --}}
                <div class="space-y-6">

                    {{-- Availability --}}
                    <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                🕐
                            </div>

                            <div>
                                <h2 class="font-bold text-gray-900">
                                    Availability
                                </h2>

                                <p class="text-xs text-gray-500">
                                    When this tutor is available
                                </p>
                            </div>

                        </div>


                        @if ($tutor->availabilities->count())

                            <div class="mt-5 space-y-3">

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

                                @foreach ($tutor->availabilities as $availability)

                                    <div class="flex items-center justify-between rounded-xl bg-gray-50 px-4 py-3">

                                        <span class="text-sm font-medium text-gray-700">
                                            {{ $days[$availability->day_of_week] }}
                                        </span>

                                        <span class="text-sm font-semibold text-indigo-600">
                                            {{ \Carbon\Carbon::parse($availability->start_time)->format('g:i A') }}
                                            –
                                            {{ \Carbon\Carbon::parse($availability->end_time)->format('g:i A') }}
                                        </span>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="mt-5 rounded-xl bg-gray-50 p-4 text-center">

                                <p class="text-sm text-gray-500">
                                    No availability listed.
                                </p>

                            </div>

                        @endif

                    </div>


                    {{-- Quick summary --}}
                    <div class="rounded-2xl bg-gradient-to-br from-indigo-600 to-violet-700 p-6 text-white shadow-lg">

                        <p class="text-sm font-medium text-indigo-100">
                            Ready to learn?
                        </p>

                        <h2 class="mt-2 text-xl font-bold">
                            Connect with {{ $tutor->name }}
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-indigo-100">
                            Send a message to discuss what you want to learn and find a suitable session.
                        </p>

                        @if ($tutor->id !== auth()->id())

                            <a
                                href="{{ route('messages.show', $tutor) }}"
                                class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-white px-4 py-3 text-sm font-bold text-indigo-700 transition hover:bg-indigo-50"
                            >
                                💬 Start a Conversation
                            </a>

                        @endif

                    </div>

                </div>

            </div>


            {{-- Bottom CTA --}}
            <div class="mt-8 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                <div class="flex flex-col items-start justify-between gap-5 p-6 sm:flex-row sm:items-center sm:p-7">

                    <div>
                        <h2 class="text-lg font-bold text-gray-900">
                            Looking for someone else?
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Browse more tutors and find someone who matches your learning goals.
                        </p>
                    </div>

                    <a
                        href="{{ route('tutors.index') }}"
                        class="inline-flex shrink-0 items-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                    >
                        Find More Tutors →
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>