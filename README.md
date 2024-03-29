# Bookstore Project
git remote add origin https://github.com/omarStgoalru/Secure-Software.git
## Description
The Bookstore project is an online platform dedicated to literature enthusiasts. It offers a wide range of features aimed at book lovers, including browsing and purchasing books, managing orders, accessing support, and more. The project aims to create a seamless and enjoyable experience for users to explore and engage with their favorite books.

The web application is developed using a secure software development process, written in PHP. It utilizes CSS and JavaScript, and integrates APIs for Google Maps and SMTP protocol for password reset functionalities.

## Installation

1. **Install XAMPP**: Download and install XAMPP from the official website: [XAMPP](https://www.apachefriends.org/index.html).
2. **Start Apache and MySQL Services**: Open the XAMPP Control Panel and start the Apache and MySQL services.
3. **Place Files in the `htdocs` Directory**: Navigate to the `htdocs` directory within the XAMPP installation directory. Place your PHP files and other web files in this directory.
4. **Access PHP Files**: Open a web browser and enter the URL `http://localhost/Bookstore` to access your PHP files.

## Configuration

1. **Database Setup**:
   - Import the provided SQL database file `database/bookstoredatabase.sql` into your MySQL server to set up the database for the Bookstore project. This can be done by accessing phpMyAdmin, selecting the "Import" option, and choosing the SQL file.
   - Configure the database connection in `includes/connection.php`:
     ```php
     define("DB_HOST", "localhost");
     define("DB_NAME", "bookstoredatabase");
     define("DB_USER", "root");
     define("DB_PASS", "");
     ```

2. **Login Credentials**:
   - **Admin**:
     - Email: admin@example.com
     - Password: AdminAdmin2024#
   - **Support**:
     - Email: support@example.com
     - Password: SupportSupport2024#
   - **User**:
     - Users must sign up as the encrypted password is not shared or backed up.

3. **Reset Password**:
   - Utilizes SMTP protocol to send a URL for updating forgotten passwords via Gmail SMTP.

## Usage

1. **User Access**: Users can log in using the provided credentials to browse and purchase books, manage orders, and access support.
2. **Admin Access**: Admins can log in to manage inventory, view orders, and perform administrative tasks.
3. **Support Access**: Support staff can log in to assist users with inquiries, provide assistance, and resolve issues.
