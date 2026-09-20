<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold tracking-tight text-slate-900">
                Find Tutors
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Discover people who can help you learn.
            </p>
        </div>
    </x-slot>


    <div class="min-h-screen bg-slate-50 py-10">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">


            {{-- ===================================================== --}}
            {{-- Hero --}}
            {{-- ===================================================== --}}

            <div class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-indigo-950 to-indigo-800 shadow-xl">

                <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-indigo-500/20 blur-3xl"></div>
                <div class="absolute -bottom-32 left-1/3 h-80 w-80 rounded-full bg-violet-500/10 blur-3xl"></div>

                <div class="relative px-6 py-10 sm:px-10 lg:py-12">

                    <div class="max-w-3xl">

                        <span class="inline-flex items-center rounded-full border border-white/10 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-widest text-indigo-200 backdrop-blur-sm">
                            🔎 Tutor Marketplace
                        </span>

                        <h1 class="mt-5 text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl">
                            Find someone who can help you grow.
                        </h1>

                        <p class="mt-4 max-w-2xl text-base leading-7 text-indigo-100 sm:text-lg">
                            Discover tutors based on their skills, location,
                            availability, and community reviews.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- Filters --}}
            {{-- ===================================================== --}}

            <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

                <div class="mb-5">

                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-indigo-600">
                        Refine your search
                    </p>

                    <h2 class="mt-1 text-lg font-bold text-slate-900">
                        Find the right tutor
                    </h2>

                </div>


                <form
                    method="GET"
                    action="{{ route('tutors.index') }}"
                    class="grid gap-4 md:grid-cols-3"
                >

                    {{-- Skill --}}
                    <div>

                        <label
                            for="skill"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Skill
                        </label>

                        <select
                            id="skill"
                            name="skill"
                            class="w-full rounded-xl border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                            <option value="">
                                All skills
                            </option>

                            @foreach ($skills as $skill)

                                <option
                                    value="{{ $skill->id }}"
                                    @selected(request('skill') == $skill->id)
                                >
                                    {{ $skill->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Location --}}
                    <div>

                        <label
                            for="location"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            Location
                        </label>

                        <input
                            id="location"
                            type="text"
                            name="location"
                            value="{{ request('location') }}"
                            placeholder="e.g. Yaounde"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                    </div>


                    {{-- Search --}}
                    <div class="flex items-end">

                        <button
                            type="submit"
                            class="w-full rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700"
                        >
                            Search Tutors →
                        </button>

                    </div>

                </form>


                @if (request()->filled('skill') || request()->filled('location'))

                    <div class="mt-4 flex flex-wrap items-center gap-2">

                        <span class="text-xs font-medium text-slate-500">
                            Active filters:
                        </span>

                        @if (request()->filled('skill'))

                            @php
                                $selectedSkill = $skills->firstWhere('id', request('skill'));
                            @endphp

                            @if ($selectedSkill)

                                <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                    Skill: {{ $selectedSkill->name }}
                                </span>

                            @endif

                        @endif


                        @if (request()->filled('location'))

                            <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                Location: {{ request('location') }}
                            </span>

                        @endif


                        <a
                            href="{{ route('tutors.index') }}"
                            class="text-xs font-semibold text-slate-500 hover:text-indigo-600"
                        >
                            Clear filters
                        </a>

                    </div>

                @endif

            </div>


            {{-- ===================================================== --}}
            {{-- Results --}}
            {{-- ===================================================== --}}

            <div class="mb-5 flex items-end justify-between">

                <div>

                    <p class="text-xs font-bold uppercase tracking-[0.18em] text-indigo-600">
                        Community
                    </p>

                    <h2 class="mt-1 text-2xl font-bold text-slate-900">
                        Available Tutors
                    </h2>

                </div>

                <span class="rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-slate-500 shadow-sm ring-1 ring-slate-200">
                    {{ $tutors->count() }}
                    {{ $tutors->count() === 1 ? 'tutor' : 'tutors' }}
                </span>

            </div>


            @if ($tutors->isEmpty())

                {{-- Empty state --}}
                <div class="rounded-3xl border border-slate-200 bg-white px-6 py-14 text-center shadow-sm">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-3xl">
                        🔎
                    </div>

                    <h3 class="mt-5 text-xl font-bold text-slate-900">
                        No tutors found
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        Try changing your skill or location filters
                        to discover more SkillLink tutors.
                    </p>

                    <a
                        href="{{ route('tutors.index') }}"
                        class="mt-6 inline-flex items-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700"
                    >
                        View All Tutors
                    </a>

                </div>

            @else

                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">

                    @foreach ($tutors as $tutor)

                        <div class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl">

                            {{-- Card header --}}
                            <div class="relative bg-gradient-to-br from-indigo-50 via-white to-violet-50 px-6 pb-5 pt-6">

                                <div class="flex items-start justify-between">

                                    {{-- Avatar --}}
                                    <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl bg-indigo-600 text-xl font-bold text-white shadow-sm">

                                        @if ($tutor->profile_image)

                                            <img
                                                src="{{ asset('storage/' . $tutor->profile_image) }}"
                                                alt="{{ $tutor->name }}"
                                                class="h-full w-full object-cover"
                                            >

                                        @else

                                            {{ strtoupper(substr($tutor->name, 0, 1)) }}

                                        @endif

                                    </div>


                                    {{-- Rating --}}
                                    <div class="rounded-xl bg-white px-3 py-2 text-right shadow-sm ring-1 ring-slate-100">

                                        <div class="flex items-center gap-1">

                                            <span class="text-sm">
                                                ⭐
                                            </span>

                                            <span class="font-bold text-slate-900">
                                                {{ number_format($tutor->average_rating ?? 0, 1) }}
                                            </span>

                                        </div>

                                        <p class="mt-0.5 text-[11px] text-slate-500">
                                            {{ $tutor->reviews_count ?? 0 }}
                                            {{ ($tutor->reviews_count ?? 0) === 1 ? 'review' : 'reviews' }}
                                        </p>

                                    </div>

                                </div>


                                <h3 class="mt-5 text-xl font-bold text-slate-900">
                                    {{ $tutor->name }}
                                </h3>

                                <p class="mt-1 flex items-center gap-1 text-sm text-slate-500">
                                    📍 {{ $tutor->location }}
                                </p>

                            </div>


                            {{-- Card body --}}
                            <div class="p-6">

                                @if ($tutor->bio)

                                    <p class="line-clamp-3 text-sm leading-6 text-slate-600">
                                        {{ $tutor->bio }}
                                    </p>

                                @else

                                    <p class="text-sm italic leading-6 text-slate-400">
                                        This tutor has not added a bio yet.
                                    </p>

                                @endif


                                {{-- Teaching skills --}}
                                @if ($tutor->skills->isNotEmpty())

                                    <div class="mt-5">

                                        <p class="mb-2 text-xs font-bold uppercase tracking-wider text-slate-400">
                                            Teaches
                                        </p>

                                        <div class="flex flex-wrap gap-2">

                                            @foreach ($tutor->skills->take(4) as $skill)

                                                <span class="rounded-lg bg-indigo-50 px-2.5 py-1.5 text-xs font-semibold text-indigo-700">
                                                    {{ $skill->name }}
                                                </span>

                                            @endforeach

                                        </div>

                                    </div>

                                @endif


                                {{-- Divider --}}
                                <div class="my-5 border-t border-slate-100"></div>


                                {{-- Actions --}}
                                <div class="flex gap-3">

                                    <a
                                        href="{{ route('tutors.show', $tutor) }}"
                                        class="flex-1 rounded-xl bg-slate-900 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-indigo-600"
                                    >
                                        View Profile
                                    </a>


                                    @if ($tutor->id !== auth()->id())

                                        <a
                                            href="{{ route('messages.show', $tutor) }}"
                                            class="flex items-center justify-center rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700"
                                            title="Message tutor"
                                        >
                                            💬
                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @endif


            {{-- ===================================================== --}}
            {{-- Bottom CTA --}}
            {{-- ===================================================== --}}

            <div class="mt-10 rounded-3xl border border-indigo-100 bg-indigo-50/60 p-6 sm:p-8">

                <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

                    <div>

                        <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">
                            Can't find what you need?
                        </p>

                        <h2 class="mt-1 text-xl font-bold text-slate-900">
                            Post a learning request.
                        </h2>

                        <p class="mt-1 text-sm text-slate-600">
                            Tell the community what you want to learn and let tutors come to you.
                        </p>

                    </div>


                    <a
                        href="{{ route('requests.create') }}"
                        class="inline-flex shrink-0 items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-indigo-700"
                    >
                        Post a Request →
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>