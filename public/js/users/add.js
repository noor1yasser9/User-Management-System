/**
 * Add User JavaScript
 * Handles adding new users
 */

/**
 * Open Add Modal
 */
function openAddModal() {
    const modal = document.getElementById('add-modal');
    if (!modal) {
        console.error('Add modal not found');
        return;
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    const form = document.getElementById('add-user-form');
    if (form) {
        form.reset();
    }
    
    clearErrors('add');
}

/**
 * Close Add Modal
 */
function closeAddModal() {
    const modal = document.getElementById('add-modal');
    if (!modal) {
        console.error('Add modal not found');
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
 * Initialize Add User Form
 */
document.addEventListener('DOMContentLoaded', function() {
    const addForm = document.getElementById('add-user-form');
    
    if (!addForm) {
        console.error('Add user form not found');
        return;
    }

    addForm.addEventListener('submit', handleAddUser);
});

/**
 * Handle Add User Form Submit
 */
async function handleAddUser(e) {
    e.preventDefault();
    clearErrors('add');

    const form = e.target;
    const formData = new FormData(form);
    const routes = window.usersRoutes || {};
    const translations = window.usersTranslations || {};

    try {
        const response = await fetch(routes.store, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            closeAddModal();
            showSuccess(data.message);
            
            // Reload users list
            if (typeof loadUsers === 'function') {
                loadUsers();
            }
        } else {
            if (data.errors) {
                showErrors(data.errors, 'add');
            } else {
                showError(data.message);
            }
        }
    } catch (error) {
        console.error('Error adding user:', error);
        showError(translations.errorAdding || 'Error adding user');
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

