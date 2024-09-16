<div class="container max-w-6xl px-4 mx-auto">
    <h1 class="mb-6 text-4xl font-bold text-gray-800">All Polls</h1>

    @if ($polls->isEmpty())
        <p class="text-gray-600">No polls found.</p>
    @else
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($polls as $poll)
                <div
                    class="overflow-hidden transition-transform duration-300 bg-white shadow-md rounded-xl hover:scale-105">
                    @if ($poll->image)
                        <img src="{{ Storage::url($poll->image) }}" alt="{{ $poll->title }}"
                            class="object-cover w-full h-48">
                    @endif
                    <div class="p-6">
                        <h3 class="mb-3 text-xl font-semibold text-gray-800">{{ $poll->title }}</h3>
                        <p class="mb-2 text-gray-600">Category: {{ $poll->category }}</p>
                        <p class="mb-2 text-gray-600">Ends:
                            {{ \Carbon\Carbon::parse($poll->end_date)->format('M d, Y') }}</p>
                        <a href="{{ route('polls.show', $poll) }}" class="text-blue-500 hover:underline">View
                            Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
