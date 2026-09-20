<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-1">

            <p class="text-sm font-medium text-indigo-600">
                {{ __('Your workspace') }}
            </p>

            <h2 class="text-2xl font-bold tracking-tight text-slate-900">
                {{ __('SkillLink Dashboard') }}
            </h2>

        </div>

    </x-slot>


    <div class="min-h-screen bg-slate-50">

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">


            {{-- =====================================================
                WELCOME BANNER
            ====================================================== --}}

            <section
                class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-700 via-indigo-600 to-blue-600 px-6 py-8 shadow-xl shadow-indigo-100 sm:px-10 sm:py-10"
            >

                {{-- Decorative circles --}}
                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>

                <div class="absolute -bottom-24 left-1/3 h-64 w-64 rounded-full bg-blue-400/20 blur-3xl"></div>


                <div class="relative z-10 flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

                    <div class="max-w-2xl">

                        <div
                            class="mb-4 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur-sm"
                        >
                            <span class="h-2 w-2 rounded-full bg-emerald-300"></span>

                            {{ __('Welcome back') }}
                        </div>


                        <h1 class="text-3xl font-black tracking-tight text-white sm:text-4xl">

                            {{ auth()->user()->name }}

                            <span class="inline-block">
                                👋
                            </span>

                        </h1>


                        <p class="mt-3 max-w-xl text-base leading-7 text-indigo-100 sm:text-lg">
                            {{ __('Continue learning, share your knowledge, and build meaningful connections through SkillLink.') }}
                        </p>


                        <div class="mt-6 flex flex-wrap gap-3">

                            <a
                                href="{{ route('tutors.index') }}"
                                class="inline-flex items-center rounded-xl bg-white px-5 py-3 text-sm font-bold text-indigo-700 shadow-lg transition hover:-translate-y-0.5 hover:bg-indigo-50"
                            >
                                {{ __('Find a Tutor') }}

                                <span class="ml-2">
                                    →
                                </span>
                            </a>


                            <a
                                href="{{ route('requests.create') }}"
                                class="inline-flex items-center rounded-xl border border-white/25 bg-white/10 px-5 py-3 text-sm font-bold text-white backdrop-blur-sm transition hover:-translate-y-0.5 hover:bg-white/20"
                            >
                                {{ __('Post a Request') }}
                            </a>

                        </div>

                    </div>


                    {{-- SkillPoints highlight --}}
                    <div class="w-full max-w-xs rounded-2xl border border-white/15 bg-white/10 p-5 backdrop-blur-md lg:w-auto">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm font-medium text-indigo-100">
                                    {{ __('SkillPoints') }}
                                </p>

                                <p class="mt-1 text-4xl font-black text-white">
                                    {{ auth()->user()->skill_points }}
                                </p>

                            </div>


                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/15 text-2xl">
                                ⭐
                            </div>

                        </div>


                        <p class="mt-4 text-xs leading-5 text-indigo-100">
                            {{ __('Teach for 1 hour and earn 1 SkillPoint. Learn for 1 hour and spend 1 SkillPoint.') }}
                        </p>

                    </div>

                </div>

            </section>


            {{-- =====================================================
                STATISTICS
            ====================================================== --}}

            <section class="mt-8">

                <div class="mb-5">

                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-indigo-600">
                        {{ __('Your activity') }}
                    </p>

                    <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">
                        {{ __('Overview') }}
                    </h2>

                </div>


                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">


                    {{-- My Skills --}}
                    <a
                        href="{{ route('skills.index') }}"
                        class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-indigo-200 hover:shadow-xl"
                    >

                        <div class="flex items-start justify-between">

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-xl">
                                🎓
                            </div>

                            <span class="text-slate-300 transition group-hover:translate-x-1 group-hover:text-indigo-500">
                                →
                            </span>

                        </div>


                        <p class="mt-6 text-sm font-medium text-slate-500">
                            {{ __('My Skills') }}
                        </p>

                        <p class="mt-1 text-3xl font-black text-slate-900">
                            {{ $skillCount }}
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $skillCount === 1 ? __('skill') : __('skills') }}
                        </p>


                        <div class="mt-5 h-1 overflow-hidden rounded-full bg-slate-100">

                            <div class="h-full w-2/3 rounded-full bg-indigo-500 transition group-hover:w-full"></div>

                        </div>

                    </a>


                    {{-- My Requests --}}
                    <a
                        href="{{ route('requests.index') }}"
                        class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-blue-200 hover:shadow-xl"
                    >

                        <div class="flex items-start justify-between">

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-xl">
                                📝
                            </div>

                            <span class="text-slate-300 transition group-hover:translate-x-1 group-hover:text-blue-500">
                                →
                            </span>

                        </div>


                        <p class="mt-6 text-sm font-medium text-slate-500">
                            {{ __('My Requests') }}
                        </p>

                        <p class="mt-1 text-3xl font-black text-slate-900">
                            {{ $requestCount }}
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $requestCount === 1 ? __('learning request') : __('learning requests') }}
                        </p>


                        <div class="mt-5 h-1 overflow-hidden rounded-full bg-slate-100">

                            <div class="h-full w-2/3 rounded-full bg-blue-500 transition group-hover:w-full"></div>

                        </div>

                    </a>


                    {{-- My Bookings --}}
                    <a
                        href="{{ route('bookings.index') }}"
                        class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-xl"
                    >

                        <div class="flex items-start justify-between">

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-100 text-xl">
                                📅
                            </div>

                            <span class="text-slate-300 transition group-hover:translate-x-1 group-hover:text-emerald-500">
                                →
                            </span>

                        </div>


                        <p class="mt-6 text-sm font-medium text-slate-500">
                            {{ __('My Bookings') }}
                        </p>

                        <p class="mt-1 text-3xl font-black text-slate-900">
                            {{ $bookingCount }}
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $bookingCount === 1 ? __('booking') : __('bookings') }}
                        </p>


                        <div class="mt-5 h-1 overflow-hidden rounded-full bg-slate-100">

                            <div class="h-full w-2/3 rounded-full bg-emerald-500 transition group-hover:w-full"></div>

                        </div>

                    </a>


                    {{-- SkillPoints --}}
                    <div
                        class="rounded-2xl border border-amber-200 bg-gradient-to-br from-amber-50 to-white p-6 shadow-sm"
                    >

                        <div class="flex items-start justify-between">

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-100 text-xl">
                                ⭐
                            </div>

                            <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-700">
                                {{ __('Balance') }}
                            </span>

                        </div>


                        <p class="mt-6 text-sm font-medium text-slate-500">
                            {{ __('SkillPoints') }}
                        </p>

                        <p class="mt-1 text-3xl font-black text-amber-600">
                            {{ auth()->user()->skill_points }}
                        </p>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ __('current balance') }}
                        </p>


                        <div class="mt-5 rounded-xl bg-white/80 p-3">

                            <p class="text-xs leading-5 text-slate-500">
                                {{ __('Teach for 1 hour and earn 1 point. Learn for 1 hour and spend 1 point.') }}
                            </p>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =====================================================
                QUICK ACTIONS + JOURNEY
            ====================================================== --}}

            <section class="mt-10 grid gap-6 lg:grid-cols-3">


                {{-- Quick Actions --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-sm font-bold uppercase tracking-[0.15em] text-indigo-600">
                                {{ __('Get started') }}
                            </p>

                            <h2 class="mt-1 text-xl font-bold text-slate-900">
                                {{ __('Quick Actions') }}
                            </h2>

                        </div>

                    </div>


                    <div class="mt-6 grid gap-3 sm:grid-cols-2">


                        <a
                            href="{{ route('skills.index') }}"
                            class="group flex items-center gap-4 rounded-xl border border-slate-200 p-4 transition hover:border-indigo-200 hover:bg-indigo-50/50"
                        >

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-lg">
                                🎓
                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold text-slate-900">
                                    {{ __('Manage My Skills') }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ __('Add skills you teach or want to learn.') }}
                                </p>

                            </div>

                            <span class="ml-auto text-slate-300 transition group-hover:translate-x-1 group-hover:text-indigo-500">
                                →
                            </span>

                        </a>


                        <a
                            href="{{ route('profile.edit') }}"
                            class="group flex items-center gap-4 rounded-xl border border-slate-200 p-4 transition hover:border-blue-200 hover:bg-blue-50/50"
                        >

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-100 text-lg">
                                👤
                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold text-slate-900">
                                    {{ __('Edit Profile') }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ __('Keep your profile information up to date.') }}
                                </p>

                            </div>

                            <span class="ml-auto text-slate-300 transition group-hover:translate-x-1 group-hover:text-blue-500">
                                →
                            </span>

                        </a>


                        <a
                            href="{{ route('messages.index') }}"
                            class="group flex items-center gap-4 rounded-xl border border-slate-200 p-4 transition hover:border-emerald-200 hover:bg-emerald-50/50"
                        >

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-lg">
                                💬
                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold text-slate-900">
                                    {{ __('Messages') }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ __('Chat with tutors and other learners.') }}
                                </p>

                            </div>

                            <span class="ml-auto text-slate-300 transition group-hover:translate-x-1 group-hover:text-emerald-500">
                                →
                            </span>

                        </a>


                        <a
                            href="{{ route('tutors.index') }}"
                            class="group flex items-center gap-4 rounded-xl border border-slate-200 p-4 transition hover:border-amber-200 hover:bg-amber-50/50"
                        >

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-100 text-lg">
                                🔎
                            </div>

                            <div class="min-w-0">

                                <p class="font-semibold text-slate-900">
                                    {{ __('Find a Tutor') }}
                                </p>

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ __('Discover people who can teach your skills.') }}
                                </p>

                            </div>

                            <span class="ml-auto text-slate-300 transition group-hover:translate-x-1 group-hover:text-amber-500">
                                →
                            </span>

                        </a>

                    </div>

                </div>


                {{-- SkillLink Journey --}}
                <div class="rounded-2xl border border-slate-200 bg-slate-950 p-6 shadow-sm">

                    <p class="text-sm font-bold uppercase tracking-[0.15em] text-indigo-300">
                        {{ __('Your journey') }}
                    </p>

                    <h2 class="mt-1 text-xl font-bold text-white">
                        {{ __('Learn. Teach. Connect.') }}
                    </h2>


                    <div class="mt-6 space-y-5">


                        <div class="flex gap-3">

                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-500 text-sm font-bold text-white">
                                1
                            </div>

                            <div>

                                <p class="font-semibold text-white">
                                    {{ __('Build your skills') }}
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-400">
                                    {{ __('Tell SkillLink what you know and what you want to learn.') }}
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-3">

                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-500 text-sm font-bold text-white">
                                2
                            </div>

                            <div>

                                <p class="font-semibold text-white">
                                    {{ __('Find your people') }}
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-400">
                                    {{ __('Connect with tutors and learners around your interests.') }}
                                </p>

                            </div>

                        </div>


                        <div class="flex gap-3">

                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-indigo-500 text-sm font-bold text-white">
                                3
                            </div>

                            <div>

                                <p class="font-semibold text-white">
                                    {{ __('Grow together') }}
                                </p>

                                <p class="mt-1 text-xs leading-5 text-slate-400">
                                    {{ __('Complete sessions, exchange skills, and build your reputation.') }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="mt-7 rounded-xl border border-white/10 bg-white/5 p-4">

                        <p class="text-xs leading-5 text-slate-400">
                            {{ __('Every session is an opportunity to learn something new or help someone else grow.') }}
                        </p>

                    </div>

                </div>

            </section>


            {{-- =====================================================
                EXPLORE SECTION
            ====================================================== --}}

            <section class="mt-10 rounded-2xl border border-indigo-100 bg-indigo-50/60 p-6 sm:p-8">

                <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

                    <div class="max-w-2xl">

                        <p class="text-sm font-bold uppercase tracking-[0.15em] text-indigo-600">
                            {{ __('Keep exploring') }}
                        </p>

                        <h2 class="mt-2 text-2xl font-black tracking-tight text-slate-900">
                            {{ __('There is always something new to learn.') }}
                        </h2>

                        <p class="mt-2 text-sm leading-6 text-slate-600">
                            {{ __('Browse available skills, discover tutors, or explore learning requests from the SkillLink community.') }}
                        </p>

                    </div>


                    <div class="flex flex-wrap gap-3">

                        <a
                            href="{{ route('skills.browse') }}"
                            class="inline-flex items-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-indigo-700"
                        >
                            {{ __('Browse Skills') }}

                            <span class="ml-2">
                                →
                            </span>
                        </a>


                        <a
                            href="{{ route('requests.browse') }}"
                            class="inline-flex items-center rounded-xl border border-indigo-200 bg-white px-5 py-3 text-sm font-bold text-indigo-700 transition hover:-translate-y-0.5 hover:bg-indigo-50"
                        >
                            {{ __('Browse Requests') }}
                        </a>

                    </div>

                </div>

            </section>


            {{-- Footer spacing --}}
            <div class="h-8"></div>

        </div>

    </div>

</x-app-layout>