<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Skills') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error message --}}
            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Add Skill --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-4">
                        Add a Skill
                    </h3>

                    <form method="POST" action="{{ route('skills.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            {{-- Skill --}}
                            <div>
                                <label for="skill_id" class="block text-sm font-medium text-gray-700">
                                    Skill
                                </label>

                                <select
                                    id="skill_id"
                                    name="skill_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    required
                                >
                                    <option value="">Select a skill</option>

                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill->id }}">
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
                                <label for="type" class="block text-sm font-medium text-gray-700">
                                    I want to
                                </label>

                                <select
                                    id="type"
                                    name="type"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    required
                                >
                                    <option value="">Select</option>
                                    <option value="teach">Teach</option>
                                    <option value="learn">Learn</option>
                                </select>

                                <x-input-error
                                    :messages="$errors->get('type')"
                                    class="mt-2"
                                />
                            </div>

                            {{-- Level --}}
                            <div>
                                <label for="level" class="block text-sm font-medium text-gray-700">
                                    Level
                                </label>

                                <select
                                    id="level"
                                    name="level"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                    required
                                >
                                    <option value="">Select level</option>
                                    <option value="beginner">Beginner</option>
                                    <option value="intermediate">Intermediate</option>
                                    <option value="advanced">Advanced</option>
                                    <option value="expert">Expert</option>
                                </select>

                                <x-input-error
                                    :messages="$errors->get('level')"
                                    class="mt-2"
                                />
                            </div>

                        </div>

                        <div class="mt-6">
                            <button
                                type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700"
                            >
                                Add Skill
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            {{-- Current Skills --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h3 class="text-lg font-semibold mb-6">
                        My Skills
                    </h3>

                    @if ($userSkills->isEmpty())

                        <p class="text-gray-500">
                            You haven't added any skills yet.
                        </p>

                    @else

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Skills I Teach --}}
                            <div>
                                <h4 class="text-md font-semibold mb-3">
                                    Skills I Teach
                                </h4>

                                @php
                                    $teachingSkills = $userSkills->where('type', 'teach');
                                @endphp

                                @if ($teachingSkills->isEmpty())

                                    <p class="text-gray-500">
                                        No teaching skills added yet.
                                    </p>

                                @else

                                    <div class="space-y-3">

                                        @foreach ($teachingSkills as $userSkill)

                                            <div class="border rounded-lg p-4 flex justify-between items-center">

                                                <div>
                                                    <p class="font-medium">
                                                        {{ $userSkill->skill->name }}
                                                    </p>

                                                    <p class="text-sm text-gray-500">
                                                        {{ ucfirst($userSkill->level) }}
                                                    </p>
                                                </div>

                                                <form
                                                    method="POST"
                                                    action="{{ route('skills.destroy', $userSkill) }}"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="text-red-600 hover:text-red-800 text-sm"
                                                    >
                                                        Remove
                                                    </button>
                                                </form>

                                            </div>

                                        @endforeach

                                    </div>

                                @endif
                            </div>

                            {{-- Skills I Want to Learn --}}
                            <div>
                                <h4 class="text-md font-semibold mb-3">
                                    Skills I Want to Learn
                                </h4>

                                @php
                                    $learningSkills = $userSkills->where('type', 'learn');
                                @endphp

                                @if ($learningSkills->isEmpty())

                                    <p class="text-gray-500">
                                        No learning skills added yet.
                                    </p>

                                @else

                                    <div class="space-y-3">

                                        @foreach ($learningSkills as $userSkill)

                                            <div class="border rounded-lg p-4 flex justify-between items-center">

                                                <div>
                                                    <p class="font-medium">
                                                        {{ $userSkill->skill->name }}
                                                    </p>

                                                    <p class="text-sm text-gray-500">
                                                        {{ ucfirst($userSkill->level) }}
                                                    </p>
                                                </div>

                                                <form
                                                    method="POST"
                                                    action="{{ route('skills.destroy', $userSkill) }}"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="text-red-600 hover:text-red-800 text-sm"
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

                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>