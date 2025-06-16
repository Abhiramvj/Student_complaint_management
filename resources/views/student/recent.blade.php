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
        <option value="">All Statuses</option>
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


