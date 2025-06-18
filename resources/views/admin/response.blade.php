<div class="container mx-auto mt-12 max-w-2xl px-6">
    <h3 class="text-2xl font-bold mb-6 text-blue-800">Respond to Complaint</h3>

    <div class="bg-white p-8 rounded-xl shadow-lg border-l-8 border-blue-600">
        <h4 class="text-xl font-semibold text-gray-900">{{ $complaint->title }}</h4>
        <p class="text-gray-700 mt-3">{{ $complaint->description }}</p>
        <div class="mt-4 text-base text-gray-800 flex items-center gap-2">
            <span class="font-semibold">Status:</span>
            <x-status-badge :status="$complaint->status" />
        </div>

        <div class="mt-8">
            <textarea id="response-message"
                class="w-full border-2 border-blue-200 focus:border-blue-500 rounded-lg p-4 text-gray-900 shadow-sm transition duration-150 resize-none"
                rows="4"
                placeholder="Type your response..."></textarea>
            <button id="send-response" data-id="{{ $complaint->id }}"
                class="mt-4 px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-400 text-white font-semibold rounded-lg shadow hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
                <svg class="inline-block w-5 h-5 mr-2 -mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Send Response
            </button>
        </div>

        <h5 class="text-lg font-semibold mt-10 mb-3 text-blue-700">Previous Responses</h5>
        <div id="responses-container" class="space-y-3">
            @forelse ($complaint->complaintResponses as $response)
                <div class="bg-blue-50 rounded-md px-4 py-3 flex items-start gap-3 shadow-sm">
                    <div class="flex-shrink-0">
                        <span class="inline-block w-8 h-8 rounded-full bg-blue-200 text-blue-800 font-bold flex items-center justify-center">
                            {{ strtoupper(substr($response->user->name, 0, 1)) }}
                        </span>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-900">{{ $response->user->name }}
                            <span class="text-xs text-gray-400 ml-2">({{ $response->created_at->diffForHumans() }})</span>
                        </div>
                        <div class="text-gray-800 mt-1">{{ $response->message }}</div>
                    </div>
                </div>
            @empty
                <div class="text-gray-400 italic">No responses yet.</div>
            @endforelse
        </div>
    </div>
</div>

<script>
   $('#send-response').click(function () {
    var id = $(this).data('id');  // Should be a real number, not "undefined"
    var message = $('#response-message').val();

    if (!message.trim()) {
        alert('Response cannot be empty.');
        return;
    }

    console.log("Complaint ID being sent:", id); // ✅ check this in browser console

    $.post(`/admin/dashboard/all/${id}/response`, {
        _token: '{{ csrf_token() }}',
        message: message
    })
    .done(function () {
        alert('Response sent!');
        location.reload();
    })
    .fail(function (xhr) {
        console.error(xhr.responseText); // debug
        alert('Failed to send response');
    });
});

</script>

