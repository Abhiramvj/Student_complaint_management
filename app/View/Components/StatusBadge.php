<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    public string $status;
    public function __construct($status)
    {
        $this->status = $status;
    }

    public function colorClass()
{
    return match ($this->status) {
        'pending' => 'bg-yellow-100 text-yellow-800',
        'in_progress' => 'bg-violet-100 text-violet-800',
        'resolved' => 'bg-green-100 text-green-800',
        default => 'bg-gray-100 text-gray-800',
    };
}
    public function render(): View|Closure|string
    {
        return view('components.status-badge');
    }
}
