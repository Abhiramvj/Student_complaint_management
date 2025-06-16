<p><strong>Complaint Submitted By:</strong> {{ $complaint->user->name }}</p>
<p><strong>Title:</strong> {{ $complaint->title }}</p>
<p><strong>Description:</strong> {{ $complaint->description }}</p>

@if($complaint->attachment)
    <p>
        <strong>Attachment:</strong>
        <a href="{{ asset('storage/' . $complaint->attachment) }}" target="_blank">View Attachment</a>
    </p>
@else
    <p><strong>Attachment:</strong> None</p>
@endif
