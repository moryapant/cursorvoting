<div class="container max-w-6xl px-4 mx-auto">
    <h1 class="mb-6 text-4xl font-bold text-gray-800">{{ $poll->title }}</h1>

    <div class="mb-8">
        @if ($poll->image)
            <img src="{{ Storage::url($poll->image) }}" alt="{{ $poll->title }}"
                class="object-cover w-full h-48 shadow-lg rounded-xl sm:h-64 md:h-80 lg:h-96">
        @endif
    </div>

    <div class="p-6 mb-8 bg-white shadow-md rounded-xl">
        <p class="mb-2 text-gray-600">Category: <span class="font-semibold">{{ $poll->category }}</span></p>
        <p class="mb-2 text-gray-600">Started: <span
                class="font-semibold">{{ \Carbon\Carbon::parse($poll->start_date)->format('M d, Y') }}</span></p>
        <p class="mb-4 text-gray-600">Ends: <span
                class="font-semibold">{{ \Carbon\Carbon::parse($poll->end_date)->format('M d, Y') }}</span></p>
    </div>

    @if (session()->has('error'))
        <div class="relative px-4 py-3 mb-6 text-red-700 bg-red-100 border border-red-400 rounded-lg" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <h2 class="mb-6 text-2xl font-semibold text-gray-800">Options</h2>
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($poll->options as $option)
            <div
                class="overflow-hidden transition-transform duration-300 bg-white shadow-md rounded-xl hover:scale-105">
                @if ($option->image)
                    <img src="{{ Storage::url($option->image) }}" alt="{{ $option->actress->name }}"
                        class="object-cover w-full h-64">
                @else
                    <div class="flex items-center justify-center w-full h-64 bg-gray-200">
                        <span class="text-gray-500">No image available</span>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="mb-3 text-xl font-semibold text-gray-800">{{ $option->actress->name }}</h3>
                    <div class="mb-4">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-700">Votes:
                                {{ $voteCounts[$option->id] ?? 0 }}</span>
                            <span
                                class="text-sm font-medium text-gray-700">{{ $this->getVotePercentage($option->id) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full"
                                style="width: {{ $this->getVotePercentage($option->id) }}%"></div>
                        </div>
                    </div>
                    @if (!\Carbon\Carbon::parse($poll->end_date)->isPast())
                        <button wire:click="vote({{ $option->id }})"
                            class="w-full px-4 py-2 text-white rounded-lg transition-colors duration-300 {{ $userVote == $option->id ? 'bg-green-500 hover:bg-green-600' : 'bg-blue-500 hover:bg-blue-600' }}">
                            {{ $userVote == $option->id ? 'Voted' : 'Vote' }}
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    @if (auth()->user()->email === 'morya123@gmail.com' && $this->isPollEnded())
        <div class="mt-8 space-x-4">
            <button wire:click="archivePoll" class="px-4 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">
                Archive Poll
            </button>
            <button wire:click="deletePoll" class="px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">
                Delete Poll
            </button>
        </div>
    @endif


</div>
