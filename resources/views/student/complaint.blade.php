<div class="max-w-lg mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-2 text-center">Student Complaint</h1>
    <p class="text-gray-600 text-center mb-6">Submit your feedback or complaint to the relevant department</p>

    <form action="{{route('student.complaint.submit')}}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow border">
        @csrf

        <div class="mb-4">
            <label for="department" class="block text-gray-700 font-semibold mb-1">Department</label>
            <select name="department" id="department" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
                <option value="" disabled selected>Select Department</option>
                @foreach ($departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-semibold mb-1">Title</label>
            <input type="text" name="title" id="title" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" placeholder="Enter complaint title">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea name="description" id="description" rows="4" required class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" placeholder="Describe your complaint"></textarea>
        </div>
        <div class="mb-4">
    <label for="attachment" class="block text-gray-700 font-semibold mb-1">Attach File (optional)</label>
    <input type="file" name="attachment" id="attachment"
           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">
</div>


        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700 transition duration-200">
            Submit Complaint
        </button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(document).on('click','[data-url="{{route('student.complaint')}}"]', function(e) {
        e.preventDefault();
        loadRecentActivity();
    });

    function loadRecentActivity() {
        $.ajax({
            url: "{{ route('student.complaint') }}",
            type: 'GET',
            beforeSend: function() {
                $('#dashboard-content').html('<div class="text-center py-4">Loading...</div>');
            },
            success: function(response) {
                $('#dashboard-content').html(response);
            },
            error: function() {
                $('#dashboard-content').html('<div class="text-red-500">Failed to load recent activity</div>');
            }
        });
    }
});

</script>
