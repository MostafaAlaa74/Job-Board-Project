@extends('layouts.app')

@section('title', 'Edit Job')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-6">Edit Job</h1>
    <form action="{{ route('jobs.update', $job->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}"class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border" required>{{ old('description', $job->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $job->location) }}"class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border" required>
        </div>
        <div class="mb-4">
            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
            <select name="type" id="type"class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                <option value="Full-time" {{ old('type', $job->type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>
                <option value="Part-time" {{ old('type', $job->type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>
                <option value="Contract" {{ old('type', $job->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="remote" class="inline-flex items-center">
                <input type="checkbox" name="remote" id="remote" class="form-checkbox" {{ old('remote', $job->remote) ? 'checked' : '' }}>
                <span class="ml-2">Remote</span>
            </label>
        </div>
        <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded">Update Job</button>
    </form>
</div>
@endsection
