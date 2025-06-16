  <h3 class="text-xl font-semibold mb-4">Recent Complaints</h3>
 @if($complaints->isEmpty())
        <div class="text-gray-500">No recent complaints found.</div>
    @else
        <div class="space-y-4">
            @foreach($complaints as $complaint)
                <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <div class="flex justify-between items-start gap-4">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-800">{{ $complaint->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $complaint->description }}</p>
                            <div class="mt-2 text-xs text-gray-500 flex gap-2 items-center flex-wrap">
                                <span class="inline-block bg-gray-100 px-2 py-1 rounded">
                                    {{ $complaint->department->name }}
                                </span>
                                <span>•</span>
                                <span id="status-{{ $complaint->id }}">
                                    <x-status-badge :status="$complaint->status" />
                                </span>
                                <span>•</span>
                                <span>{{ $complaint->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="mt-2">
                            <form>
                                <select
                                    class="status-dropdown text-sm font-semibold text-gray-800 border border-gray-300 rounded-md px-3 py-2 shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-150 ease-in-out w-48"
                                    data-id="{{ $complaint->id }}"
                                >
                                    <option disabled>-- Update --</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ $complaint->status === $status ? 'selected' : '' }}>
                                            {{ ucwords(str_replace('_', ' ', $status)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        <button
    class="open-response-form mt-3 px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 transition"
    data-id="{{ $complaint->id }}">
    Respond
</button>

                    </div>
                </div>
            @endforeach
        </div>
    @endif
