@extends('layouts.app')

@section('title', $job->title ?? 'Job Details')

@section('content')
    <div class="bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Job Header -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-16 w-16 bg-gray-100 rounded-md flex items-center justify-center">
                            @if ($job->company->logo ?? false)
                                <img class="h-12 w-12 rounded-md" src="{{ $job->company->logo }}"
                                    alt="{{ $job->company->name ?? 'Company' }}">
                            @else
                                <span
                                    class="text-xl font-medium text-gray-500">{{ substr($job->company->name ?? 'C', 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $job->title ?? 'Job Title' }}</h1>
                            <div class="mt-1 flex items-center text-sm text-gray-500">
                                <a href="{{ url('/companies/' . ($job->company->id ?? 0)) }}"
                                    class="hover:text-primary-600">{{ $job->company->name ?? 'Company Name' }}</a>
                                <span class="mx-1">&middot;</span>
                                <span>{{ $job->location ?? 'Location' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
                        <span
                            class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium {{ $job->type === 'Full-time' ? 'bg-green-100 text-green-800' : ($job->type === 'Part-time' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                            {{ $job->type ?? 'Full-time' }}
                        </span>
                        @if ($job->remote ?? false)
                            <span
                                class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                Remote
                            </span>
                        @endif
                        <span
                            class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                            Posted {{ $job->created_at ? $job->created_at->diffForHumans() : 'recently' }}
                        </span>
                    </div>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Salary</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if (($job->salary_min ?? false) && ($job->salary_max ?? false))
                                    ${{ number_format($job->salary_min) }} - ${{ number_format($job->salary_max) }}
                                @elseif($job->salary_min ?? false)
                                    From ${{ number_format($job->salary_min) }}
                                @elseif($job->salary_max ?? false)
                                    Up to ${{ number_format($job->salary_max) }}
                                @else
                                    Not specified
                                @endif
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Experience</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($job->experience ?? 'Not specified') }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Department</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $job->department ?? 'Not specified' }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">Applications</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $job->applications_count ?? 0 }} applicants</dd>
                        </div>
                    </dl>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <div class="flex space-x-3">
                        <a href="#apply-now"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Apply Now
                        </a>
                        <form action="{{ url('/jobs/' . ($job->id ?? 0) . '/save') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                                </svg>
                                Save Job
                            </button>
                        </form>
                        <button type="button"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                            </svg>
                            Share
                        </button>
                    </div>
                </div>
            </div>

            <!-- Job Content -->
            <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Job Description -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 class="text-lg font-medium text-gray-900">Job Description</h2>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6 prose max-w-none">
                            {!! $job->description ?? '<p>No description provided.</p>' !!}
                        </div>
                    </div>

                    <!-- Requirements -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 class="text-lg font-medium text-gray-900">Requirements</h2>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6 prose max-w-none">
                            @if ($job->requirements ?? false)
                                {!! $job->requirements !!}
                            @else
                                <ul>
                                    <li>Bachelor's degree in related field</li>
                                    <li>2+ years of experience in similar role</li>
                                    <li>Strong communication skills</li>
                                    <li>Ability to work in a team environment</li>
                                    <li>Problem-solving skills</li>
                                </ul>
                            @endif
                        </div>
                    </div>

                    <!-- Benefits -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 class="text-lg font-medium text-gray-900">Benefits</h2>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6 prose max-w-none">
                            @if ($job->benefits ?? false)
                                {!! $job->benefits !!}
                            @else
                                <ul>
                                    <li>Competitive salary</li>
                                    <li>Health insurance</li>
                                    <li>Retirement plan</li>
                                    <li>Paid time off</li>
                                    <li>Professional development opportunities</li>
                                </ul>
                            @endif
                        </div>
                    </div>

                    <!-- Apply Now Form -->
                    <div id="apply-now" class="bg-white shadow overflow-hidden sm:rounded-lg">
                        @if (auth()->check() && auth()->user()->role === 'company')
                            <div class="px-4 py-5 sm:px-6">
                                <h2 class="text-lg font-medium text-gray-900">Applications Received</h2>
                                <p class="mt-1 text-sm text-gray-500">View all seekers who applied for this job.</p>
                                <a href="{{ route('jobs.applications', $job->id) }}"
                                    class="mt-4 inline-flex items-center px-4 py-2 border border-primary-600 text-sm font-medium rounded-md text-primary-600 bg-white hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    View Applications
                                </a>
                            </div>
                        @else
                            <div class="px-4 py-5 sm:px-6">
                                <h2 class="text-lg font-medium text-gray-900">Apply for this Position</h2>
                                <p class="mt-1 text-sm text-gray-500">Fill out the form below to apply for this job.</p>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                @if (auth()->check())
                                    <form action="{{ route('application.store') }}" method="POST"
                                        enctype="multipart/form-data" class="space-y-6">
                                        @csrf
                                        <input type="hidden" name="job_id" value="{{ $job->id ?? 0 }}">
                                        @if ($errors->any())
                                            <div class="rounded-md bg-red-50 p-4">
                                                <div class="flex">
                                                    <div class="flex-shrink-0">
                                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <div class="ml-3">
                                                        <h3 class="text-sm font-medium text-red-800">There were errors with
                                                            your
                                                            submission</h3>
                                                        <div class="mt-2 text-sm text-red-700">
                                                            <ul class="list-disc pl-5 space-y-1">
                                                                @foreach ($errors->all() as $error)
                                                                    <li>{{ $error }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <!-- ...existing application form fields... -->
                                        <div>
                                            <label for="cover_letter" class="block text-sm font-medium text-gray-700">Cover
                                                Letter</label>
                                            <div class="mt-1">
                                                <textarea id="cover_letter" name="cover_letter" rows="4"
                                                    class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                                                    placeholder="Explain why you're a good fit for this position...">{{ old('cover_letter') }}</textarea>
                                            </div>
                                            <p class="mt-2 text-sm text-gray-500">Brief explanation of why you're
                                                interested
                                                and qualified for this position.</p>
                                        </div>
                                        <div>
                                            <label for="resume"
                                                class="block text-sm font-medium text-gray-700">Resume/CV</label>
                                            <div
                                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                <div class="space-y-1 text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                        fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                        <path
                                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                    <div class="flex text-sm text-gray-600">
                                                        <label for="file-upload"
                                                            class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                                            <span>Upload a file</span>
                                                            <input id="file-upload" name="resume" type="file"
                                                                class="sr-only">
                                                        </label>
                                                        <p class="pl-1">or drag and drop</p>
                                                    </div>
                                                    <p class="text-xs text-gray-500">PDF, DOC, DOCX up to 5MB</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone
                                                Number</label>
                                            <div class="mt-1">
                                                <input type="tel" name="phone" id="phone"
                                                    value="{{ old('phone') }}"
                                                    class="mt-1 block w-full border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2 border"
                                                    placeholder="+1 (555) 123-4567">
                                            </div>
                                        </div>
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="terms" name="terms" type="checkbox"
                                                    class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded">
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="terms" class="font-medium text-gray-700">I agree to the
                                                    terms
                                                    and conditions</label>
                                                <p class="text-gray-500">By applying, you agree to our <a href="#"
                                                        class="text-primary-600 hover:text-primary-500">Privacy Policy</a>
                                                    and
                                                    <a href="#"
                                                        class="text-primary-600 hover:text-primary-500">Terms of
                                                        Service</a>.
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <button type="submit"
                                                class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                Submit Application
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <div class="rounded-md bg-yellow-50 p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <h3 class="text-sm font-medium text-yellow-800">Login Required</h3>
                                                <div class="mt-2 text-sm text-yellow-700">
                                                    <p>You need to be logged in to apply for this job.</p>
                                                </div>
                                                <div class="mt-4">
                                                    <div class="flex space-x-3">
                                                        <a href="{{ route('login') }}"
                                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                            Login
                                                        </a>
                                                        <a href="{{ route('register') }}"
                                                            class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                            Register
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Company Info -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 class="text-lg font-medium text-gray-900">About the Company</h2>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                            <div class="flex items-center">
                                <div
                                    class="flex-shrink-0 h-12 w-12 bg-gray-100 rounded-md flex items-center justify-center">
                                    @if ($job->company->logo ?? false)
                                        <img class="h-10 w-10 rounded-md" src="{{ $job->company->logo }}"
                                            alt="{{ $job->company->name ?? 'Company' }}">
                                    @else
                                        <span
                                            class="text-lg font-medium text-gray-500">{{ substr($job->company->name ?? 'C', 0, 1) }}</span>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">
                                        {{ $job->company->name ?? 'Company Name' }}</h3>
                                    <p class="text-sm text-gray-500">{{ $job->company->industry ?? 'Industry' }}</p>
                                </div>
                            </div>
                            <div class="mt-4 text-sm text-gray-500">
                                <p>{{ $job->company->description ?? 'No company description available.' }}</p>
                            </div>
                            <div class="mt-4">
                                <a href="{{ url('/companies/' . ($job->company->id ?? 0)) }}"
                                    class="text-sm font-medium text-primary-600 hover:text-primary-500">View Company
                                    Profile</a>
                            </div>
                        </div>
                    </div>

                    <!-- Job Details -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 class="text-lg font-medium text-gray-900">Job Details</h2>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                            <dl class="divide-y divide-gray-200">
                                <div class="py-3 flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Job ID</dt>
                                    <dd class="text-sm text-gray-900">{{ $job->id ?? 'JOB-' . rand(1000, 9999) }}</dd>
                                </div>
                                <div class="py-3 flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Posted</dt>
                                    <dd class="text-sm text-gray-900">
                                        {{ $job->created_at ? $job->created_at->format('M d, Y') : date('M d, Y') }}</dd>
                                </div>
                                <div class="py-3 flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Closes</dt>
                                    <dd class="text-sm text-gray-900">
                                        {{ $job->closes_at ? $job->closes_at->format('M d, Y') : date('M d, Y', strtotime('+30 days')) }}
                                    </dd>
                                </div>
                                <div class="py-3 flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Employment Type</dt>
                                    <dd class="text-sm text-gray-900">{{ $job->type ?? 'Full-time' }}</dd>
                                </div>
                                <div class="py-3 flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Location</dt>
                                    <dd class="text-sm text-gray-900">{{ $job->location ?? 'Location' }}</dd>
                                </div>
                                @if ($job->remote ?? false)
                                    <div class="py-3 flex justify-between">
                                        <dt class="text-sm font-medium text-gray-500">Remote Work</dt>
                                        <dd class="text-sm text-gray-900">Available</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <!-- Similar Jobs -->
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <h2 class="text-lg font-medium text-gray-900">Similar Jobs</h2>
                        </div>
                        <div class="border-t border-gray-200">
                            <ul role="list" class="divide-y divide-gray-200">
                                @forelse($similarJobs ?? [] as $similarJob)
                                    <li>
                                        <a href="{{ url('/jobs/' . ($similarJob->id ?? 0)) }}"
                                            class="block hover:bg-gray-50">
                                            <div class="px-4 py-4 sm:px-6">
                                                <div class="flex items-center justify-between">
                                                    <div class="truncate">
                                                        <div class="flex">
                                                            <p class="text-sm font-medium text-primary-600 truncate">
                                                                {{ $similarJob->title ?? 'Job Title' }}</p>
                                                        </div>
                                                        <div class="mt-1 flex">
                                                            <p class="text-sm text-gray-500 truncate">
                                                                {{ $similarJob->company->name ?? 'Company' }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="ml-2 flex-shrink-0 flex">
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $similarJob->type === 'Full-time' ? 'bg-green-100 text-green-800' : ($similarJob->type === 'Part-time' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                                            {{ $similarJob->type ?? 'Full-time' }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="px-4 py-5 sm:px-6 text-center text-sm text-gray-500">
                                        No similar jobs found.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // File upload preview
            const fileUpload = document.getElementById('file-upload');
            if (fileUpload) {
                fileUpload.addEventListener('change', function(e) {
                    const fileName = e.target.files[0].name;
                    const fileSize = (e.target.files[0].size / 1024 / 1024).toFixed(2);
                    const fileInfo = document.createElement('p');
                    fileInfo.classList.add('mt-2', 'text-sm', 'text-gray-600');
                    fileInfo.textContent = `Selected file: ${fileName} (${fileSize} MB)`;

                    // Remove any existing file info
                    const existingFileInfo = this.parentElement.parentElement.parentElement.querySelector(
                        'p.mt-2');
                    if (existingFileInfo && existingFileInfo.textContent.startsWith('Selected file:')) {
                        existingFileInfo.remove();
                    }

                    this.parentElement.parentElement.parentElement.appendChild(fileInfo);
                });
            }
        });
    </script>
@endsection
