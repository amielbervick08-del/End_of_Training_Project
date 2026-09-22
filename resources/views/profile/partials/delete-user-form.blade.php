<section>

    {{-- Section heading --}}
    <div class="mb-8">

        <div class="flex items-start gap-3">

            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl bg-red-50 text-xl">
                ⚠️
            </div>

            <div>
                <h2 class="text-lg font-bold text-gray-900">
                    {{ __('Delete Account') }}
                </h2>

                <p class="mt-1 text-sm leading-6 text-gray-500">
                    {{ __('Permanently remove your SkillLink account and all associated data.') }}
                </p>
            </div>

        </div>

    </div>

    {{-- Warning --}}
    <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

        <div class="flex items-start gap-3">

            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-lg bg-white text-sm shadow-sm">
                ⚠️
            </div>

            <div>
                <p class="text-sm font-bold text-red-900">
                    This action cannot be undone
                </p>

                <p class="mt-1 text-sm leading-6 text-red-700">
                    Once your account is deleted, your profile and associated SkillLink data
                    will be permanently removed. Make sure you have saved anything you want
                    to keep before continuing.
                </p>
            </div>

        </div>

    </div>

    {{-- Delete button --}}
    <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <p class="text-sm text-gray-500">
            You will be asked to enter your password before the account is deleted.
        </p>

        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="inline-flex justify-center rounded-xl px-5 py-3 text-sm font-bold"
        >
            {{ __('Delete Account') }}
        </x-danger-button>

    </div>

    {{-- Confirmation modal --}}
    <x-modal
        name="confirm-user-deletion"
        :show="$errors->userDeletion->isNotEmpty()"
        focusable
    >

        <form
            method="post"
            action="{{ route('profile.destroy') }}"
            class="p-6 sm:p-8"
        >
            @csrf
            @method('delete')

            {{-- Modal heading --}}
            <div class="flex items-start gap-4">

                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-red-100 text-xl">
                    ⚠️
                </div>

                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        {{ __('Delete your account?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        This action is permanent and cannot be undone.
                    </p>
                </div>

            </div>

            {{-- Explanation --}}
            <div class="mt-6 rounded-2xl bg-slate-50 px-5 py-4">

                <p class="text-sm leading-6 text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

            </div>

            {{-- Password --}}
            <div class="mt-6">

                <x-input-label
                    for="password"
                    :value="__('Current Password')"
                    class="font-semibold text-gray-700"
                />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-2 block w-full rounded-xl border-gray-200 bg-slate-50 px-4 py-3 shadow-sm transition focus:border-red-500 focus:bg-white focus:ring-red-500"
                    placeholder="{{ __('Enter your password to confirm') }}"
                    autocomplete="current-password"
                />

                <x-input-error
                    :messages="$errors->userDeletion->get('password')"
                    class="mt-2"
                />

            </div>

            {{-- Modal actions --}}
            <div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <x-secondary-button
                    x-on:click="$dispatch('close')"
                    class="inline-flex justify-center rounded-xl px-5 py-2.5"
                >
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button
                    class="inline-flex justify-center rounded-xl px-5 py-2.5"
                >
                    {{ __('Yes, Delete My Account') }}
                </x-danger-button>

            </div>

        </form>

    </x-modal>

</section>