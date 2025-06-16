<div class="recent-activity-container container mx-auto px-4 mt-10">
 <div class="mb-4 flex justify-end">
    @include('department.partials.filter')
</div>
      <div id="complaint-wrapper">
   @include('department.partials.complaints')
      </div>
</div>

<div id="responseModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6 relative">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-600 hover:text-gray-900">&times;</button>
        <div id="responseContent">Loading...</div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
const statusClasses = {
    'pending': 'bg-yellow-100 text-yellow-800',
    'assigned': 'bg-purple-100 text-purple-800',
    'in_progress': 'bg-blue-100 text-blue-800',
    'resolved': 'bg-green-100 text-green-800'
};

$(document).ready(function () {
    // Status dropdown for each complaint (inline update)
    $(document).on('change', '.status-dropdown', function () {
        const complaintId = $(this).data('id');
        const status = $(this).val();

        $.ajax({
            url: '/complaints/' + complaintId + '/status',
            type: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function () {
                const formatted = status.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
                const badgeClass = statusClasses[status] || 'bg-gray-100 text-gray-800';

                $('#status-' + complaintId).html(`
                    <span class="inline-block px-2 py-1 rounded text-xs font-medium ${badgeClass}">
                        ${formatted}
                    </span>
                `);
            },
            error: function () {
                alert('Failed to update status.');
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

    $(document).on('click', '#closeModal', function () {
        $('#responseModal').addClass('hidden');
        $('#responseContent').html('Loading...');
    });



});
</script>
