@extends('layouts.app')

@section('title', '{{ $job->title ?? "Job Title" }} at {{ $job->company->name ?? "Company Name" }} - JobBoard')

@section('content')
<div class="bg-white">
    <!-- Job Header -->
    <div class="bg-gray-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="lg:flex lg:items-start lg:justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex items-start space-x-4">
                        <!-- Company Logo -->
                        <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            @if(isset($job->company->logo))
                                <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="w-14 h-14 rounded-lg">
                            @else
                                <span class="text-gray-600 font-semibold text-xl">{{ substr($job->company->name ?? 'T', 0, 1) }}</span>
                            @endif
                        </div>

                        <div class="flex-1">
                            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">
                                {{ $job->title ?? 'Senior Software Engineer' }}
                            </h1>
                            <div class="mt-2 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6">
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <a href="{{ route('companies.show', $job->company ?? '#') }}" class="hover:text-primary-600">
                                        {{ $job->company->name ?? 'TechCorp Inc.' }}
                                    </a>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $job->location ?? 'San Francisco, CA' }}
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Posted {{ $job->created_at->diffForHumans() ?? '2 days ago' }}
                                </div>
                            </div>
                            <div class="mt-4 flex items-center space-x-3">
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium 
                                    @if(($job->type ?? 'full-time') === 'full-time') bg-green-100 text-green-800
                                    @elseif(($job->type ?? 'full-time') === 'part-time') bg-blue-100 text-blue-800
                                    @elseif(($job->type ?? 'full-time') === 'contract') bg-purple-100 text-purple-800
                                    @elseif(($job->type ?? 'full-time') === 'freelance') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst(str_replace('_', ' ', $job->type ?? 'Full Time')) }}
                                </span>
                                @if(isset($job->experience_level))
                                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                        {{ ucfirst($job->experience_level) }} Level
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5 flex lg:mt-0 lg:ml-4">
                    <div class="flex items-center space-x-3">
                        @auth
                            @if(auth()->user()->role === 'job_seeker')
                                <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    Save Job
                                </button>
                            @endif
                        @endauth
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                            Share
                        </button>
                    </div>
                </div>
            </div>

            <!-- Salary and Quick Info -->
            <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Salary</p>
                            <p class="text-lg font-semibold text-gray-900">
                                @if(isset($job->salary_min) && isset($job->salary_max))
                                    ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                @elseif(isset($job->salary_min))
                                    From ${{ number_format($job->salary_min) }}
                                @else
                                    $120,000 - $160,000
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Applicants</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $job->applications_count ?? 12 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 p-4">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Views</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $job->views_count ?? 156 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <!-- Job Details -->
            <div class="lg:col-span-2">
                <div class="bg-white">
                    <!-- Job Description -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Job Description</h2>
                        <div class="prose prose-blue max-w-none">
                            <p class="text-gray-600 leading-relaxed">
                                {{ $job->description ?? 'We are looking for a talented Senior Software Engineer to join our growing team. You will be responsible for designing, developing, and maintaining scalable web applications using modern technologies. The ideal candidate should have strong experience with full-stack development and a passion for creating high-quality software solutions.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Responsibilities -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Key Responsibilities</h2>
                        <ul class="space-y-2 text-gray-600">
                            @if(isset($job->responsibilities))
                                @foreach(explode("\n", $job->responsibilities) as $responsibility)
                                    <li class="flex items-start">
                                        <svg class="flex-shrink-0 h-5 w-5 text-green-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ trim($responsibility) }}
                                    </li>
                                @endforeach
                            @else
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-green-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Design and develop scalable web applications using modern frameworks
                                </li>
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-green-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Collaborate with cross-functional teams to define and implement new features
                                </li>
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-green-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Write clean, maintainable, and well-documented code
                                </li>
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-green-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Participate in code reviews and maintain high coding standards
                                </li>
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-green-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Troubleshoot and debug applications to optimize performance
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Requirements -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Requirements</h2>
                        <ul class="space-y-2 text-gray-600">
                            @if(isset($job->requirements))
                                @foreach(explode("\n", $job->requirements) as $requirement)
                                    <li class="flex items-start">
                                        <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ trim($requirement) }}
                                    </li>
                                @endforeach
                            @else
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Bachelor's degree in Computer Science or related field
                                </li>
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    5+ years of experience in software development
                                </li>
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Proficiency in JavaScript, React, Node.js, and modern web technologies
                                </li>
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Experience with database design and optimization
                                </li>
                                <li class="flex items-start">
                                    <svg class="flex-shrink-0 h-5 w-5 text-blue-500 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Strong problem-solving skills and attention to detail
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Benefits -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Benefits & Perks</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if(isset($job->benefits))
                                @foreach(explode("\n", $job->benefits) as $benefit)
                                    <div class="flex items-center">
                                        <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="text-gray-600">{{ trim($benefit) }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-600">Competitive salary and equity</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-600">Health, dental, and vision insurance</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-600">Flexible working hours</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-600">Remote work options</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-600">Professional development budget</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-600">Unlimited PTO</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 space-y-6">
                    <!-- Apply Section -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Apply for this job</h3>
                        
                        @auth
                            @if(auth()->user()->role === 'job_seeker')
                                @if(isset($hasApplied) && $hasApplied)
                                    <div class="text-center">
                                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-4">You have already applied for this job.</p>
                                        <a href="{{ route('applications.index') }}" class="text-primary-600 hover:text-primary-500 text-sm font-medium">
                                            View your applications →
                                        </a>
                                    </div>
                                @else
                                    <form action="{{ route('jobs.apply', $job ?? '#') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                        @csrf
                                        
                                        <!-- Cover Letter -->
                                        <div>
                                            <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-2">
                                                Cover Letter
                                            </label>
                                            <textarea 
                                                id="cover_letter" 
                                                name="cover_letter" 
                                                rows="4" 
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                                placeholder="Tell us why you're interested in this role..."
                                            ></textarea>
                                        </div>

                                        <!-- Resume Upload -->
                                        <div>
                                            <label for="resume" class="block text-sm font-medium text-gray-700 mb-2">
                                                Resume/CV <span class="text-red-500">*</span>
                                            </label>
                                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                                                <div class="space-y-1 text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <div class="flex text-sm text-gray-600">
                                                        <label for="resume" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                                            <span>Upload a file</span>
                                                            <input id="resume" name="resume" type="file" class="sr-only" accept=".pdf,.doc,.docx" required>
                                                        </label>
                                                        <p class="pl-1">or drag and drop</p>
                                                    </div>
                                                    <p class="text-xs text-gray-500">PDF, DOC, DOCX up to 10MB</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <button 
                                            type="submit"
                                            class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-3 px-4 rounded-md transition-colors duration-200 flex items-center justify-center"
                                        >
                                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                            </svg>
                                            Submit Application
                                        </button>
                                    </form>
                                @endif
                            @else
                                <div class="text-center">
                                    <p class="text-sm text-gray-600 mb-4">This feature is only available for job seekers.</p>
                                    <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-500 text-sm font-medium">
                                        Create a job seeker account →
                                    </a>
                                </div>
                            @endif
                        @else
                            <div class="text-center">
                                <p class="text-sm text-gray-600 mb-4">Please sign in to apply for this job.</p>
                                <div class="space-y-2">
                                    <a href="{{ route('login') }}" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-md transition-colors block text-center">
                                        Sign In
                                    </a>
                                    <a href="{{ route('register') }}" class="w-full border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-md transition-colors block text-center">
                                        Create Account
                                    </a>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <!-- Company Info -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">About {{ $job->company->name ?? 'TechCorp Inc.' }}</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-3">
                                    @if(isset($job->company->logo))
                                        <img src="{{ $job->company->logo }}" alt="{{ $job->company->name }}" class="w-10 h-10 rounded-lg">
                                    @else
                                        <span class="text-gray-600 font-semibold">{{ substr($job->company->name ?? 'T', 0, 1) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $job->company->name ?? 'TechCorp Inc.' }}</h4>
                                    <p class="text-sm text-gray-500">{{ $job->company->industry ?? 'Technology' }}</p>
                                </div>
                            </div>
                            
                            <p class="text-sm text-gray-600">
                                {{ $job->company->description ?? 'We are a leading technology company focused on building innovative solutions that make a difference in people\'s lives. Our team is passionate about creating products that solve real-world problems.' }}
                            </p>

                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <p class="text-gray-500">Company Size</p>
                                    <p class="font-medium text-gray-900">{{ $job->company->size ?? '100-500' }} employees</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Founded</p>
                                    <p class="font-medium text-gray-900">{{ $job->company->founded ?? '2015' }}</p>
                                </div>
                            </div>

                            <a href="{{ route('companies.show', $job->company ?? '#') }}" class="w-full border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-md transition-colors block text-center">
                                View Company Profile
                            </a>
                        </div>
                    </div>

                    <!-- Similar Jobs -->
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Similar Jobs</h3>
                        <div class="space-y-4">
                            @for($i = 1; $i <= 3; $i++)
                                <div class="border border-gray-200 rounded-lg p-3">
                                    <h4 class="font-medium text-gray-900 text-sm">{{ ['Frontend Developer', 'Full Stack Engineer', 'React Developer'][$i-1] }}</h4>
                                    <p class="text-sm text-gray-500">{{ ['WebAgency', 'StartupCo', 'DevStudio'][$i-1] }}</p>
                                    <p class="text-sm text-primary-600 font-medium">${{ ['90,000 - 120,000', '100,000 - 130,000', '85,000 - 115,000'][$i-1] }}</p>
                                    <a href="#" class="text-xs text-primary-600 hover:text-primary-500 mt-2 inline-block">View job →</a>
                                </div>
                            @endfor
                        </div>
                        <a href="{{ route('jobs.index') }}" class="mt-4 text-sm text-primary-600 hover:text-primary-500 font-medium">
                            View all similar jobs →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

