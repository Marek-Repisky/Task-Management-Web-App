# To-Do List Web Application

A simple, responsive web-based to-do list application built with PHP and MySQL. Users can register, log in, and manage their personal to-do lists with full CRUD (Create, Read, Update, Delete) functionality.

## Features

- **User Authentication**: Secure registration and login system with password hashing
- **Personal Lists**: Each user has their own private to-do lists
- **CRUD Operations**: Create, read, update, and delete to-do lists
- **Responsive Design**: Mobile-friendly interface with modern CSS styling
- **Session Management**: Cookie-based authentication for persistent sessions
- **Input Validation**: Server-side validation for all user inputs
- **SQL Injection Protection**: Prepared statements for database security

## Technology Stack

- **Backend**: PHP 7.4+
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Architecture**: Object-oriented PHP with MVC-like structure

## Project Structure

```
├── _inc/                   # Core PHP classes and handlers
│   ├── App.php            # Main application controller
│   ├── Database.php       # Database connection and operations
│   ├── UserAuth.php       # User authentication management
│   ├── ToDoList.php       # To-do list operations
│   ├── deleteTable.php    # Delete list handler
│   ├── insert.php         # Create list handler
│   ├── login.php          # Login handler
│   ├── logout.php         # Logout handler
│   ├── register.php       # Registration handler
│   └── updateTable.php    # Update list handler
├── templates/             # HTML template files
│   ├── Create.php         # Create new list page
│   ├── Read.php           # View all lists page
│   ├── Update.php         # Update existing list page
│   ├── Delete.php         # Delete list page
│   ├── LoginForm.php      # Login form page
│   └── RegisterForm.php   # Registration form page
├── partials/              # Reusable HTML components
│   ├── header.php         # Main navigation header
│   ├── registerHeader.php # Registration page header
│   └── footer.php         # Footer with contact info
├── css/                   # Stylesheets
│   ├── style.css          # Main application styles
│   └── register.css       # Registration/login page styles
├── scripts/               # JavaScript files
│   └── script.js          # Textarea auto-resize functionality
├── config.php             # Database configuration
└── index.php              # Entry point (redirects to login)
```

## Installation

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

### Setup Instructions

1. **Clone or download** the project files to your web server directory

2. **Configure the database** by editing `config.php`:
   ```php
   return [
       'servername' => 'localhost',
       'username' => 'your_db_username',
       'password' => 'your_db_password',
       'dbname' => 'List_Database',
       'tbname' => 'List_Table',
       'tb2name' => 'Users',
   ];
   ```

3. **Set up the web server** to point to the project directory

4. **Access the application** in your browser - the database and tables will be created automatically on first run

### Database Schema

The application automatically creates the following tables:

**Users Table:**
- `id` (Primary Key, Auto Increment)
- `username` (VARCHAR 50)
- `email` (VARCHAR 50)
- `password` (VARCHAR 255, hashed)
- `reg_date` (TIMESTAMP)

**List_Table:**
- `id` (Primary Key, Auto Increment)
- `Title` (VARCHAR 255)
- `Description` (TEXT)
- `ListItem` (TEXT)
- `User_Id` (Foreign Key to Users)
- `reg_date` (TIMESTAMP)

## Usage

### Getting Started

1. **Register**: Visit the application and create a new account
2. **Login**: Use your credentials to access your personal dashboard
3. **Create Lists**: Add new to-do lists with titles, descriptions, and items
4. **Manage Lists**: View, update, or delete your existing lists

### Navigation

- **Create**: Add new to-do lists
- **Read**: View all your existing lists
- **Update**: Modify existing lists by selecting from a dropdown
- **Delete**: Remove lists by selecting from a dropdown
- **Logout**: Sign out of your account (top-right icon)

### Features Detail

- **Auto-expanding textareas**: Text areas automatically resize as you type
- **Dropdown selection**: Update and delete operations use datalist for easy selection
- **Responsive design**: Works on desktop and mobile devices
- **Secure authentication**: Passwords are hashed using PHP's password_hash()
- **Session persistence**: Stay logged in with secure cookies

## Security Features

- **Password Hashing**: Uses PHP's `password_hash()` with bcrypt
- **Prepared Statements**: All database queries use prepared statements
- **Input Validation**: Server-side validation for all user inputs
- **XSS Protection**: HTML special characters are escaped in output
- **Session Security**: Secure cookie-based authentication

## Configuration

### Database Configuration

Edit `config.php` to match your database settings:

```php
return [
    'servername' => 'localhost',     // Database server
    'username' => 'root',            // Database username
    'password' => '',                // Database password
    'dbname' => 'List_Database',     // Database name
    'tbname' => 'List_Table',        // Lists table name
    'tb2name' => 'Users',            // Users table name
];
```

### Customization

- **Styling**: Modify CSS files in the `css/` directory
- **Languages**: The interface is currently in Slovak, but can be translated by updating text in template files
- **Functionality**: Extend the `ToDoList` class to add more features

## Browser Compatibility

- Modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile browsers
- Requires JavaScript enabled for textarea auto-resize

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## Support

For issues or questions:
- Check the code comments for implementation details
- Review the class structure in the `_inc/` directory
- Ensure your PHP and MySQL versions meet the requirements
