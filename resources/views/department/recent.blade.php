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
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>





