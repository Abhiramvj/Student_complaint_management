<nav>
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded shadow text-center border-2 border-black-100 flex items-center justify-between">
      <div class="text-gray-600 text-sm align-top">Total Complaints</div>
      <div class="text-lg font-semibold">{{ $totalCount }}</div>
       <img
    src="https://static.vecteezy.com/system/resources/previews/016/907/743/non_2x/complaint-icon-design-free-vector.jpg"
    alt="Icon"
    class="w-16 h-16 object-contain">
    </div>
    <div class="bg-white p-4 rounded shadow text-center border-2 border-black-100 flex items-center justify-between">
      <div class="text-gray-600 text-sm">Pending</div>
      <div class="text-lg font-semibold">{{ $pendingCount }}</div>
      <img
    src="https://t3.ftcdn.net/jpg/08/76/82/44/360_F_876824437_Mtmgb2hl11t5o7wJaZU5pxuJljaMkwCy.jpg"
    alt="Icon"
    class="w-16 h-16 object-contain">
    </div>
     <div class="bg-white p-4 rounded shadow text-center border-2 border-black-100 flex items-center justify-between">
      <div class="text-gray-600 text-sm">Resolved</div>
      <div class="text-lg font-semibold">{{ $resolvedCount }}</div>
      <img
    src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Pictogram_resolved.svg/1024px-Pictogram_resolved.svg.png"
    alt="Icon"
    class="w-16 h-16 object-contain">
    </div>
    <div class="bg-white p-4 rounded shadow text-center border-2 border-black-100 flex items-center justify-between">
      <div class="text-gray-600 text-sm">In Progress</div>
      <div class="text-lg font-semibold">{{ $inProgressCount }}</div>
       <img
    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToP3-LoG2LBjTSaaWdqRB2Zvn9xYlQdHOfVQ&s"
    alt="Icon"
    class="w-16 h-16 object-contain">
    </div>

  </div>
</nav>
<div class="mb-4 flex justify-end">
   <form id="filter-form">
    <select name="status" id="status-filter" class="...">
        <option value=" ">All Statuses   </option>
        @foreach ($statuses as $status)
            <option value="{{ $status }}">{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
        @endforeach
    </select>
</form>


</div>



<div class="recent-activity-container">
    <h3 class="text-xl font-semibold mb-4">Recent Complaints</h3>
    <div id="student-recent">
    @include('student.partials.student-recent', ['complaints' => $complaints])
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

