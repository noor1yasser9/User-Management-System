<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', trans('messages.login.subtitle'))</title>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    @auth
    <nav class="bg-white shadow-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo & Navigation Links -->
                <div class="flex {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-8">
                    <!-- Logo/Brand -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <div class="h-10 w-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-md">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900 {{ app()->getLocale() === 'ar' ? 'mr-3' : 'ml-3' }}">
                                {{ trans('messages.app.name') }}
                            </span>
                        </div>
                    </div>

                    <!-- Navigation Links -->
                    <div class="flex {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-1">
                        <a href="{{ route('users.index', ['locale' => app()->getLocale()]) }}"
                           class="inline-flex items-center px-4 py-2 border-b-2 {{ request()->routeIs('users.*') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }} text-sm font-semibold transition-all duration-200">
                            <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                            {{ trans('messages.nav.users') }}
                        </a>
                        <a href="{{ route('logs.index', ['locale' => app()->getLocale()]) }}"
                           class="inline-flex items-center px-4 py-2 border-b-2 {{ request()->routeIs('logs.*') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-600 hover:text-gray-900 hover:border-gray-300' }} text-sm font-semibold transition-all duration-200">
                            <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            {{ trans('messages.nav.logs') }}
                        </a>
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="flex items-center">
                    <div class="relative" x-data="{ open: false }">
                        <!-- Dropdown Button -->
                        <button @click="open = !open" @click.away="open = false"
                                class="flex items-center {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-3 px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <!-- User Avatar -->
                            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <!-- User Name -->
                            <span class="text-sm font-semibold text-gray-700">{{ auth()->user()->name }}</span>
                            <!-- Dropdown Icon -->
                            <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-2 w-56 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                             style="display: none;">
                            <div class="py-2">
                                <!-- User Info Section -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-xs text-gray-500 {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ trans('messages.nav.signed_in_as') }}</p>
                                    <p class="text-sm font-semibold text-gray-900 truncate {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ auth()->user()->email }}</p>
                                </div>

                                <!-- Language Section -->
                                <div class="px-2 py-2">
                                    <p class="px-3 py-1 text-xs font-semibold text-gray-500 uppercase {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">{{ trans('messages.nav.language') }}</p>
                                    <a href="{{ url(str_replace(app()->getLocale(), 'ar', request()->path())) }}"
                                       class="flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }} px-3 py-2 text-sm rounded-lg {{ app()->getLocale() === 'ar' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors duration-150">
                                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                        </svg>
                                        <span class="font-medium">العربية</span>
                                        @if(app()->getLocale() === 'ar')
                                        <svg class="w-4 h-4 {{ app()->getLocale() === 'ar' ? 'mr-auto' : 'ml-auto' }} text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        @endif
                                    </a>
                                    <a href="{{ url(str_replace(app()->getLocale(), 'en', request()->path())) }}"
                                       class="flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }} px-3 py-2 text-sm rounded-lg {{ app()->getLocale() === 'en' ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50' }} transition-colors duration-150">
                                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                        </svg>
                                        <span class="font-medium">English</span>
                                        @if(app()->getLocale() === 'en')
                                        <svg class="w-4 h-4 {{ app()->getLocale() === 'ar' ? 'mr-auto' : 'ml-auto' }} text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        @endif
                                    </a>
                                </div>

                                <!-- Logout Section -->
                                <div class="px-2 py-2 border-t border-gray-100">
                                    <form action="{{ route('logout', ['locale' => app()->getLocale()]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center {{ app()->getLocale() === 'ar' ? 'flex-row-reverse' : '' }} w-full px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-150">
                                            <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                            </svg>
                                            <span class="font-medium">{{ trans('messages.logout.button') }}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <main class="@auth py-10 @endauth">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>

