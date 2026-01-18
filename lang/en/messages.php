<?php

return [
    // Auth messages
    'login' => [
        'title' => 'Sign in to your account',
        'subtitle' => 'User Management System',
        'email' => 'Email address',
        'username_or_email' => 'Username or Email',
        'username_or_email_placeholder' => 'Enter username or email',
        'password' => 'Password',
        'submit' => 'Sign in',
        'signing_in' => 'Signing in...',
        'demo_credentials' => 'Demo Credentials',
        'success' => 'Login successful',
        'user_not_found' => 'User not found',
        'wrong_password' => 'Wrong password',
        'error' => 'An error occurred. Please try again.',
    ],
    
    'logout' => [
        'success' => 'Logged out successfully',
        'button' => 'Logout',
    ],

    'nav' => [
        'users' => 'Users',
        'logs' => 'Logs',
        'signed_in_as' => 'Signed in as',
        'language' => 'Language',
    ],

    'app' => [
        'name' => 'Management System',
        'subtitle' => 'User Management System',
    ],

    // User messages
    'user' => [
        'title' => 'User Management',
        'subtitle' => 'Manage and view all users in the system',
        'list' => 'Users List',
        'add_new' => 'Add New User',
        'edit' => 'Edit User',
        'delete' => 'Delete User',
        'delete_confirm' => 'Are you sure you want to delete this user?',
        'name' => 'Name',
        'username' => 'Username',
        'email' => 'Email',
        'age' => 'Age',
        'password' => 'Password',
        'actions' => 'Actions',
        'save' => 'Save',
        'cancel' => 'Cancel',
        'edit_button' => 'Edit',
        'delete_button' => 'Delete',
        'no_users' => 'No users found',
        'loading' => 'Loading...',
        'created' => 'User created successfully',
        'updated' => 'User updated successfully',
        'deleted' => 'User deleted successfully',
        'not_found' => 'User not found',
        'create_failed' => 'Failed to create user',
        'update_failed' => 'Failed to update user',
        'delete_failed' => 'Failed to delete user',
        'list_retrieved' => 'Users list retrieved successfully',
        'error_loading' => 'Error loading users',
        'error_adding' => 'Error adding user',
        'error_updating' => 'Error updating user',
        'error_deleting' => 'Error deleting user',
        'error_no_user_id' => 'User ID not found',
        'per_page' => 'Per Page:',
    ],
    
    // Log messages
    'log' => [
        'login' => 'User :name logged in',
        'logout' => 'User :name logged out',
        'user_added' => 'User :actor added new user: :target',
        'user_updated' => 'User :actor updated user: :target',
        'user_deleted' => 'User :actor deleted user: :target',
        'title' => 'Activity Logs',
        'user' => 'User',
        'action' => 'Action',
        'description' => 'Description',
        'date' => 'Date',
        'loading' => 'Loading...',
        'no_logs' => 'No logs found',
        'showing' => 'Showing',
        'to' => 'to',
        'of' => 'of',
        'results' => 'results',
    ],
    
    // Validation messages
    'validation' => [
        'email_required' => 'Email is required',
        'email_valid' => 'Email must be a valid email address',
        'email_unique' => 'Email already exists',
        'username_or_email_required' => 'Username or email is required',
        'username_required' => 'Username is required',
        'username_unique' => 'Username already exists',
        'password_required' => 'Password is required',
        'password_min' => 'Password must be at least 6 characters',
        'name_required' => 'Name is required',
        'age_required' => 'Age is required',
        'age_integer' => 'Age must be a number',
        'age_min' => 'Age must be at least 1',
        'age_max' => 'Age must not exceed 150',
    ],
    
    // General messages
    'general' => [
        'validation_error' => 'Validation error',
        'not_found' => 'Item not found',
        'unauthorized' => 'Unauthorized access',
        'forbidden' => 'You do not have permission to perform this action',
        'server_error' => 'Server error occurred',
        'optional' => 'Optional',
    ],
];

