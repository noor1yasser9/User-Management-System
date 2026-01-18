# SweetAlert Component Usage Guide

## Overview
This is a reusable SweetAlert2 component that provides beautiful, customizable alerts for the application. It supports both Arabic and English languages automatically based on the page locale.

## Installation
The component is already installed and configured. It's automatically available globally as `window.SweetAlert`.

## Available Methods

### 1. Success Alert
Shows a success message with a green checkmark icon.

```javascript
// Basic usage
window.SweetAlert.success('User created successfully!');

// With custom title
window.SweetAlert.success('User created successfully!', 'Success!');
```

**Features:**
- Auto-closes after 3 seconds
- Shows timer progress bar
- Fade in/out animation

---

### 2. Error Alert
Shows an error message with a red X icon.

```javascript
// Basic usage
window.SweetAlert.error('Failed to delete user');

// With custom title
window.SweetAlert.error('Failed to delete user', 'Error!');
```

**Features:**
- Shake animation
- Red color scheme
- Manual close only

---

### 3. Confirmation Dialog
Shows a confirmation dialog with Yes/No buttons.

```javascript
// Basic usage
const result = await window.SweetAlert.confirm('Are you sure you want to proceed?');
if (result.isConfirmed) {
    // User clicked Yes
    console.log('Confirmed!');
}

// With custom title and button texts
const result = await window.SweetAlert.confirm(
    'This action cannot be undone',
    'Are you sure?',
    {
        confirmText: 'Yes, do it',
        cancelText: 'No, cancel'
    }
);
```

**Features:**
- Two buttons (Confirm/Cancel)
- Returns a promise
- RTL support (buttons reversed in Arabic)

---

### 4. Delete Confirmation
Special confirmation dialog for delete operations.

```javascript
// Without item name
const result = await window.SweetAlert.confirmDelete();

// With item name
const result = await window.SweetAlert.confirmDelete('John Doe');

if (result.isConfirmed) {
    // Proceed with deletion
    deleteUser(userId);
}
```

**Features:**
- Pre-configured for delete operations
- Shows item name in message
- Red confirm button
- Warning icon

---

### 5. Info Alert
Shows an informational message with a blue info icon.

```javascript
window.SweetAlert.info('Please check your email for verification link');
```

---

### 6. Warning Alert
Shows a warning message with an orange warning icon.

```javascript
window.SweetAlert.warning('Your session will expire in 5 minutes');
```

---

### 7. Loading Alert
Shows a loading spinner (useful for async operations).

```javascript
// Show loading
window.SweetAlert.loading();

// Or with custom message
window.SweetAlert.loading('Please wait...');

// Do async operation
await someAsyncOperation();

// Close loading
window.SweetAlert.close();
```

**Features:**
- Blocks user interaction
- Shows spinning loader
- No close button

---

## Complete Example: Delete User

```javascript
async function deleteUser(userId, userName) {
    // Show confirmation
    const result = await window.SweetAlert.confirmDelete(userName);
    
    if (!result.isConfirmed) {
        return; // User cancelled
    }
    
    // Show loading
    window.SweetAlert.loading('Deleting user...');
    
    try {
        const response = await fetch(`/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        });
        
        const data = await response.json();
        
        // Close loading
        window.SweetAlert.close();
        
        if (data.success) {
            // Show success
            window.SweetAlert.success(data.message);
            // Refresh list
            loadUsers();
        } else {
            // Show error
            window.SweetAlert.error(data.message);
        }
    } catch (error) {
        window.SweetAlert.close();
        window.SweetAlert.error('An error occurred');
    }
}
```

---

## Language Support

The component automatically detects the page language from `document.documentElement.lang` and shows appropriate messages:

**Arabic (ar):**
- Success: "نجح!"
- Error: "خطأ!"
- Confirm: "هل أنت متأكد؟"
- Yes: "نعم، احذف"
- Cancel: "إلغاء"
- OK: "حسناً"

**English (en):**
- Success: "Success!"
- Error: "Error!"
- Confirm: "Are you sure?"
- Yes: "Yes, delete it"
- Cancel: "Cancel"
- OK: "OK"

---

## Styling

The component uses the following color scheme:
- **Success**: Green (#10b981)
- **Error**: Red (#dc2626)
- **Warning**: Orange (#f59e0b)
- **Info**: Blue (#3b82f6)
- **Primary**: Indigo (#4f46e5)

All colors match the Tailwind CSS theme used in the application.

---

## Notes

1. All methods return a Promise (except `close()`)
2. The component is globally available as `window.SweetAlert`
3. RTL is automatically handled for Arabic
4. Animations are included by default
5. The component is already imported in `app.js`

