<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Cricket Management</h2>
    </div>

    <div class="bg-white rounded shadow p-4">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-2">Series</th>
                    <th class="p-2">Teams</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Time</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($matches as $match)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-2">{{ $match->series_name }}</td>
                    <td class="p-2">{{ $match->team_home }} vs {{ $match->team_away }}</td>
                    <td class="p-2">
                        <span class="px-2 py-1 rounded text-xs font-bold
                            @if($match->status == 'live') bg-red-100 text-red-700
                            @elseif($match->status == 'completed') bg-gray-100 text-gray-700
                            @else bg-blue-100 text-blue-700 @endif">
                            {{ ucfirst($match->status) }}
                        </span>
                    </td>
                    <td class="p-2">{{ $match->match_time ? $match->match_time->format('d M H:i') : '-' }}</td>
                    <td class="p-2">
                        <button class="text-blue-600">Details</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $matches->links() }}
        </div>
    </div>
</div>
