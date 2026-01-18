/**
 * Users Display JavaScript
 * Handles loading and displaying users in the table
 */

// Global variables - will be set from blade template
const locale = window.usersLocale || 'en';
const translations = window.usersTranslations || {};
const routes = window.usersRoutes || {};

// Pagination state
let currentPage = 1;
let perPage = 10;

/**
 * Handle per page change
 */
function handlePerPageChange(value) {
    perPage = parseInt(value);
    currentPage = 1; // Reset to first page
    loadUsers();

    // Close dropdown
    const dropdown = document.getElementById('per-page-dropdown');
    if (dropdown) {
        dropdown.classList.add('hidden');
    }
}

/**
 * Toggle per page dropdown
 */
function togglePerPageDropdown() {
    const dropdown = document.getElementById('per-page-dropdown');
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

/**
 * Close dropdown when clicking outside
 */
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('per-page-dropdown');
    const trigger = document.getElementById('per-page-trigger');

    if (dropdown && trigger && !trigger.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});

/**
 * Load users on page load
 */
document.addEventListener('DOMContentLoaded', function() {
    loadUsers();
});

/**
 * Load all users from API with pagination
 */
async function loadUsers(page = null) {
    if (page !== null) {
        currentPage = page;
    }

    try {
        const url = new URL(routes.list, window.location.origin);
        url.searchParams.append('per_page', perPage);
        url.searchParams.append('page', currentPage);

        const response = await fetch(url, {
            headers: {
                'Accept': 'application/json',
            }
        });

        const data = await response.json();

        if (data.success) {
            displayUsers(data.data.data);
            renderPagination(data.data);
        } else {
            showError(data.message);
        }
    } catch (error) {
        console.error('Error loading users:', error);
        showError(translations.errorLoading || 'Error loading users');
    }
}

/**
 * Display users in table
 */
function displayUsers(users) {
    const tbody = document.getElementById('users-table-body');

    if (!tbody) {
        console.error('Users table body not found');
        return;
    }

    // Show empty state if no users
    if (users.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="5" class="px-8 py-12 text-center">
                    <div class="flex flex-col items-center justify-center gap-3">
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="text-gray-500 text-lg font-medium">${translations.noUsers || 'No users found'}</span>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    // Display users rows
    tbody.innerHTML = users.map((user, index) => `
        <tr class="hover:bg-indigo-50/50 transition-colors duration-150 ${index % 2 === 0 ? 'bg-white' : 'bg-gray-50/30'}">
            <td class="px-8 py-5 whitespace-nowrap">
                <div class="flex items-center gap-3">
                    <div class="flex-shrink-0 h-11 w-11">
                        <div class="h-11 w-11 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold text-lg shadow-md">
                            ${user.name.charAt(0).toUpperCase()}
                        </div>
                    </div>
                    <div class="${locale === 'ar' ? 'text-right' : 'text-left'}">
                        <div class="text-base font-semibold text-gray-900">${escapeHtml(user.name)}</div>
                    </div>
                </div>
            </td>
            <td class="px-8 py-5 whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">@${escapeHtml(user.username || '')}</span>
                </div>
            </td>
            <td class="px-8 py-5 whitespace-nowrap">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">${escapeHtml(user.email)}</span>
                </div>
            </td>
            <td class="px-8 py-5 whitespace-nowrap">
                <div class="flex items-center ${locale === 'ar' ? 'justify-end' : 'justify-start'}">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-indigo-100 text-indigo-800">
                        ${user.age} ${translations.yearsLabel || (locale === 'ar' ? 'سنة' : 'years')}
                    </span>
                </div>
            </td>
            <td class="px-8 py-5 whitespace-nowrap">
                <div class="flex items-center ${locale === 'ar' ? 'justify-end space-x-reverse' : 'justify-start'} gap-2">
                    <button onclick="openEditModal(${user.id}, '${escapeHtml(user.name).replace(/'/g, "\\'")}', '${escapeHtml(user.username || '').replace(/'/g, "\\'")}', '${escapeHtml(user.email)}', ${user.age})"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200 hover:shadow-md">
                        <svg class="w-4 h-4 ${locale === 'ar' ? 'ml-2' : 'mr-2'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        ${translations.edit || 'Edit'}
                    </button>
                    <button onclick="deleteUser(${user.id}, '${escapeHtml(user.name).replace(/'/g, "\\'")}')"
                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200 hover:shadow-md">
                        <svg class="w-4 h-4 ${locale === 'ar' ? 'ml-2' : 'mr-2'}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        ${translations.delete || 'Delete'}
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

/**
 * Escape HTML to prevent XSS
 */
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

/**
 * Show success message
 */
function showSuccess(message) {
    if (window.SweetAlert) {
        window.SweetAlert.success(message);
    } else {
        alert(message);
    }
}

/**
 * Show error message
 */
function showError(message) {
    if (window.SweetAlert) {
        window.SweetAlert.error(message);
    } else {
        alert(message);
    }
}

/**
 * Render pagination controls
 */
function renderPagination(paginationData) {
    const paginationContainer = document.getElementById('pagination-container');

    if (!paginationContainer) {
        console.error('Pagination container not found');
        return;
    }

    const { current_page, last_page, from, to, total } = paginationData;

    // Always show info and dropdown, but hide pagination buttons if only one page
    const showPaginationButtons = last_page > 1;

    // Generate page numbers to show
    const pageNumbers = generatePageNumbers(current_page, last_page);

    const isRTL = locale === 'ar';
    const perPageLabel = isRTL ? 'عدد العناصر' : 'Items per page';
    const showingText = isRTL
        ? `عرض <span class="font-semibold text-indigo-600">${from || 0}</span> إلى <span class="font-semibold text-indigo-600">${to || 0}</span> من <span class="font-semibold text-indigo-600">${total}</span> نتيجة`
        : `Showing <span class="font-semibold text-indigo-600">${from || 0}</span> to <span class="font-semibold text-indigo-600">${to || 0}</span> of <span class="font-semibold text-indigo-600">${total}</span> results`;

    paginationContainer.innerHTML = `
        <div class="flex items-center justify-between px-6 py-4 flex-wrap gap-4 bg-gradient-to-r from-gray-50 to-gray-100">
            <!-- Pagination buttons - Left side (Right in RTL) -->
            <div class="flex items-center gap-3 order-2 sm:order-1">
                ${showPaginationButtons ? `
                <!-- Pagination buttons -->
                <nav class="isolate inline-flex -space-x-px rounded-lg shadow-sm" aria-label="Pagination">
                    <!-- Previous button -->
                    <button
                        onclick="loadUsers(${current_page - 1})"
                        ${current_page === 1 ? 'disabled' : ''}
                        class="relative inline-flex items-center rounded-${isRTL ? 'r' : 'l'}-lg px-3 py-2.5 text-gray-600 bg-white ring-1 ring-inset ring-gray-300 hover:bg-indigo-50 hover:text-indigo-600 focus:z-20 focus:outline-offset-0 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-white disabled:hover:text-gray-600 transition-all duration-200">
                        <span class="sr-only">${translations.previous || 'Previous'}</span>
                        <svg class="h-5 w-5 ${isRTL ? 'rotate-180' : ''}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Page numbers -->
                    ${pageNumbers.map(pageNum => {
                        if (pageNum === '...') {
                            return `<span class="relative inline-flex items-center px-4 py-2.5 text-sm font-semibold text-gray-700 bg-white ring-1 ring-inset ring-gray-300">...</span>`;
                        }

                        const isActive = pageNum === current_page;
                        return `
                            <button
                                onclick="loadUsers(${pageNum})"
                                class="relative inline-flex items-center px-4 py-2.5 text-sm font-semibold ${
                                    isActive
                                        ? 'z-10 bg-gradient-to-r from-indigo-600 to-purple-600 text-white shadow-md ring-2 ring-indigo-500'
                                        : 'text-gray-700 bg-white ring-1 ring-inset ring-gray-300 hover:bg-indigo-50 hover:text-indigo-600 focus:z-20 focus:outline-offset-0'
                                } transition-all duration-200">
                                ${pageNum}
                            </button>
                        `;
                    }).join('')}

                    <!-- Next button -->
                    <button
                        onclick="loadUsers(${current_page + 1})"
                        ${current_page === last_page ? 'disabled' : ''}
                        class="relative inline-flex items-center rounded-${isRTL ? 'l' : 'r'}-lg px-3 py-2.5 text-gray-600 bg-white ring-1 ring-inset ring-gray-300 hover:bg-indigo-50 hover:text-indigo-600 focus:z-20 focus:outline-offset-0 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-white disabled:hover:text-gray-600 transition-all duration-200">
                        <span class="sr-only">${translations.next || 'Next'}</span>
                        <svg class="h-5 w-5 ${isRTL ? 'rotate-180' : ''}" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </nav>
                ` : ''}
            </div>

            <!-- Info text and Dropdown - Right side (Left in RTL) -->
            <div class="flex items-center gap-4 order-1 sm:order-2">
                <!-- Info text -->
                <div class="hidden sm:block">
                    <p class="text-sm text-gray-700">
                        ${showingText}
                    </p>
                </div>

                <!-- Per Page Dropdown (Custom) -->
                <div class="relative">
                    <div
                        id="per-page-trigger"
                        onclick="togglePerPageDropdown()"
                        class="flex items-center gap-3 bg-white px-4 py-2.5 rounded-lg shadow-sm border border-gray-200 hover:border-indigo-400 hover:shadow-md transition-all duration-200 cursor-pointer group">
                        <span class="text-sm font-medium text-gray-700 whitespace-nowrap group-hover:text-indigo-600 transition-colors">
                            ${perPageLabel}
                        </span>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-bold text-indigo-600 min-w-[1.5rem] text-center">
                                ${perPage}
                            </span>
                            <svg class="w-4 h-4 text-gray-500 group-hover:text-indigo-600 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Dropdown Menu -->
                    <div
                        id="per-page-dropdown"
                        class="hidden absolute ${isRTL ? 'left-0' : 'right-0'} bottom-full mb-2 w-48 bg-white rounded-lg shadow-2xl border border-gray-200 overflow-hidden"
                        style="z-index: 9999;">
                        <div class="py-1">
                            ${[5, 10, 25, 50].map(value => `
                                <button
                                    onclick="handlePerPageChange(${value})"
                                    class="w-full text-${isRTL ? 'right' : 'left'} px-4 py-2.5 text-sm font-medium ${
                                        perPage === value
                                            ? 'bg-gradient-to-r from-indigo-50 to-purple-50 text-indigo-700 border-r-4 border-indigo-600'
                                            : 'text-gray-700 hover:bg-gray-50'
                                    } transition-all duration-150 flex items-center justify-between group">
                                    <span class="flex items-center gap-2">
                                        ${perPage === value ? `
                                            <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        ` : ''}
                                        <span class="font-semibold">${value}</span>
                                        <span class="text-xs text-gray-500">${isRTL ? 'عنصر' : 'items'}</span>
                                    </span>
                                    ${perPage !== value ? `
                                        <svg class="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    ` : ''}
                                </button>
                            `).join('')}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

/**
 * Generate page numbers array for pagination
 */
function generatePageNumbers(currentPage, lastPage) {
    const delta = 2; // Number of pages to show on each side of current page
    const pages = [];

    for (let i = 1; i <= lastPage; i++) {
        if (
            i === 1 || // First page
            i === lastPage || // Last page
            (i >= currentPage - delta && i <= currentPage + delta) // Pages around current
        ) {
            pages.push(i);
        } else if (pages[pages.length - 1] !== '...') {
            pages.push('...');
        }
    }

    return pages;
}

