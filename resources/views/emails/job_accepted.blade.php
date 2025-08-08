<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
    <h2 style="color: #22c55e;">Job Approved</h2>
    <p>Hello {{ $job->company->name }},</p>
    <p>Your job posting for <strong>{{ $job->title }}</strong> has been <span
            style="color: #22c55e; font-weight: bold;">approved</span> by the admin and is now live on the platform.</p>
    <ul style="list-style: none; padding: 0;">
        <li><strong>Title:</strong> {{ $job->title }}</li>
        <li><strong>Location:</strong> {{ $job->location }}</li>
        <li><strong>Type:</strong> {{ $job->type }}</li>
        <li><strong>Created At:</strong> {{ $job->created_at->format('Y-m-d H:i') }}</li>
    </ul>
    <a href="{{ url('/jobs/' . $job->id) }}" style="color: #2563eb;">View Job Posting</a>
    <hr>
    <p style="color: #64748b; font-size: 14px;">Thank you for using our job portal!</p>
</div>
