<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                    SkillLink
                </p>

                <h2 class="mt-1 text-2xl font-bold text-gray-900">
                    Notifications
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Stay updated on your SkillLink activity.
                </p>
            </div>

            @if ($notifications->whereNull('read_at')->count() > 0)
                <form method="POST" action="{{ route('notifications.read-all') }}">
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
                    >
                        Mark all as read
                    </button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50">
        <div class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm font-medium text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($notifications->count())
                <div class="space-y-4">
                    @foreach ($notifications as $notification)
                        <div
                            class="rounded-2xl border p-5 shadow-sm transition
                            {{ $notification->read_at
                                ? 'border-gray-200 bg-white'
                                : 'border-indigo-200 bg-indigo-50/50' }}"
                        >
                            <div class="flex items-start gap-4">

                                <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl
                                    {{ $notification->read_at
                                        ? 'bg-gray-100 text-gray-500'
                                        : 'bg-indigo-100 text-indigo-600' }}">
                                    @if (($notification->data['type'] ?? '') === 'message')
                                        💬
                                    @elseif (($notification->data['type'] ?? '') === 'booking')
                                        📅
                                    @elseif (($notification->data['type'] ?? '') === 'review')
                                        ⭐
                                    @elseif (($notification->data['type'] ?? '') === 'skill_exchange')
                                        🔄
                                    @else
                                        🔔
                                    @endif
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                        <div>
                                            <h3 class="font-bold text-gray-900">
                                                {{ $notification->data['title'] ?? 'Notification' }}
                                            </h3>

                                            <p class="mt-1 text-sm leading-6 text-gray-600">
                                                {{ $notification->data['message'] ?? '' }}
                                            </p>
                                        </div>

                                        @if (!$notification->read_at)
                                            <span class="inline-flex w-fit rounded-full bg-indigo-100 px-2.5 py-1 text-xs font-bold text-indigo-700">
                                                New
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                        <p class="text-xs text-gray-400">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>

                                        <div class="flex flex-wrap gap-2">
                                            @if (!empty($notification->data['url']))
                                                <a
                                                    href="{{ $notification->data['url'] }}"
                                                    class="inline-flex items-center rounded-lg bg-indigo-600 px-3 py-2 text-xs font-bold text-white transition hover:bg-indigo-700"
                                                >
                                                    View
                                                </a>
                                            @endif

                                            @if (!$notification->read_at)
                                                <form
                                                    method="POST"
                                                    action="{{ route('notifications.read', $notification->id) }}"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-xs font-bold text-gray-700 transition hover:bg-gray-50"
                                                    >
                                                        Mark as read
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $notifications->links() }}
                </div>
            @else
                <div class="rounded-3xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center shadow-sm">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-3xl">
                        🔔
                    </div>

                    <h3 class="mt-5 text-lg font-bold text-gray-900">
                        No notifications yet
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        You're all caught up. New messages, bookings, reviews,
                        and SkillLink activity will appear here.
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>