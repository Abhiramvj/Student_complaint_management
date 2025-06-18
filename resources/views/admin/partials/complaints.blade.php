@if($complaints->isEmpty())
    <div class="text-gray-500">No complaints found.</div>
@else
    <div class="space-y-4">
        @foreach($complaints as $complaint)
            <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-blue-500">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-medium text-gray-800">{{ $complaint->title }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ $complaint->description }}</p>
                        <div class="mt-2 text-xs text-gray-500">
                            <span class="inline-block bg-gray-100 px-2 py-1 rounded">
                                {{ $complaint->department->name }}
                            </span>
                            <span class="mx-2">•</span>
                            <x-status-badge :status="$complaint->status" />
                            <span class="mx-2">•</span>
                            <span>{{ $complaint->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="ml-4 flex-shrink-0">
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
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $complaints->links() }}
    </div>
@endif
<div id="complaintModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 hidden z-50 transition-all duration-300">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl relative animate-fadeIn border border-blue-200">
        <div id="modalContent" class="p-0 relative">
            <button id="closeModal" class="absolute top-4 right-4 text-gray-400 hover:text-blue-600 transition-colors duration-200 text-2xl font-bold z-10" aria-label="Close">
                &times;
            </button>
            <div class="flex justify-center items-center h-32 text-blue-400" id="modalLoading">
                <svg class="animate-spin h-8 w-8 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
                <span>Loading details...</span>
            </div>
        </div>
    </div>
</div>
<style>
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(40px);}
    to { opacity: 1; transform: translateY(0);}
}
.animate-fadeIn {
    animation: fadeIn 0.3s ease;
}
</style>
<script>
$(document).ready(function() {
  $(document).on('click', '.view-complaint-btn', function() {
    var complaintId = $(this).data('id');
    $.ajax({
      url: 'dashboard/complaints/' + complaintId,
      method: 'GET',
      success: function(data) {
        $('#modalContent').html(data);
        $('#complaintModal').removeClass('hidden');
      },
      error: function() {
        $('#modalContent').html('<p class="text-red-500">Failed to load complaint details.</p>');
        $('#complaintModal').removeClass('hidden');
      }
    });
  });

  $('#closeModal').on('click', function() {
    $('#complaintModal').addClass('hidden');
    $('#modalContent').html('');
  });

  $('#complaintModal').on('click', function(e) {
    if (e.target === this) {
      $(this).addClass('hidden');
      $('#modalContent').html('');
    }
  });

  $(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    let url = $(this).attr('href');
    $.ajax({
      url: url,
      type: 'GET',
      beforeSend: function () {
        $('#complaints-container').html('<div class="text-center py-4">Loading...</div>');
      },
      success: function(data) {
        $('#complaints-container').html(data);
      },
      error: function() {
        $('#complaints-container').html('<div class="text-red-600">Error loading complaints.</div>');
      }
    });
  });
});


    </script>
