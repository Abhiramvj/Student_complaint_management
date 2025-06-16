<div class="bg-white p-6 rounded shadow max-w-7xl mx-auto">
    <table class="w-full text-left">
        <thead>
            <tr class="text-gray-700 font-semibold border-b">
                <th class="py-2 w-1/4">ID</th>
                <th class="py-2 w-1/2">Name</th>
                <th class="py-2 w-1/4">Email</th>
                <th class="py-2 w-1/2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2">{{ $student->id }}</td>
                    <td class="py-2">{{ $student->name }}</td>
                    <td class = "py-2">{{$student->email}}</td>
                    <td class="py-2">
                        <div class="flex items-center space-x-2">
                           <td class="py-2">
    <div class="flex items-center space-x-2">
        <button type="button"
                class="text-red-600 hover:underline delete-student"
                data-url="{{ route('admin.student.destroy', $student->id) }}">
            Delete
        </button>
    </div>
</td>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).on('click', '.delete-student', function (e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    if (!confirm('Are you sure you want to delete this student?')) return;

    const url = $(this).data('url');

    $.ajax({
        url: url,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function () {
            location.reload();
        },
        error: function (xhr) {
            alert('Failed to delete student.');
            console.error(xhr.responseText);
        }
    });
});

</script>
