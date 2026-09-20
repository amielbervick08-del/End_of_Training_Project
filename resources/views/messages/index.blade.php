<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-800">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Your Conversations
                        </h3>

                        @if ($unreadCount > 0)
                        <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                            {{ $unreadCount }} unread
                        </span>
                        @endif
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
                    <div class="mt-6 rounded-lg border border-dashed border-gray-300 p-8 text-center">
                        <p class="text-gray-600">
                            You don't have any conversations yet.
                        </p>

                        <p class="mt-2 text-sm text-gray-500">
                            Start a conversation with a tutor or another SkillLink user.
                        </p>
                    </div>
                    @else
                    <div class="mt-6 space-y-3">
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
                        @endphp

                        @php
                        $conversationUnreadCount = $messages
                        ->where('sender_id', $conversationUser->id)
                        ->where('receiver_id', auth()->id())
                        ->where('is_read', false)
                        ->count();
                        @endphp

                        <a
                            href="{{ route('messages.show', $conversationUser) }}"
                            class="block rounded-lg border border-gray-200 p-4 hover:bg-gray-50">
                            <div class="flex items-start justify-between gap-4">

                                <div class="min-w-0">

                                    <p class="font-semibold text-gray-900">
                                        {{ $conversationUser->name }}
                                    </p>

                                    <p class="text-sm text-gray-500">
                                        {{ $conversationUser->location ?? 'Location not provided' }}
                                    </p>

                                    @if ($latestMessage)
                                    <p class="mt-2 truncate text-sm text-gray-600">
                                        {{ $latestMessage->message }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        {{ $latestMessage->created_at->format('M d, Y g:i A') }}
                                    </p>
                                    @endif

                                </div>

                                <div class="flex shrink-0 flex-col items-end gap-2">

                                    @if ($conversationUnreadCount > 0)
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                        {{ $conversationUnreadCount }} unread
                                    </span>
                                    @endif

                                    <span class="text-sm text-indigo-600">
                                        Open conversation →
                                    </span>

                                </div>

                            </div>
                        </a>

                        @endforeach
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>