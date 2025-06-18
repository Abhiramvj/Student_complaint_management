@php
    $colorClass = match($status) {
        'pending' => 'bg-yellow-100 text-yellow-800',
        'in_progress' => 'bg-violet-100 text-violet-800',
        'resolved' => 'bg-green-100 text-green-800',
        default => 'bg-gray-100 text-gray-800',
    };
@endphp

<span class="capitalize {{ $colorClass }} px-2 py-1 rounded text-xs font-medium">
    {{ ucfirst(str_replace('_', ' ', $status)) }}
</span>
