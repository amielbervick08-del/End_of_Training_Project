<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-600">
                    Communication
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Conversation
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Chat with {{ $user->name }}.
                </p>
            </div>

            <a
                href="{{ route('messages.index') }}"
                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50">
                ← All Messages
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8">

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if (session('success'))
            <div class="mb-5 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-800">
                <div class="flex items-center gap-3">
                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 font-bold">
                        ✓
                    </span>

                    {{ session('success') }}
                </div>
            </div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-800">

                <div class="flex gap-3">
                    <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-red-100 font-bold">
                        !
                    </span>

                    <div>
                        <p class="font-bold">
                            Please check your message.
                        </p>

                        <ul class="mt-2 list-disc space-y-1 pl-5">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
            @endif

            {{-- Chat container --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                {{-- Conversation header --}}
                <div class="border-b border-gray-100 bg-white px-5 py-5 sm:px-7">

                    <div class="flex items-center justify-between gap-4">

                        <div class="flex min-w-0 items-center gap-4">

                            {{-- Avatar --}}
                            <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-lg font-bold text-white shadow-sm">

                                @if ($user->profile_image)
                                <img
                                    src="{{ asset('storage/' . $user->profile_image) }}"
                                    alt="{{ $user->name }}"
                                    class="h-full w-full object-cover">
                                @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif

                            </div>

                            <div class="min-w-0">

                                <h3 class="truncate text-lg font-bold text-gray-900">
                                    {{ $user->name }}
                                </h3>

                                <div class="mt-1 flex items-center gap-2 text-sm text-gray-500">
                                    <svg
                                        class="h-4 w-4 text-gray-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>

                                    {{ $user->location ?? 'Location not provided' }}
                                </div>

                            </div>

                        </div>

                        <a
                            href="{{ route('tutors.show', $user) }}"
                            class="hidden rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 sm:inline-flex">
                            View Profile
                        </a>

                    </div>

                </div>

                {{-- Messages area --}}
                <div class="bg-slate-50 px-4 py-6 sm:px-7">

                    <div class="max-h-[520px] min-h-[320px] space-y-5 overflow-y-auto pr-1">

                        @forelse ($messages as $message)

                        @if ($message->sender_id === auth()->id())

                        {{-- Sent message --}}
                        <div class="flex justify-end">

                            <div class="flex max-w-[85%] flex-col items-end sm:max-w-[70%]">

                                <div class="rounded-2xl rounded-br-md bg-indigo-600 px-4 py-3 text-sm leading-6 text-white shadow-sm">
                                    {{ $message->message }}
                                </div>

                                <p class="mt-1.5 px-1 text-xs text-gray-400">
                                    {{ $message->created_at->format('M d, Y g:i A') }}
                                </p>

                            </div>

                        </div>

                        @else

                        {{-- Received message --}}
                        <div class="flex justify-start">

                            <div class="flex max-w-[85%] items-start gap-3 sm:max-w-[70%]">

                                <div class="hidden h-9 w-9 flex-shrink-0 items-center justify-center overflow-hidden rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-xs font-bold text-white sm:flex">

                                    @if ($user->profile_image)
                                    <img
                                        src="{{ asset('storage/' . $user->profile_image) }}"
                                        alt="{{ $user->name }}"
                                        class="h-full w-full object-cover">
                                    @else
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                    @endif

                                </div>

                                <div>

                                    <div class="rounded-2xl rounded-bl-md border border-gray-200 bg-white px-4 py-3 text-sm leading-6 text-gray-900 shadow-sm">
                                        {{ $message->message }}
                                    </div>

                                    <p class="mt-1.5 px-1 text-xs text-gray-400">
                                        {{ $message->created_at->format('M d, Y g:i A') }}
                                    </p>

                                </div>

                            </div>

                        </div>

                        @endif

                        @empty

                        {{-- Empty conversation --}}
                        <div class="flex min-h-[300px] items-center justify-center">

                            <div class="max-w-sm text-center">

                                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-3xl">
                                    💬
                                </div>

                                <h3 class="mt-5 text-lg font-bold text-gray-900">
                                    Start the conversation
                                </h3>

                                <p class="mt-2 text-sm leading-6 text-gray-500">
                                    There are no messages between you and {{ $user->name }} yet.
                                    Send the first message below.
                                </p>

                            </div>

                        </div>

                        @endforelse

                    </div>

                </div>

                {{-- Message composer --}}
                <div class="border-t border-gray-100 bg-white px-4 py-5 sm:px-7">

                    <form
                        method="POST"
                        action="{{ route('messages.store', $user) }}">
                        @csrf

                        <div class="flex flex-col gap-3 sm:flex-row sm:items-end">

                            <div class="flex-1">

                                <label
                                    for="message"
                                    class="sr-only">
                                    Message
                                </label>

                                <textarea
                                    id="message"
                                    name="message"
                                    rows="3"
                                    required
                                    maxlength="5000"
                                    class="block w-full resize-none rounded-2xl border-gray-200 bg-slate-50 px-4 py-3 text-sm leading-6 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                                    placeholder="Write a message to {{ $user->name }}...">{{ old('message') }}</textarea>

                                <div class="mt-2 flex items-center justify-between px-1">

                                    <p class="text-xs text-gray-400">
                                        Be respectful and keep your message relevant to your learning journey.
                                    </p>

                                    <p class="hidden text-xs text-gray-400 sm:block">
                                        Max 5000 characters
                                    </p>

                                </div>

                            </div>

                            <button
                                type="submit"
                                class="inline-flex h-12 items-center justify-center rounded-xl bg-indigo-600 px-6 text-sm font-bold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Send
                                <span class="ml-2">➤</span>
                            </button>

                        </div>

                    </form>

                </div>

            </div>

            {{-- Bottom navigation --}}
            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                <a
                    href="{{ route('messages.index') }}"
                    class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-800">
                    ← Back to all conversations
                </a>

                <a
                    href="{{ route('tutors.show', $user) }}"
                    class="text-sm font-semibold text-gray-500 transition hover:text-gray-700">
                    View {{ $user->name }}'s profile →
                </a>

            </div>

        </div>

    </div>

</x-app-layout>