  <div class="py-6">
        <div class="lg:px-8 ">
            <div class="flex">
                <aside class="custom-sidebar w-1/6 p-3">
                    <nav class="space-y-2">
                        <button class="w-full text-left px-4 py-2 rounded nav-btn"
                                data-url="{{route('department.recent')}}">
                            Dashboard
                        </button>
                       <button class="w-full text-left px-4 py-2 rounded nav-btn"
                        data-url="{{route('department.all')}}">
                            All Complaints
                        </button>
                    </nav>
                </aside>


                <main class="w-3/4 bg-white p-6 rounded-r-lg min-h-[400px]" id="main-content">
                    <div>
                        <div id="dashboard-content" class="mt-4">

                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
