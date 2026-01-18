/**
 * Edit User JavaScript
 * Handles editing existing users
 */

/**
 * Open Edit Modal
 */
function openEditModal(id, name, username, email, age) {
    const modal = document.getElementById('edit-modal');
    if (!modal) {
        console.error('Edit modal not found');
        return;
    }

    // Set form values
    const idInput = document.getElementById('edit-user-id');
    const nameInput = document.getElementById('edit-name');
    const usernameInput = document.getElementById('edit-username');
    const emailInput = document.getElementById('edit-email');
    const ageInput = document.getElementById('edit-age');
    const passwordInput = document.getElementById('edit-password');

    if (idInput) idInput.value = id;
    if (nameInput) nameInput.value = name;
    if (usernameInput) usernameInput.value = username;
    if (emailInput) emailInput.value = email;
    if (ageInput) ageInput.value = age;
    if (passwordInput) passwordInput.value = '';

    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    clearErrors('edit');
}

/**
 * Close Edit Modal
 */
function closeEditModal() {
    const modal = document.getElementById('edit-modal');
    if (!modal) {
        console.error('Edit modal not found');
        return;
    }

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

/**
 * Clear form errors
 */
function clearErrors(prefix) {
    ['name', 'email', 'age', 'password'].forEach(field => {
        const errorElement = document.getElementById(`${prefix}-${field}-error`);
        if (errorElement) {
            errorElement.classList.add('hidden');
            errorElement.textContent = '';
        }
    });
}

/**
 * Show form errors
 */
function showErrors(errors, prefix) {
    Object.keys(errors).forEach(field => {
        const errorElement = document.getElementById(`${prefix}-${field}-error`);
        if (errorElement) {
            errorElement.textContent = errors[field][0];
            errorElement.classList.remove('hidden');
        }
    });
}

/**
 * Initialize Edit User Form
 */
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('edit-user-form');
    
    if (!editForm) {
        console.error('Edit user form not found');
        return;
    }

    editForm.addEventListener('submit', handleEditUser);
});

/**
 * Handle Edit User Form Submit
 */
async function handleEditUser(e) {
    e.preventDefault();
    clearErrors('edit');

    const form = e.target;
    const userId = document.getElementById('edit-user-id').value;
    const formData = new FormData(form);
    const routes = window.usersRoutes || {};
    const translations = window.usersTranslations || {};

    if (!userId) {
        showError(translations.errorNoUserId || 'User ID not found');
        return;
    }

    // Add _method field for Laravel
    formData.append('_method', 'PUT');

    try {
        const response = await fetch(routes.update.replace(':id', userId), {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            closeEditModal();
            showSuccess(data.message);
            
            // Reload users list
            if (typeof loadUsers === 'function') {
                loadUsers();
            }
        } else {
            if (data.errors) {
                showErrors(data.errors, 'edit');
            } else {
                showError(data.message);
            }
        }
    } catch (error) {
        console.error('Error updating user:', error);
        showError(translations.errorUpdating || 'Error updating user');
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

