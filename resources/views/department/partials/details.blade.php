<div class="bg-white rounded-xl shadow-lg p-6 transition-transform hover:scale-[1.01] hover:shadow-2xl duration-200 border border-gray-100 relative overflow-hidden">

    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-t-xl"></div>

     <button id="closeModal"
        class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 transition-colors z-10"
        aria-label="Close"
        type="button">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>


    <h2 class="text-2xl font-extrabold mb-3 text-gray-900 flex items-center gap-2">
        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 20l9-5-9-5-9 5 9 5z" />
            <path d="M12 12V4" />
        </svg>
        {{ $complaint->title }}
    </h2>

    <div class="mb-5 text-gray-700">
        <span class="font-semibold text-gray-800">Description:</span>
        <p class="mt-2 whitespace-pre-line bg-gray-50 rounded p-3 border border-gray-100 transition-colors hover:bg-gray-100">
            {{ $complaint->description }}
        </p>
    </div>


    <div class="flex flex-wrap gap-8 mb-6 text-sm text-gray-600">
        <div class="flex items-center gap-2">
            <span class="font-semibold text-gray-700">Department:</span>
            <span class="px-2 py-1 rounded bg-blue-50 text-blue-700 font-medium">{{ $complaint->department->name }}</span>
        </div>
        <div class="flex items-center gap-2">
    <span class="font-semibold text-gray-700">Status:</span>
    <span id="status-badge-{{ $complaint->id }}">
        <x-status-badge :status="$complaint->status"/>
    </span>
</div>

    </div>

   <label for="status-{{ $complaint->id }}" class="font-semibold text-gray-700 mr-2">Update Status:</label>
<select
    id="status-{{ $complaint->id }}"
    class="status-dropdown text-sm font-semibold text-gray-800 border border-gray-300 rounded-md px-3 py-2 shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-150 ease-in-out w-48"
    data-id="{{ $complaint->id }}"
class="status-dropdown text-sm font-semibold text-gray-800 border border-gray-300 rounded-md px-3 py-2 shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-150 ease-in-out w-48 inline-block align-middle"
    data-id="{{ $complaint->id }}"
>
    <option disabled>-- Update --</option>
    @foreach($statuses as $status)
        <option value="{{ $status }}" {{ $complaint->status === $status ? 'selected' : '' }}>
            {{ ucwords(str_replace('_', ' ', $status)) }}
        </option>
    @endforeach
</select>
<span id="statusUpdateMsg-{{ $complaint->id }}" class="text-xs ml-2 inline-block align-middle"></span>
<div class="flex flex-col items-end ml-auto mt-2">
  <button
    class="open-response-form bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded shadow transition-colors duration-150 open-response-form"
    type="button"
    data-id="{{ $complaint->id }}">
    Reply
</button>

    <div class="text-xs text-gray-500 flex items-center gap-2 mt-3">
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M8 7V3M16 7V3M4 11h16M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
        <span class="italic">
            {{ $complaint->created_at->format('d M Y, h:i A') }} ({{ $complaint->created_at->diffForHumans() }})
        </span>
    </div>
</div>
</div>
<div id="responseModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 hidden z-50">
    <div class="bg-white w-full max-w-xl rounded-lg shadow-lg relative">
        <button id="closeModal" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl font-bold">
            &times;
        </button>
        <div id="responseContent" class="p-6 text-gray-700">Loading...</div>
    </div>
</div>
<script>
document.addEventListener('click', function(e) {
    if (e.target.closest('#closeModal')) {
        document.getElementById('complaintModal').classList.add('hidden');
        document.getElementById('modalContent').innerHTML = '';
    }
});
$(document).on('change', '.status-dropdown', function() {
    var complaintId = $(this).data('id');
    var status = $(this).val();
    var $msg = $('#statusUpdateMsg-' + complaintId);

    $.ajax({
        url: 'complaints/' + complaintId + '/status',
        method: 'PATCH',
        data: {
            status: status,
            _token: '{{ csrf_token() }}'
        },
        beforeSend: function() {
            $msg.text('Updating...');
        },
        success: function(res) {
            $msg.text('Status updated!').css('color', 'green');
             $('#status-badge-' + complaintId).html(res.badge_html);
             $('#status-' + complaintId).html(res.badge_html);
        },
        error: function() {
            $msg.text('Error updating status.').css('color', 'red');
        }
    });
});
 $(document).on('click', '.open-response-form', function () {
        const complaintId = $(this).data('id');
        $('#responseModal').removeClass('hidden');

        $.get(`/department/dashboard/all/${complaintId}/response`, function (html) {
            $('#responseContent').html(html);
        });
    });


</script>
