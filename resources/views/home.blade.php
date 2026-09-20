<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta
        name="description"
        content="{{ __('SkillLink connects people who want to learn with people who can teach. Find a tutor, share your skills, and grow together.') }}">

    <meta property="og:title" content="SkillLink">

    <meta
        property="og:description"
        content="{{ __('Learn new skills from people around you.') }}">

    <meta property="og:type" content="website">

    <title>SkillLink — Learn. Teach. Connect.</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-slate-50 text-gray-900 antialiased">

    {{-- =========================================================
        HERO
    ========================================================== --}}

    <section class="relative min-h-screen overflow-hidden">

        {{-- Background video --}}
        <video
            autoplay
            muted
            loop
            playsinline
            preload="metadata"
            poster=""
            class="absolute inset-0 h-full w-full object-cover"
            aria-hidden="true">
            <source src="{{ asset('videos/skilllink-hero.mp4') }}" type="video/mp4">
        </video>

        {{-- Dark overlay --}}
        <div class="absolute inset-0 bg-slate-950/70"></div>

        {{-- Gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-950/80 via-slate-900/50 to-blue-950/70"></div>

        {{-- Decorative glow --}}
        <div class="absolute -left-32 top-32 h-96 w-96 rounded-full bg-indigo-500/20 blur-3xl"></div>

        <div class="absolute -right-32 bottom-20 h-96 w-96 rounded-full bg-blue-500/20 blur-3xl"></div>


        {{-- =====================================================
            NAVIGATION
        ====================================================== --}}

        <nav class="relative z-20">

            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-8">

                {{-- Logo --}}
                <a
                    href="{{ route('home') }}"
                    class="group flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/20 backdrop-blur-md transition group-hover:bg-white/20">
                        <span class="text-lg font-black text-white">
                            S
                        </span>
                    </div>

                    <span class="text-2xl font-bold tracking-tight text-white">
                        Skill<span class="text-indigo-300">Link</span>
                    </span>

                </a>


                {{-- Desktop navigation --}}
                <div class="hidden items-center gap-7 md:flex">

                    <a
                        href="{{ route('tutors.index') }}"
                        class="text-sm font-medium text-white/80 transition hover:text-white">
                        {{ __('Find Tutors') }}
                    </a>

                    <a
                        href="{{ route('skills.browse') }}"
                        class="text-sm font-medium text-white/80 transition hover:text-white">
                        {{ __('Browse Skills') }}
                    </a>

                    <a
                        href="{{ route('requests.browse') }}"
                        class="text-sm font-medium text-white/80 transition hover:text-white">
                        {{ __('Browse Requests') }}
                    </a>

                    <a
                        href="{{ route('skill-exchanges.index') }}"
                        class="text-sm font-medium text-white/80 transition hover:text-white">
                        {{ __('Skill Exchange') }}
                    </a>

                    @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="text-sm font-medium text-white/80 transition hover:text-white">
                        {{ __('Dashboard') }}
                    </a>

                    @else

                    <a
                        href="{{ route('login') }}"
                        class="text-sm font-medium text-white/80 transition hover:text-white">
                        {{ __('Login') }}
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="rounded-lg bg-white px-5 py-2.5 text-sm font-semibold text-indigo-700 shadow-lg shadow-black/10 transition hover:-translate-y-0.5 hover:bg-indigo-50">
                        {{ __('Register') }}
                    </a>

                    @endauth

                </div>

            </div>

        </nav>


        {{-- =====================================================
            HERO CONTENT
        ====================================================== --}}

        <div class="relative z-10 mx-auto flex min-h-[calc(100vh-81px)] max-w-7xl items-center px-6 pb-20 pt-16 lg:px-8">

            <div class="max-w-4xl">

                {{-- Eyebrow --}}
                <div
                    class="mb-7 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-medium text-white/90 shadow-lg backdrop-blur-md">

                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>

                    {{ __('A community built around learning') }}

                </div>


                {{-- Main heading --}}
                <h1
                    class="max-w-4xl text-5xl font-black leading-[1.05] tracking-tight text-white sm:text-6xl lg:text-7xl">

                    {{ __('Learn a skill.') }}

                    <span class="block text-indigo-300">
                        {{ __('Share what you know.') }}
                    </span>

                </h1>


                {{-- Description --}}
                <p
                    class="mt-7 max-w-2xl text-lg leading-8 text-white/75 sm:text-xl">
                    {{ __('SkillLink connects people who want to learn with people who can teach. Discover tutors, share your knowledge, and grow together.') }}
                </p>


                {{-- CTA buttons --}}
                <div class="mt-9 flex flex-col gap-4 sm:flex-row">

                    <a
                        href="{{ route('tutors.index') }}"
                        class="group inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-500 px-7 py-3.5 text-sm font-bold text-white shadow-xl shadow-indigo-950/30 transition duration-200 hover:-translate-y-1 hover:bg-indigo-400">

                        {{ __('Find a Tutor') }}

                        <span class="transition-transform group-hover:translate-x-1">
                            →
                        </span>

                    </a>


                    @auth

                    <a
                        href="{{ route('requests.create') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-white/25 bg-white/10 px-7 py-3.5 text-sm font-bold text-white backdrop-blur-md transition duration-200 hover:-translate-y-1 hover:bg-white/20">
                        {{ __('Post a Learning Request') }}
                    </a>

                    @else

                    <a
                        href="{{ route('register') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-white/25 bg-white/10 px-7 py-3.5 text-sm font-bold text-white backdrop-blur-md transition duration-200 hover:-translate-y-1 hover:bg-white/20">
                        {{ __('Join SkillLink') }}
                    </a>

                    @endauth

                </div>


                {{-- Small trust message --}}
                <div class="mt-10 flex flex-wrap items-center gap-x-8 gap-y-3 text-sm text-white/60">

                    <div class="flex items-center gap-2">

                        <span class="text-emerald-400">✓</span>

                        {{ __('Learn from real people') }}

                    </div>

                    <div class="flex items-center gap-2">

                        <span class="text-emerald-400">✓</span>

                        {{ __('Online or in-person') }}

                    </div>

                    <div class="flex items-center gap-2">

                        <span class="text-emerald-400">✓</span>

                        {{ __('Build meaningful connections') }}

                    </div>

                </div>

            </div>

        </div>


        {{-- Scroll indicator --}}
        <div class="absolute bottom-6 left-1/2 z-10 hidden -translate-x-1/2 flex-col items-center gap-2 text-xs text-white/50 sm:flex">

            <span>
                {{ __('Discover more') }}
            </span>

            <span class="animate-bounce">
                ↓
            </span>

        </div>

    </section>


    {{-- =========================================================
        INTRO / VALUE SECTION
    ========================================================== --}}

    <section class="bg-white py-20 sm:py-24">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="grid gap-12 lg:grid-cols-2 lg:items-center">

                <div>

                    <p class="text-sm font-bold uppercase tracking-[0.2em] text-indigo-600">
                        {{ __('Why SkillLink?') }}
                    </p>

                    <h2 class="mt-4 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                        {{ __('Learning becomes better when people learn together.') }}
                    </h2>

                    <p class="mt-5 max-w-xl text-lg leading-8 text-slate-600">
                        {{ __('Whether you want to master a new technology, improve a creative skill, or share something you already know, SkillLink makes it easier to find the right person.') }}
                    </p>

                </div>


                {{-- Feature highlights --}}
                <div class="grid gap-4 sm:grid-cols-2">

                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-xl">
                            🎯
                        </div>

                        <h3 class="mt-5 font-bold text-slate-900">
                            {{ __('Find the right tutor') }}
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            {{ __('Discover people based on skills, location, availability, and reviews.') }}
                        </p>

                    </div>


                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-xl">
                            🤝
                        </div>

                        <h3 class="mt-5 font-bold text-slate-900">
                            {{ __('Share your knowledge') }}
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            {{ __('Turn your experience into something valuable for someone else.') }}
                        </p>

                    </div>


                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-100 text-xl">
                            ⭐
                        </div>

                        <h3 class="mt-5 font-bold text-slate-900">
                            {{ __('Build your reputation') }}
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            {{ __('Complete sessions, receive reviews, and grow your profile.') }}
                        </p>

                    </div>


                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-6 transition hover:-translate-y-1 hover:shadow-lg">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-100 text-xl">
                            ⚡
                        </div>

                        <h3 class="mt-5 font-bold text-slate-900">
                            {{ __('Exchange skills') }}
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            {{ __('Learn from someone while offering your own knowledge in return.') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        HOW IT WORKS
    ========================================================== --}}

    <section class="bg-slate-50 py-20 sm:py-24">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <div class="mx-auto max-w-2xl text-center">

                <p class="text-sm font-bold uppercase tracking-[0.2em] text-indigo-600">
                    {{ __('Simple process') }}
                </p>

                <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">
                    {{ __('How SkillLink Works') }}
                </h2>

                <p class="mt-4 text-lg text-slate-600">
                    {{ __('From finding a skill to completing a session, everything happens in a few simple steps.') }}
                </p>

            </div>


            <div class="relative mt-14 grid gap-6 md:grid-cols-3">

                {{-- Step 1 --}}
                <div class="relative rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-lg font-black text-white shadow-lg shadow-indigo-200">
                        01
                    </div>

                    <h3 class="mt-6 text-xl font-bold text-slate-900">
                        {{ __('Tell us what you want to learn') }}
                    </h3>

                    <p class="mt-3 leading-7 text-slate-600">
                        {{ __('Create a learning request with the skill, location, session format, and preferred schedule.') }}
                    </p>

                </div>


                {{-- Step 2 --}}
                <div class="relative rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-lg font-black text-white shadow-lg shadow-indigo-200">
                        02
                    </div>

                    <h3 class="mt-6 text-xl font-bold text-slate-900">
                        {{ __('Connect with a tutor') }}
                    </h3>

                    <p class="mt-3 leading-7 text-slate-600">
                        {{ __('Explore tutors and find people whose skills, location, availability, and experience match your needs.') }}
                    </p>

                </div>


                {{-- Step 3 --}}
                <div class="relative rounded-2xl border border-slate-200 bg-white p-8 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-lg font-black text-white shadow-lg shadow-indigo-200">
                        03
                    </div>

                    <h3 class="mt-6 text-xl font-bold text-slate-900">
                        {{ __('Learn, teach, and grow') }}
                    </h3>

                    <p class="mt-3 leading-7 text-slate-600">
                        {{ __('Book your session, communicate with your tutor, complete the session, and build your reputation.') }}
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        CTA
    ========================================================== --}}

    <section class="relative overflow-hidden bg-slate-950 py-20 sm:py-24">

        <div class="absolute -left-40 top-0 h-80 w-80 rounded-full bg-indigo-600/20 blur-3xl"></div>

        <div class="absolute -right-40 bottom-0 h-80 w-80 rounded-full bg-blue-600/20 blur-3xl"></div>

        <div class="relative mx-auto max-w-4xl px-6 text-center lg:px-8">

            <p class="text-sm font-bold uppercase tracking-[0.2em] text-indigo-300">
                {{ __('Your next skill is waiting') }}
            </p>

            <h2 class="mt-4 text-3xl font-black tracking-tight text-white sm:text-5xl">
                {{ __('Ready to learn something new?') }}
            </h2>

            <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-white/65">
                {{ __('Join SkillLink and connect with people who can help you learn, teach, and grow.') }}
            </p>

            <div class="mt-8">

                @auth

                <a
                    href="{{ route('tutors.index') }}"
                    class="inline-flex items-center rounded-xl bg-white px-7 py-3.5 text-sm font-bold text-indigo-700 shadow-xl transition hover:-translate-y-1 hover:bg-indigo-50">
                    {{ __('Explore Tutors →') }}
                </a>

                @else

                <a
                    href="{{ route('register') }}"
                    class="inline-flex items-center rounded-xl bg-white px-7 py-3.5 text-sm font-bold text-indigo-700 shadow-xl transition hover:-translate-y-1 hover:bg-indigo-50">
                    {{ __('Join SkillLink →') }}
                </a>

                @endauth

            </div>

        </div>

    </section>


    {{-- =========================================================
        FOOTER
    ========================================================== --}}

    <footer class="border-t border-slate-200 bg-white">

        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-6 py-8 text-center sm:flex-row sm:items-center sm:justify-between sm:text-left lg:px-8">

            <div>

                <div class="text-lg font-bold text-slate-900">
                    Skill<span class="text-indigo-600">Link</span>
                </div>

                <p class="mt-1 text-sm text-slate-500">
                    {{ __('Learn, teach, and connect.') }}
                </p>

            </div>

            <p class="text-sm text-slate-500">
                © {{ date('Y') }} {{ __('SkillLink. All rights reserved.') }}
            </p>

        </div>

    </footer>


    {{-- Respect users who prefer reduced motion --}}
    <style>
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            video {
                display: none;
            }
        }
    </style>

</body>

</html>