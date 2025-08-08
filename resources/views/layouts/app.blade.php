<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'JobBoard - Find Your Dream Job')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js for basic interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo and primary navigation -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <a href="{{ route('home') }}" class="flex items-center">
                                <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">J</span>
                                </div>
                                <span class="ml-2 text-xl font-bold text-gray-900">JobBoard</span>
                            </a>
                        </div>

                        <!-- Desktop Navigation -->
                        <div class="hidden md:ml-10 md:flex md:space-x-8">

                            @auth
                                @if (auth()->user()->role === 'seeker' || auth()->user()->role === 'admin')
                                    <a href="{{ route('jobs.index') }}"
                                        class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                        Find Jobs
                                    </a>

                                    <a href="{{ route('application.index') }}"
                                        class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                        My Applications
                                    </a>
                                @endif
                                @if (auth()->user()->role === 'company' || auth()->user()->role === 'admin')
                                    <a href="{{ route('companies.index') }}"
                                        class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                        Companies
                                    </a>
                                    @if (auth()->user()->role === 'company')
                                        <a href="{{ route('jobs.create') }}"
                                            class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                            Post Job
                                        </a>
                                    @endif
                                    @if (auth()->user()->role === 'company')
                                        <a href="{{ route('company.jobs.show', auth()->user()->companies->first()->id) }}"
                                            class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                            My Jobs
                                        </a>
                                    @endif
                                    @if (!auth()->user()->role === 'company')
                                        <a href="{{ route('company.jobs.show', auth()->user()->id) }}"
                                            class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                            My Jobs
                                        </a>
                                    @endif
                                @endif
                                @if (auth()->user()->role === 'admin')
                                    <a href="{{ route('pending.jobs.index') }}"
                                        class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                        Pending Jobs
                                    </a>
                                @endif
                            @endauth

                        </div>
                    </div>

                    <!-- Right side navigation -->
                    <div class="flex items-center space-x-4">
                        @guest
                            <a href="{{ route('login.form') }}"
                                class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                Sign In
                            </a>
                            <a href="{{ route('register.form') }}"
                                class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                Sign Up
                            </a>
                        @else
                            <!-- User dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                        <span
                                            class="text-gray-700 font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <span
                                        class="ml-2 text-gray-700 font-medium hidden sm:block">{{ auth()->user()->name }}</span>
                                    <svg class="ml-1 h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false" x-transition
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                    {{-- <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a> --}}
                                    {{-- <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a> --}}
                                    {{-- @if (auth()->user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Panel</a>
                                    @endif --}}
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Notification Icon -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="relative focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    <svg class="w-6 h-6 text-gray-500 hover:text-primary-600 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    @php $unread = auth()->user()->unreadNotifications->count(); @endphp
                                    @if ($unread > 0)
                                        <span
                                            class="absolute -top-1 -right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-600 rounded-full">{{ $unread }}</span>
                                    @endif
                                </button>
                                <div x-show="open" @click.away="open = false" x-transition
                                    class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-2 z-50 max-h-96 overflow-y-auto">
                                    <h3 class="px-4 py-2 text-sm font-semibold text-gray-700 border-b">Notifications</h3>
                                    <ul class="divide-y divide-gray-100">
                                        @forelse(auth()->user()->notifications->take(10) as $notification)
                                            <li class="px-4 py-3 hover:bg-gray-50 flex items-start">
                                                <div class="flex-1">
                                                    <div class="text-sm text-gray-800">
                                                        {{ $notification->data['message'] ?? $notification->type }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 mt-1">
                                                        {{ $notification->created_at->diffForHumans() }}</div>
                                                </div>
                                                @if ($notification->unread())
                                                    <form method="POST"
                                                        action="{{ route('notification.read', $notification->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="ml-2 text-xs text-primary-600 hover:underline">Mark as
                                                            read</button>
                                                    </form>
                                                @else
                                                    <span class="ml-2 text-xs text-gray-400">Read</span>
                                                @endif
                                            </li>
                                        @empty
                                            <li class="px-4 py-3 text-gray-500 text-sm">No notifications.</li>
                                        @endforelse
                                    </ul>
                                    <div class="px-4 py-2 border-t text-center">
                                        <a href="{{ route('application.index') }}"
                                            class="text-primary-600 hover:underline text-sm">View all notifications</a>
                                    </div>
                                </div>
                            </div>
                        @endauth
                        <!-- End Notification Icon -->

                        <!-- Mobile menu button -->
                        <div class="md:hidden">
                            <button x-data="{ open: false }" @click="open = !open"
                                class="text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile Navigation Menu -->
                <div class="md:hidden" x-data="{ open: false }" x-show="open" x-transition>
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 border-t border-gray-200">
                        <a href="{{ route('jobs.index') }}"
                            class="text-gray-500 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">
                            Find Jobs
                        </a>
                        <a href="{{ route('companies.index') }}"
                            class="text-gray-500 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">
                            Companies
                        </a>
                        @auth
                            @if (auth()->user()->role === 'company' || auth()->user()->role === 'admin')
                                <a href="{{ route('jobs.create') }}"
                                    class="text-gray-500 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">
                                    Post Job
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md mx-4 mt-4"
                role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-md mx-4 mt-4" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Content -->
        <main class="flex-1">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center">
                                <span class="text-white font-bold text-lg">J</span>
                            </div>
                            <span class="ml-2 text-xl font-bold">JobBoard</span>
                        </div>
                        <p class="text-gray-300 mb-4 max-w-md">
                            Connect talented professionals with amazing opportunities. Find your dream job or discover
                            your next great hire.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('jobs.index') }}"
                                    class="text-gray-300 hover:text-white transition-colors">Find Jobs</a></li>
                            <li><a href="{{ route('companies.index') }}"
                                    class="text-gray-300 hover:text-white transition-colors">Browse Companies</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Career
                                    Advice</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Salary
                                    Guide</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Support</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Help
                                    Center</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Contact
                                    Us</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Privacy
                                    Policy</a></li>
                            <li><a href="#" class="text-gray-300 hover:text-white transition-colors">Terms of
                                    Service</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                    <p class="text-gray-400">&copy; {{ date('Y') }} JobBoard. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>

</html>
