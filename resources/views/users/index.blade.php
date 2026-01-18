@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ trans('messages.user.title') }}</h1>
            <p class="text-gray-600">{{ trans('messages.user.subtitle') }}</p>
        </div>
        <div class="flex items-center gap-4">
            <!-- Add Button -->
            <button onclick="openAddModal()" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-sm font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                {{ trans('messages.user.add_new') }}
            </button>
        </div>
    </div>



    <!-- Users Table -->
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
                                <span>{{ trans('messages.user.name') }}</span>
                            </div>
                        </th>
                        <th class="px-8 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-sm font-bold text-indigo-900 uppercase tracking-wide">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ trans('messages.user.username') }}</span>
                            </div>
                        </th>
                        <th class="px-8 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-sm font-bold text-indigo-900 uppercase tracking-wide">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ trans('messages.user.email') }}</span>
                            </div>
                        </th>
                        <th class="px-8 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-sm font-bold text-indigo-900 uppercase tracking-wide">
                            <div class="flex items-center {{ app()->getLocale() === 'ar' ? 'justify-end' : 'justify-start' }} gap-2">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ trans('messages.user.age') }}</span>
                            </div>
                        </th>
                        <th class="px-8 py-4 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-sm font-bold text-indigo-900 uppercase tracking-wide">
                            <div class="flex items-center {{ app()->getLocale() === 'ar' ? 'justify-end' : 'justify-start' }} gap-2">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                </svg>
                                <span>{{ trans('messages.user.actions') }}</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="users-table-body" class="bg-white divide-y divide-gray-100">
                    <!-- Loading State -->
                    <tr id="loading-row">
                        <td colspan="5" class="px-8 py-12 text-center">
                            <div class="flex flex-col items-center justify-center gap-3">
                                <svg class="animate-spin h-10 w-10 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span class="text-gray-600 font-medium">{{ trans('messages.user.loading') }}</span>
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

@include('users.modals.add')
@include('users.modals.edit')
@endsection

@push('scripts')
<script>
// Pass locale to JavaScript
window.usersLocale = '{{ app()->getLocale() }}';

// Pass translations to JavaScript
window.usersTranslations = {
    edit: '{{ trans("messages.user.edit_button") }}',
    delete: '{{ trans("messages.user.delete_button") }}',
    deleteConfirm: '{{ trans("messages.user.delete_confirm") }}',
    noUsers: '{{ trans("messages.user.no_users") }}',
    yearsLabel: '{{ app()->getLocale() === "ar" ? "سنة" : "years" }}',
    errorLoading: '{{ trans("messages.user.error_loading") }}',
    errorAdding: '{{ trans("messages.user.error_adding") }}',
    errorUpdating: '{{ trans("messages.user.error_updating") }}',
    showing: '{{ app()->getLocale() === "ar" ? "عرض" : "Showing" }}',
    to: '{{ app()->getLocale() === "ar" ? "إلى" : "to" }}',
    of: '{{ app()->getLocale() === "ar" ? "من" : "of" }}',
    results: '{{ app()->getLocale() === "ar" ? "نتيجة" : "results" }}',
    previous: '{{ app()->getLocale() === "ar" ? "السابق" : "Previous" }}',
    next: '{{ app()->getLocale() === "ar" ? "التالي" : "Next" }}',
    errorDeleting: '{{ trans("messages.user.error_deleting") }}',
    errorNoUserId: '{{ trans("messages.user.error_no_user_id") }}'
};

// Pass routes to JavaScript
window.usersRoutes = {
    list: '{{ route("users.list", ["locale" => app()->getLocale()]) }}',
    store: '{{ route("users.store", ["locale" => app()->getLocale()]) }}',
    update: '{{ url(app()->getLocale() . "/users") }}/:id',
    delete: '{{ url(app()->getLocale() . "/users") }}/:id'
};
</script>

<!-- Include Users JavaScript Files -->
<script src="{{ asset('js/users/display.js') }}"></script>
<script src="{{ asset('js/users/add.js') }}"></script>
<script src="{{ asset('js/users/edit.js') }}"></script>
<script src="{{ asset('js/users/delete.js') }}"></script>
@endpush

