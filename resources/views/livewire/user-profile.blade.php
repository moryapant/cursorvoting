<div class="container p-4">
    <h1 class="mb-4 text-2xl font-bold">{{ $user->name }}'s Profile</h1>

    @if (session()->has('message'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" class="mb-8">
        <div class="mb-4">
            <label for="name" class="block mb-2">Name</label>
            <input type="text" id="name" wire:model="user.name" class="w-full px-3 py-2 border rounded">
            @error('user.name')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="bio" class="block mb-2">Bio</label>
            <textarea id="bio" wire:model="bio" class="w-full px-3 py-2 border rounded"></textarea>
            @error('bio')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="avatar" class="block mb-2">Avatar</label>
            <input type="file" id="avatar" wire:model="avatar">
            @error('avatar')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        @if ($user->avatar)
            <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="w-20 h-20 mb-4 rounded-full">
            <button type="button" wire:click="deleteAvatar" class="px-2 py-1 text-white bg-red-500 rounded">Delete
                Avatar</button>
        @endif

        <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded">Update Profile</button>
    </form>

    <h2 class="mb-4 text-xl font-bold">Voting History</h2>
    <p>Total votes: {{ $totalVotes }}</p>
    <ul>
        @foreach ($votingHistory as $vote)
            <li class="mb-2">
                Voted on "{{ $vote->poll->title }}"
                @if ($vote->created_at)
                    on {{ $vote->created_at->format('M d, Y') }}
                @else
                    (date unknown)
                @endif
            </li>
        @endforeach
    </ul>
</div>
