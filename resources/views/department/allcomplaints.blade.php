<div class="recent-activity-container container mx-auto px-4 mt-10">
 <div class="mb-4 flex justify-end">
    @include('department.partials.filter')
</div>
      <div id="complaint-wrapper">
   @include('department.partials.complaints')
      </div>
</div>


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
  $('.view-complaint-btn').on('click', function() {
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
});
</script>
