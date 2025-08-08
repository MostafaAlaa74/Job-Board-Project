@extends('layouts.app')

@section('title', 'Job Applications')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Applications for {{ $job->title }}</h1>
        <div class="bg-white rounded shadow p-6">
            @if ($job->applications->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seeker
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Applied At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                CV</th>
                            <th class="px-6 py-3"></th>
                            <th class="px-6 py-3"></th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($job->applications as $application)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $application->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $application->user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $application->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank"
                                        class="text-green-600 hover:underline">Download</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <a href="{{ route('application.show', $application->id) }}"
                                        class="text-primary-600 hover:underline">View</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <a href="{{ route('users.show', $application->user->id) }}"
                                        class="text-primary-600 hover:underline">Profile</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    {{-- Accept Form --}}
                                    <form action="{{ route('accept.application', $application->id) }}" method="POST"
                                        class="inline ">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700">Accept</button>
                                    </form>
                                    {{-- Reject Form --}}
                                    <form action="{{ route('application.reject', $application->id) }}" method="POST"
                                        class="inline ml-2">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No seekers have applied to this job yet.</p>
            @endif
        </div>
        @if (auth()->check())
            @php
                // To Check Which Notifications the user has
                // Here we are checking for the AcceptApplicationNotificaion type
                $notifications = auth()
                    ->user()
                    ->notifications->where('type', App\Notifications\ApplingToJobNotification::class);

            @endphp
            @if ($notifications->count())
                <div class="max-w-2xl mx-auto mt-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <h2 class="text-lg font-semibold text-blue-700 mb-2">Notifications</h2>
                        <ul class="space-y-2">
                            @foreach ($notifications as $notification)
                                <li class="text-blue-800">
                                    {{ $notification->data['message'] ?? $notification->type }}
                                    <span
                                        class="text-xs text-gray-500 ml-2">{{ $notification->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection
