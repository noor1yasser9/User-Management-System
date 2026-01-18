/**
 * Delete User JavaScript
 * Handles deleting users
 */

/**
 * Delete User
 */
async function deleteUser(id, userName = null) {
    const routes = window.usersRoutes || {};
    const translations = window.usersTranslations || {};

    if (!id) {
        showError(translations.errorNoUserId || 'User ID not found');
        return;
    }

    // Show confirmation dialog
    if (!window.SweetAlert) {
        const confirmed = confirm(translations.deleteConfirm || 'Are you sure you want to delete this user?');
        if (!confirmed) {
            return;
        }
    } else {
        const result = await window.SweetAlert.confirmDelete(userName);
        if (!result.isConfirmed) {
            return;
        }

        // Show loading
        window.SweetAlert.loading();
    }

    try {
        const response = await fetch(routes.delete.replace(':id', id), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        });

        const data = await response.json();

        // Close loading
        if (window.SweetAlert) {
            window.SweetAlert.close();
        }

        if (data.success) {
            showSuccess(data.message);
            
            // Reload users list
            if (typeof loadUsers === 'function') {
                loadUsers();
            }
        } else {
            showError(data.message);
        }
    } catch (error) {
        console.error('Error deleting user:', error);
        
        // Close loading
        if (window.SweetAlert) {
            window.SweetAlert.close();
        }
        
        showError(translations.errorDeleting || 'Error deleting user');
    }
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

