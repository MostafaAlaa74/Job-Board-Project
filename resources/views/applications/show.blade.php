@extends('layouts.app')

@section('title', 'Application Details')

@section('content')
    <div class="max-w-2xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow p-8">
            <h1 class="text-2xl font-bold mb-4">Application Details</h1>
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-primary-700 mb-2">Job Information</h2>
                <div class="flex items-center mb-2">
                    <span class="font-medium text-gray-700">Title:</span>
                    <span class="ml-2 text-gray-900">{{ $application->job->title }}</span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="font-medium text-gray-700">Company:</span>
                    <span class="ml-2 text-gray-900">{{ $application->job->company->name }}</span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="font-medium text-gray-700">Location:</span>
                    <span class="ml-2 text-gray-900">{{ $application->job->location }}</span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="font-medium text-gray-700">Type:</span>
                    <span class="ml-2 text-gray-900">{{ $application->job->type }}</span>
                </div>
                <a href="{{ route('jobs.show', $application->job->id) }}" class="text-primary-600 hover:underline">View
                    Job</a>
            </div>
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-primary-700 mb-2">Applicant Information</h2>
                <div class="flex items-center mb-2">
                    <span class="font-medium text-gray-700">Name:</span>
                    <span class="ml-2 text-gray-900">{{ $application->user->name }}</span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="font-medium text-gray-700">Email:</span>
                    <span class="ml-2 text-gray-900">{{ $application->user->email }}</span>
                </div>
                <div class="flex items-center mb-2">
                    <span class="font-medium text-gray-700">Phone:</span>
                    <span class="ml-2 text-gray-900">{{ $application->phone ?? '-' }}</span>
                </div>
                <a href="{{ route('users.show', $application->user->id) }}" class="text-primary-600 hover:underline">View
                    Profile</a>
            </div>
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-primary-700 mb-2">Cover Letter</h2>
                <div class="bg-gray-50 rounded p-4 text-gray-800">
                    {{ $application->cover_letter ?? 'No cover letter provided.' }}
                </div>
            </div>
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-primary-700 mb-2">Resume/CV</h2>
                @if ($application->resume_path)
                    <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank"
                        class="inline-flex items-center px-4 py-2 border border-primary-600 text-sm font-medium rounded text-primary-600 bg-white hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">Download
                        Resume</a>
                @else
                    <span class="text-gray-500">No resume uploaded.</span>
                @endif
            </div>
            <div class="mb-2 text-sm text-gray-500">
                <span>Applied at: {{ $application->created_at->format('Y-m-d H:i') }}</span>
            </div>
            <div class="mt-6 flex gap-4">
                <form action="{{ route('accept.application', $application->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700">
                        Accept
                    </button>
                </form>
                <form action="{{ route('application.reject', $application->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700">
                        Reject
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
