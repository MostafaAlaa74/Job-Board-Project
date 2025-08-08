@extends('layouts.app')

@section('title', 'Pending Jobs')

@section('content')
    <div class="max-w-5xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Pending Jobs</h1>
        <div class="bg-white rounded shadow p-6">
            @if ($jobs->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Company</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Location</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created At</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($jobs as $job)
                            @if ($job->status !== 'pending') continue; // Ensure only pending jobs are displayed
                            @endif
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $job->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $job->company->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $job->location }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $job->type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $job->created_at->format('Y-m-d H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <form action="{{ route('jobs.accept', $job->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700">Accept</button>
                                    </form>
                                    <form action="{{ route('jobs.reject', $job->id) }}" method="POST" class="inline ml-2">
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
                <p class="text-gray-500">No pending jobs found.</p>
            @endif
        </div>
    </div>
@endsection
