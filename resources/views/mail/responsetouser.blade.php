<p>Dear {{ $complaint->user->name }},</p>
<p>Your complaint has been reviewed. Please see the recent update:</p>
<p><strong>Complaint Title:</strong> {{ $complaint->title }}</p>
<p><strong>Description:</strong> {{ $complaint->description }}</p>
@foreach ($complaint->complaintResponses as $response)
    <div>
        – <strong>{{ $response->user->name }}:</strong> {{ $response->message }}
        <span class="text-xs text-gray-400">({{ $response->created_at->diffForHumans() }})</span>
    </div>
@endforeach
