<section>

    {{-- Section heading --}}
    <div class="mb-8">

        <div class="flex items-center gap-3">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-xl">
                👤
            </div>

            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    {{ __('Profile Information') }}
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    {{ __('Update your SkillLink profile information.') }}
                </p>
            </div>

        </div>

    </div>

    {{-- Email verification form --}}
    <form
        id="send-verification"
        method="post"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    {{-- Profile form --}}
    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="space-y-7"
    >
        @csrf
        @method('patch')

        {{-- Name --}}
        <div>
            <x-input-label
                for="name"
                :value="__('Full Name')"
                class="font-semibold text-gray-700"
            />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-slate-50 px-4 py-3 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                :value="old('name', $user->name)"
                required
                autofocus
                autocomplete="name"
                placeholder="Enter your full name"
            />

            <p class="mt-1.5 text-xs text-gray-400">
                This is the name other SkillLink users will see.
            </p>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('name')"
            />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label
                for="email"
                :value="__('Email Address')"
                class="font-semibold text-gray-700"
            />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-slate-50 px-4 py-3 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                :value="old('email', $user->email)"
                required
                autocomplete="username"
                placeholder="you@example.com"
            />

            <x-input-error
                class="mt-2"
                :messages="$errors->get('email')"
            />

            {{-- Email verification --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

                <div class="mt-3 rounded-xl border border-amber-200 bg-amber-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-amber-100 text-sm">
                            ⚠️
                        </div>

                        <div class="min-w-0">

                            <p class="text-sm font-semibold text-amber-900">
                                {{ __('Your email address is unverified.') }}
                            </p>

                            <p class="mt-1 text-sm leading-5 text-amber-800">
                                Please verify your email address to keep your account secure.
                            </p>

                            <button
                                form="send-verification"
                                class="mt-3 inline-flex items-center rounded-lg font-semibold text-amber-900 underline decoration-amber-400 underline-offset-2 transition hover:text-amber-700"
                            >
                                {{ __('Resend verification email') }}
                            </button>

                            @if (session('status') === 'verification-link-sent')

                                <p class="mt-2 text-sm font-medium text-green-700">
                                    ✓ {{ __('A new verification link has been sent to your email address.') }}
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

            @endif
        </div>

        {{-- Location --}}
        <div>
            <x-input-label
                for="location"
                :value="__('Location')"
                class="font-semibold text-gray-700"
            />

            <div class="relative mt-2">

                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    📍
                </div>

                <x-text-input
                    id="location"
                    name="location"
                    type="text"
                    class="block w-full rounded-xl border-gray-200 bg-slate-50 py-3 pl-11 pr-4 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                    :value="old('location', $user->location)"
                    placeholder="e.g. Yaoundé"
                    required
                    autocomplete="address-level2"
                />

            </div>

            <p class="mt-1.5 text-xs text-gray-400">
                Your location helps other users find relevant learning opportunities.
            </p>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('location')"
            />
        </div>

        {{-- Bio --}}
        <div>
            <div class="flex items-center justify-between">

                <x-input-label
                    for="bio"
                    :value="__('Bio')"
                    class="font-semibold text-gray-700"
                />

                <span class="text-xs text-gray-400">
                    About you
                </span>

            </div>

            <textarea
                id="bio"
                name="bio"
                rows="5"
                maxlength="1000"
                class="mt-2 block w-full resize-y rounded-xl border-gray-200 bg-slate-50 px-4 py-3 text-sm leading-6 text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                placeholder="Tell other SkillLink users a little about yourself..."
            >{{ old('bio', $user->bio) }}</textarea>

            <div class="mt-1.5 flex items-center justify-between">

                <p class="text-xs text-gray-400">
                    Introduce yourself and share what you enjoy learning or teaching.
                </p>

                <span class="hidden text-xs text-gray-400 sm:block">
                    Max 1000 characters
                </span>

            </div>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('bio')"
            />
        </div>

        {{-- Role --}}
        <div>
            <x-input-label
                for="role"
                :value="__('I want to')"
                class="font-semibold text-gray-700"
            />

            <select
                id="role"
                name="role"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-slate-50 px-4 py-3 text-sm shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                required
            >

                <option value="">
                    Select your role
                </option>

                <option
                    value="learn"
                    {{ old('role', $user->role) === 'learn' ? 'selected' : '' }}
                >
                    Learn — I want to develop new skills
                </option>

                <option
                    value="teach"
                    {{ old('role', $user->role) === 'teach' ? 'selected' : '' }}
                >
                    Teach — I want to help others learn
                </option>

                <option
                    value="both"
                    {{ old('role', $user->role) === 'both' ? 'selected' : '' }}
                >
                    Both — I want to learn and teach
                </option>

            </select>

            <p class="mt-1.5 text-xs text-gray-400">
                You can change this whenever your learning goals change.
            </p>

            <x-input-error
                class="mt-2"
                :messages="$errors->get('role')"
            />
        </div>

        {{-- Save --}}
        <div class="flex flex-col gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center">

            <x-primary-button
                class="inline-flex justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                {{ __('Save Changes') }}
            </x-primary-button>

            @if (session('status') === 'profile-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-green-600"
                >
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-green-100 text-xs">
                        ✓
                    </span>

                    {{ __('Changes saved successfully.') }}
                </p>

            @endif

        </div>

    </form>

</section>