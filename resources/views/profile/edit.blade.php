<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">

        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold">
                    Reviews
                </h3>

                @if($reviews->count() > 0)
                    <p class="mt-1 text-sm text-gray-600">
                        Average rating:
                        <span class="font-semibold">
                            {{ number_format($averageRating, 1) }}/5
                        </span>
                    </p>
                @else
                    <p class="mt-1 text-sm text-gray-600">
                        No reviews yet.
                    </p>
                @endif
            </div>
        </div>

        @if($reviews->count() > 0)
            <div class="mt-6 space-y-4">

                @foreach($reviews as $review)
                    <div class="rounded-lg border border-gray-200 p-4">

                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">
                                    {{ $review->reviewer->name }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $review->created_at->format('M d, Y') }}
                                </p>
                            </div>

                            <div class="font-semibold">
                                {{ $review->rating }}/5
                            </div>
                        </div>

                        @if($review->comment)
                            <p class="mt-3 text-gray-700">
                                {{ $review->comment }}
                            </p>
                        @endif

                    </div>
                @endforeach

            </div>
        @endif

    </div>
</div>
</x-app-layout>
