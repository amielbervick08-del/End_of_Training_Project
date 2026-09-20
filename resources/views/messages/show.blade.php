<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Conversation with {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-800">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Conversation header -->
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $user->name }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $user->location ?? 'Location not provided' }}
                            </p>
                        </div>

                        <a
                            href="{{ route('messages.index') }}"
                            class="text-sm text-indigo-600 hover:text-indigo-800"
                        >
                            ← Back to Messages
                        </a>
                    </div>
                </div>

                <!-- Messages -->
                <div class="p-6">
                    <div class="space-y-4 max-h-[500px] overflow-y-auto">

                        @forelse ($messages as $message)
                            @if ($message->sender_id === auth()->id())
                                <!-- Sent message -->
                                <div class="flex justify-end">
                                    <div class="max-w-md">
                                        <div class="rounded-lg bg-indigo-600 px-4 py-3 text-white">
                                            {{ $message->message }}
                                        </div>

                                        <p class="mt-1 text-right text-xs text-gray-500">
                                            {{ $message->created_at->format('M d, Y g:i A') }}
                                        </p>
                                    </div>
                                </div>
                            @else
                                <!-- Received message -->
                                <div class="flex justify-start">
                                    <div class="max-w-md">
                                        <div class="rounded-lg bg-gray-100 px-4 py-3 text-gray-900">
                                            {{ $message->message }}
                                        </div>

                                        <p class="mt-1 text-xs text-gray-500">
                                            {{ $message->created_at->format('M d, Y g:i A') }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="py-12 text-center">
                                <p class="text-gray-500">
                                    No messages yet.
                                </p>

                                <p class="mt-1 text-sm text-gray-400">
                                    Send the first message below.
                                </p>
                            </div>
                        @endforelse

                    </div>

                    <!-- Send message form -->
                    <form
                        method="POST"
                        action="{{ route('messages.store', $user) }}"
                        class="mt-6 border-t border-gray-200 pt-6"
                    >
                        @csrf

                        <label
                            for="message"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Message
                        </label>

                        <textarea
                            id="message"
                            name="message"
                            rows="4"
                            required
                            maxlength="5000"
                            class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Write your message..."
                        >{{ old('message') }}</textarea>

                        <div class="mt-4 flex justify-end">
                            <button
                                type="submit"
                                class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700"
                            >
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>