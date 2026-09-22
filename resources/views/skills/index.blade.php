<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-600">
                    Skill Development
                </p>

                <h2 class="mt-1 text-2xl font-bold text-gray-900">
                    My Skills
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Manage the skills you can teach and the skills you want to learn.
                </p>
            </div>

            <a
                href="{{ route('dashboard') }}"
                class="hidden sm:inline-flex items-center rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50"
            >
                ← Dashboard
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-800 shadow-sm">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-100">
                        ✓
                    </div>

                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            {{-- Error message --}}
            @if (session('error'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-800 shadow-sm">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-100">
                        !
                    </div>

                    <p class="text-sm font-medium">
                        {{ session('error') }}
                    </p>
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-800 shadow-sm">
                    <p class="font-semibold">
                        Please check the following:
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Hero --}}
            <section class="relative mb-8 overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-indigo-600 to-purple-600 shadow-xl">

                {{-- Decorative circles --}}
                <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-32 right-32 h-80 w-80 rounded-full bg-purple-400/20"></div>

                <div class="relative px-6 py-10 sm:px-10 lg:px-12">

                    <div class="max-w-3xl">

                        <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-2 text-sm font-semibold text-white backdrop-blur-sm">
                            <span>🧠</span>
                            <span>Your Skill Profile</span>
                        </div>

                        <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            Build your learning journey.
                        </h1>

                        <p class="mt-4 max-w-2xl text-base leading-7 text-indigo-100 sm:text-lg">
                            Tell the SkillLink community what you know, what you want to learn,
                            and where you are on your learning journey.
                        </p>

                    </div>

                    {{-- Skill count --}}
                    <div class="mt-8 grid max-w-xl grid-cols-3 gap-3 sm:gap-4">

                        <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
                            <p class="text-2xl font-bold text-white">
                                {{ $userSkills->count() }}
                            </p>

                            <p class="mt-1 text-xs font-medium text-indigo-100 sm:text-sm">
                                Total Skills
                            </p>
                        </div>

                        <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
                            <p class="text-2xl font-bold text-white">
                                {{ $userSkills->where('type', 'teach')->count() }}
                            </p>

                            <p class="mt-1 text-xs font-medium text-indigo-100 sm:text-sm">
                                Teaching
                            </p>
                        </div>

                        <div class="rounded-2xl border border-white/20 bg-white/10 p-4 backdrop-blur-sm">
                            <p class="text-2xl font-bold text-white">
                                {{ $userSkills->where('type', 'learn')->count() }}
                            </p>

                            <p class="mt-1 text-xs font-medium text-indigo-100 sm:text-sm">
                                Learning
                            </p>
                        </div>

                    </div>

                </div>
            </section>

            {{-- Add Skill --}}
            <section class="mb-8 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-indigo-50 text-2xl">
                            ➕
                        </div>

                        <div>
                            <h2 class="text-xl font-bold text-gray-900">
                                Add a Skill
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                Add something you can teach or would like to learn.
                            </p>
                        </div>

                    </div>

                </div>

                <div class="px-6 py-6 sm:px-8">

                    <form method="POST" action="{{ route('skills.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                            {{-- Skill --}}
                            <div>
                                <label
                                    for="skill_id"
                                    class="block text-sm font-semibold text-gray-700"
                                >
                                    Skill
                                </label>

                                <select
                                    id="skill_id"
                                    name="skill_id"
                                    required
                                    class="mt-2 block w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="">
                                        Select a skill
                                    </option>

                                    @foreach ($skills as $skill)
                                        <option
                                            value="{{ $skill->id }}"
                                            @selected(old('skill_id') == $skill->id)
                                        >
                                            {{ $skill->name }}
                                            @if ($skill->category)
                                                — {{ $skill->category }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>

                                <x-input-error
                                    :messages="$errors->get('skill_id')"
                                    class="mt-2"
                                />
                            </div>

                            {{-- Type --}}
                            <div>
                                <label
                                    for="type"
                                    class="block text-sm font-semibold text-gray-700"
                                >
                                    I want to
                                </label>

                                <select
                                    id="type"
                                    name="type"
                                    required
                                    class="mt-2 block w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="">
                                        Select an option
                                    </option>

                                    <option
                                        value="teach"
                                        @selected(old('type') === 'teach')
                                    >
                                        Teach
                                    </option>

                                    <option
                                        value="learn"
                                        @selected(old('type') === 'learn')
                                    >
                                        Learn
                                    </option>
                                </select>

                                <x-input-error
                                    :messages="$errors->get('type')"
                                    class="mt-2"
                                />
                            </div>

                            {{-- Level --}}
                            <div>
                                <label
                                    for="level"
                                    class="block text-sm font-semibold text-gray-700"
                                >
                                    Level
                                </label>

                                <select
                                    id="level"
                                    name="level"
                                    required
                                    class="mt-2 block w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:ring-indigo-500"
                                >
                                    <option value="">
                                        Select your level
                                    </option>

                                    <option
                                        value="beginner"
                                        @selected(old('level') === 'beginner')
                                    >
                                        Beginner
                                    </option>

                                    <option
                                        value="intermediate"
                                        @selected(old('level') === 'intermediate')
                                    >
                                        Intermediate
                                    </option>

                                    <option
                                        value="advanced"
                                        @selected(old('level') === 'advanced')
                                    >
                                        Advanced
                                    </option>

                                    <option
                                        value="expert"
                                        @selected(old('level') === 'expert')
                                    >
                                        Expert
                                    </option>
                                </select>

                                <x-input-error
                                    :messages="$errors->get('level')"
                                    class="mt-2"
                                />
                            </div>

                        </div>

                        <div class="mt-6 flex justify-end">

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                            >
                                + Add Skill
                            </button>

                        </div>

                    </form>

                </div>
            </section>

            {{-- Current Skills --}}
            <section>

                <div class="mb-5 flex items-end justify-between">

                    <div>
                        <p class="text-sm font-semibold text-indigo-600">
                            Your Skills
                        </p>

                        <h2 class="mt-1 text-2xl font-bold text-gray-900">
                            What you bring to SkillLink
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Manage your teaching abilities and learning goals.
                        </p>
                    </div>

                </div>

                @if ($userSkills->isEmpty())

                    <div class="rounded-3xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center shadow-sm">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-3xl">
                            🧠
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-gray-900">
                            No skills added yet
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                            Add your first skill above to start building your SkillLink
                            learning profile.
                        </p>

                    </div>

                @else

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                        {{-- Skills I Teach --}}
                        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                            <div class="border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-white px-6 py-5">

                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-100 text-xl">
                                            🎓
                                        </div>

                                        <div>
                                            <h3 class="font-bold text-gray-900">
                                                Skills I Teach
                                            </h3>

                                            <p class="text-sm text-gray-500">
                                                Skills you can share with others.
                                            </p>
                                        </div>

                                    </div>

                                    <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-bold text-indigo-700">
                                        {{ $userSkills->where('type', 'teach')->count() }}
                                    </span>

                                </div>

                            </div>

                            @php
                                $teachingSkills = $userSkills->where('type', 'teach');
                            @endphp

                            <div class="p-6">

                                @if ($teachingSkills->isEmpty())

                                    <div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-8 text-center">

                                        <p class="text-sm font-medium text-gray-600">
                                            No teaching skills added yet.
                                        </p>

                                        <p class="mt-1 text-xs text-gray-400">
                                            Add a skill above to show others what you can teach.
                                        </p>

                                    </div>

                                @else

                                    <div class="space-y-3">

                                        @foreach ($teachingSkills as $userSkill)

                                            <div class="group flex items-center justify-between gap-4 rounded-2xl border border-gray-200 p-4 transition hover:border-indigo-200 hover:bg-indigo-50/40">

                                                <div class="flex min-w-0 items-center gap-3">

                                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700">
                                                        ✓
                                                    </div>

                                                    <div class="min-w-0">

                                                        <p class="font-semibold text-gray-900">
                                                            {{ $userSkill->skill->name }}
                                                        </p>

                                                        <span class="mt-1 inline-flex rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold capitalize text-indigo-700">
                                                            {{ $userSkill->level }}
                                                        </span>

                                                    </div>

                                                </div>

                                                <form
                                                    method="POST"
                                                    action="{{ route('skills.destroy', $userSkill) }}"
                                                    onsubmit="return confirm('Remove this skill from your profile?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="rounded-lg px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50 hover:text-red-700"
                                                    >
                                                        Remove
                                                    </button>
                                                </form>

                                            </div>

                                        @endforeach

                                    </div>

                                @endif

                            </div>

                        </div>

                        {{-- Skills I Want to Learn --}}
                        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                            <div class="border-b border-gray-100 bg-gradient-to-r from-purple-50 to-white px-6 py-5">

                                <div class="flex items-center justify-between">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-100 text-xl">
                                            📚
                                        </div>

                                        <div>
                                            <h3 class="font-bold text-gray-900">
                                                Skills I Want to Learn
                                            </h3>

                                            <p class="text-sm text-gray-500">
                                                Skills you want to develop.
                                            </p>
                                        </div>

                                    </div>

                                    <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-bold text-purple-700">
                                        {{ $userSkills->where('type', 'learn')->count() }}
                                    </span>

                                </div>

                            </div>

                            @php
                                $learningSkills = $userSkills->where('type', 'learn');
                            @endphp

                            <div class="p-6">

                                @if ($learningSkills->isEmpty())

                                    <div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-8 text-center">

                                        <p class="text-sm font-medium text-gray-600">
                                            No learning skills added yet.
                                        </p>

                                        <p class="mt-1 text-xs text-gray-400">
                                            Add a skill above to define your learning goals.
                                        </p>

                                    </div>

                                @else

                                    <div class="space-y-3">

                                        @foreach ($learningSkills as $userSkill)

                                            <div class="group flex items-center justify-between gap-4 rounded-2xl border border-gray-200 p-4 transition hover:border-purple-200 hover:bg-purple-50/40">

                                                <div class="flex min-w-0 items-center gap-3">

                                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-purple-100 text-purple-700">
                                                        📖
                                                    </div>

                                                    <div class="min-w-0">

                                                        <p class="font-semibold text-gray-900">
                                                            {{ $userSkill->skill->name }}
                                                        </p>

                                                        <span class="mt-1 inline-flex rounded-full bg-purple-50 px-2.5 py-1 text-xs font-semibold capitalize text-purple-700">
                                                            {{ $userSkill->level }}
                                                        </span>

                                                    </div>

                                                </div>

                                                <form
                                                    method="POST"
                                                    action="{{ route('skills.destroy', $userSkill) }}"
                                                    onsubmit="return confirm('Remove this skill from your profile?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="rounded-lg px-3 py-2 text-xs font-semibold text-red-600 transition hover:bg-red-50 hover:text-red-700"
                                                    >
                                                        Remove
                                                    </button>
                                                </form>

                                            </div>

                                        @endforeach

                                    </div>

                                @endif

                            </div>

                        </div>

                    </div>

                @endif

            </section>

            {{-- Bottom CTA --}}
            <section class="mt-8 rounded-3xl border border-indigo-100 bg-indigo-50 px-6 py-6 sm:px-8">

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="font-bold text-gray-900">
                            Ready to keep learning?
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Find tutors who can help you develop your learning skills.
                        </p>
                    </div>

                    <a
                        href="{{ route('tutors.index') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                    >
                        Find a Tutor →
                    </a>

                </div>

            </section>

        </div>

    </div>

</x-app-layout>