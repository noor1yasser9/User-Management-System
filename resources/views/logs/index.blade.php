@extends('layouts.app')

@section('title', trans('messages.log.title'))

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">
                {{ trans('messages.log.title') }}
            </h1>
            <p class="mt-2 text-gray-600">{{ trans('messages.app.subtitle') }}</p>
        </div>
    </div>



    <!-- Logs Table -->
    <div class="bg-white shadow-lg rounded-xl border border-gray-100">
        <div class="overflow-hidden rounded-t-xl">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-indigo-50 to-purple-50 border-b-2 border-indigo-100">
                            <th class="px-8 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-sm font-bold text-indigo-900 uppercase tracking-wide">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>{{ trans('messages.log.user') }}</span>
                                </div>
                            </th>
                            <th class="px-8 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-sm font-bold text-indigo-900 uppercase tracking-wide">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    <span>{{ trans('messages.log.action') }}</span>
                                </div>
                            </th>
                            <th class="px-8 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-sm font-bold text-indigo-900 uppercase tracking-wide">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span>{{ trans('messages.log.description') }}</span>
                                </div>
                            </th>
                            <th class="px-8 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-sm font-bold text-indigo-900 uppercase tracking-wide">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ trans('messages.log.date') }}</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="logs-table-body" class="bg-white divide-y divide-gray-100">
                        <!-- Loading State -->
                        <tr id="loading-row">
                            <td colspan="4" class="px-8 py-12 text-center">
                                <div class="flex flex-col items-center justify-center gap-3">
                                    <svg class="animate-spin h-10 w-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="text-gray-600 font-medium">{{ trans('messages.log.loading') }}</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Container -->
        <div id="pagination-container" class="relative bg-gray-50 border-t border-gray-200 rounded-b-xl overflow-visible">
            <!-- Pagination will be rendered here by JavaScript -->
        </div>
    </div>
</div>

@push('scripts')
<script>
// Pass routes and locale to JavaScript
window.logsListRoute = '{{ route("logs.list", ["locale" => app()->getLocale()]) }}';
window.locale = '{{ app()->getLocale() }}';
</script>
<script src="{{ asset('js/logs/display.js') }}"></script>
@endpush
@endsection

