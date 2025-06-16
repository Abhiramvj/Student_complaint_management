 @if($complaints->isEmpty())
        <div class="text-gray-500">No recent complaints found.</div>
    @else
        <div class="space-y-4">
            @foreach($complaints as $complaint)
                <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $complaint->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ ($complaint->description) }}
                            </p>
                            <div class="mt-2 text-xs text-gray-500">
                                <span class="inline-block bg-gray-100 px-2 py-1 rounded">
                                    {{ $complaint->department->name }}
                                </span>
                                <span class="mx-2">•</span>
                                <x-status-badge :status="$complaint->status"/>
                                <span class="mx-2">•</span>
                                <span>{{ $complaint->created_at->diffForHumans() }}</span>
                                @if($complaint->complaintResponses->isNotEmpty())
    <div class="mt-4 border-t pt-2">
        <h5 class="font-semibold text-sm text-gray-700 mb-1">Responses:</h5>
        @foreach($complaint->complaintResponses as $response)
            <div class="text-sm text-gray-600">
                – <strong>{{ $response->user->name }}:</strong> {{ $response->message }}
                <span class="text-xs text-gray-400">({{ $response->created_at->diffForHumans() }})</span>
            </div>
        @endforeach
    </div>
@endif
              </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @endif
