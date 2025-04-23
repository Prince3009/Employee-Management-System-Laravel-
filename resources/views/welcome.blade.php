<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Employee Management System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
            @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="relative">
            <!-- Navigation -->
            <nav class="absolute top-0 left-0 right-0 z-10">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-end h-16">
                    @auth
                            <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                                @csrf
                                <button type="submit" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                                    Logout
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="relative pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
                <div class="relative max-w-7xl mx-auto">
                    <div class="text-center">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                            <span class="block">Employee Management</span>
                            <span class="block text-indigo-600 dark:text-indigo-400">Made Simple</span>
                        </h1>
                        <p class="mt-3 max-w-md mx-auto text-base text-gray-500 dark:text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                            Streamline your workforce management with our comprehensive solution. Manage employees, track performance, and enhance productivity.
                        </p>
                    </div>

                    <!-- Action Cards -->
                    <div class="mt-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-2 lg:max-w-none">
                        <!-- Login Card -->
                        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transform transition duration-500 hover:scale-105">
                            <div class="flex-1 p-6 flex flex-col justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Login</h3>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Access your dashboard</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-200">
                                        Sign In
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Register Card -->
                        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white dark:bg-gray-800 transform transition duration-500 hover:scale-105">
                            <div class="flex-1 p-6 flex flex-col justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Register</h3>
                                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Create new account</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 transition-colors duration-200">
                                        Sign Up
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Features Section -->
                    <div class="mt-20">
                        <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                            <!-- Feature 1 -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform transition duration-500 hover:scale-105">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-indigo-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Employee Management</h3>
                                <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                                    Efficiently manage your workforce with our comprehensive employee management tools.
                                </p>
                            </div>

                            <!-- Feature 2 -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform transition duration-500 hover:scale-105">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-indigo-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Performance Tracking</h3>
                                <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                                    Monitor and analyze employee performance with detailed metrics and reports.
                                </p>
                            </div>

                            <!-- Feature 3 -->
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform transition duration-500 hover:scale-105">
                                <div class="flex items-center justify-center h-12 w-12 rounded-xl bg-indigo-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-lg font-semibold text-gray-900 dark:text-white">Time Management</h3>
                                <p class="mt-2 text-base text-gray-500 dark:text-gray-300">
                                    Track attendance and manage work schedules efficiently.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 dark:text-gray-300 tracking-wider uppercase">
                                About
                            </h3>
                            <p class="mt-4 text-base text-gray-500 dark:text-gray-300">
                                A comprehensive employee management system designed to streamline your workforce operations and enhance productivity.
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 dark:text-gray-300 tracking-wider uppercase">
                                Quick Links
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="{{ route('login') }}" class="text-base text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                                        Login
                                    </a>
                        </li>
                        <li>
                                    <a href="{{ route('register') }}" class="text-base text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors duration-200">
                                        Register
                            </a>
                        </li>
                    </ul>
                </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 dark:text-gray-300 tracking-wider uppercase">
                                Contact
                            </h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <span class="text-base text-gray-500 dark:text-gray-300">
                                        Email: thisisprince@gmail.com
                                    </span>
                                </li>
                                <li>
                                    <span class="text-base text-gray-500 dark:text-gray-300">
                                        Phone: +91 6205014681
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-8">
                        <p class="text-base text-gray-400 dark:text-gray-300 text-center">
                            &copy; {{ date('Y') }} Employee Management System. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
