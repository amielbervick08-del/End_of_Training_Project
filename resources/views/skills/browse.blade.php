<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold tracking-tight text-slate-900">
                    Browse Skills
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Discover skills and find people who can teach them.
                </p>
            </div>

            <a
                href="{{ route('home') }}"
                class="hidden text-sm font-medium text-indigo-600 transition hover:text-indigo-800 sm:inline-flex"
            >
                ← Back to Home
            </a>
        </div>
    </x-slot>


    <div class="min-h-screen bg-slate-50 py-10">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- ===================================================== --}}
            {{-- Page introduction --}}
            {{-- ===================================================== --}}

            <div class="mb-10 text-center">

                <span class="inline-flex items-center rounded-full bg-indigo-50 px-4 py-2 text-sm font-semibold text-indigo-600">
                    ✨ Explore & Learn
                </span>

                <h1 class="mt-5 text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">
                    Discover your next skill.
                </h1>

                <p class="mx-auto mt-4 max-w-2xl text-base leading-7 text-slate-500 sm:text-lg">
                    Explore skills available on SkillLink and connect with
                    people who can help you learn, practice, and grow.
                </p>

            </div>


            {{-- ===================================================== --}}
            {{-- Skills --}}
            {{-- ===================================================== --}}

            @if ($skills->isEmpty())

                <div class="rounded-3xl border border-slate-200 bg-white p-12 text-center shadow-sm">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-3xl">
                        🎓
                    </div>

                    <h2 class="mt-5 text-xl font-bold text-slate-900">
                        No skills available yet
                    </h2>

                    <p class="mt-2 text-sm text-slate-500">
                        New skills will appear here as they are added to SkillLink.
                    </p>

                </div>

            @else

                @foreach ($skills->groupBy('category') as $category => $categorySkills)

                    <section class="mb-12">

                        {{-- Category heading --}}
                        <div class="mb-5 flex items-end justify-between">

                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-600">
                                    Category
                                </p>

                                <h2 class="mt-1 text-2xl font-bold text-slate-900">
                                    {{ $category }}
                                </h2>
                            </div>

                            <span class="rounded-full bg-white px-3 py-1 text-xs font-semibold text-slate-500 shadow-sm ring-1 ring-slate-200">
                                {{ $categorySkills->count() }}
                                {{ $categorySkills->count() === 1 ? 'skill' : 'skills' }}
                            </span>

                        </div>


                        {{-- Skill cards --}}
                        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                            @foreach ($categorySkills as $skill)

                                <div
                                    class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl"
                                >

                                    {{-- Decorative background --}}
                                    <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-indigo-50 opacity-0 transition duration-300 group-hover:opacity-100"></div>


                                    <div class="relative">

                                        {{-- Icon --}}
                                        <div class="flex items-center justify-between">

                                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-2xl transition group-hover:bg-indigo-100">
                                                @switch($skill->category)
                                                    @case('Programming')
                                                        💻
                                                        @break

                                                    @case('Design')
                                                        🎨
                                                        @break

                                                    @case('Languages')
                                                        🌍
                                                        @break

                                                    @case('Creative')
                                                        🎬
                                                        @break

                                                    @case('Business')
                                                        📈
                                                        @break

                                                    @default
                                                        🎓
                                                @endswitch
                                            </div>

                                            <span class="text-slate-300 transition group-hover:text-indigo-500">
                                                ↗
                                            </span>

                                        </div>


                                        {{-- Skill information --}}
                                        <h3 class="mt-6 text-xl font-bold text-slate-900">
                                            {{ $skill->name }}
                                        </h3>

                                        @if ($skill->description)

                                            <p class="mt-2 min-h-[48px] text-sm leading-6 text-slate-500">
                                                {{ $skill->description }}
                                            </p>

                                        @else

                                            <p class="mt-2 min-h-[48px] text-sm leading-6 text-slate-400">
                                                Learn this skill from people in the SkillLink community.
                                            </p>

                                        @endif


                                        {{-- Action --}}
                                        <div class="mt-6">

                                            <a
                                                href="{{ route('tutors.index', ['skill' => $skill->id]) }}"
                                                class="inline-flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-indigo-600"
                                            >
                                                Find Tutors
                                                <span class="ml-2 transition group-hover:translate-x-1">
                                                    →
                                                </span>
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </section>

                @endforeach

            @endif


            {{-- ===================================================== --}}
            {{-- Bottom CTA --}}
            {{-- ===================================================== --}}

            <div class="mt-4 overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 to-violet-600 shadow-xl">

                <div class="relative px-6 py-10 text-center sm:px-10">

                    <div class="absolute -left-16 -top-20 h-48 w-48 rounded-full bg-white/10"></div>
                    <div class="absolute -bottom-24 -right-10 h-56 w-56 rounded-full bg-white/10"></div>

                    <div class="relative">

                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-white/15 text-2xl">
                            🚀
                        </div>

                        <h2 class="mt-5 text-2xl font-bold text-white sm:text-3xl">
                            Ready to start learning?
                        </h2>

                        <p class="mx-auto mt-3 max-w-xl text-sm leading-6 text-indigo-100 sm:text-base">
                            Find someone who knows what you want to learn
                            and start building your skills today.
                        </p>

                        <div class="mt-6">

                            <a
                                href="{{ route('tutors.index') }}"
                                class="inline-flex items-center rounded-xl bg-white px-6 py-3 text-sm font-bold text-indigo-700 shadow-sm transition hover:bg-indigo-50"
                            >
                                Find a Tutor →
                            </a>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Mobile back link --}}
            <div class="mt-6 text-center sm:hidden">

                <a
                    href="{{ route('home') }}"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-800"
                >
                    ← Back to Home
                </a>

            </div>

        </div>

    </div>

</x-app-layout>