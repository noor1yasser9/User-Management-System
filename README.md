# User Management System

A complete user management system built with Laravel, featuring authentication, CRUD operations, and activity logging.

## Features

- **Login System**: Secure authentication with username or email
- **User Management**: Add, edit, and delete users with AJAX
- **Activity Logs**: Track all user actions (login, logout, add, edit, delete)
- **Bilingual Support**: Arabic and English interface
- **Real-time Updates**: All operations without page reload

## Requirements

Before you begin, ensure you have the following installed:

- **PHP** >= 8.2
- **Composer** (PHP dependency manager)
- **MySQL** >= 5.7 or MariaDB
- **Node.js** >= 18.x and npm (for frontend assets)
- **Git** (optional, for cloning)

### Check if Composer is installed

```bash
composer --version
```

If not installed, download from: <https://getcomposer.org/download/>

### Check if PHP is installed

```bash
php --version
```

### Check if MySQL is installed

```bash
mysql --version
```

## Installation Steps

### 1. Clone the Project

```bash
git clone https://github.com/noor1yasser9/User-Management-System.git
cd User-Management-System
```

### 2. Install PHP Dependencies

```bash
composer install
```

This will install all Laravel and PHP packages defined in `composer.json`.

### 3. Install Frontend Dependencies

```bash
npm install
```

### 4. Create Environment File

```bash
cp .env.example .env
```

### 5. Configure Database

Open the `.env` file and update the database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=offer_db
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

Replace `your_password_here` with your MySQL root password.

### 6. Create Database

Open MySQL command line or phpMyAdmin and create the database:

```sql
CREATE DATABASE offer_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Or using command line:

```bash
mysql -u root -p -e "CREATE DATABASE offer_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 7. Generate Application Key

```bash
php artisan key:generate
```

### 8. Run Database Migrations

```bash
php artisan migrate
```

This will create all necessary tables (users, logs, migrations, etc.).

### 9. Seed Database with Sample Data (Optional)

```bash
php artisan db:seed
```

This will create a default admin user:

- **Email**: <noor1yasser9@gmail.com>
- **Username**: noor1yasser9
- **Password**: 123456

### 10. Build Frontend Assets

```bash
npm run build
```

For development with hot reload:

```bash
npm run dev
```

### 11. Start the Development Server

```bash
php artisan serve
```

The application will be available at: **<http://127.0.0.1:8000>**

### 12. Access the Application

Open your browser and navigate to:

- **Arabic**: <http://127.0.0.1:8000/ar/login>
- **English**: <http://127.0.0.1:8000/en/login>

**Default Login Credentials:**

- **Username or Email**: <noor1yasser9@gmail.com> or noor1yasser9
- **Password**: 123456

## Project Structure
```
laravel-project/
├── app/
│   ├── Http/Controllers/     # Controllers for handling requests
│   ├── Models/               # Database models (User, Log)
│   ├── Repositories/         # Data access layer
│   └── Services/             # Business logic layer
├── database/
│   └── migrations/           # Database schema migrations
├── public/
│   └── js/                   # JavaScript files (AJAX logic)
├── resources/
│   └── views/                # Blade templates (HTML)
├── routes/
│   └── web.php              # Application routes
└── lang/                     # Translations (ar, en)
```
## Available Routes

### Authentication

- `GET /ar/login` - Arabic login page
- `GET /en/login` - English login page
- `POST /ar/login` - Login authentication
- `POST /ar/logout` - Logout

### Users Management

- `GET /ar/users` - Users list page
- `GET /ar/users/list` - Get users (AJAX)
- `POST /ar/users` - Create user (AJAX)
- `PUT /ar/users/{id}` - Update user (AJAX)
- `DELETE /ar/users/{id}` - Delete user (AJAX)

### Activity Logs

- `GET /ar/logs` - Logs page
- `GET /ar/logs/list` - Get logs (AJAX)

## Troubleshooting

### Issue: "composer: command not found"

**Solution**: Install Composer from <https://getcomposer.org/download/>

### Issue: "SQLSTATE[HY000] [1045] Access denied"

**Solution**: Check your database credentials in `.env` file

### Issue: "Class 'PDO' not found"

**Solution**: Enable PHP PDO extension in `php.ini`:

```ini
extension=pdo_mysql
```

### Issue: Port 8000 already in use

**Solution**: Use a different port:

```bash
php artisan serve --port=8001
```

### Issue: "npm: command not found"

**Solution**: Install Node.js from <https://nodejs.org/>

### Issue: Permission denied on storage/logs

**Solution**: Set proper permissions:

```bash
chmod -R 775 storage bootstrap/cache
```

## Technologies Used

- **Backend**: Laravel 11.x (PHP 8.2)
- **Database**: MySQL 8.0
- **Frontend**: Blade Templates, Tailwind CSS, Vanilla JavaScript
- **AJAX**: Fetch API
- **Authentication**: Laravel built-in Auth
- **Password Hashing**: Bcrypt

## Database Schema

### Users Table

- id, name, username, email, age, password, timestamps

### Logs Table

- id, user_id, action, description, timestamps

## Security Features

- ✅ Password hashing (bcrypt)
- ✅ CSRF protection
- ✅ SQL injection prevention (Eloquent ORM)
- ✅ XSS protection (Blade escaping)
- ✅ Authentication middleware
