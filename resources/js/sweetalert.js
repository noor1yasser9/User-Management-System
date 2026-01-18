import Swal from 'sweetalert2';

/**
 * SweetAlert Component
 * Reusable alert component for the application
 */
const SweetAlertComponent = {
    /**
     * Show success alert
     * @param {string} message - Success message
     * @param {string} title - Alert title (optional)
     */
    success(message, title = null) {
        const locale = document.documentElement.lang || 'ar';
        const defaultTitle = locale === 'ar' ? 'نجح!' : 'Success!';
        
        return Swal.fire({
            icon: 'success',
            title: title || defaultTitle,
            text: message,
            confirmButtonText: locale === 'ar' ? 'حسناً' : 'OK',
            confirmButtonColor: '#4f46e5',
            timer: 3000,
            timerProgressBar: true,
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    },

    /**
     * Show error alert
     * @param {string} message - Error message
     * @param {string} title - Alert title (optional)
     */
    error(message, title = null) {
        const locale = document.documentElement.lang || 'ar';
        const defaultTitle = locale === 'ar' ? 'خطأ!' : 'Error!';
        
        return Swal.fire({
            icon: 'error',
            title: title || defaultTitle,
            text: message,
            confirmButtonText: locale === 'ar' ? 'حسناً' : 'OK',
            confirmButtonColor: '#dc2626',
            showClass: {
                popup: 'animate__animated animate__shakeX'
            }
        });
    },

    /**
     * Show confirmation dialog
     * @param {string} message - Confirmation message
     * @param {string} title - Alert title (optional)
     * @param {object} options - Additional options
     */
    confirm(message, title = null, options = {}) {
        const locale = document.documentElement.lang || 'ar';
        const defaultTitle = locale === 'ar' ? 'هل أنت متأكد؟' : 'Are you sure?';
        
        return Swal.fire({
            icon: 'warning',
            title: title || defaultTitle,
            text: message,
            showCancelButton: true,
            confirmButtonText: options.confirmText || (locale === 'ar' ? 'نعم، احذف' : 'Yes, delete it'),
            cancelButtonText: options.cancelText || (locale === 'ar' ? 'إلغاء' : 'Cancel'),
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6b7280',
            reverseButtons: locale === 'ar',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    },

    /**
     * Show delete confirmation dialog
     * @param {string} itemName - Name of item to delete (optional)
     */
    confirmDelete(itemName = null) {
        const locale = document.documentElement.lang || 'ar';
        const message = itemName 
            ? (locale === 'ar' ? `هل تريد حذف "${itemName}"؟` : `Do you want to delete "${itemName}"?`)
            : (locale === 'ar' ? 'لن تتمكن من التراجع عن هذا!' : 'You won\'t be able to revert this!');
        
        return this.confirm(message, null, {
            confirmText: locale === 'ar' ? 'نعم، احذف' : 'Yes, delete it',
            cancelText: locale === 'ar' ? 'إلغاء' : 'Cancel'
        });
    },

    /**
     * Show info alert
     * @param {string} message - Info message
     * @param {string} title - Alert title (optional)
     */
    info(message, title = null) {
        const locale = document.documentElement.lang || 'ar';
        const defaultTitle = locale === 'ar' ? 'معلومات' : 'Info';
        
        return Swal.fire({
            icon: 'info',
            title: title || defaultTitle,
            text: message,
            confirmButtonText: locale === 'ar' ? 'حسناً' : 'OK',
            confirmButtonColor: '#4f46e5'
        });
    },

    /**
     * Show warning alert
     * @param {string} message - Warning message
     * @param {string} title - Alert title (optional)
     */
    warning(message, title = null) {
        const locale = document.documentElement.lang || 'ar';
        const defaultTitle = locale === 'ar' ? 'تحذير!' : 'Warning!';
        
        return Swal.fire({
            icon: 'warning',
            title: title || defaultTitle,
            text: message,
            confirmButtonText: locale === 'ar' ? 'حسناً' : 'OK',
            confirmButtonColor: '#f59e0b'
        });
    },

    /**
     * Show loading alert
     * @param {string} message - Loading message (optional)
     */
    loading(message = null) {
        const locale = document.documentElement.lang || 'ar';
        const defaultMessage = locale === 'ar' ? 'جاري التحميل...' : 'Loading...';
        
        return Swal.fire({
            title: message || defaultMessage,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
    },

    /**
     * Close any open alert
     */
    close() {
        Swal.close();
    }
};

// Make it available globally
window.SweetAlert = SweetAlertComponent;

export default SweetAlertComponent;

