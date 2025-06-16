<x-app-layout>
    <x-sidebar-style />
    <x-slot name="title">Department Dashboard</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Feedback And Complaint Management') }}
        </h2>
    </x-slot>
   <x-departmentdashboard>
   </x-departmentdashboard>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.nav-btn').click(function (e) {
            e.preventDefault();
            let url = $(this).data('url');

            if (!url || url === '#') {
                $('#dashboard-content').html('<div class="text-gray-500">This section is not available yet.</div>');
                return;
            }

            $('.nav-btn').removeClass('bg-gray-300');
            $(this).addClass('bg-gray-300');

            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function () {
                    $('#dashboard-content').html('<div class="text-center py-4">Loading...</div>');
                },
                success: function (response) {
                    $('#dashboard-content').html(response);
                },
                error: function () {
                    $('#dashboard-content').html('<div class="text-red-600">Error loading content.</div>');
                }
            });
        });
        $(document).on('change', '#status-filter', function () {
    const url = $('#filter-form').attr('action');
    const data = $('#filter-form').serialize();

    $('#complaint-wrapper').html('<div class="text-center py-4">Loading...</div>');

    $.ajax({
        url: url,
        type: 'GET',
        data: data,
        success: function (response) {
            $('#complaint-wrapper').html(response);
        },
        error: function () {
            $('#complaint-wrapper').html('<div class="text-red-500 text-center py-4">Failed to load data.</div>');
        }
    });
});
          $('.nav-btn[data-url="{{ route('department.recent') }}"]').trigger('click');
    });
</script>


</x-app-layout>
