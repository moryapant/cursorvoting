<div>
    <h2 class="mb-6 text-2xl font-bold">Fan Battle</h2>
    <p class="mb-4">Category: {{ $category }}</p>

    <div class="flex justify-between">
        @foreach ([$actress1, $actress2] as $actress)
            <div class="w-1/2 p-4 {{ $loop->first ? 'mr-4' : '' }} bg-white border rounded-lg">
                <img src="{{ $actress->image_url }}" alt="{{ $actress->name }}"
                    class="object-cover w-full h-64 mb-4 rounded-lg">
                <h3 class="mb-2 text-xl font-semibold">{{ $actress->name }}</h3>
                <button wire:click="vote({{ $actress->id }})"
                    class="w-full px-4 py-2 text-white bg-blue-500 rounded-lg {{ $votedFor ? 'opacity-50 cursor-not-allowed' : '' }}"
                    {{ $votedFor ? 'disabled' : '' }}>
                    Vote
                </button>
                @if ($votedFor)
                    <p class="mt-2 text-center">
                        Votes: {{ $votes[$actress->id] }}
                        ({{ round(($votes[$actress->id] / array_sum($votes)) * 100, 1) }}%)
                    </p>
                @endif
            </div>
        @endforeach
    </div>

    @if ($votedFor)
        <p class="mt-4 text-center text-green-600">Thank you for voting!</p>
    @endif

    <button wire:click="selectRandomActresses" class="px-4 py-2 mt-6 text-white bg-green-500 rounded-lg">
        Next Battle
    </button>
</div>
