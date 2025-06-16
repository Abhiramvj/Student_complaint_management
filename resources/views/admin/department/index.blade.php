<x-slot name="title">Departments</x-slot>

<h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">Department Management</h1>

<div class="mb-4 flex justify-end items-start -mt-2">
    <button id="load-create-form"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Create Department
    </button>
</div>

<div id="dynamic-content">
    @include('admin.department.partials.table')
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#load-create-form').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('admin.department.create') }}",
            type: "GET",
            success: function(response) {
                $('#dynamic-content').html(response);
            },
            error: function() {
                alert("Failed to load the form.");
            }
        });
    });
      $(document).on('click', '.load-edit-form', function(e) {
    e.preventDefault();
    const url = $(this).data('url');

    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            $('#dynamic-content').html(response);
        },
        error: function() {
            alert('Failed to load edit form.');
        }
    });
});
 $(document).on('submit', '#edit-department-form', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Reload department list dynamically
                $('#dynamic-content').html(response);
            },
            error: function() {
                alert('Update failed.');
            }
        });
    });
  $(document).on('click', '.delete-department', function(e) {
    e.preventDefault();
    e.stopImmediatePropagation();

    if (!confirm('Are you sure you want to delete this department and its complaints?')) return;

    const url = $(this).data('url');

    $.ajax({
        url: url,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
            location.reload();
        },
        error: function(xhr) {
            alert('Delete failed.');
            console.error(xhr.responseText);
        }
    });
});




</script>


