<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-600">
                    Community Learning
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Skill Exchange
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Share what you know and discover what others can teach you.
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

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">
                    <p class="font-bold">Please check the following:</p>

                    <ul class="mt-2 list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Hero --}}
            <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-purple-600 shadow-lg">

                <div class="relative px-6 py-10 sm:px-10 sm:py-12">

                    <div class="absolute -right-16 -top-20 h-56 w-56 rounded-full bg-white/10"></div>
                    <div class="absolute -bottom-24 right-32 h-64 w-64 rounded-full bg-white/5"></div>

                    <div class="relative flex flex-col gap-8 md:flex-row md:items-center md:justify-between">

                        <div class="max-w-2xl">

                            <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-white ring-1 ring-white/20">
                                🤝
                                Learn by sharing
                            </div>

                            <h1 class="mt-5 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                                Exchange your knowledge.
                            </h1>

                            <p class="mt-4 max-w-xl text-base leading-7 text-indigo-100">
                                Teach something you know and learn something you want to know.
                                Connect with people whose skills complement yours.
                            </p>

                        </div>

                        <div class="grid grid-cols-2 gap-3 text-center">

                            <div class="rounded-2xl bg-white/10 px-5 py-5 ring-1 ring-white/20 backdrop-blur-sm">
                                <div class="text-3xl">🎓</div>
                                <p class="mt-2 text-sm font-semibold text-white">
                                    Teach
                                </p>
                                <p class="mt-1 text-xs text-indigo-100">
                                    Share your skills
                                </p>
                            </div>

                            <div class="rounded-2xl bg-white/10 px-5 py-5 ring-1 ring-white/20 backdrop-blur-sm">
                                <div class="text-3xl">📚</div>
                                <p class="mt-2 text-sm font-semibold text-white">
                                    Learn
                                </p>
                                <p class="mt-1 text-xs text-indigo-100">
                                    Grow your skills
                                </p>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            {{-- Potential Exchanges --}}
            <div class="mb-8">

                <div class="mb-5">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-100 text-xl">
                            🔄
                        </div>

                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">
                                Potential Skill Exchanges
                            </h2>

                            <p class="mt-1 text-sm text-gray-500">
                                People whose skills may complement what you want to learn and teach.
                            </p>
                        </div>
                    </div>
                </div>

                @if ($potentialExchanges->isEmpty())

                    <div class="rounded-3xl border border-gray-200 bg-white px-6 py-12 text-center shadow-sm">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-3xl">
                            🔍
                        </div>

                        <h3 class="mt-5 text-xl font-bold text-gray-900">
                            No potential exchanges yet
                        </h3>

                        <p class="mx-auto mt-2 max-w-lg text-sm leading-6 text-gray-500">
                            As more users join SkillLink, potential exchanges will appear here
                            when your teaching and learning skills match theirs.
                        </p>

                        <a
                            href="{{ route('skills.index') }}"
                            class="mt-6 inline-flex items-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-indigo-700"
                        >
                            Manage My Skills
                            <span class="ml-2">→</span>
                        </a>

                    </div>

                @else

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                        @foreach ($potentialExchanges as $exchange)

                            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                                {{-- Person --}}
                                <div class="border-b border-gray-100 px-6 py-6">

                                    <div class="flex items-start justify-between gap-4">

                                        <div class="flex items-center gap-4">

                                            <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-xl font-bold text-white shadow-sm">
                                                {{ strtoupper(substr($exchange['user']->name, 0, 1)) }}
                                            </div>

                                            <div>
                                                <h3 class="text-lg font-bold text-gray-900">
                                                    {{ $exchange['user']->name }}
                                                </h3>

                                                @if ($exchange['user']->location)
                                                    <p class="mt-1 flex items-center gap-1 text-sm text-gray-500">
                                                        📍 {{ $exchange['user']->location }}
                                                    </p>
                                                @endif
                                            </div>

                                        </div>

                                        <span class="rounded-full bg-indigo-50 px-3 py-1 text-xs font-bold text-indigo-700">
                                            Potential Match
                                        </span>

                                    </div>

                                </div>

                                {{-- Skill comparison --}}
                                <div class="grid gap-4 px-6 py-6 sm:grid-cols-2">

                                    <div class="rounded-2xl bg-blue-50 p-4">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">🎓</span>

                                            <h4 class="text-sm font-bold text-blue-900">
                                                You can teach
                                            </h4>
                                        </div>

                                        <div class="mt-3 flex flex-wrap gap-2">

                                            @foreach ($exchange['skills_you_can_teach'] as $userSkill)

                                                <span class="rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-blue-700 ring-1 ring-blue-200">
                                                    {{ $userSkill->skill->name }}
                                                </span>

                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="rounded-2xl bg-green-50 p-4">
                                        <div class="flex items-center gap-2">
                                            <span class="text-lg">📚</span>

                                            <h4 class="text-sm font-bold text-green-900">
                                                They can teach you
                                            </h4>
                                        </div>

                                        <div class="mt-3 flex flex-wrap gap-2">

                                            @foreach ($exchange['skills_they_can_teach'] as $userSkill)

                                                <span class="rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-green-700 ring-1 ring-green-200">
                                                    {{ $userSkill->skill->name }}
                                                </span>

                                            @endforeach

                                        </div>
                                    </div>

                                </div>

                                {{-- Profile --}}
                                <div class="px-6">

                                    <a
                                        href="{{ route('tutors.show', $exchange['user']) }}"
                                        class="inline-flex items-center text-sm font-bold text-indigo-600 transition hover:text-indigo-800"
                                    >
                                        View Profile
                                        <span class="ml-2">→</span>
                                    </a>

                                </div>

                                {{-- Proposal --}}
                                <div class="mt-6 border-t border-gray-100 bg-gray-50/70 px-6 py-6">

                                    <div class="mb-5">
                                        <h4 class="text-base font-bold text-gray-900">
                                            Propose a Skill Exchange
                                        </h4>

                                        <p class="mt-1 text-sm text-gray-500">
                                            Choose what you'll teach and what you'd like to learn.
                                        </p>
                                    </div>

                                    <form
                                        method="POST"
                                        action="{{ route('skill-exchanges.store') }}"
                                        class="space-y-4"
                                    >
                                        @csrf

                                        <input
                                            type="hidden"
                                            name="receiver_id"
                                            value="{{ $exchange['user']->id }}"
                                        >

                                        <div>
                                            <label
                                                for="teach_skill_{{ $exchange['user']->id }}"
                                                class="mb-2 block text-sm font-semibold text-gray-700"
                                            >
                                                Skill you will teach
                                            </label>

                                            <select
                                                id="teach_skill_{{ $exchange['user']->id }}"
                                                name="teach_skill_id"
                                                required
                                                class="block w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            >
                                                @foreach ($exchange['skills_you_can_teach'] as $userSkill)
                                                    <option value="{{ $userSkill->skill_id }}">
                                                        {{ $userSkill->skill->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label
                                                for="learn_skill_{{ $exchange['user']->id }}"
                                                class="mb-2 block text-sm font-semibold text-gray-700"
                                            >
                                                Skill you want to learn
                                            </label>

                                            <select
                                                id="learn_skill_{{ $exchange['user']->id }}"
                                                name="learn_skill_id"
                                                required
                                                class="block w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            >
                                                @foreach ($exchange['skills_they_can_teach'] as $userSkill)
                                                    <option value="{{ $userSkill->skill_id }}">
                                                        {{ $userSkill->skill->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <label
                                                for="message_{{ $exchange['user']->id }}"
                                                class="mb-2 block text-sm font-semibold text-gray-700"
                                            >
                                                Message
                                            </label>

                                            <textarea
                                                id="message_{{ $exchange['user']->id }}"
                                                name="message"
                                                rows="3"
                                                class="block w-full rounded-xl border-gray-300 bg-white px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                                placeholder="Tell them about the exchange you are proposing..."
                                            ></textarea>
                                        </div>

                                        <button
                                            type="submit"
                                            class="inline-flex w-full items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-indigo-700"
                                        >
                                            Propose Exchange
                                            <span class="ml-2">→</span>
                                        </button>

                                    </form>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

            {{-- Proposed Exchanges --}}
            <div class="mb-8">

                <div class="mb-5 flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-100 text-xl">
                        📤
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">
                            Exchanges You Proposed
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Track the skill exchanges you've offered to others.
                        </p>
                    </div>

                </div>

                <div class="rounded-3xl border border-gray-200 bg-white shadow-sm">

                    @if ($proposedExchanges->isEmpty())

                        <div class="px-6 py-10 text-center">

                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-2xl">
                                📤
                            </div>

                            <p class="mt-4 font-semibold text-gray-700">
                                You have not proposed any skill exchanges yet.
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                Potential matches will appear above when your skills complement another user's.
                            </p>

                        </div>

                    @else

                        <div class="divide-y divide-gray-100">

                            @foreach ($proposedExchanges as $exchange)

                                @php
                                    $statusClasses = match ($exchange->status) {
                                        'accepted' => 'bg-green-50 text-green-700 ring-green-200',
                                        'declined' => 'bg-red-50 text-red-700 ring-red-200',
                                        default => 'bg-amber-50 text-amber-700 ring-amber-200',
                                    };

                                    $statusIcon = match ($exchange->status) {
                                        'accepted' => '✓',
                                        'declined' => '×',
                                        default => '⏳',
                                    };
                                @endphp

                                <div class="px-6 py-6 sm:px-8">

                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                                        <div>

                                            <div class="flex flex-wrap items-center gap-3">

                                                <h3 class="font-bold text-gray-900">
                                                    {{ $exchange->receiver->name }}
                                                </h3>

                                                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $statusClasses }}">
                                                    {{ $statusIcon }}
                                                    {{ ucfirst($exchange->status) }}
                                                </span>

                                            </div>

                                            <div class="mt-2 flex flex-wrap items-center gap-2 text-sm">

                                                <span class="rounded-lg bg-blue-50 px-3 py-1 font-semibold text-blue-700">
                                                    {{ $exchange->teachSkill->name }}
                                                </span>

                                                <span class="text-gray-400">
                                                    →
                                                </span>

                                                <span class="rounded-lg bg-green-50 px-3 py-1 font-semibold text-green-700">
                                                    {{ $exchange->learnSkill->name }}
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                    @if ($exchange->message)

                                        <div class="mt-4 rounded-2xl bg-slate-50 px-4 py-3">
                                            <p class="text-sm leading-6 text-gray-600">
                                                “{{ $exchange->message }}”
                                            </p>
                                        </div>

                                    @endif

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

            {{-- Received Exchanges --}}
            <div>

                <div class="mb-5 flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-100 text-xl">
                        📥
                    </div>

                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">
                            Skill Exchanges You Received
                        </h2>

                        <p class="mt-1 text-sm text-gray-500">
                            Review proposals from people who want to exchange skills with you.
                        </p>
                    </div>

                </div>

                <div class="rounded-3xl border border-gray-200 bg-white shadow-sm">

                    @if ($receivedExchanges->isEmpty())

                        <div class="px-6 py-10 text-center">

                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-2xl">
                                📥
                            </div>

                            <p class="mt-4 font-semibold text-gray-700">
                                You have not received any skill exchange proposals.
                            </p>

                            <p class="mt-1 text-sm text-gray-500">
                                When another member proposes an exchange with you, it will appear here.
                            </p>

                        </div>

                    @else

                        <div class="divide-y divide-gray-100">

                            @foreach ($receivedExchanges as $exchange)

                                @php
                                    $statusClasses = match ($exchange->status) {
                                        'accepted' => 'bg-green-50 text-green-700 ring-green-200',
                                        'declined' => 'bg-red-50 text-red-700 ring-red-200',
                                        default => 'bg-amber-50 text-amber-700 ring-amber-200',
                                    };

                                    $statusIcon = match ($exchange->status) {
                                        'accepted' => '✓',
                                        'declined' => '×',
                                        default => '⏳',
                                    };
                                @endphp

                                <div class="px-6 py-6 sm:px-8">

                                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

                                        <div class="min-w-0">

                                            <div class="flex flex-wrap items-center gap-3">

                                                <h3 class="font-bold text-gray-900">
                                                    {{ $exchange->proposer->name }}
                                                </h3>

                                                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $statusClasses }}">
                                                    {{ $statusIcon }}
                                                    {{ ucfirst($exchange->status) }}
                                                </span>

                                            </div>

                                            <div class="mt-3 flex flex-wrap items-center gap-2 text-sm">

                                                <span class="text-gray-500">
                                                    They offer:
                                                </span>

                                                <span class="rounded-lg bg-blue-50 px-3 py-1 font-semibold text-blue-700">
                                                    {{ $exchange->teachSkill->name }}
                                                </span>

                                                <span class="text-gray-400">
                                                    and want to learn
                                                </span>

                                                <span class="rounded-lg bg-green-50 px-3 py-1 font-semibold text-green-700">
                                                    {{ $exchange->learnSkill->name }}
                                                </span>

                                            </div>

                                            @if ($exchange->message)

                                                <div class="mt-4 rounded-2xl bg-slate-50 px-4 py-3">
                                                    <p class="text-sm leading-6 text-gray-600">
                                                        “{{ $exchange->message }}”
                                                    </p>
                                                </div>

                                            @endif

                                        </div>

                                        @if ($exchange->status === 'pending')

                                            <div class="flex flex-shrink-0 gap-3">

                                                <form
                                                    method="POST"
                                                    action="{{ route('skill-exchanges.accept', $exchange) }}"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center rounded-xl bg-green-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-green-700"
                                                    >
                                                        ✓ Accept
                                                    </button>

                                                </form>

                                                <form
                                                    method="POST"
                                                    action="{{ route('skill-exchanges.decline', $exchange) }}"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center rounded-xl bg-red-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-red-700"
                                                    >
                                                        × Decline
                                                    </button>

                                                </form>

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

            {{-- Bottom CTA --}}
            <div class="mt-10 rounded-3xl border border-indigo-100 bg-indigo-50 px-6 py-8 sm:px-8">

                <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-indigo-600">
                            Grow together
                        </p>

                        <h3 class="mt-1 text-xl font-bold text-gray-900">
                            Your skills are valuable.
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-gray-600">
                            Keep your skills updated so SkillLink can discover more meaningful exchanges for you.
                        </p>
                    </div>

                    <a
                        href="{{ route('skills.index') }}"
                        class="inline-flex flex-shrink-0 items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700"
                    >
                        Manage My Skills
                        <span class="ml-2">→</span>
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>