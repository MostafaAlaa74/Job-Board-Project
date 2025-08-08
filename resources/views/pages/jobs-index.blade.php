@extends('layouts.app')

@section('title', 'Find Jobs - JobBoard')

@section('content')
<div class="bg-white">
    <!-- Header Section -->
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        Find Your Next Job
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ $jobs->total() ?? '1,234' }} jobs found
                        @if(request('search'))
                            for "{{ request('search') }}"
                        @endif
                        @if(request('location'))
                            in {{ request('location') }}
                        @endif
                    </p>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <button 
                        x-data="{ open: false }" 
                        @click="open = !open"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 lg:hidden"
                    >
                        <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        Filters
                    </button>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mt-6">
                <form action="{{ route('jobs.index') }}" method="GET" class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Job Title/Keywords -->
                        <div class="relative">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                Job Title or Keywords
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="search"
                                    name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="e.g. Software Engineer"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                >
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="relative">
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">
                                Location
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="location"
                                    name="location" 
                                    value="{{ request('location') }}"
                                    placeholder="City, State or Remote"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                >
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Job Type -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                Job Type
                            </label>
                            <select 
                                id="type"
                                name="type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                            >
                                <option value="">All Types</option>
                                <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                <option value="contract" {{ request('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="freelance" {{ request('type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>Remote</option>
                            </select>
                        </div>

                        <!-- Search Button -->
                        <div class="flex items-end">
                            <button 
                                type="submit"
                                class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 flex items-center justify-center"
                            >
                                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="lg:grid lg:grid-cols-4 lg:gap-8">
            <!-- Sidebar Filters -->
            <div class="hidden lg:block lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Filters</h3>
                    
                    <form action="{{ route('jobs.index') }}" method="GET" class="space-y-6">
                        <!-- Preserve search params -->
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <input type="hidden" name="location" value="{{ request('location') }}">
                        <input type="hidden" name="type" value="{{ request('type') }}">

                        <!-- Salary Range -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Salary Range</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="salary" value="" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300" {{ !request('salary') ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Any</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="salary" value="0-50000" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300" {{ request('salary') == '0-50000' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">$0 - $50,000</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="salary" value="50000-100000" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300" {{ request('salary') == '50000-100000' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">$50,000 - $100,000</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="salary" value="100000-150000" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300" {{ request('salary') == '100000-150000' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">$100,000 - $150,000</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="salary" value="150000+" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300" {{ request('salary') == '150000+' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">$150,000+</span>
                                </label>
                            </div>
                        </div>

                        <!-- Experience Level -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Experience Level</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="experience[]" value="entry" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" {{ in_array('entry', request('experience', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Entry Level</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="experience[]" value="mid" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" {{ in_array('mid', request('experience', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Mid Level</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="experience[]" value="senior" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" {{ in_array('senior', request('experience', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Senior Level</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="experience[]" value="executive" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" {{ in_array('executive', request('experience', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Executive</span>
                                </label>
                            </div>
                        </div>

                        <!-- Company Size -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Company Size</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="company_size[]" value="startup" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" {{ in_array('startup', request('company_size', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Startup (1-10)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="company_size[]" value="small" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" {{ in_array('small', request('company_size', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Small (11-50)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="company_size[]" value="medium" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" {{ in_array('medium', request('company_size', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Medium (51-200)</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="company_size[]" value="large" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded" {{ in_array('large', request('company_size', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Large (200+)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Posted Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Posted Date</label>
                            <div class="space-y-2">
                                <label class="flex items-center">
                                    <input type="radio" name="posted" value="" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300" {{ !request('posted') ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Any time</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="posted" value="today" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300" {{ request('posted') == 'today' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Today</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="posted" value="week" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300" {{ request('posted') == 'week' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Past week</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="posted" value="month" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300" {{ request('posted') == 'month' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-600">Past month</span>
                                </label>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                Apply Filters
                            </button>
                            <a href="{{ route('jobs.index') }}" class="mt-2 w-full block text-center text-sm text-gray-500 hover:text-gray-700">
                                Clear all filters
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="lg:col-span-3">
                <!-- Sort Options -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-500">Sort by:</span>
                        <select 
                            name="sort" 
                            onchange="window.location.href = '{{ route('jobs.index') }}?' + new URLSearchParams(Object.assign(Object.fromEntries(new URLSearchParams(window.location.search)), {sort: this.value})).toString()"
                            class="text-sm border-gray-300 rounded-md focus:ring-primary-500 focus:border-primary-500"
                        >
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest first</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest first</option>
                            <option value="salary_high" {{ request('sort') == 'salary_high' ? 'selected' : '' }}>Salary: High to Low</option>
                            <option value="salary_low" {{ request('sort') == 'salary_low' ? 'selected' : '' }}>Salary: Low to High</option>
                            <option value="relevance" {{ request('sort') == 'relevance' ? 'selected' : '' }}>Most relevant</option>
                        </select>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="p-2 text-gray-400 hover:text-gray-600 border border-gray-300 rounded-md">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                        </button>
                        <button class="p-2 text-gray-600 border border-gray-300 rounded-md bg-gray-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Job Cards -->
                <div class="space-y-4">
                    @forelse($jobs ?? [] as $job)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-4 flex-1">
                                    <!-- Company Logo -->
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        @if($job->company->logo)
                                            <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="w-10 h-10 rounded-lg">
                                        @else
                                            <span class="text-gray-600 font-semibold text-lg">{{ substr($job->company->name, 0, 1) }}</span>
                                        @endif
                                    </div>

                                    <!-- Job Info -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-900 hover:text-primary-600">
                                                    <a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                                                </h3>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    <a href="{{ route('companies.show', $job->company) }}" class="hover:text-primary-600">{{ $job->company->name }}</a>
                                                    • {{ $job->location }}
                                                </p>
                                            </div>
                                            <div class="flex items-center space-x-2 ml-4">
                                                @auth
                                                    @if(auth()->user()->role === 'job_seeker')
                                                        <button class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                            </svg>
                                                        </button>
                                                    @endif
                                                @endauth
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                    @if($job->type === 'full-time') bg-green-100 text-green-800
                                                    @elseif($job->type === 'part-time') bg-blue-100 text-blue-800
                                                    @elseif($job->type === 'contract') bg-purple-100 text-purple-800
                                                    @elseif($job->type === 'freelance') bg-yellow-100 text-yellow-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst(str_replace('_', ' ', $job->type)) }}
                                                </span>
                                            </div>
                                        </div>

                                        <p class="text-gray-600 mt-3 line-clamp-2">{{ Str::limit($job->description, 150) }}</p>

                                        <div class="flex items-center justify-between mt-4">
                                            <div class="flex items-center space-x-4">
                                                @if($job->salary_min && $job->salary_max)
                                                    <span class="text-lg font-semibold text-primary-600">
                                                        ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                                    </span>
                                                @elseif($job->salary_min)
                                                    <span class="text-lg font-semibold text-primary-600">
                                                        From ${{ number_format($job->salary_min) }}
                                                    </span>
                                                @else
                                                    <span class="text-lg font-semibold text-primary-600">Competitive</span>
                                                @endif
                                                <span class="text-sm text-gray-500">• Posted {{ $job->created_at->diffForHumans() }}</span>
                                            </div>
                                            <a 
                                                href="{{ route('jobs.show', $job) }}" 
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 transition-colors"
                                            >
                                                View Job
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Sample Job Cards for Demo -->
                        @for($i = 1; $i <= 6; $i++)
                            <div class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200 p-6">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start space-x-4 flex-1">
                                        <div class="w-12 h-12 bg-{{ ['blue', 'green', 'purple', 'red', 'yellow', 'indigo'][$i-1] }}-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                            <span class="text-{{ ['blue', 'green', 'purple', 'red', 'yellow', 'indigo'][$i-1] }}-600 font-semibold text-lg">{{ ['T', 'D', 'M', 'S', 'A', 'F'][$i-1] }}</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-900 hover:text-primary-600">
                                                        <a href="#">{{ ['Senior Software Engineer', 'UX/UI Designer', 'Digital Marketing Manager', 'Data Scientist', 'Product Manager', 'Frontend Developer'][$i-1] }}</a>
                                                    </h3>
                                                    <p class="text-sm text-gray-600 mt-1">
                                                        <a href="#" class="hover:text-primary-600">{{ ['TechCorp Inc.', 'DesignStudio', 'MarketingPro', 'DataCorp', 'StartupCo', 'WebAgency'][$i-1] }}</a>
                                                        • {{ ['San Francisco, CA', 'Remote', 'New York, NY', 'Seattle, WA', 'Austin, TX', 'Los Angeles, CA'][$i-1] }}
                                                    </p>
                                                </div>
                                                <div class="flex items-center space-x-2 ml-4">
                                                    <button class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                                        </svg>
                                                    </button>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ ['bg-green-100 text-green-800', 'bg-purple-100 text-purple-800', 'bg-blue-100 text-blue-800', 'bg-green-100 text-green-800', 'bg-yellow-100 text-yellow-800', 'bg-green-100 text-green-800'][$i-1] }}">
                                                        {{ ['Full Time', 'Remote', 'Contract', 'Full Time', 'Part Time', 'Full Time'][$i-1] }}
                                                    </span>
                                                </div>
                                            </div>
                                            <p class="text-gray-600 mt-3 line-clamp-2">{{ ['Join our team to build scalable web applications using modern technologies. We\'re looking for someone passionate about clean code.', 'Create beautiful and intuitive user experiences for our digital products. Work with a talented team of designers and developers.', 'Lead our digital marketing efforts across multiple channels. Experience with SEO, PPC, and social media marketing required.', 'Analyze complex datasets to drive business insights. Experience with Python, R, and machine learning algorithms preferred.', 'Drive product strategy and roadmap for our flagship product. Work closely with engineering and design teams.', 'Build responsive web applications using React and modern JavaScript. Join a fast-growing startup environment.'][$i-1] }}</p>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="flex items-center space-x-4">
                                                    <span class="text-lg font-semibold text-primary-600">
                                                        {{ ['$120,000 - $160,000', '$80,000 - $110,000', '$70,000 - $95,000', '$130,000 - $170,000', '$110,000 - $140,000', '$90,000 - $120,000'][$i-1] }}
                                                    </span>
                                                    <span class="text-sm text-gray-500">• Posted {{ [$i, $i+1, $i+2, $i+3, $i+4, $i+5][$i-1] }} days ago</span>
                                                </div>
                                                <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                                                    View Job
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endforelse
                </div>

                <!-- Pagination -->
                @if(isset($jobs) && $jobs->hasPages())
                    <div class="mt-8">
                        {{ $jobs->appends(request()->query())->links() }}
                    </div>
                @else
                    <!-- Sample Pagination for Demo -->
                    <div class="mt-8 flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Previous
                            </a>
                            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Next
                            </a>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">97</span> results
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="#" class="bg-primary-50 border-primary-500 text-primary-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</a>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</a>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">3</a>
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                                    <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">10</a>
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

