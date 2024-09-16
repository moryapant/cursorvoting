<div>
    <h2 class="mb-6 text-2xl font-bold">Create a New Poll</h2>

    @if (session()->has('message'))
        <div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="relative px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="createPoll">
        <div class="mb-4">
            <label for="title" class="block mb-2">Title</label>
            <input type="text" id="title" wire:model="title" class="w-full px-3 py-2 border rounded-lg">
            @error('title')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="category" class="block mb-2">Category</label>
            <select wire:model="category" id="category"
                class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
            @error('category')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="endDate" class="block mb-2">End Date</label>
            <input type="date" id="endDate" wire:model="endDate" class="w-full px-3 py-2 border rounded-lg">
            @error('endDate')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="pollImage" class="block mb-2">Poll Card Image</label>
            <input type="file" id="pollImage" wire:model="pollImage" accept="image/*"
                class="w-full px-3 py-2 border rounded-lg">
            @error('pollImage')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
            @if ($pollImage)
                <img src="{{ $pollImage->temporaryUrl() }}" alt="Poll Card Preview" class="max-w-xs mt-2">
            @endif
        </div>

        <div class="mb-4">
            <label class="block mb-2">Options</label>
            @foreach ($options as $index => $option)
                <div class="flex items-center mb-2">
                    <select wire:model="options.{{ $index }}.actress_id"
                        class="flex-grow px-3 py-2 border rounded-lg">
                        <option value="">Select an actress</option>
                        @foreach ($actresses as $actress)
                            <option value="{{ $actress->id }}">{{ $actress->name }}</option>
                        @endforeach
                    </select>
                    <input type="file" wire:model="options.{{ $index }}.image" accept="image/*"
                        class="px-3 py-2 ml-2 border rounded-lg">
                    <button type="button" wire:click="removeOption({{ $index }})"
                        class="px-3 py-2 ml-2 text-white bg-red-500 rounded-lg">Remove</button>
                </div>
                @if (isset($options[$index]['image']) && $options[$index]['image'])
                    <img src="{{ $options[$index]['image']->temporaryUrl() }}" alt="Option Preview"
                        class="max-w-xs mt-2">
                @endif
                @error("options.{$index}.actress_id")
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                @error("options.{$index}.image")
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            @endforeach
            <button type="button" wire:click="addOption" class="px-3 py-2 mt-2 text-white bg-blue-500 rounded-lg">Add
                Option</button>
            @error('options')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-green-500 rounded-lg">Create Poll</button>
    </form>
</div>
