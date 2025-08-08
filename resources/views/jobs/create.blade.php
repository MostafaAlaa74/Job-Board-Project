@extends('layouts.app')

@section('title', 'Add Job')

@section('content')
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Create a New Job</h1>
        <form action="{{ route('Jobs.s') }}" method="post" class="bg-white p-6 rounded shadow">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                <input type="text" name="title" id="title"
                    class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                    required></textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" id="location"
                    class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                    required>
                @error('location')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                <select name="type" id="type"
                    class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                    <option value="full-time">Full-time</option>
                    <option value="part-time">Part-time</option>
                    <option value="contract">Contract</option>
                </select>
                @error('type')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="salary" class="inline-flex items-center">
                    <input type="number" name="salary" id="salary"
                        class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border">
                    <span class="ml-2">Salary</span>
                </label>
                @error('salary')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <input type="hidden" name="company_id" value="{{ auth()->user()->companies->first()->id }}">
            @error('company_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            <button type="submit" class="bg-primary-600 text-white px-4 py-2 rounded">Create Job</button>
        </form>
    </div>
@endsection
