Online Registration Management System

A simple PHP-based web application for managing user registrations with admin authentication, CRUD operations, and search functionality.

## 📋 Features

- **Admin Authentication**: Secure login system with session management
- **User Registration**: Add new users with validation
- **CRUD Operations**: Create, Read, Update, and Delete user records
- **Search Functionality**: Search users by name or email
- **Input Validation**: Email, phone number (10 digits), and field validation
- **Session Management**: Automatic logout after inactivity (30 seconds)
- **Responsive Design**: Clean and user-friendly interface

## 🛠️ Requirements

- PHP 7.0 or higher
- MySQL Server
- Apache/XAMPP
- Web Browser

## 🔐 Default Login Credentials

- **Username**: ``
- **Password**: ``


## 📁 File Structure

### Core Application Files

| File | Purpose |
|------|---------|
| `index.php` | Main dashboard - displays all registered users in a table, contains registration form |
| `login.php` | Admin login page with session validation |
| `insert.php` | Handles new user registration form submission and inserts data into database |
| `update.php` | Edit existing user records with form validation |
| `delete.php` | Delete user records from the database |
| `search.php` | Search users by name or email with a user-friendly interface |
| `logout.php` | Ends user session and redirects to login page |
| `session.php` | Manages session lifecycle, login checks, and auto-logout on inactivity |
| `setup_database.php` | Creates database and users table if they don't exist |
| `style.css` | Stylesheet for the entire application |

## 🔄 Workflow

```
User Access
    ↓
login.php (Authentication)
    ↓
index.php (Dashboard)
    ↓
├─→ insert.php (Add New User)
├─→ update.php (Edit User)
├─→ delete.php (Remove User)
├─→ search.php (Find User)
└─→ logout.php (Exit)
```

## 📝 User Data Fields

Each registered user contains:
- **Name** (required, text)
- **Email** (required, valid email format)
- **Phone** (required, exactly 10 digits)
- **Address** (required, text)
- **Course** (required, text)

## 🔒 Security Notes

- Sessions expire after 30 seconds of inactivity
- Input validation on all forms
- SQL escape strings used for data sanitization
- Admin login required for all operations


## 📝 Notes

- The auto-increment ID resets when records are deleted to maintain consistency
- Flash messages display validation errors at the top of the page
- All timestamps are handled by the session management system
