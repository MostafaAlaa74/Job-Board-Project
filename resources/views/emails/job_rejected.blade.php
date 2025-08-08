<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
    <h2 style="color: #ef4444;">Job Rejected</h2>
    <p>Hello {{ $job->company->name }},</p>
    <p>We regret to inform you that your job posting for <strong>{{ $job->title }}</strong> has been <span
            style="color: #ef4444; font-weight: bold;">rejected</span> by the admin and will not be published on the
        platform.</p>
    <ul style="list-style: none; padding: 0;">
        <li><strong>Title:</strong> {{ $job->title }}</li>
        <li><strong>Location:</strong> {{ $job->location }}</li>
        <li><strong>Type:</strong> {{ $job->type }}</li>
        <li><strong>Created At:</strong> {{ $job->created_at->format('Y-m-d H:i') }}</li>
    </ul>
    <hr>
    <p style="color: #64748b; font-size: 14px;">If you have questions, please contact support.<br>Thank you for using our
        job portal!</p>
</div>
