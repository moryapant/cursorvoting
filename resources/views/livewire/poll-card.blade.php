<div class="p-4 bg-white rounded-lg shadow-md">
    <h3 class="mb-2 text-xl font-semibold">{{ $poll->title }}</h3>
    <p class="mb-2 text-gray-600">{{ $poll->category }}</p>
    <p class="mb-4 text-sm text-gray-500">
        @if ($daysLeft === 'Ended')
            Ended
        @elseif ($daysLeft === 'Ends today')
            Ends today
        @else
            Ends in: {{ $daysLeft }}
        @endif
    </p>
    <a href="{{ route('polls.show', $poll->id) }}" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Vote
        Now</a>
</div>
