<div class="container mx-auto mt-10 px-4">
    <h3 class="text-xl font-semibold mb-4">Respond to Complaint</h3>

    <div class="bg-white p-6 rounded shadow-md border-l-4 border-blue-500">
        <h4 class="text-lg font-semibold">{{ $complaint->title }}</h4>
        <p class="text-gray-600 mt-2">{{ $complaint->description }}</p>
        <div class="mt-4 text-sm text-gray-700">
            <strong>Status:</strong> <x-status-badge :status="$complaint->status" />
        </div>

        <div class="mt-6">
            <textarea id="response-message" class="w-full border rounded p-3" rows="3" placeholder="Type your response..."></textarea>
            <button id="send-response" data-id="{{ $complaint->id }}"
                    class="mt-3 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Send Response
            </button>
        </div>

        <h5 class="text-md font-semibold mt-6 mb-2">Previous Responses</h5>
        <div id="responses-container" class="text-sm text-gray-700 space-y-2">
            @foreach ($complaint->complaintResponses as $response)
                <div>– <strong>{{ $response->user->name }}:</strong> {{ $response->message }}
                    <span class="text-xs text-gray-400">({{ $response->created_at->diffForHumans() }})</span>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $('#send-response').click(function () {
    var id = $(this).data('id');  // Should be a real number, not "undefined"
    var message = $('#response-message').val();

    if (!message.trim()) {
        alert('Response cannot be empty.');
        return;
    }

    console.log("Complaint ID being sent:", id); // ✅ check this in browser console

    $.post(`/department/dashboard/all/${id}/response`, {
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

