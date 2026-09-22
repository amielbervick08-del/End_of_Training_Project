<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-semibold text-indigo-600">
                    Account & Settings
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-gray-900">
                    My Profile
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    Manage your SkillLink profile, security, and account settings.
                </p>
            </div>

            <a
                href="{{ route('dashboard') }}"
                class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm transition hover:bg-gray-50">
                ← Dashboard
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-10">

        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- Profile overview --}}
            <div class="mb-8 overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-600 to-purple-600 shadow-lg">

                <div class="relative px-6 py-8 sm:px-10 sm:py-10">

                    {{-- Decorative circles --}}
                    <div class="absolute -right-20 -top-24 h-64 w-64 rounded-full bg-white/10"></div>
                    <div class="absolute -bottom-32 right-32 h-72 w-72 rounded-full bg-white/5"></div>

                    <div class="relative flex flex-col gap-7 sm:flex-row sm:items-center">

                        {{-- Avatar --}}
                        <div class="flex h-24 w-24 flex-shrink-0 items-center justify-center overflow-hidden rounded-3xl bg-white/15 text-3xl font-bold text-white ring-1 ring-white/30 backdrop-blur-sm">

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

                            <div class="flex flex-wrap items-center gap-3">

                                <h1 class="text-3xl font-bold tracking-tight text-white">
                                    {{ $user->name }}
                                </h1>

                                @if ($user->role)
                                <span class="rounded-full bg-white/15 px-3 py-1 text-xs font-bold capitalize text-white ring-1 ring-white/20">
                                    {{ $user->role === 'both' ? 'Learn & Teach' : $user->role }}
                                </span>
                                @endif

                            </div>

                            <p class="mt-2 text-indigo-100">
                                {{ $user->email }}
                            </p>

                            <div class="mt-4 flex flex-wrap gap-2">

                                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-sm font-medium text-indigo-50 ring-1 ring-white/10">
                                    <span>📍</span>
                                    {{ $user->location ?? 'Location not provided' }}
                                </span>

                                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-sm font-medium text-indigo-50 ring-1 ring-white/10">
                                    <span>⭐</span>

                                    @if ($reviews->count() > 0)
                                    {{ number_format($averageRating, 1) }}/5
                                    @else
                                    No reviews yet
                                    @endif
                                </span>

                                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1.5 text-sm font-medium text-indigo-50 ring-1 ring-white/10">
                                    <span>⚡</span>
                                    {{ $user->skill_points ?? 0 }} SkillPoints
                                </span>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Quick profile statistics --}}
            <div class="mb-8 grid gap-4 sm:grid-cols-3">

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl">
                            👤
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Profile
                            </p>

                            <p class="font-bold text-gray-900">
                                {{ ucfirst($user->role ?? 'Member') }}
                            </p>
                        </div>

                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-50 text-xl">
                            ⭐
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Rating
                            </p>

                            <p class="font-bold text-gray-900">
                                @if ($reviews->count() > 0)
                                {{ number_format($averageRating, 1) }}/5
                                @else
                                No ratings
                                @endif
                            </p>
                        </div>

                    </div>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-xl">
                            💬
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Reviews
                            </p>

                            <p class="font-bold text-gray-900">
                                {{ $reviews->count() }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>

            {{-- Profile information --}}
            <div class="mb-6 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <p class="text-sm font-semibold text-indigo-600">
                        Personal Information
                    </p>

                    <h3 class="mt-1 text-xl font-bold text-gray-900">
                        Profile Information
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Update your name, email, location, bio, and SkillLink profile details.
                    </p>

                </div>

                <div class="p-6 sm:p-8">
                    <div class="max-w-3xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

            </div>

            {{-- Password --}}
            <div class="mb-6 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <p class="text-sm font-semibold text-indigo-600">
                        Security
                    </p>

                    <h3 class="mt-1 text-xl font-bold text-gray-900">
                        Password & Security
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Keep your SkillLink account secure by using a strong password.
                    </p>

                </div>

                <div class="p-6 sm:p-8">
                    <div class="max-w-3xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

            </div>

            {{-- Reviews --}}
            <div class="mb-6 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm">

                <div class="border-b border-gray-100 px-6 py-5 sm:px-8">

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <p class="text-sm font-semibold text-indigo-600">
                                Community Feedback
                            </p>

                            <h3 class="mt-1 text-xl font-bold text-gray-900">
                                Reviews
                            </h3>

                            @if ($reviews->count() > 0)
                            <p class="mt-1 text-sm text-gray-500">
                                Feedback from people you've learned with or helped.
                            </p>
                            @else
                            <p class="mt-1 text-sm text-gray-500">
                                You haven't received any reviews yet.
                            </p>
                            @endif
                        </div>

                        @if ($reviews->count() > 0)
                        <div class="flex items-center gap-3 rounded-2xl bg-yellow-50 px-4 py-3 ring-1 ring-yellow-100">

                            <span class="text-2xl">
                                ⭐
                            </span>

                            <div>
                                <p class="text-lg font-bold text-gray-900">
                                    {{ number_format($averageRating, 1) }}/5
                                </p>

                                <p class="text-xs text-gray-500">
                                    {{ $reviews->count() }}
                                    {{ $reviews->count() === 1 ? 'review' : 'reviews' }}
                                </p>
                            </div>

                        </div>
                        @endif

                    </div>

                </div>

                @if ($reviews->count() > 0)

                <div class="divide-y divide-gray-100">

                    @foreach ($reviews as $review)

                    <div class="px-6 py-6 sm:px-8">

                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

                            <div class="flex items-start gap-4">

                                {{-- Reviewer avatar --}}
                                <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-sm font-bold text-white">
                                    {{ strtoupper(substr($review->reviewer->name, 0, 1)) }}
                                </div>

                                <div>

                                    <p class="font-bold text-gray-900">
                                        {{ $review->reviewer->name }}
                                    </p>

                                    <p class="mt-1 text-xs text-gray-400">
                                        {{ $review->created_at->format('M d, Y') }}
                                    </p>

                                </div>

                            </div>

                            <div class="flex items-center gap-2">

                                <span class="text-yellow-500">
                                    ★
                                </span>

                                <span class="font-bold text-gray-900">
                                    {{ $review->rating }}/5
                                </span>

                            </div>

                        </div>

                        @if ($review->comment)

                        <div class="mt-4 rounded-2xl bg-slate-50 px-5 py-4">

                            <p class="text-sm leading-6 text-gray-600">
                                "{{ $review->comment }}"
                            </p>

                        </div>

                        @endif

                    </div>

                    @endforeach

                </div>

                @else

                <div class="px-6 py-12 text-center sm:px-8">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-3xl">
                        ⭐
                    </div>

                    <h4 class="mt-5 font-bold text-gray-900">
                        No reviews yet
                    </h4>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500">
                        Complete learning or teaching sessions to start building your SkillLink reputation.
                    </p>

                </div>

                @endif

            </div>

            {{-- Danger zone --}}
            <div class="overflow-hidden rounded-3xl border border-red-200 bg-white shadow-sm">

                <div class="border-b border-red-100 bg-red-50/50 px-6 py-5 sm:px-8">

                    <p class="text-sm font-semibold text-red-600">
                        Danger Zone
                    </p>

                    <h3 class="mt-1 text-xl font-bold text-gray-900">
                        Delete Account
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Permanently remove your SkillLink account and associated data.
                    </p>

                </div>

                <div class="p-6 sm:p-8">

                    <div class="max-w-3xl">
                        @include('profile.partials.delete-user-form')
                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>