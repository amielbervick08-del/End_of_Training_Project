<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Leave a Review
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h1 class="text-2xl font-bold mb-2">
                        Review {{ $reviewee->name }}
                    </h1>

                    <p class="text-gray-600 mb-6">
                        Share your experience from this completed session.
                    </p>

                    <div class="mb-6 rounded-lg bg-gray-50 p-4">
                        <p class="font-semibold">
                            {{ $booking->request->title }}
                        </p>

                        <p class="text-sm text-gray-600 mt-1">
                            {{ $booking->date->format('M d, Y') }}
                            ·
                            {{ \Carbon\Carbon::parse($booking->start_time)->format('g:i A') }}
                            -
                            {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 rounded-lg bg-red-50 p-4 text-red-700">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 rounded-lg bg-red-50 p-4 text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('reviews.store', $booking) }}"
                        class="space-y-6"
                    >
                        @csrf

                        <div>
                            <x-input-label for="rating" value="Rating" />

                            <select
                                id="rating"
                                name="rating"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                            >
                                <option value="">Select a rating</option>
                                <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>
                                    5 - Excellent
                                </option>
                                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>
                                    4 - Very Good
                                </option>
                                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>
                                    3 - Good
                                </option>
                                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>
                                    2 - Fair
                                </option>
                                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>
                                    1 - Poor
                                </option>
                            </select>
                        </div>

                        <div>
                            <x-input-label
                                for="comment"
                                value="Comment (optional)"
                            />

                            <textarea
                                id="comment"
                                name="comment"
                                rows="5"
                                maxlength="2000"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                placeholder="Tell us about your experience..."
                            >{{ old('comment') }}</textarea>
                        </div>

                        <div class="flex items-center gap-3">
                            <button
                                type="submit"
                                class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700"
                            >
                                Submit Review
                            </button>

                            <a
                                href="{{ route('requests.show', $booking->request_id) }}"
                                class="text-sm text-gray-600 hover:text-gray-900"
                            >
                                Cancel
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>