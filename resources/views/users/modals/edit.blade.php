<!-- Edit User Modal -->
<div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white border border-gray-200 rounded-lg shadow-sm p-4 md:p-6">
            <!-- Modal header -->
            <div class="flex items-center justify-between border-b border-gray-200 pb-4 md:pb-5">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ trans('messages.user.edit') }}
                </h3>
                <button type="button" onclick="closeEditModal()" class="text-gray-500 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-9 h-9 ms-auto inline-flex justify-center items-center">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="space-y-4 md:space-y-6 py-4 md:py-6">
                <form id="edit-user-form">
                    @csrf
                    <input type="hidden" id="edit-user-id">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ trans('messages.user.name') }}</label>
                        <input type="text" id="edit-name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <p class="text-red-600 text-sm mt-1 hidden" id="edit-name-error"></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ trans('messages.user.username') }}</label>
                        <input type="text" id="edit-username" name="username" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <p class="text-red-600 text-sm mt-1 hidden" id="edit-username-error"></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ trans('messages.user.email') }}</label>
                        <input type="email" id="edit-email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <p class="text-red-600 text-sm mt-1 hidden" id="edit-email-error"></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ trans('messages.user.age') }}</label>
                        <input type="number" id="edit-age" name="age" required min="1" max="150" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <p class="text-red-600 text-sm mt-1 hidden" id="edit-age-error"></p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ trans('messages.user.password') }} ({{ trans('messages.general.optional') }})</label>
                        <input type="password" id="edit-password" name="password" minlength="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <p class="text-red-600 text-sm mt-1 hidden" id="edit-password-error"></p>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center justify-end border-t border-gray-200 space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }} pt-4 md:pt-5">
                <button type="button" onclick="closeEditModal()" class="text-gray-700 bg-gray-200 box-border border border-gray-300 hover:bg-gray-300 hover:text-gray-900 focus:ring-4 focus:ring-gray-200 shadow-sm font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                    {{ trans('messages.user.cancel') }}
                </button>
                <button type="submit" form="edit-user-form" class="text-white bg-indigo-600 box-border border border-transparent hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 shadow-sm font-medium leading-5 rounded-lg text-sm px-4 py-2.5 focus:outline-none">
                    {{ trans('messages.user.save') }}
                </button>
            </div>
        </div>
    </div>
</div>

