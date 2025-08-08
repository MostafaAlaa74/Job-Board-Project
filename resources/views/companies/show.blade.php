@extends('layouts.app')

@section('title', $company->name ?? 'Company Profile')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Company Header -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 md:flex md:items-center md:justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-20 w-20 bg-gray-100 rounded-md flex items-center justify-center">
                        @if($company->logo ?? false)
                            <img class="h-16 w-16 rounded-md" src="{{ $company->logo }}" alt="{{ $company->name ?? 'Company' }}">
                        @else
                            <span class="text-2xl font-medium text-gray-500">{{ substr($company->name ?? 'C', 0, 1) }}</span>
                        @endif
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $company->name ?? 'Company Name' }}</h1>
                        <div class="mt-1 flex items-center text-sm text-gray-500">
                            <span>{{ $company->industry ?? 'Industry' }}</span>
                            @if($company->location ?? false)
                                <span class="mx-1">&middot;</span>
                                <span>{{ $company->location }}</span>
                            @endif
                            @if($company->founded_year ?? false)
                                <span class="mx-1">&middot;</span>
                                <span>Founded {{ $company->founded_year }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
                    @if($company->website ?? false)
                        <a href="{{ $company->website }}" target="_blank" rel="noopener" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd" />
                            </svg>
                            Website
                        </a>
                    @endif
                    @if($company->linkedin ?? false)
                        <a href="{{ $company->linkedin }}" target="_blank" rel="noopener" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path fill-rule="evenodd" d="M16.338 16.338H13.67V12.16c0-1-.02-2.285-1.39-2.285-1.39 0-1.6 1.087-1.6 2.21v4.253h-2.667V8.5h2.56v1.17h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v3.963zM6.75 7.33a1.55 1.55 0 01-1.553-1.554A1.55 1.55 0 016.75 4.222a1.55 1.55 0 011.553 1.554A1.55 1.55 0 016.75 7.33zm1.336 9.008H5.417V8.5h2.67v7.838zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.404C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.298V2.298C19 1.581 18.402 1 17.668 1z" clip-rule="evenodd" />
                            </svg>
                            LinkedIn
                        </a>
                    @endif
                    @if($company->twitter ?? false)
                        <a href="{{ $company->twitter }}" target="_blank" rel="noopener" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                            Twitter
                        </a>
                    @endif
                    <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                        </svg>
                        Share
                    </button>
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Company Size</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $company->size ?? 'Not specified' }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Headquarters</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $company->headquarters ?? 'Not specified' }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Active Jobs</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $company->jobs_count ?? 0 }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Employees on JobBoard</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $company->employees_count ?? 0 }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Company Content -->
        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- About Company -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900">About {{ $company->name ?? 'Company' }}</h2>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6 prose max-w-none">
                        @if($company->description ?? false)
                            {!! $company->description !!}
                        @else
                            <p>No company description available.</p>
                        @endif
                    </div>
                </div>

                <!-- Company Culture -->
                @if($company->culture ?? false)
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900">Company Culture</h2>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6 prose max-w-none">
                        {!! $company->culture !!}
                    </div>
                </div>
                @endif

                <!-- Benefits -->
                @if($company->benefits ?? false)
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900">Benefits</h2>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6 prose max-w-none">
                        {!! $company->benefits !!}
                    </div>
                </div>
                @endif

                <!-- Open Positions -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">Open Positions</h2>
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-primary-100 text-primary-800">
                            {{ $company->jobs_count ?? 0 }} jobs
                        </span>
                    </div>
                    <div class="border-t border-gray-200">
                        @if(isset($company->jobs) && count($company->jobs) > 0)
                            <ul role="list" class="divide-y divide-gray-200">
                                @foreach($company->jobs as $job)
                                <li>
                                    <a href="{{ url('/jobs/' . ($job->id ?? 0)) }}" class="block hover:bg-gray-50">
                                        <div class="px-4 py-4 sm:px-6">
                                            <div class="flex items-center justify-between">
                                                <div class="truncate">
                                                    <div class="flex">
                                                        <p class="text-sm font-medium text-primary-600 truncate">{{ $job->title ?? 'Job Title' }}</p>
                                                        <p class="ml-2 flex-shrink-0 text-sm text-gray-500">
                                                            {{ $job->location ?? 'Location' }}
                                                        </p>
                                                    </div>
                                                    <div class="mt-1 flex">
                                                        <p class="flex items-center text-sm text-gray-500">
                                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                            </svg>
                                                            Posted {{ $job->created_at ? $job->created_at->diffForHumans() : 'recently' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="ml-2 flex-shrink-0 flex">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $job->type === 'Full-time' ? 'bg-green-100 text-green-800' : ($job->type === 'Part-time' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                                        {{ $job->type ?? 'Full-time' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @if(count($company->jobs) > 5)
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <a href="{{ url('/jobs?company=' . ($company->id ?? 0)) }}" class="text-sm font-medium text-primary-600 hover:text-primary-500">
                                    View all positions <span aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                            @endif
                        @else
                            <div class="px-4 py-5 sm:px-6 text-center text-sm text-gray-500">
                                No open positions at this time.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Company Photos -->
                @if(isset($company->photos) && count($company->photos) > 0)
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900">Company Photos</h2>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($company->photos as $photo)
                            <div class="aspect-w-16 aspect-h-9 rounded-md overflow-hidden">
                                <img src="{{ $photo }}" alt="Company photo" class="w-full h-full object-cover">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Company Location -->
                @if($company->location ?? false)
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900">Location</h2>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <p class="text-sm text-gray-500">{{ $company->location }}</p>
                        <div class="mt-3 aspect-w-16 aspect-h-9 rounded-md overflow-hidden bg-gray-100">
                            <!-- Map placeholder - in a real app, you would integrate with a maps API -->
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="h-12 w-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Similar Companies -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900">Similar Companies</h2>
                    </div>
                    <div class="border-t border-gray-200">
                        <ul role="list" class="divide-y divide-gray-200">
                            @forelse($similarCompanies ?? [] as $similarCompany)
                            <li>
                                <a href="{{ url('/companies/' . ($similarCompany->id ?? 0)) }}" class="block hover:bg-gray-50">
                                    <div class="px-4 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-100 rounded-md flex items-center justify-center">
                                                @if($similarCompany->logo ?? false)
                                                    <img class="h-8 w-8 rounded-md" src="{{ $similarCompany->logo }}" alt="{{ $similarCompany->name ?? 'Company' }}">
                                                @else
                                                    <span class="text-sm font-medium text-gray-500">{{ substr($similarCompany->name ?? 'C', 0, 1) }}</span>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $similarCompany->name ?? 'Company Name' }}</div>
                                                <div class="text-sm text-gray-500">{{ $similarCompany->industry ?? 'Industry' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @empty
                            <li class="px-4 py-5 sm:px-6 text-center text-sm text-gray-500">
                                No similar companies found.
                            </li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h2 class="text-lg font-medium text-gray-900">Contact Information</h2>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <dl class="divide-y divide-gray-200">
                            @if($company->email ?? false)
                            <div class="py-3 flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="text-sm text-gray-900">{{ $company->email }}</dd>
                            </div>
                            @endif
                            @if($company->phone ?? false)
                            <div class="py-3 flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="text-sm text-gray-900">{{ $company->phone }}</dd>
                            </div>
                            @endif
                            @if($company->website ?? false)
                            <div class="py-3 flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Website</dt>
                                <dd class="text-sm text-primary-600">
                                    <a href="{{ $company->website }}" target="_blank" rel="noopener">{{ $company->website }}</a>
                                </dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection