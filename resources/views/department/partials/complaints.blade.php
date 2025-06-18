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
                         <button class="view-complaint-btn flex items-center gap-1 border border-white px-3 py-1 rounded bg-transparent hover:bg-gray-100 transition"
                            data-id="{{ $complaint->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span class="text-black font-medium">View</span>
                        </button>

                    </div>
                </div>
            @endforeach
        </div>
@endif
