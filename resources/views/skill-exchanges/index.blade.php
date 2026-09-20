<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Skill Exchange
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Success message --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error message --}}
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Introduction --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-900">
                    Exchange your knowledge
                </h1>

                <p class="mt-2 text-gray-600">
                    Teach something you know and learn something you want to know.
                </p>
            </div>

            {{-- Potential Exchanges --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900">
                    Potential Skill Exchanges
                </h2>

                <p class="mt-1 text-gray-600">
                    People whose skills may complement what you want to learn and teach.
                </p>

                @if ($potentialExchanges->isEmpty())

                    <div class="mt-6 text-center py-8">
                        <p class="text-gray-500">
                            No potential skill exchanges found yet.
                        </p>

                        <p class="mt-2 text-sm text-gray-400">
                            As more users join SkillLink, potential exchanges will appear
                            here when your skills match theirs.
                        </p>
                    </div>

                @else

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                        @foreach ($potentialExchanges as $exchange)

                            <div class="border rounded-lg p-5">

                                <h3 class="text-lg font-semibold text-gray-900">
                                    {{ $exchange['user']->name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $exchange['user']->location }}
                                </p>

                                <div class="mt-4">
                                    <h4 class="font-medium text-gray-800">
                                        You can teach
                                    </h4>

                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach ($exchange['skills_you_can_teach'] as $userSkill)
                                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                                                {{ $userSkill->skill->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <h4 class="font-medium text-gray-800">
                                        They can teach you
                                    </h4>

                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach ($exchange['skills_they_can_teach'] as $userSkill)
                                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                                {{ $userSkill->skill->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <a
                                        href="{{ route('tutors.show', $exchange['user']) }}"
                                        class="inline-block px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700"
                                    >
                                        View Profile
                                    </a>
                                </div>

                                {{-- Proposal form --}}
                                <div class="mt-6 border-t pt-5">

                                    <h4 class="font-semibold text-gray-900">
                                        Propose a Skill Exchange
                                    </h4>

                                    <form
                                        method="POST"
                                        action="{{ route('skill-exchanges.store') }}"
                                        class="mt-4 space-y-4"
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
                                                class="block text-sm font-medium text-gray-700"
                                            >
                                                Skill you will teach
                                            </label>

                                            <select
                                                id="teach_skill_{{ $exchange['user']->id }}"
                                                name="teach_skill_id"
                                                required
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
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
                                                class="block text-sm font-medium text-gray-700"
                                            >
                                                Skill you want to learn
                                            </label>

                                            <select
                                                id="learn_skill_{{ $exchange['user']->id }}"
                                                name="learn_skill_id"
                                                required
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
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
                                                class="block text-sm font-medium text-gray-700"
                                            >
                                                Message
                                            </label>

                                            <textarea
                                                id="message_{{ $exchange['user']->id }}"
                                                name="message"
                                                rows="3"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                                placeholder="Tell them about the exchange you are proposing..."
                                            ></textarea>
                                        </div>

                                        <button
                                            type="submit"
                                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                                        >
                                            Propose Exchange
                                        </button>
                                    </form>

                                </div>
                            </div>

                        @endforeach

                    </div>

                @endif
            </div>

            {{-- Proposed Exchanges --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h2 class="text-xl font-semibold text-gray-900">
                    Exchanges You Proposed
                </h2>

                @if ($proposedExchanges->isEmpty())

                    <p class="mt-4 text-gray-500">
                        You have not proposed any skill exchanges yet.
                    </p>

                @else

                    <div class="mt-6 space-y-4">

                        @foreach ($proposedExchanges as $exchange)

                            <div class="border rounded-lg p-5">

                                <div class="flex justify-between items-start">

                                    <div>
                                        <h3 class="font-semibold text-gray-900">
                                            {{ $exchange->receiver->name }}
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            {{ $exchange->teachSkill->name }}
                                            →
                                            {{ $exchange->learnSkill->name }}
                                        </p>
                                    </div>

                                    <span class="px-3 py-1 rounded-full text-sm
                                        @if ($exchange->status === 'accepted')
                                            bg-green-100 text-green-800
                                        @elseif ($exchange->status === 'declined')
                                            bg-red-100 text-red-800
                                        @else
                                            bg-yellow-100 text-yellow-800
                                        @endif
                                    ">
                                        {{ ucfirst($exchange->status) }}
                                    </span>

                                </div>

                                @if ($exchange->message)
                                    <p class="mt-3 text-gray-600">
                                        {{ $exchange->message }}
                                    </p>
                                @endif

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

            {{-- Received Exchanges --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h2 class="text-xl font-semibold text-gray-900">
                    Skill Exchanges You Received
                </h2>

                @if ($receivedExchanges->isEmpty())

                    <p class="mt-4 text-gray-500">
                        You have not received any skill exchange proposals.
                    </p>

                @else

                    <div class="mt-6 space-y-4">

                        @foreach ($receivedExchanges as $exchange)

                            <div class="border rounded-lg p-5">

                                <div class="flex justify-between items-start">

                                    <div>
                                        <h3 class="font-semibold text-gray-900">
                                            {{ $exchange->proposer->name }}
                                        </h3>

                                        <p class="text-sm text-gray-500">
                                            They offer:
                                            <strong>{{ $exchange->teachSkill->name }}</strong>

                                            and want to learn:

                                            <strong>{{ $exchange->learnSkill->name }}</strong>
                                        </p>
                                    </div>

                                    <span class="px-3 py-1 rounded-full text-sm
                                        @if ($exchange->status === 'accepted')
                                            bg-green-100 text-green-800
                                        @elseif ($exchange->status === 'declined')
                                            bg-red-100 text-red-800
                                        @else
                                            bg-yellow-100 text-yellow-800
                                        @endif
                                    ">
                                        {{ ucfirst($exchange->status) }}
                                    </span>

                                </div>

                                @if ($exchange->message)
                                    <p class="mt-3 text-gray-600">
                                        {{ $exchange->message }}
                                    </p>
                                @endif

                                @if ($exchange->status === 'pending')

                                    <div class="mt-4 flex gap-3">

                                        <form
                                            method="POST"
                                            action="{{ route('skill-exchanges.accept', $exchange) }}"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"
                                            >
                                                Accept
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
                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                                            >
                                                Decline
                                            </button>
                                        </form>

                                    </div>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @endif

            </div>

        </div>
    </div>
</x-app-layout>