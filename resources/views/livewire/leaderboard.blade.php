<div class="container px-4 mx-auto">
    <h1 class="mb-6 text-3xl font-bold">Actress Leaderboard</h1>

    <div class="overflow-hidden bg-white rounded-lg shadow-md">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Rank</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actress
                    </th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Total
                        Votes</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($topActresses as $index => $actress)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap">{{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $actress->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $actress->vote_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
