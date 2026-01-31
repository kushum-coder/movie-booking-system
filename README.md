# Movie Booking System (Admin Panel)

A full-stack PHP-based Movie Booking and Management System with a secure Admin Panel to manage movies, genres, and cast members.
The system is built using PHP (PDO), MySQL, Twig templates, AJAX, and a professional dark blue/black UI.

---

## Project Overview

This project demonstrates a clean MVC-style folder structure, secure authentication, relational database design using foreign keys, and modern UI rendering using Twig templates. The system allows administrators to manage all movie-related data efficiently while providing live search functionality for fast data retrieval.

It is designed to be run locally using **XAMPP** or any PHP 8+ compatible web server.

---

## Features

### Admin Authentication

* Secure admin login system
* Password hashing using PHP password_hash()
* Session-based authentication
* Logout functionality
* Protected admin routes

### Movie Management

* Add, edit, and delete movies
* Assign genres and cast members using foreign keys
* Manage release year and rating
* Validation on both client and server side

### Genre and Cast Management

* Add, edit, and delete genres
* Add, edit, and delete cast members
* Used as foreign keys in movies table

### Live Search (AJAX)

* Instant search without page reload
* Search by:

  * Movie title
  * Genre
  * Cast
  * Release year
  * Rating

### UI / UX

* Dark blue and black professional theme
* Card-based movie grid layout
* Responsive and clean admin interface
* Twig-based reusable layout system

---

## Folder Structure

```
movie-booking-system/
│
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── main.js
│
├── config/
│   ├── csrf.php
│   └── db.php
│
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── functions.php
│
├── public/
│   ├── admin/
│   │   ├── auth.php
│   │   ├── login.php
│   │   └── logout.php
│   │
│   ├── cast/
│   │   ├── add.php
│   │   ├── edit.php
│   │   ├── delete.php
│   │   └── index.php
│   │
│   ├── genres/
│   │   ├── add.php
│   │   ├── edit.php
│   │   ├── delete.php
│   │   └── index.php
│   │
│   ├── add.php
│   ├── edit.php
│   ├── delete.php
│   ├── index.php
│   ├── search.php
│   └── ajax_search.php
│
├── sql/
│   └── database.sql
│
├── templates/
│   ├── cast/
│   │   ├── form.twig
│   │   └── index.twig
│   │
│   ├── genres/
│   │   ├── form.twig
│   │   └── index.twig
│   │
│   ├── form.twig
│   ├── layout.twig
│   └── movies.twig
│
├── vendor/
│
├── bootstrap.php
├── composer.json
├── composer.lock
├── .gitignore
└── README.md
```

---

## Technologies Used

* **Backend:** PHP 8 (PDO)
* **Frontend:** HTML5, CSS3, JavaScript, Twig Templates
* **Database:** MySQL
* **AJAX:** Live search functionality
* **Security:** Sessions, CSRF protection, Password Hashing
* **Dependency Management:** Composer

---

## Database Design

The database uses relational design with foreign key constraints:

* `movies`

  * id (PK)
  * title
  * release_year
  * rating
  * genre_id (FK)

* `genres`

  * id (PK)
  * name

* `cast`

  * id (PK)
  * name

* `movie_cast` (Pivot Table)

  * movie_id (FK)
  * cast_id (FK)

---

## Installation & Setup

### 1. Clone the Repository

```
git clone https://github.com/your-username/movie-booking-system.git
```

### 2. Move to XAMPP htdocs

Place the project inside:

```
C:/xampp/htdocs/
```

### 3. Install Dependencies

```
composer install
```

### 4. Setup Database

* Open phpMyAdmin
* Create a database (e.g., `movie_booking_system`)
* Import the SQL file from:

```
/sql/database.sql
```

### 5. Configure Database Connection

Edit:

```
/config/db.php
```

Update your database credentials:

```
$host = 'localhost';
$db   = 'movie_booking_system';
$user = 'root';
$pass = '';
```



---

## Security Features

* Password hashing with `password_hash()`
* CSRF token validation
* Prepared statements using PDO
* Session-based route protection

---


---

## Author

**Kushum Rana**
Bachelor’s Student | Web Development & Machine Learning

---

## License

This project is for educational purposes only.
