<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-600">
                    Communication
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    Messages
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Stay connected with tutors and members of the SkillLink community.
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

        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            {{-- Success message --}}
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-800">
                    <div class="flex items-center gap-3">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100 font-bold">
                            ✓
                        </span>

                        {{ session('success') }}
                    </div>
                </div>
            @endif

            {{-- Hero --}}
            <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-purple-600 shadow-lg">

                <div class="relative px-6 py-10 sm:px-10 sm:py-12">

                    <div class="absolute -right-16 -top-20 h-56 w-56 rounded-full bg-white/10"></div>
                    <div class="absolute -bottom-24 right-24 h-64 w-64 rounded-full bg-white/5"></div>

                    <div class="relative flex flex-col gap-8 sm:flex-row sm:items-center sm:justify-between">

                        <div class="max-w-2xl">

                            <div class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-semibold text-white ring-1 ring-white/20">
                                💬
                                Stay connected
                            </div>

                            <h1 class="mt-5 text-3xl font-bold tracking-tight text-white sm:text-4xl">
                                Your conversations.
                            </h1>

                            <p class="mt-4 max-w-xl text-base leading-7 text-indigo-100">
                                Communicate with tutors, students, and other SkillLink members
                                before and during your learning journey.
                            </p>

                        </div>

                        <div class="flex h-24 w-24 flex-shrink-0 items-center justify-center rounded-3xl bg-white/10 text-5xl ring-1 ring-white/20 backdrop-blur-sm">
                            💬
                        </div>

                    </div>

                </div>

            </div>

            {{-- Conversations --}}
            <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <h3 class="text-xl font-bold text-gray-900">
                                Your Conversations
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Open a conversation to continue messaging.
                            </p>
                        </div>

                        @if ($unreadCount > 0)
                            <div class="inline-flex w-fit items-center gap-2 rounded-full bg-red-50 px-4 py-2 text-sm font-bold text-red-700 ring-1 ring-red-200">
                                <span class="h-2 w-2 rounded-full bg-red-500"></span>
                                {{ $unreadCount }}
                                {{ $unreadCount === 1 ? 'unread message' : 'unread messages' }}
                            </div>
                        @else
                            <div class="inline-flex w-fit items-center gap-2 rounded-full bg-green-50 px-4 py-2 text-sm font-semibold text-green-700 ring-1 ring-green-200">
                                <span class="h-2 w-2 rounded-full bg-green-500"></span>
                                All caught up
                            </div>
                        @endif

                    </div>

                </div>

                @php
                    $conversationUsers = $messages
                        ->map(function ($message) {
                            return $message->sender_id === auth()->id()
                                ? $message->receiver
                                : $message->sender;
                        })
                        ->unique('id');
                @endphp

                @if ($conversationUsers->isEmpty())

                    {{-- Empty state --}}
                    <div class="px-6 py-16 text-center sm:px-8">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-indigo-50 text-4xl">
                            💬
                        </div>

                        <h3 class="mt-6 text-xl font-bold text-gray-900">
                            No conversations yet
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                            Start a conversation with a tutor or another SkillLink user
                            to discuss a learning session or exchange.
                        </p>

                        <div class="mt-7 flex flex-col justify-center gap-3 sm:flex-row">

                            <a
                                href="{{ route('tutors.index') }}"
                                class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-indigo-700"
                            >
                                Find a Tutor
                                <span class="ml-2">→</span>
                            </a>

                            <a
                                href="{{ route('requests.browse') }}"
                                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-5 py-3 text-sm font-bold text-gray-700 transition hover:bg-gray-50"
                            >
                                Browse Requests
                            </a>

                        </div>

                    </div>

                @else

                    <div class="divide-y divide-gray-100">

                        @foreach ($conversationUsers as $conversationUser)

                            @php
                                $latestMessage = $messages
                                    ->filter(function ($message) use ($conversationUser) {
                                        return
                                            ($message->sender_id === auth()->id() && $message->receiver_id === $conversationUser->id)
                                            ||
                                            ($message->sender_id === $conversationUser->id && $message->receiver_id === auth()->id());
                                    })
                                    ->sortByDesc('created_at')
                                    ->first();

                                $conversationUnreadCount = $messages
                                    ->where('sender_id', $conversationUser->id)
                                    ->where('receiver_id', auth()->id())
                                    ->where('is_read', false)
                                    ->count();
                            @endphp

                            <a
                                href="{{ route('messages.show', $conversationUser) }}"
                                class="group block px-6 py-5 transition hover:bg-slate-50 sm:px-8"
                            >

                                <div class="flex items-center gap-4">

                                    {{-- Avatar --}}
                                    <div class="relative flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-lg font-bold text-white shadow-sm">

                                        @if ($conversationUser->profile_image)
                                            <img
                                                src="{{ asset('storage/' . $conversationUser->profile_image) }}"
                                                alt="{{ $conversationUser->name }}"
                                                class="h-full w-full rounded-2xl object-cover"
                                            >
                                        @else
                                            {{ strtoupper(substr($conversationUser->name, 0, 1)) }}
                                        @endif

                                        @if ($conversationUnreadCount > 0)
                                            <span class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white ring-2 ring-white">
                                                {{ $conversationUnreadCount > 9 ? '9+' : $conversationUnreadCount }}
                                            </span>
                                        @endif

                                    </div>

                                    {{-- Conversation content --}}
                                    <div class="min-w-0 flex-1">

                                        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                                            <div class="flex min-w-0 items-center gap-2">

                                                <p class="truncate text-base font-bold text-gray-900 group-hover:text-indigo-600">
                                                    {{ $conversationUser->name }}
                                                </p>

                                                @if ($conversationUnreadCount > 0)
                                                    <span class="h-2 w-2 flex-shrink-0 rounded-full bg-indigo-500"></span>
                                                @endif

                                            </div>

                                            @if ($latestMessage)
                                                <p class="flex-shrink-0 text-xs text-gray-400">
                                                    {{ $latestMessage->created_at->format('M d, Y g:i A') }}
                                                </p>
                                            @endif

                                        </div>

                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ $conversationUser->location ?? 'Location not provided' }}
                                        </p>

                                        @if ($latestMessage)

                                            <p class="mt-2 truncate text-sm {{ $conversationUnreadCount > 0 ? 'font-semibold text-gray-700' : 'text-gray-500' }}">
                                                @if ($latestMessage->sender_id === auth()->id())
                                                    <span class="font-medium text-gray-400">You:</span>
                                                @endif

                                                {{ $latestMessage->message }}
                                            </p>

                                        @else

                                            <p class="mt-2 text-sm italic text-gray-400">
                                                No messages yet.
                                            </p>

                                        @endif

                                    </div>

                                    {{-- Open conversation --}}
                                    <div class="hidden flex-shrink-0 items-center gap-3 sm:flex">

                                        @if ($conversationUnreadCount > 0)
                                            <span class="rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 ring-1 ring-red-200">
                                                {{ $conversationUnreadCount }} unread
                                            </span>
                                        @endif

                                        <span class="text-lg text-gray-300 transition group-hover:translate-x-1 group-hover:text-indigo-500">
                                            →
                                        </span>

                                    </div>

                                </div>

                            </a>

                        @endforeach

                    </div>

                @endif

            </div>

            {{-- Bottom information --}}
            @if ($conversationUsers->isNotEmpty())

                <div class="mt-8 rounded-3xl border border-indigo-100 bg-indigo-50 px-6 py-7 sm:px-8">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <p class="text-sm font-bold uppercase tracking-wider text-indigo-600">
                                SkillLink Community
                            </p>

                            <h3 class="mt-1 text-lg font-bold text-gray-900">
                                Keep the conversation going.
                            </h3>

                            <p class="mt-1 text-sm leading-6 text-gray-600">
                                Discuss your learning goals, sessions, and skill exchanges directly with other members.
                            </p>
                        </div>

                        <a
                            href="{{ route('tutors.index') }}"
                            class="inline-flex flex-shrink-0 items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-indigo-700"
                        >
                            Find Someone to Learn From
                            <span class="ml-2">→</span>
                        </a>

                    </div>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>