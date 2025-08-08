@extends('layouts.app')

@section('title', '{{ $company->name ?? "Company Name" }} - Company Profile - JobBoard')

@section('content')
<div class="bg-white">
    <!-- Company Header -->
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="lg:flex lg:items-start lg:justify-between">
                <div class="flex items-start space-x-6">
                    <!-- Company Logo -->
                    <div class="w-24 h-24 bg-white rounded-xl shadow-sm border border-gray-200 flex items-center justify-center flex-shrink-0">
                        @if(isset($company->logo))
                            <img src="{{ $company->logo }}" alt="{{ $company->name }}" class="w-20 h-20 rounded-xl">
                        @else
                            <span class="text-gray-600 font-bold text-2xl">{{ substr($company->name ?? 'T', 0, 1) }}</span>
                        @endif
                    </div>

                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl">
                            {{ $company->name ?? 'TechCorp Inc.' }}
                        </h1>
                        <p class="mt-2 text-lg text-gray-600">
                            {{ $company->tagline ?? 'Building the future of technology' }}
                        </p>
                        <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                {{ $company->industry ?? 'Technology' }}
                            </div>
                            <div class="flex items-center">
                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $company->location ?? 'San Francisco, CA' }}
                            </div>
                            <div class="flex items-center">
                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                {{ $company->size ?? '100-500' }} employees
                            </div>
                            <div class="flex items-center">
                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1m-6 0h6m-6 0v10a2 2 0 002 2h4a2 2 0 002-2V7m-6 0V6a2 2 0 012-2h4a2 2 0 012 2v1"></path>
                                </svg>
                                Founded {{ $company->founded ?? '2015' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 lg:mt-0 lg:ml-4">
                    <div class="flex items-center space-x-3">
                        @if(isset($company->website))
                            <a href="{{ $company->website }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Visit Website
                            </a>
                        @endif
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            Follow
                        </button>
                    </div>
                </div>
            </div>

            <!-- Company Stats -->
            <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-4">
                <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $company->active_jobs_count ?? 5 }}</div>
                    <div class="text-sm text-gray-500">Open Positions</div>
                </div>
                <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $company->total_applications ?? 47 }}</div>
                    <div class="text-sm text-gray-500">Applications</div>
                </div>
                <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
                    <div class="text-2xl font-bold text-gray-900">{{ $company->followers_count ?? 1234 }}</div>
                    <div class="text-sm text-gray-500">Followers</div>
                </div>
                <div class="bg-white rounded-lg border border-gray-200 p-4 text-center">
                    <div class="text-2xl font-bold text-gray-900">4.8</div>
                    <div class="text-sm text-gray-500">Rating</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="lg:grid lg:grid-cols-3 lg:gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- About Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">About {{ $company->name ?? 'TechCorp Inc.' }}</h2>
                    <div class="prose prose-blue max-w-none">
                        <p class="text-gray-600 leading-relaxed">
                            {{ $company->description ?? 'We are a leading technology company focused on building innovative solutions that make a difference in people\'s lives. Our team is passionate about creating products that solve real-world problems and drive meaningful change in the industry.' }}
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            {{ $company->mission ?? 'Our mission is to empower businesses and individuals through cutting-edge technology solutions. We believe in fostering a culture of innovation, collaboration, and continuous learning.' }}
                        </p>
                    </div>
                </div>

                <!-- Open Positions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Open Positions ({{ $company->active_jobs_count ?? 5 }})</h2>
                        <a href="{{ route('jobs.index', ['company' => $company->id ?? '']) }}" class="text-primary-600 hover:text-primary-500 text-sm font-medium">
                            View all jobs →
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($company->jobs ?? [] as $job)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 hover:text-primary-600">
                                            <a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
                                        </h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $job->location }}</p>
                                        <p class="text-gray-600 mt-2 line-clamp-2">{{ Str::limit($job->description, 120) }}</p>
                                        <div class="flex items-center justify-between mt-4">
                                            <div class="flex items-center space-x-4">
                                                @if($job->salary_min && $job->salary_max)
                                                    <span class="text-lg font-semibold text-primary-600">
                                                        ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                                    </span>
                                                @endif
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    {{ ucfirst(str_replace('_', ' ', $job->type)) }}
                                                </span>
                                            </div>
                                            <span class="text-sm text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('jobs.show', $job) }}" class="ml-4 inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                                        View Job
                                    </a>
                                </div>
                            </div>
                        @empty
                            <!-- Sample Jobs for Demo -->
                            @for($i = 1; $i <= 3; $i++)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h3 class="text-lg font-semibold text-gray-900 hover:text-primary-600">
                                                <a href="#">{{ ['Senior Software Engineer', 'Product Manager', 'UX Designer'][$i-1] }}</a>
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ ['San Francisco, CA', 'Remote', 'New York, NY'][$i-1] }}</p>
                                            <p class="text-gray-600 mt-2 line-clamp-2">{{ ['Join our team to build scalable web applications using modern technologies.', 'Drive product strategy and roadmap for our flagship product.', 'Create beautiful and intuitive user experiences for our digital products.'][$i-1] }}</p>
                                            <div class="flex items-center justify-between mt-4">
                                                <div class="flex items-center space-x-4">
                                                    <span class="text-lg font-semibold text-primary-600">
                                                        {{ ['$120,000 - $160,000', '$110,000 - $140,000', '$90,000 - $120,000'][$i-1] }}
                                                    </span>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Full Time
                                                    </span>
                                                </div>
                                                <span class="text-sm text-gray-500">{{ $i }} days ago</span>
                                            </div>
                                        </div>
                                        <a href="#" class="ml-4 inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 transition-colors">
                                            View Job
                                        </a>
                                    </div>
                                </div>
                            @endfor
                        @endforelse
                    </div>
                </div>

                <!-- Company Culture -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Company Culture & Values</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if(isset($company->values))
                            @foreach($company->values as $value)
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $value['title'] }}</h3>
                                        <p class="text-sm text-gray-600 mt-1">{{ $value['description'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Sample Values for Demo -->
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Innovation</h3>
                                    <p class="text-sm text-gray-600 mt-1">We constantly push boundaries and embrace new technologies to solve complex problems.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Collaboration</h3>
                                    <p class="text-sm text-gray-600 mt-1">We believe in the power of teamwork and diverse perspectives to achieve great results.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Quality</h3>
                                    <p class="text-sm text-gray-600 mt-1">We are committed to delivering exceptional quality in everything we do.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Growth</h3>
                                    <p class="text-sm text-gray-600 mt-1">We invest in our people's development and provide opportunities for career advancement.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Benefits -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Benefits & Perks</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if(isset($company->benefits))
                            @foreach($company->benefits as $benefit)
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-gray-600">{{ $benefit }}</span>
                                </div>
                            @endforeach
                        @else
                            <!-- Sample Benefits for Demo -->
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

            <!-- Sidebar -->
            <div class="lg:col-span-1 mt-8 lg:mt-0">
                <div class="sticky top-8 space-y-6">
                    <!-- Contact Info -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                        <div class="space-y-3">
                            @if(isset($company->website))
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                    <a href="{{ $company->website }}" target="_blank" class="text-primary-600 hover:text-primary-500">{{ $company->website }}</a>
                                </div>
                            @endif
                            @if(isset($company->email))
                                <div class="flex items-center">
                                    <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <a href="mailto:{{ $company->email }}" class="text-primary-600 hover:text-primary-500">{{ $company->email }}</a>
                                </div>
                            @endif
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-gray-600">{{ $company->address ?? 'San Francisco, CA' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    @if(isset($company->social_links))
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Follow Us</h3>
                            <div class="flex space-x-3">
                                @foreach($company->social_links as $platform => $url)
                                    <a href="{{ $url }}" target="_blank" class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center hover:bg-gray-200 transition-colors">
                                        <!-- Social media icons would go here -->
                                        <span class="text-gray-600 font-medium text-sm">{{ strtoupper(substr($platform, 0, 1)) }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Similar Companies -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Similar Companies</h3>
                        <div class="space-y-4">
                            @for($i = 1; $i <= 3; $i++)
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-{{ ['blue', 'green', 'purple'][$i-1] }}-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-{{ ['blue', 'green', 'purple'][$i-1] }}-600 font-semibold">{{ ['S', 'D', 'W'][$i-1] }}</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900 text-sm">{{ ['StartupCo', 'DesignStudio', 'WebAgency'][$i-1] }}</h4>
                                        <p class="text-xs text-gray-500">{{ ['Technology', 'Design', 'Marketing'][$i-1] }}</p>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

