@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="bg-primary-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="md:flex md:items-center md:justify-between">
                <div class="md:w-1/2 text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Find Your Dream Job Today
                    </h1>
                    <p class="mt-4 text-lg text-primary-100">
                        Browse thousands of job listings from top companies and find the perfect opportunity for your
                        career.
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('jobs.index') }}"
                            class="inline-block bg-white text-primary-700 font-semibold px-6 py-3 rounded-md shadow-md hover:bg-gray-100 transition duration-300 ease-in-out">
                            Browse All Jobs
                        </a>
                    </div>
                </div>
                <div class="hidden md:block md:w-1/2">
                    <img src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                        alt="People working" class="rounded-lg shadow-xl mx-auto">
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    {{-- <div class="bg-white shadow-md rounded-lg -mt-8 md:-mt-12 mx-4 md:mx-auto max-w-5xl relative z-10">
        <div class="p-6">
            <form action="{{ url('/jobs') }}" method="GET" class="space-y-4 md:space-y-0 md:flex md:space-x-4">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Job Title or Keyword</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                            placeholder="Search for jobs...">
                    </div>
                </div>
                <div class="md:w-1/4">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" name="location" id="location"
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
                            placeholder="Any location">
                    </div>
                </div>
                <div class="md:w-1/4">
                    <label for="job_type" class="block text-sm font-medium text-gray-700 mb-1">Job Type</label>
                    <select id="job_type" name="job_type"
                        class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                        <option value="">All Types</option>
                        <option value="full_time">Full Time</option>
                        <option value="part_time">Part Time</option>
                        <option value="contract">Contract</option>
                        <option value="internship">Internship</option>
                        <option value="remote">Remote</option>
                    </select>
                </div>
                <div class="md:flex md:items-end">
                    <button type="submit"
                        class="w-full md:w-auto bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out">
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div> --}}

    <!-- Featured Jobs Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Featured Job Opportunities
            </h2>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                Discover top positions from leading companies
            </p>
        </div>
        <?php $counter = 0; ?>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Featured Job Card 1 -->
            @foreach ($jobs as $job)
                @if ($counter < 3)
                    <div
                        class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="h-12 w-12 bg-gray-100 rounded-md flex items-center justify-center">
                                    <svg class="h-8 w-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zM10 4h4v2h-4V4zm10 16H4V8h16v12z">
                                        </path>
                                    </svg>
                                </div>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $job->type }}
                                </span>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                <a href="#" class="hover:text-primary-600">{{ $job->title }}</a>
                            </h3>
                            <div class="text-sm text-gray-500 mb-4">{{ $job->company->name }}</div>
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $job->company->location }}
                            </div>
                            <div class="text-sm text-gray-700 mb-4">
                                <p>{{ $job->description }}</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-primary-600 font-medium">
                                    ${{ $job->salary }}
                                </div>
                                {{-- <div class="text-sm text-gray-500">
                                Posted 2 days ago
                            </div> --}}
                            </div>
                        </div>
                        <div class="bg-gray-50 px-6 py-3 border-t border-gray-200">
                            <a href="{{ route('jobs.show', $job->id) }}"
                                class="text-primary-600 hover:text-primary-700 font-medium">View Details</a>
                        </div>
                    </div>
                    <?php $counter++; ?>
                @else
                    <?php break; ?>
                @endif
            @endforeach

            <div class="mt-10 text-center">
                <a href="{{ route('jobs.index') }}"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    View All Jobs
                    <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>





        <!-- CTA Section -->
        @if (!auth()->check())
            <div class="bg-primary-700">
                <div
                    class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                        <span class="block">Ready to start your career journey?</span>
                        <span class="block text-primary-200">Create your profile today.</span>
                    </h2>
                    <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                        <div class="inline-flex rounded-md shadow">
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary-600 bg-white hover:bg-primary-50">
                                Sign Up Now
                            </a>
                        </div>
                        <div class="ml-3 inline-flex rounded-md shadow">
                            <a href="{{ url('/jobs') }}"
                                class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700">
                                Browse Jobs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endsection
