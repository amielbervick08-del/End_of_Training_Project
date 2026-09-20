<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <p class="text-sm font-medium text-indigo-600">
                    Learning Hub
                </p>

                <h2 class="text-xl font-bold leading-tight text-gray-900">
                    My Learning Requests
                </h2>
            </div>

            <a
                href="{{ route('requests.create') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 hover:shadow-md"
            >
                + Post a Request
            </a>

        </div>
    </x-slot>


    <div class="min-h-screen bg-slate-50 py-8 sm:py-10">

        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if (session('success'))

                <div class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800 shadow-sm">

                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100">
                        ✓
                    </div>

                    <div>
                        <p class="font-semibold">
                            Success
                        </p>

                        <p class="mt-0.5 text-sm">
                            {{ session('success') }}
                        </p>
                    </div>

                </div>

            @endif


            {{-- Page hero --}}
            <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-700 via-indigo-600 to-violet-600 p-6 text-white shadow-lg sm:p-8">

                <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

                    <div class="max-w-2xl">

                        <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-xs font-semibold text-indigo-100 ring-1 ring-white/20">
                            🎯 Your Learning Goals
                        </div>

                        <h1 class="text-2xl font-bold tracking-tight sm:text-3xl">
                            Find the right person to help you learn.
                        </h1>

                        <p class="mt-3 max-w-xl text-sm leading-6 text-indigo-100 sm:text-base">
                            Create and manage learning requests, connect with tutors,
                            and turn your learning goals into real progress.
                        </p>

                    </div>


                    <div class="hidden shrink-0 md:block">

                        <div class="flex h-24 w-24 items-center justify-center rounded-3xl bg-white/10 text-5xl ring-1 ring-white/20">
                            📚
                        </div>

                    </div>

                </div>

            </div>


            {{-- Section heading --}}
            <div class="mb-5 flex items-end justify-between gap-4">

                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        Your Requests
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        View and manage the skills you want to learn.
                    </p>
                </div>

                @if (!$requests->isEmpty())

                    <div class="hidden rounded-full bg-indigo-50 px-3 py-1.5 text-xs font-semibold text-indigo-700 sm:block">
                        {{ $requests->count() }}
                        {{ Str::plural('request', $requests->count()) }}
                    </div>

                @endif

            </div>


            {{-- Empty state --}}
            @if ($requests->isEmpty())

                <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                    <div class="flex flex-col items-center px-6 py-14 text-center">

                        <div class="flex h-20 w-20 items-center justify-center rounded-3xl bg-indigo-50 text-4xl">
                            🎯
                        </div>

                        <h3 class="mt-6 text-xl font-bold text-gray-900">
                            No learning requests yet
                        </h3>

                        <p class="mt-2 max-w-md text-sm leading-6 text-gray-500">
                            Tell the SkillLink community what you want to learn
                            and let tutors come to you.
                        </p>

                        <a
                            href="{{ route('requests.create') }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                        >
                            + Post Your First Request
                        </a>

                    </div>

                </div>

            @else

                {{-- Request cards --}}
                <div class="space-y-5">

                    @foreach ($requests as $request)

                        <div class="group overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 transition hover:-translate-y-0.5 hover:shadow-md">

                            <div class="p-5 sm:p-6">

                                {{-- Card top --}}
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                    <div class="min-w-0">

                                        <div class="flex flex-wrap items-center gap-2">

                                            <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                                {{ $request->skill->name }}
                                            </span>

                                            <span
                                                class="rounded-full px-3 py-1 text-xs font-semibold
                                                {{ $request->status === 'open'
                                                    ? 'bg-emerald-50 text-emerald-700'
                                                    : 'bg-gray-100 text-gray-600' }}"
                                            >
                                                {{ ucfirst($request->status) }}
                                            </span>

                                        </div>

                                        <h3 class="mt-3 text-xl font-bold text-gray-900 transition group-hover:text-indigo-600">
                                            {{ $request->title }}
                                        </h3>

                                    </div>


                                    <div class="shrink-0 text-sm text-gray-400">
                                        #{{ $request->id }}
                                    </div>

                                </div>


                                {{-- Description --}}
                                <p class="mt-4 line-clamp-2 leading-6 text-gray-600">
                                    {{ $request->description }}
                                </p>


                                {{-- Request details --}}
                                <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4">

                                    {{-- Location --}}
                                    <div class="rounded-xl bg-gray-50 p-4">

                                        <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wide text-gray-400">
                                            📍 Location
                                        </div>

                                        <p class="mt-1.5 text-sm font-semibold text-gray-800">
                                            {{ $request->location }}
                                        </p>

                                    </div>


                                    {{-- Session --}}
                                    <div class="rounded-xl bg-gray-50 p-4">

                                        <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wide text-gray-400">
                                            💻 Session
                                        </div>

                                        <p class="mt-1.5 text-sm font-semibold text-gray-800">
                                            {{ ucwords(str_replace('_', ' ', $request->session_type)) }}
                                        </p>

                                    </div>


                                    {{-- Duration --}}
                                    <div class="rounded-xl bg-gray-50 p-4">

                                        <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wide text-gray-400">
                                            ⏱ Duration
                                        </div>

                                        <p class="mt-1.5 text-sm font-semibold text-gray-800">
                                            {{ $request->duration }} minutes
                                        </p>

                                    </div>


                                    {{-- Preferred time --}}
                                    <div class="rounded-xl bg-gray-50 p-4">

                                        <div class="flex items-center gap-2 text-xs font-medium uppercase tracking-wide text-gray-400">
                                            📅 Preferred Time
                                        </div>

                                        <p class="mt-1.5 text-sm font-semibold text-gray-800">

                                            @if ($request->preferred_date)
                                                {{ $request->preferred_date->format('M d, Y') }}
                                            @else
                                                Flexible
                                            @endif

                                            @if ($request->preferred_time)
                                                <span class="block text-xs font-medium text-gray-500">
                                                    {{ \Carbon\Carbon::parse($request->preferred_time)->format('g:i A') }}
                                                </span>
                                            @endif

                                        </p>

                                    </div>

                                </div>


                                {{-- Footer --}}
                                <div class="mt-6 flex flex-col gap-3 border-t border-gray-100 pt-5 sm:flex-row sm:items-center sm:justify-between">

                                    <div class="text-xs text-gray-400">
                                        Posted {{ $request->created_at->diffForHumans() }}
                                    </div>

                                    <a
                                        href="{{ route('requests.show', $request) }}"
                                        class="inline-flex items-center justify-center rounded-xl bg-indigo-50 px-4 py-2.5 text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100"
                                    >
                                        View Request →
                                    </a>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif


            {{-- Bottom CTA --}}
            @if (!$requests->isEmpty())

                <div class="mt-8 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-100">

                    <div class="flex flex-col gap-5 p-6 sm:flex-row sm:items-center sm:justify-between sm:p-7">

                        <div>

                            <h2 class="text-lg font-bold text-gray-900">
                                Want to learn something new?
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Post another request and let the SkillLink community help you.
                            </p>

                        </div>

                        <a
                            href="{{ route('requests.create') }}"
                            class="inline-flex shrink-0 items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                        >
                            + Post a Request
                        </a>

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>