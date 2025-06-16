<x-app-layout>
    <x-sidebar-style />
    <x-slot name="title">Student Dashboard</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Feedback And Complaint Management') }}
        </h2>
    </x-slot>
   <x-studentdashboard>
   </x-studentdashboard>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.nav-btn', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                if (!url || url === '#') {
                    $('#dashboard-content').html('<div class="text-gray-500">This section is not available yet.</div>');
                    $('.nav-btn').removeClass('active');
                    $(this).addClass('active');
                    return;
                }
                $('.nav-btn').removeClass('active');
                $(this).addClass('active');
                $.ajax({
                    url: url,
                    type: 'GET',
                    beforeSend: function() {
                        $('#dashboard-content').html('<div class="text-center py-4">Loading...</div>');
                    },
                    success: function(response) {
                        $('#dashboard-content').html(response);
                    },
                    error: function() {
                        $('#dashboard-content').html('<div class="text-red-600">Error loading content.</div>');
                    }
                });
            });
             $(document).on('change', '#status-filter', function() {
        var status = $(this).val();
        $.ajax({
            url: '{{ route("student.recent.filter") }}',
            type: 'GET',
            data: { status: status },
            beforeSend: function() {
                $('#student-recent').html('<div class="text-gray-500">Loading...</div>');
            },
            success: function(data) {
                $('#student-recent').html(data.html);
            },
            error: function() {
                $('#student-recent').html('<div class="text-red-500">Failed to load complaints.</div>');
            }
        });
    });


            $('.nav-btn[data-url="{{ route('student.recent') }}"]').trigger('click');

        });
    </script>

</x-app-layout>
