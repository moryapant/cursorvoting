<div class="container px-4 mx-auto">
    {{-- @if ($message)
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ $message }}
        </div>
    @endif --}}

    <h1 class="mb-6 text-3xl font-bold">Latest Polls</h1>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($polls as $poll)
            <div class="overflow-hidden bg-white rounded-lg shadow-md">
                @if ($poll->image)
                    <img src="{{ Storage::url($poll->image) }}" alt="{{ $poll->title }}" class="object-cover w-full h-48">
                @else
                    <div class="flex items-center justify-center w-full h-48 bg-gray-200">
                        <span class="text-gray-500">No image available</span>
                    </div>
                @endif
                <div class="p-4">
                    <h2 class="mb-2 text-xl font-semibold">{{ $poll->title }}</h2>
                    <p class="mb-2 text-gray-600">Category: {{ $poll->category }}</p>
                    <p class="mb-4 text-gray-600">Ends: {{ $poll->end_date->format('M d, Y') }}</p>
                    <a href="{{ route('polls.show', $poll) }}"
                        class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">View Poll</a>
                    {{-- <button wire:click="vote({{ $poll->id }})"
                        class="px-4 py-2 ml-2 text-white bg-green-500 rounded hover:bg-green-600">
                        Vote
                    </button> --}}
                </div>
            </div>
        @endforeach
    </div>
</div>
