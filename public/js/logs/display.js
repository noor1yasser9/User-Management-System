/**
 * Logs Display JavaScript
 * Handles loading and displaying logs in the table
 */

// Global variables - will be set from blade template
const locale = window.locale || 'en';
const logsListRoute = window.logsListRoute;

// Pagination state
let currentPage = 1;
let perPage = 10;

/**
 * Handle per page change
 */
function handlePerPageChange(value) {
    perPage = parseInt(value);
    currentPage = 1; // Reset to first page
    loadLogs();

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
 * Load logs from the server
 */
function loadLogs(page = currentPage) {
    currentPage = page;

    fetch(`${logsListRoute}?page=${page}&per_page=${perPage}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderLogsTable(data.data.data);
                renderPagination(data.data.pagination);
            }
        })
        .catch(error => {
            console.error('Error loading logs:', error);
        });
}

/**
 * Render logs table
 */
function renderLogsTable(logs) {
    const tableBody = document.getElementById('logs-table-body');

    if (logs.length === 0) {
        tableBody.innerHTML = `
            <tr>
                <td colspan="4" class="px-8 py-12 text-center">
                    <div class="flex flex-col items-center justify-center gap-3">
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-gray-500 text-lg font-medium">${locale === 'ar' ? 'لا توجد سجلات' : 'No logs found'}</p>
                    </div>
                </td>
            </tr>
        `;
        return;
    }

    tableBody.innerHTML = logs.map(log => {
        const date = new Date(log.created_at);
        const formattedDate = date.toLocaleString(locale === 'ar' ? 'ar-EG' : 'en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });

        // Action badge colors
        const actionColors = {
            'login': 'bg-green-100 text-green-800',
            'logout': 'bg-gray-100 text-gray-800',
            'add': 'bg-blue-100 text-blue-800',
            'edit': 'bg-yellow-100 text-yellow-800',
            'delete': 'bg-red-100 text-red-800'
        };

        const actionColor = actionColors[log.action] || 'bg-gray-100 text-gray-800';

        return `
            <tr class="hover:bg-indigo-50 transition-colors duration-150">
                <td class="px-8 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">${log.user ? log.user.name.charAt(0).toUpperCase() : '?'}</span>
                        </div>
                        <div class="${locale === 'ar' ? 'mr-4' : 'ml-4'}">
                            <div class="text-sm font-semibold text-gray-900">${log.user ? log.user.name : (locale === 'ar' ? 'مستخدم محذوف' : 'Deleted User')}</div>
                            <div class="text-sm text-gray-500">${log.user ? log.user.email : '-'}</div>
                        </div>
                    </div>
                </td>
                <td class="px-8 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${actionColor}">
                        ${log.action}
                    </span>
                </td>
                <td class="px-8 py-4">
                    <div class="text-sm text-gray-900">${log.description || '-'}</div>
                </td>
                <td class="px-8 py-4 whitespace-nowrap text-sm text-gray-500">
                    ${formattedDate}
                </td>
            </tr>
        `;
    }).join('');
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
                        onclick="loadLogs(${current_page - 1})"
                        ${current_page === 1 ? 'disabled' : ''}
                        class="relative inline-flex items-center rounded-${isRTL ? 'r' : 'l'}-lg px-3 py-2.5 text-gray-600 bg-white ring-1 ring-inset ring-gray-300 hover:bg-indigo-50 hover:text-indigo-600 focus:z-20 focus:outline-offset-0 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-white disabled:hover:text-gray-600 transition-all duration-200">
                        <span class="sr-only">${isRTL ? 'السابق' : 'Previous'}</span>
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
                                onclick="loadLogs(${pageNum})"
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
                        onclick="loadLogs(${current_page + 1})"
                        ${current_page === last_page ? 'disabled' : ''}
                        class="relative inline-flex items-center rounded-${isRTL ? 'l' : 'r'}-lg px-3 py-2.5 text-gray-600 bg-white ring-1 ring-inset ring-gray-300 hover:bg-indigo-50 hover:text-indigo-600 focus:z-20 focus:outline-offset-0 disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-white disabled:hover:text-gray-600 transition-all duration-200">
                        <span class="sr-only">${isRTL ? 'التالي' : 'Next'}</span>
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

// Load logs when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadLogs();
});

