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

</x-app-layout>
