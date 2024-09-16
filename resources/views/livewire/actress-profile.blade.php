<div>
    <h2 class="mb-6 text-2xl font-bold">{{ $actress->name }}</h2>

    <div class="mb-6">
        <img src="{{ $actress->image_url }}" alt="{{ $actress->name }}" class="object-cover w-64 h-64 rounded-lg">
    </div>

    <div class="mb-6">
        <h3 class="mb-2 text-xl font-semibold">Biography</h3>
        <p>{{ $actress->bio }}</p>
    </div>

    <div class="mb-6">
        <h3 class="mb-2 text-xl font-semibold">Recent Polls</h3>
        <ul>
            @foreach ($recentPolls as $poll)
                <li class="mb-2">
                    <a href="{{ route('polls.show', $poll) }}"
                        class="text-blue-500 hover:underline">{{ $poll->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    <div>
        <h3 class="mb-2 text-xl font-semibold">Rankings</h3>
        <ul>
            @foreach ($rankings as $ranking)
                <li class="mb-2">
                    {{ $ranking->category }}: #{{ $ranking->rank }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
