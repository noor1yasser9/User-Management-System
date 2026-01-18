@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Language Switcher -->
        <div class="flex justify-center {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} space-x-2">
            <a href="{{ route('login', ['locale' => 'ar']) }}"
               class="px-3 py-1 text-sm font-medium rounded {{ app()->getLocale() === 'ar' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:text-gray-700' }}">
                العربية
            </a>
            <a href="{{ route('login', ['locale' => 'en']) }}"
               class="px-3 py-1 text-sm font-medium rounded {{ app()->getLocale() === 'en' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:text-gray-700' }}">
                English
            </a>
        </div>

        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                {{ trans('messages.login.title') }}
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                {{ trans('messages.login.subtitle') }}
            </p>
        </div>
        
        <div class="mt-8 bg-white py-8 px-4 shadow-lg rounded-lg sm:px-10">
            <!-- Laravel Session Success Message -->
            @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <!-- Error Messages -->
            <div id="error-message" class="hidden mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline" id="error-text"></span>
            </div>

            <!-- Success Messages -->
            <div id="success-message" class="hidden mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline" id="success-text"></span>
            </div>
            
            <form id="login-form" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        {{ trans('messages.login.username_or_email') }}
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="text" autocomplete="username" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="{{ trans('messages.login.username_or_email_placeholder') }}">
                    </div>
                    <p id="email-error" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        {{ trans('messages.login.password') }}
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <p id="password-error" class="mt-1 text-sm text-red-600 hidden"></p>
                </div>

                <div>
                    <button type="submit" id="login-btn"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <span id="btn-text">{{ trans('messages.login.submit') }}</span>
                        <svg id="loading-spinner" class="hidden animate-spin {{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }} h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </form>
            
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">
                            {{ trans('messages.login.demo_credentials') }}
                        </span>
                    </div>
                </div>

                <div class="mt-4 text-sm text-gray-600 bg-gray-50 p-3 rounded-md">
                    <p class="font-semibold mb-2">{{ trans('messages.login.demo_credentials') }}:</p>
                    <p><strong>{{ trans('messages.login.username_or_email') }}:</strong> noor1yasser9@gmail.com</p>
                    <p><strong>{{ trans('messages.login.password') }}:</strong> 123456</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Pass translations to JavaScript
window.loginTranslations = {
    signingIn: '{{ trans("messages.login.signing_in") }}',
    submit: '{{ trans("messages.login.submit") }}',
    error: '{{ trans("messages.login.error") }}'
};

// Pass login route to JavaScript
window.loginRoute = '{{ route("login.attempt", ["locale" => app()->getLocale()]) }}';
</script>
<script src="{{ asset('js/login.js') }}"></script>
@endpush

