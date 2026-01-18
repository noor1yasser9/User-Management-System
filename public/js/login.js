/**
 * Login Page JavaScript
 * Handles login form submission with AJAX
 */

// Translations object - will be populated from blade template
const translations = window.loginTranslations || {
    signingIn: 'Signing in...',
    submit: 'Sign in',
    error: 'An error occurred. Please try again.'
};

// Login route - will be set from blade template
const loginRoute = window.loginRoute || '/login';

// Redirect URL - will be set from blade template
const redirectUrl = window.redirectUrl || '/users';

/**
 * Initialize login form handler
 */
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('login-form');
    
    if (!loginForm) {
        console.error('Login form not found');
        return;
    }

    loginForm.addEventListener('submit', handleLoginSubmit);
});

/**
 * Handle login form submission
 */
async function handleLoginSubmit(e) {
    e.preventDefault();

    // Get form elements
    const form = e.target;
    const btn = document.getElementById('login-btn');
    const btnText = document.getElementById('btn-text');
    const spinner = document.getElementById('loading-spinner');
    const errorMessage = document.getElementById('error-message');
    const successMessage = document.getElementById('success-message');
    const errorText = document.getElementById('error-text');
    const successText = document.getElementById('success-text');

    // Clear previous errors
    clearErrors();

    // Show loading state
    setLoadingState(btn, btnText, spinner, true);

    // Get form data
    const formData = new FormData(form);

    try {
        const response = await fetch(loginRoute, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            // Show success message
            successText.textContent = data.message;
            successMessage.classList.remove('hidden');

            // Redirect to users page
            setTimeout(() => {
                window.location.href = data.data.redirect_url || redirectUrl;
            }, 500);
        } else {
            // Show error message
            errorText.textContent = data.message;
            errorMessage.classList.remove('hidden');

            // Show field-specific errors
            if (data.errors) {
                showFieldErrors(data.errors);
            }
        }
    } catch (error) {
        console.error('Login error:', error);
        errorText.textContent = translations.error;
        errorMessage.classList.remove('hidden');
    } finally {
        // Reset button state
        setLoadingState(btn, btnText, spinner, false);
    }
}

/**
 * Clear all error messages
 */
function clearErrors() {
    const errorMessage = document.getElementById('error-message');
    const successMessage = document.getElementById('success-message');
    const emailError = document.getElementById('email-error');
    const passwordError = document.getElementById('password-error');

    if (errorMessage) errorMessage.classList.add('hidden');
    if (successMessage) successMessage.classList.add('hidden');
    if (emailError) emailError.classList.add('hidden');
    if (passwordError) passwordError.classList.add('hidden');
}

/**
 * Show field-specific errors
 */
function showFieldErrors(errors) {
    Object.keys(errors).forEach(key => {
        const errorElement = document.getElementById(key + '-error');
        if (errorElement) {
            errorElement.textContent = errors[key][0];
            errorElement.classList.remove('hidden');
        }
    });
}

/**
 * Set loading state for submit button
 */
function setLoadingState(btn, btnText, spinner, isLoading) {
    if (!btn || !btnText || !spinner) return;

    if (isLoading) {
        btn.disabled = true;
        btnText.textContent = translations.signingIn;
        spinner.classList.remove('hidden');
    } else {
        btn.disabled = false;
        btnText.textContent = translations.submit;
        spinner.classList.add('hidden');
    }
}

