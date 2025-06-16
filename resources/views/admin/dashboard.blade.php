<x-app-layout>
    <x-sidebar-style />
    <x-slot name="title">Admin Dashboard</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard - Manage System') }}
        </h2>
    </x-slot>

    <x-admindashboard>
    </x-admindashboard>
</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.nav-btn', function (e) {
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

        let defaultUrl = @json(route('admin.dashboard.main'));
        $('.nav-btn[data-url="' + defaultUrl + '"]').trigger('click');
    });
</script>

