<nav>
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white p-4 rounded shadow text-center border-2 border-black-100 flex items-center justify-between">
      <div class="text-gray-600 text-sm">Total Complaints</div>
      <div class="text-lg font-semibold">{{ $totalCount }}</div>
      <img src="https://static.vecteezy.com/system/resources/previews/016/907/743/non_2x/complaint-icon-design-free-vector.jpg"
           alt="Icon" class="w-16 h-16 object-contain">
    </div>

    <div class="bg-white p-4 rounded shadow text-center border-2 border-black-100 flex items-center justify-between">
      <div class="text-gray-600 text-sm">Pending</div>
      <div class="text-lg font-semibold">{{ $pendingCount }}</div>
      <img src="https://t3.ftcdn.net/jpg/08/76/82/44/360_F_876824437_Mtmgb2hl11t5o7wJaZU5pxuJljaMkwCy.jpg"
           alt="Icon" class="w-16 h-16 object-contain">
    </div>

    <div class="bg-white p-4 rounded shadow text-center border-2 border-black-100 flex items-center justify-between">
      <div class="text-gray-600 text-sm">Resolved</div>
      <div class="text-lg font-semibold">{{ $resolvedCount }}</div>
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Pictogram_resolved.svg/1024px-Pictogram_resolved.svg.png"
           alt="Icon" class="w-16 h-16 object-contain">
    </div>

    <div class="bg-white p-4 rounded shadow text-center border-2 border-black-100 flex items-center justify-between">
      <div class="text-gray-600 text-sm">In Progress</div>
      <div class="text-lg font-semibold">{{ $inProgressCount }}</div>
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcToP3-LoG2LBjTSaaWdqRB2Zvn9xYlQdHOfVQ&s"
           alt="Icon" class="w-16 h-16 object-contain">
    </div>
  </div>
</nav>


<div class="recent-activity-container container mx-auto px-4 mt-10">
    <h3 class="text-xl font-semibold mb-4">Recent Complaints</h3>

    @if($complaints->isEmpty())
        <div class="text-gray-500">No recent complaints found.</div>
    @else
        <div class="space-y-4">
            @foreach($complaints as $complaint)
                <div class="bg-white p-4 rounded-lg shadow-sm border-l-4 border-blue-500">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-medium text-gray-800">{{ $complaint->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ $complaint->description }}</p>
                            <div class="mt-2 text-xs text-gray-500 flex gap-2 items-center flex-wrap">
                                <span class="inline-block bg-gray-100 px-2 py-1 rounded">
                                    {{ $complaint->department->name }}
                                </span>
                                <span>•</span>
                                <span id="status-{{ $complaint->id }}">
                                    <x-status-badge :status="$complaint->status"/>
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






