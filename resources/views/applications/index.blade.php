@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
    <div class="max-w-4xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">My Applications</h1>
        <div class="bg-white rounded shadow p-6">
            @if ($applications->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Job
                                Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Company</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Applied At</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($applications as $application)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $application->job->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $application->job->company->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $application->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $application->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <a href="{{ route('jobs.show', $application->job->id) }}"
                                        class="text-primary-600 hover:underline">View Job</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">You have not applied to any jobs yet.</p>
            @endif
        </div>
    </div>

    {{-- The Seeker Notification System --}}

    @if (auth()->check())
        @php
        // To Check Which Notifications the user has
            // Here we are checking for the AcceptApplicationNotificaion type
            $notifications = auth()
                ->user()
                ->notifications->where('type', App\Notifications\AcceptApplicationNotificaion::class);
            
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
@endsection
