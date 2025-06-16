<form id="filter-form" method="GET" action="{{ route('department.dashboard.filter') }}">
    <select name="status" id="status-filter" class="...">
        <option value="">All Statuses</option>
        @foreach ($statuses as $status)
            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                {{ ucfirst(str_replace('_', ' ', $status)) }}
            </option>
        @endforeach
    </select>
</form>
