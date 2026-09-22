<section>

    {{-- Section heading --}}
    <div class="mb-8">

        <div class="flex items-center gap-3">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-xl">
                🔐
            </div>

            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    {{ __('Update Password') }}
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    {{ __('Keep your SkillLink account secure with a strong password.') }}
                </p>
            </div>

        </div>

    </div>

    {{-- Security reminder --}}
    <div class="mb-7 rounded-2xl border border-indigo-100 bg-indigo-50 px-5 py-4">

        <div class="flex items-start gap-3">

            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-white text-sm shadow-sm">
                💡
            </div>

            <div>
                <p class="text-sm font-semibold text-indigo-900">
                    Password security
                </p>

                <p class="mt-1 text-sm leading-5 text-indigo-700">
                    Use a unique password with a mix of letters, numbers, and symbols.
                    Avoid using passwords you've used on other websites.
                </p>
            </div>

        </div>

    </div>

    <form
        method="post"
        action="{{ route('password.update') }}"
        class="space-y-7"
    >
        @csrf
        @method('put')

        {{-- Current password --}}
        <div>

            <x-input-label
                for="update_password_current_password"
                :value="__('Current Password')"
                class="font-semibold text-gray-700"
            />

            <x-text-input
                id="update_password_current_password"
                name="current_password"
                type="password"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-slate-50 px-4 py-3 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                autocomplete="current-password"
                placeholder="Enter your current password"
            />

            <p class="mt-1.5 text-xs text-gray-400">
                Required to confirm that you own this account.
            </p>

            <x-input-error
                :messages="$errors->updatePassword->get('current_password')"
                class="mt-2"
            />

        </div>

        {{-- New password --}}
        <div>

            <x-input-label
                for="update_password_password"
                :value="__('New Password')"
                class="font-semibold text-gray-700"
            />

            <x-text-input
                id="update_password_password"
                name="password"
                type="password"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-slate-50 px-4 py-3 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                autocomplete="new-password"
                placeholder="Enter your new password"
            />

            <p class="mt-1.5 text-xs text-gray-400">
                Choose a strong password that you don't use elsewhere.
            </p>

            <x-input-error
                :messages="$errors->updatePassword->get('password')"
                class="mt-2"
            />

        </div>

        {{-- Confirm password --}}
        <div>

            <x-input-label
                for="update_password_password_confirmation"
                :value="__('Confirm New Password')"
                class="font-semibold text-gray-700"
            />

            <x-text-input
                id="update_password_password_confirmation"
                name="password_confirmation"
                type="password"
                class="mt-2 block w-full rounded-xl border-gray-200 bg-slate-50 px-4 py-3 shadow-sm transition focus:border-indigo-500 focus:bg-white focus:ring-indigo-500"
                autocomplete="new-password"
                placeholder="Confirm your new password"
            />

            <x-input-error
                :messages="$errors->updatePassword->get('password_confirmation')"
                class="mt-2"
            />

        </div>

        {{-- Save --}}
        <div class="flex flex-col gap-3 border-t border-gray-100 pt-6 sm:flex-row sm:items-center">

            <x-primary-button
                class="inline-flex justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                {{ __('Update Password') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')

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

                    {{ __('Password updated successfully.') }}
                </p>

            @endif

        </div>

    </form>

</section>