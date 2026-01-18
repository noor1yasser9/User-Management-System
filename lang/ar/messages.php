<?php

return [
    // Auth messages
    'login' => [
        'title' => 'تسجيل الدخول',
        'subtitle' => 'نظام إدارة المستخدمين',
        'email' => 'البريد الإلكتروني',
        'username_or_email' => 'اسم المستخدم أو البريد الإلكتروني',
        'username_or_email_placeholder' => 'أدخل اسم المستخدم أو البريد الإلكتروني',
        'password' => 'كلمة المرور',
        'submit' => 'تسجيل الدخول',
        'signing_in' => 'جاري تسجيل الدخول...',
        'demo_credentials' => 'بيانات تجريبية',
        'success' => 'تم تسجيل الدخول بنجاح',
        'user_not_found' => 'المستخدم غير موجود',
        'wrong_password' => 'كلمة المرور غير صحيحة',
        'error' => 'حدث خطأ. يرجى المحاولة مرة أخرى.',
    ],
    
    'logout' => [
        'success' => 'تم تسجيل الخروج بنجاح',
        'button' => 'تسجيل الخروج',
    ],

    'nav' => [
        'users' => 'المستخدمين',
        'logs' => 'السجلات',
        'signed_in_as' => 'مسجل الدخول كـ',
        'language' => 'اللغة',
    ],

    'app' => [
        'name' => 'نظام الإدارة',
        'subtitle' => 'نظام إدارة المستخدمين',
    ],

    // User messages
    'user' => [
        'title' => 'إدارة المستخدمين',
        'subtitle' => 'إدارة وعرض جميع المستخدمين في النظام',
        'list' => 'قائمة المستخدمين',
        'add_new' => 'إضافة مستخدم جديد',
        'edit' => 'تعديل المستخدم',
        'delete' => 'حذف المستخدم',
        'delete_confirm' => 'هل أنت متأكد من حذف هذا المستخدم؟',
        'name' => 'الاسم',
        'username' => 'اسم المستخدم',
        'email' => 'البريد الإلكتروني',
        'age' => 'العمر',
        'password' => 'كلمة المرور',
        'actions' => 'الإجراءات',
        'save' => 'حفظ',
        'cancel' => 'إلغاء',
        'edit_button' => 'تعديل',
        'delete_button' => 'حذف',
        'no_users' => 'لا يوجد مستخدمين',
        'loading' => 'جاري التحميل...',
        'created' => 'تم إنشاء المستخدم بنجاح',
        'updated' => 'تم تحديث المستخدم بنجاح',
        'deleted' => 'تم حذف المستخدم بنجاح',
        'not_found' => 'المستخدم غير موجود',
        'create_failed' => 'فشل في إنشاء المستخدم',
        'update_failed' => 'فشل في تحديث المستخدم',
        'delete_failed' => 'فشل في حذف المستخدم',
        'list_retrieved' => 'تم جلب قائمة المستخدمين بنجاح',
        'error_loading' => 'خطأ في تحميل المستخدمين',
        'error_adding' => 'خطأ في إضافة المستخدم',
        'error_updating' => 'خطأ في تحديث المستخدم',
        'error_deleting' => 'خطأ في حذف المستخدم',
        'error_no_user_id' => 'معرف المستخدم غير موجود',
        'per_page' => 'عدد العناصر:',
    ],
    
    // Log messages
    'log' => [
        'login' => 'قام المستخدم :name بتسجيل الدخول',
        'logout' => 'قام المستخدم :name بتسجيل الخروج',
        'user_added' => 'قام المستخدم :actor بإضافة مستخدم جديد: :target',
        'user_updated' => 'قام المستخدم :actor بتعديل المستخدم: :target',
        'user_deleted' => 'قام المستخدم :actor بحذف المستخدم: :target',
        'title' => 'سجل النشاطات',
        'user' => 'المستخدم',
        'action' => 'الإجراء',
        'description' => 'الوصف',
        'date' => 'التاريخ',
        'loading' => 'جاري التحميل...',
        'no_logs' => 'لا توجد سجلات',
        'showing' => 'عرض',
        'to' => 'إلى',
        'of' => 'من',
        'results' => 'نتيجة',
    ],
    
    // Validation messages
    'validation' => [
        'email_required' => 'البريد الإلكتروني مطلوب',
        'email_valid' => 'يجب أن يكون البريد الإلكتروني صحيحاً',
        'email_unique' => 'البريد الإلكتروني موجود مسبقاً',
        'username_or_email_required' => 'اسم المستخدم أو البريد الإلكتروني مطلوب',
        'username_required' => 'اسم المستخدم مطلوب',
        'username_unique' => 'اسم المستخدم موجود مسبقاً',
        'password_required' => 'كلمة المرور مطلوبة',
        'password_min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
        'name_required' => 'الاسم مطلوب',
        'age_required' => 'العمر مطلوب',
        'age_integer' => 'العمر يجب أن يكون رقماً',
        'age_min' => 'العمر يجب أن يكون 1 على الأقل',
        'age_max' => 'العمر يجب ألا يتجاوز 150',
    ],
    
    // General messages
    'general' => [
        'validation_error' => 'خطأ في البيانات المدخلة',
        'not_found' => 'العنصر غير موجود',
        'unauthorized' => 'غير مصرح لك بالوصول',
        'forbidden' => 'ليس لديك صلاحية للقيام بهذا الإجراء',
        'server_error' => 'حدث خطأ في الخادم',
        'optional' => 'اختياري',
    ],
];

