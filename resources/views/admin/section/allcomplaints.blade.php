<x-app-layout>
    <x-slot name="title">All Complaints</x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Complaints</h2>
    </x-slot>
    <x-admindashboard>
        <div id="complaints-container">
            @include('admin.partials.complaints')
        </div>
    </x-admindashboard>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function () {
                    $('#complaints-container').html('<div class="text-center py-4">Loading...</div>');
                },
                success: function(data) {
                    $('#complaints-container').html(data);
                },
                error: function() {
                    $('#complaints-container').html('<div class="text-red-600">Error loading complaints.</div>');
                }
            });
        });
    </script>
</x-app-layout>
