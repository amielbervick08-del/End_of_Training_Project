<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Learning Request
            </h2>

            <a
                href="{{ route('requests.show', $learningRequest) }}"
                class="text-sm text-gray-600 hover:text-gray-900"
            >
                ← Back to Request
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h1 class="text-2xl font-bold text-gray-900">
                        Edit Your Learning Request
                    </h1>

                    <p class="mt-1 text-sm text-gray-600">
                        Update the details of your learning request.
                    </p>

                    @if ($errors->any())
                        <div class="mt-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mt-4 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('requests.update', $learningRequest) }}"
                        class="mt-6 space-y-6"
                    >
                        @csrf
                        @method('PUT')

                        {{-- Skill --}}
                        <div>
                            <x-input-label for="skill_id" value="Skill" />

                            <select
                                id="skill_id"
                                name="skill_id"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required
                            >
                                <option value="">Select a skill</option>

                                @foreach ($skills as $skill)
                                    <option
                                        value="{{ $skill->id }}"
                                        {{ old('skill_id', $learningRequest->skill_id) == $skill->id ? 'selected' : '' }}
                                    >
                                        {{ $skill->name }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error
                                :messages="$errors->get('skill_id')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Title --}}
                        <div>
                            <x-input-label for="title" value="Request Title" />

                            <x-text-input
                                id="title"
                                class="block mt-1 w-full"
                                type="text"
                                name="title"
                                :value="old('title', $learningRequest->title)"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('title')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Description --}}
                        <div>
                            <x-input-label for="description" value="Description" />

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required
                            >{{ old('description', $learningRequest->description) }}</textarea>

                            <x-input-error
                                :messages="$errors->get('description')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Location --}}
                        <div>
                            <x-input-label for="location" value="Location" />

                            <x-text-input
                                id="location"
                                class="block mt-1 w-full"
                                type="text"
                                name="location"
                                :value="old('location', $learningRequest->location)"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('location')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Session Type --}}
                        <div>
                            <x-input-label for="session_type" value="Session Type" />

                            <select
                                id="session_type"
                                name="session_type"
                                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                required
                            >
                                <option
                                    value="online"
                                    {{ old('session_type', $learningRequest->session_type) === 'online' ? 'selected' : '' }}
                                >
                                    Online
                                </option>

                                <option
                                    value="in_person"
                                    {{ old('session_type', $learningRequest->session_type) === 'in_person' ? 'selected' : '' }}
                                >
                                    In Person
                                </option>

                                <option
                                    value="either"
                                    {{ old('session_type', $learningRequest->session_type) === 'either' ? 'selected' : '' }}
                                >
                                    Either
                                </option>
                            </select>

                            <x-input-error
                                :messages="$errors->get('session_type')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Duration --}}
                        <div>
                            <x-input-label
                                for="duration"
                                value="Duration (minutes)"
                            />

                            <x-text-input
                                id="duration"
                                class="block mt-1 w-full"
                                type="number"
                                name="duration"
                                min="15"
                                max="480"
                                step="15"
                                :value="old('duration', $learningRequest->duration)"
                                required
                            />

                            <p class="mt-1 text-sm text-gray-500">
                                Choose a duration between 15 and 480 minutes.
                            </p>

                            <x-input-error
                                :messages="$errors->get('duration')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Preferred Date --}}
                        <div>
                            <x-input-label
                                for="preferred_date"
                                value="Preferred Date"
                            />

                            <x-text-input
                                id="preferred_date"
                                class="block mt-1 w-full"
                                type="date"
                                name="preferred_date"
                                :value="old(
                                    'preferred_date',
                                    $learningRequest->preferred_date
                                        ? $learningRequest->preferred_date->format('Y-m-d')
                                        : ''
                                )"
                            />

                            <x-input-error
                                :messages="$errors->get('preferred_date')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Preferred Time --}}
                        <div>
                            <x-input-label
                                for="preferred_time"
                                value="Preferred Time"
                            />

                            <x-text-input
                                id="preferred_time"
                                class="block mt-1 w-full"
                                type="time"
                                name="preferred_time"
                                :value="old('preferred_time', $learningRequest->preferred_time)"
                            />

                            <x-input-error
                                :messages="$errors->get('preferred_time')"
                                class="mt-2"
                            />
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-center justify-end gap-3">

                            <a
                                href="{{ route('requests.show', $learningRequest) }}"
                                class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900"
                            >
                                Cancel
                            </a>

                            <x-primary-button>
                                Save Changes
                            </x-primary-button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>