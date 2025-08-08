<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
    <h2 style="color: #2563eb;">New Job Application Received</h2>
    <p>Hello {{ $company->name }},</p>
    <p>You have received a new application for the job position: <strong>{{ $job->title }}</strong>.</p>
    <hr>
    <h3>Applicant Details</h3>
    <ul style="list-style: none; padding: 0;">
        <li><strong>Name:</strong> {{ $application->user->name }}</li>
        <li><strong>Email:</strong> {{ $application->user->email }}</li>
        <li><strong>Phone:</strong> {{ $application->phone ?? '-' }}</li>
        <li><strong>Applied At:</strong> {{ $application->created_at->format('Y-m-d H:i') }}</li>
    </ul>
    <h3>Cover Letter</h3>
    <div style="background: #f1f5f9; padding: 12px; border-radius: 6px; margin-bottom: 16px;">
        {{ $application->cover_letter ?? 'No cover letter provided.' }}
    </div>
    <h3>Resume/CV</h3>
    @if ($application->resume_path)
        <a href="{{ asset('storage/' . $application->resume_path) }}" style="color: #2563eb;">Download Resume</a>
    @else
        <span>No resume uploaded.</span>
    @endif
    <hr>
    <p style="color: #64748b; font-size: 14px;">This is an automated message from the job portal. Please do not reply
        directly to this email.</p>
</div>
