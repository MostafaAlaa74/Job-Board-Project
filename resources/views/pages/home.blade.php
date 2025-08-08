@extends('layouts.app')

@section('title', 'Find Your Dream Job - JobBoard')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">
                Find Your 
                <span class="text-yellow-300">Dream Job</span>
            </h1>
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Connect with top companies and discover opportunities that match your skills and ambitions.
            </p>
            
            <!-- Search Form -->
            <div class="max-w-4xl mx-auto">
                <form action="{{ route('jobs.index') }}" method="GET" class="bg-white rounded-2xl shadow-2xl p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <!-- Job Title/Keywords -->
                        <div class="relative">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                                Job Title or Keywords
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="search"
                                    name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="e.g. Software Engineer, Marketing"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                >
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="relative">
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                Location
                            </label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="location"
                                    name="location" 
                                    value="{{ request('location') }}"
                                    placeholder="City, State or Remote"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                >
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Job Type -->
                        <div class="relative">
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                Job Type
                            </label>
                            <select 
                                id="type"
                                name="type" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                            >
                                <option value="">All Types</option>
                                <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                <option value="contract" {{ request('type') == 'contract' ? 'selected' : '' }}>Contract</option>
                                <option value="freelance" {{ request('type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="remote" {{ request('type') == 'remote' ? 'selected' : '' }}>Remote</option>
                            </select>
                        </div>
                    </div>

                    <button 
                        type="submit"
                        class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-4 px-8 rounded-lg transition-colors duration-200 flex items-center justify-center space-x-2"
                    >
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>Search Jobs</span>
                    </button>
                </form>
            </div>

            <!-- Stats -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-white">{{ $stats['total_jobs'] ?? '1,234' }}</div>
                    <div class="text-blue-200 mt-2">Active Jobs</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-white">{{ $stats['total_companies'] ?? '567' }}</div>
                    <div class="text-blue-200 mt-2">Companies</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-white">{{ $stats['total_applications'] ?? '8,901' }}</div>
                    <div class="text-blue-200 mt-2">Applications</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Jobs Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Featured Jobs
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Discover hand-picked opportunities from top companies looking for talented professionals like you.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @forelse($featured_jobs ?? [] as $job)
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 p-6">
                    <!-- Company Logo and Info -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                @if($job->company->logo)
                                    <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="w-8 h-8 rounded">
                                @else
                                    <span class="text-gray-600 font-semibold text-lg">{{ substr($job->company->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="ml-3">
                                <h3 class="font-semibold text-gray-900">{{ $job->company->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $job->location }}</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ ucfirst(str_replace('_', ' ', $job->type)) }}
                        </span>
                    </div>

                    <!-- Job Title and Description -->
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $job->title }}</h4>
                        <p class="text-gray-600 text-sm line-clamp-3">{{ Str::limit($job->description, 120) }}</p>
                    </div>

                    <!-- Salary and Apply Button -->
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-semibold text-primary-600">
                            @if($job->salary_min && $job->salary_max)
                                ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                            @elseif($job->salary_min)
                                From ${{ number_format($job->salary_min) }}
                            @else
                                Competitive
                            @endif
                        </div>
                        <a 
                            href="{{ route('jobs.show', $job) }}" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 transition-colors"
                        >
                            View Job
                        </a>
                    </div>

                    <!-- Posted Date -->
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-500">Posted {{ $job->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <!-- Sample Job Cards for Demo -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <span class="text-blue-600 font-semibold text-lg">T</span>
                            </div>
                            <div class="ml-3">
                                <h3 class="font-semibold text-gray-900">TechCorp Inc.</h3>
                                <p class="text-sm text-gray-500">San Francisco, CA</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Full Time
                        </span>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Senior Software Engineer</h4>
                        <p class="text-gray-600 text-sm">Join our team to build scalable web applications using modern technologies. We're looking for someone passionate about clean code and user experience.</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-semibold text-primary-600">$120,000 - $160,000</div>
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                            View Job
                        </a>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-500">Posted 2 days ago</p>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <span class="text-green-600 font-semibold text-lg">D</span>
                            </div>
                            <div class="ml-3">
                                <h3 class="font-semibold text-gray-900">DesignStudio</h3>
                                <p class="text-sm text-gray-500">Remote</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            Remote
                        </span>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">UX/UI Designer</h4>
                        <p class="text-gray-600 text-sm">Create beautiful and intuitive user experiences for our digital products. Work with a talented team of designers and developers.</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-semibold text-primary-600">$80,000 - $110,000</div>
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                            View Job
                        </a>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-500">Posted 1 week ago</p>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <span class="text-red-600 font-semibold text-lg">M</span>
                            </div>
                            <div class="ml-3">
                                <h3 class="font-semibold text-gray-900">MarketingPro</h3>
                                <p class="text-sm text-gray-500">New York, NY</p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Contract
                        </span>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Digital Marketing Manager</h4>
                        <p class="text-gray-600 text-sm">Lead our digital marketing efforts across multiple channels. Experience with SEO, PPC, and social media marketing required.</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-semibold text-primary-600">$70,000 - $95,000</div>
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                            View Job
                        </a>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <p class="text-xs text-gray-500">Posted 3 days ago</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center">
            <a 
                href="{{ route('jobs.index') }}" 
                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-primary-600 bg-primary-50 hover:bg-primary-100 transition-colors"
            >
                View All Jobs
                <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                How It Works
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Getting started is easy. Follow these simple steps to find your next opportunity.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">1. Search Jobs</h3>
                <p class="text-gray-600">Use our powerful search to find jobs that match your skills, location, and preferences.</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">2. Apply Easily</h3>
                <p class="text-gray-600">Submit your application with just a few clicks. Upload your resume and cover letter.</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">3. Get Hired</h3>
                <p class="text-gray-600">Connect with employers and land your dream job. Track your applications in your dashboard.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-primary-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
            Ready to Find Your Next Opportunity?
        </h2>
        <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
            Join thousands of professionals who have found their dream jobs through our platform.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a 
                href="{{ route('register') }}" 
                class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-medium rounded-lg text-primary-600 bg-white hover:bg-gray-50 transition-colors"
            >
                Get Started Today
            </a>
            <a 
                href="{{ route('jobs.index') }}" 
                class="inline-flex items-center px-8 py-4 border-2 border-white text-lg font-medium rounded-lg text-white hover:bg-white hover:text-primary-600 transition-colors"
            >
                Browse Jobs
            </a>
        </div>
    </div>
</section>
@endsection

