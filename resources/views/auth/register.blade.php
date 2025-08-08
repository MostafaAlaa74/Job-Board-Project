@extends('layouts.app')

@section('title', 'Create Account - JobBoard')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <div class="mx-auto h-12 w-12 bg-primary-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">J</span>
                </div>
                <h2 class="mt-6 text-center text-3xl font-bold text-gray-900">
                    Create your account
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Or
                    <a href="{{ route('login') }}"
                        class="font-medium text-primary-600 hover:text-primary-500 transition-colors">
                        sign in to your existing account
                    </a>
                </p>
            </div>

            <form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    <!-- Account Type Selection -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            I want to:
                        </label>
                        <div class="space-y-3">
                            <label
                                class="relative flex items-start p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="role" value="seeker" onclick="toggleFields(false)"
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 mt-1"
                                    {{ old('role', 'seeker') == 'seeker' ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Find a job</div>
                                    <div class="text-sm text-gray-500">Search and apply for job opportunities</div>
                                </div>
                            </label>

                            <label
                                class="relative flex items-start p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="role" value="company" onclick="toggleFields(true)"
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 mt-1"
                                    {{ old('role') == 'company' ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">Hire talent</div>
                                    <div class="text-sm text-gray-500">Post jobs and find qualified candidates</div>
                                </div>
                            </label>
                        </div>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Full Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Full name
                        </label>
                        <input id="name" name="name" type="text" autocomplete="name" required
                            value="{{ old('name') }}"
                            class="appearance-none relative block w-full px-3 py-3 border @error('name') border-red-300 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Enter your full name">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email address
                        </label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            value="{{ old('email') }}"
                            class="appearance-none relative block w-full px-3 py-3 border @error('email') border-red-300 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Enter your email address">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Name (conditional) -->
                    <div id="additionalFields" x-data="{ showCompanyField: {{ old('role') == 'company' ? 'true' : 'false' }} }" x-show="showCompanyField" x-transition>
                        <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Company name
                        </label>
                        <input id="company_name" name="company_name" type="text" value="{{ old('company_name') }}"
                            class="appearance-none relative block w-full px-3 py-3 border @error('company_name') border-red-300 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Enter your company name">
                        @error('company_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="company_website" class="block text-sm font-medium text-gray-700 mb-1">
                            Company website
                        </label>
                        <input id="company_website" name="company_website" type="text" value="{{ old('company_website') }}"
                            class="appearance-none relative block w-full px-3 py-3 border @error('company_website') border-red-300 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Enter your company website">
                        @error('company_website')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <label for="company_location" class="block text-sm font-medium text-gray-700 mb-1">
                            Company Location
                        </label>
                        <input id="company_location" name="company_location" type="text" value="{{ old('company_location') }}"
                            class="appearance-none relative block w-full px-3 py-3 border @error('company_location') border-red-300 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Enter your company location">
                        @error('company_location')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="appearance-none relative block w-full px-3 py-3 border @error('password') border-red-300 @else border-gray-300 @enderror placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Create a password">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Must be at least 8 characters long</p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                            Confirm password
                        </label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            autocomplete="new-password" required
                            class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 focus:z-10 sm:text-sm transition-colors"
                            placeholder="Confirm your password">
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <input id="terms" name="terms" type="checkbox" required
                        class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-1">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        I agree to the
                        <a href="#" class="text-primary-600 hover:text-primary-500">Terms of Service</a>
                        and
                        <a href="#" class="text-primary-600 hover:text-primary-500">Privacy Policy</a>
                    </label>
                </div>
                @error('terms')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-primary-500 group-hover:text-primary-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                </path>
                            </svg>
                        </span>
                        Create account
                    </button>
                </div>

                <!-- Divider -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-50 text-gray-500">Already have an account?</span>
                        </div>
                    </div>
                </div>

                <!-- Sign in link -->
                <div class="mt-6">
                    <a href="{{ route('login') }}"
                        class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                        Sign in instead
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            // Show/hide company name field based on role selection
            // document.addEventListener('DOMContentLoaded', function() {
            //     const roleInputs = document.querySelectorAll('input[name="role"]');
            //     const companyField = document.querySelector('[x-data]');

            //     roleInputs.forEach(input => {
            //         input.addEventListener('change', function() {
            //             if (this.value === 'company') {
            //                 companyField.__x.$data.showCompanyField = true;
            //             } else {
            //                 companyField.__x.$data.showCompanyField = false;
            //             }
            //         });
            //     });
            // });

            function toggleFields(show) {
                const fields = document.getElementById('additionalFields');
                fields.style.display = show ? 'block' : 'none';
            }
        </script>
    @endpush
@endsection
