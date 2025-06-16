<x-sidebar-style />
<div class="py-6">
        <div class="lg:px-8">
            <div class="flex">
                <aside class="custom-sidebar w-1/6 p-3">
                    <nav class="space-y-2">
                        <button class="w-full text-left px-4 py-2 rounded nav-btn"
                                data-url="{{route('admin.dashboard.main')}}">
                            Dashboard
                        </button>
                        <button class="w-full text-left px-4 py-2 rounded nav-btn"
                                data-url="{{route('admin.dashboard.all')}}">
                            All Complaints
                        </button>
                        <button class="w-full text-left px-4 py-2 rounded nav-btn"
                                data-url="{{route('admin.department.index')}}">
                            Departments
                        </button>
                        <button class="w-full text-left px-4 py-2 rounded nav-btn"
                                data-url="{{route('admin.student.index')}}">
                            Users
                        </button>
                    </nav>
                </aside>


                <main class="w-3/4 bg-white p-6 rounded-r-lg min-h-[400px]" id="main-content">
                    <div id="dashboard-content" class="mt-4">
                            {{$slot}}
                    </div>
                </main>
            </div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.nav-btn', function(e) {
        e.preventDefault();
        let url = $(this).data('url');

        if (url) {
            $('#dashboard-content').html('<div class="text-center py-4">Loading...</div>');

            $.get(url, function(response) {
                $('#dashboard-content').html(response);
            }).fail(function() {
                $('#dashboard-content').html('<div class="text-red-600">Failed to load content.</div>');
            });
        }
    });
</script>
