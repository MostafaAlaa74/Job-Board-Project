@extends('layouts.app')

@section('title', 'Browse Jobs')

@section('content')
    <div class="bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Browse Jobs</h1>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">Find your dream job from thousands of
                    listings</p>
                @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'company'))
                    <div class="mt-6 flex justify-center">
                        <a href="{{ route('jobs.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Add Job
                        </a>
                    </div>
                @endif
            </div>

            <!-- Search and Filter Form -->
            {{-- <div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
                <form action="{{ url('/jobs') }}" method="GET" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Job Title or
                                Keyword</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    class="focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 pr-3 py-2 border-gray-300 rounded-md"
                                    placeholder="Search jobs...">
                            </div>
                        </div>

                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" name="location" id="location" value="{{ request('location') }}"
                                    class="focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 pr-3 py-2 border-gray-300 rounded-md"
                                    placeholder="City, state, or remote">
                            </div>
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Job Type</label>
                            <select id="type" name="type"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                                <option value="">All Types</option>
                                <option value="Full-time" {{ request('type') == 'Full-time' ? 'selected' : '' }}>Full-time
                                </option>
                                <option value="Part-time" {{ request('type') == 'Part-time' ? 'selected' : '' }}>Part-time
                                </option>
                                <option value="Contract" {{ request('type') == 'Contract' ? 'selected' : '' }}>Contract
                                </option>
                                <option value="Freelance" {{ request('type') == 'Freelance' ? 'selected' : '' }}>Freelance
                                </option>
                                <option value="Internship" {{ request('type') == 'Internship' ? 'selected' : '' }}>
                                    Internship</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Search Jobs
                        </button>
                    </div>
                </form>
            </div>

            <!-- Advanced Filters (Collapsible) -->
            <div class="mt-4">
                <button type="button" id="advanced-filters-toggle"
                    class="text-primary-600 hover:text-primary-500 text-sm font-medium flex items-center">
                    <span id="advanced-filters-text">Show Advanced Filters</span>
                    <svg id="advanced-filters-icon" class="ml-1 h-5 w-5 transform transition-transform duration-200"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <div id="advanced-filters" class="mt-4 bg-white rounded-lg shadow overflow-hidden hidden">
                    <form action="{{ url('/jobs') }}" method="GET" class="p-6">
                        <!-- Hidden fields to preserve main search params -->
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        <input type="hidden" name="type" value="{{ request('type') }}">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="salary" class="block text-sm font-medium text-gray-700">Salary Range</label>
                                <select id="salary" name="salary"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                                    <option value="">Any Salary</option>
                                    <option value="0-30000" {{ request('salary') == '0-30000' ? 'selected' : '' }}>$0 -
                                        $30,000</option>
                                    <option value="30000-60000" {{ request('salary') == '30000-60000' ? 'selected' : '' }}>
                                        $30,000 - $60,000</option>
                                    <option value="60000-90000" {{ request('salary') == '60000-90000' ? 'selected' : '' }}>
                                        $60,000 - $90,000</option>
                                    <option value="90000-120000"
                                        {{ request('salary') == '90000-120000' ? 'selected' : '' }}>$90,000 - $120,000
                                    </option>
                                    <option value="120000-" {{ request('salary') == '120000-' ? 'selected' : '' }}>
                                        $120,000+</option>
                                </select>
                            </div>

                            <div>
                                <label for="experience" class="block text-sm font-medium text-gray-700">Experience
                                    Level</label>
                                <select id="experience" name="experience"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                                    <option value="">Any Experience</option>
                                    <option value="entry" {{ request('experience') == 'entry' ? 'selected' : '' }}>Entry
                                        Level</option>
                                    <option value="mid" {{ request('experience') == 'mid' ? 'selected' : '' }}>Mid
                                        Level</option>
                                    <option value="senior" {{ request('experience') == 'senior' ? 'selected' : '' }}>
                                        Senior Level</option>
                                    <option value="executive"
                                        {{ request('experience') == 'executive' ? 'selected' : '' }}>Executive Level
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label for="posted" class="block text-sm font-medium text-gray-700">Date Posted</label>
                                <select id="posted" name="posted"
                                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                                    <option value="">Any Time</option>
                                    <option value="today" {{ request('posted') == 'today' ? 'selected' : '' }}>Today
                                    </option>
                                    <option value="week" {{ request('posted') == 'week' ? 'selected' : '' }}>Past Week
                                    </option>
                                    <option value="month" {{ request('posted') == 'month' ? 'selected' : '' }}>Past Month
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div> --}}

            <!-- Results Count and Sort -->
            {{-- <div class="mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-gray-700">
                Showing <span class="font-medium">{{ $jobs->firstItem() ?? 0 }}</span> to <span class="font-medium">{{ $jobs->lastItem() ?? 0 }}</span> of <span class="font-medium">{{ $jobs->total() ?? 0 }}</span> jobs
            </p>
            <div class="mt-2 sm:mt-0">
                <label for="sort" class="sr-only">Sort by</label>
                <select id="sort" name="sort" onchange="window.location.href = this.value" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'oldest']) }}" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'salary_high']) }}" {{ request('sort') == 'salary_high' ? 'selected' : '' }}>Salary: High to Low</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'salary_low']) }}" {{ request('sort') == 'salary_low' ? 'selected' : '' }}>Salary: Low to High</option>
                </select>
            </div>
        </div> --}}

            <!-- Job Listings -->
            <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    @forelse($jobs ?? [] as $job)
                        @if ($job->status == 'accepted')
                            <li>
                                <a href="{{ route('jobs.show', $job->id) }}" class="block hover:bg-gray-50">
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <h3 class="text-lg font-medium text-gray-900 truncate">
                                                        {{ $job->title ?? 'Job Title' }}</h3>
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <span>{{ $job->company->name ?? 'Company Name' }}</span>
                                                        <span class="mx-1">&middot;</span>
                                                        <span>{{ $job->company->location ?? 'Location' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ml-2 flex-shrink-0 flex">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $job->type === 'Full-time' ? 'bg-green-100 text-green-800' : ($job->type === 'Part-time' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                                    {{ $job->type ?? 'Full-time' }}
                                                </span>
                                                @if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'company'))
                                                    <a href="{{ route('jobs.edit', $job->id) }}"
                                                        class="ml-2 inline-flex items-center px-3 py-1 border border-primary-600 text-xs font-medium rounded text-primary-600 bg-white hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                        Edit
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endif
                        @empty
                            <li class="px-4 py-6 sm:px-6 text-center">
                                <p class="text-gray-500">No jobs found matching your criteria.</p>
                                <p class="mt-2 text-sm text-gray-500">Try adjusting your search filters or browse all
                                    available
                                    jobs.</p>
                                <div class="mt-4">
                                    <a href="{{ url('/jobs') }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                        View All Jobs
                                    </a>
                                </div>
                            </li>
                        
                    @endforelse
                </ul>
            </div>

            <!-- Pagination -->
            @if (isset($jobs) && $jobs->hasPages())
                <div class="mt-8 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:show">
                        {{-- Previous Button --}}
                        @if ($jobs->onFirstPage())
                            <span
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-50 cursor-not-allowed">
                                Previous
                            </span>
                        @else
                            <a href="{{ $jobs->previousPageUrl() }}"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Previous
                            </a>
                        @endif

                        {{-- Next Button --}}
                        @if ($jobs->hasMorePages())
                            <a href="{{ $jobs->nextPageUrl() }}"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Next
                            </a>
                        @else
                            <span
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-50 cursor-not-allowed">
                                Next
                            </span>
                        @endif
                    </div>
                </div>
            @endif
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        {{-- Showing <span class="font-medium">{{ $jobs->firstItem() ?? 0 }}</span> to <span class="font-medium">{{ $jobs->lastItem() ?? 0 }}</span> of <span class="font-medium">{{ $jobs->total() ?? 0 }}</span> results --}}
                    </p>
                </div>
                <div>
                    {{-- <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                        Previous Page Link
                        @if ($jobs->onFirstPage())
                            <span class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-300 cursor-not-allowed">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @else
                            <a href="{{ $jobs->previousPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif --}}

                    {{-- Pagination Elements --}}
                    {{-- @foreach ($jobs->getUrlRange(1, $jobs->lastPage()) as $page => $url)
                            @if ($page == $jobs->currentPage())
                                <span aria-current="page" class="relative inline-flex items-center px-4 py-2 border border-primary-500 bg-primary-50 text-sm font-medium text-primary-600">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach --}}

                    {{-- Next Page Link --}}
                    {{-- @if ($jobs->hasMorePages())
                            <a href="{{ $jobs->nextPageUrl() }}" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <span class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-300 cursor-not-allowed">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif --}}
                    </nav>
                </div>
            </div>
        </div>

    </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const advancedFiltersToggle = document.getElementById('advanced-filters-toggle');
            const advancedFilters = document.getElementById('advanced-filters');
            const advancedFiltersText = document.getElementById('advanced-filters-text');
            const advancedFiltersIcon = document.getElementById('advanced-filters-icon');

            if (advancedFiltersToggle && advancedFilters && advancedFiltersText && advancedFiltersIcon) {
                advancedFiltersToggle.addEventListener('click', function() {
                    advancedFilters.classList.toggle('hidden');
                    if (advancedFilters.classList.contains('hidden')) {
                        advancedFiltersText.textContent = 'Show Advanced Filters';
                        advancedFiltersIcon.classList.remove('rotate-180');
                    } else {
                        advancedFiltersText.textContent = 'Hide Advanced Filters';
                        advancedFiltersIcon.classList.add('rotate-180');
                    }
                });
            }
        });
    </script>
@endsection
