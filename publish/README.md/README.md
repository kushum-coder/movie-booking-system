#  Movie Booking System  

## 📌 About My Project  
This is my Movie Booking System developed using **PHP, MySQL, HTML, CSS, JavaScript, and Twig**.  
The main purpose of this system is to allow an **admin** to manage movies, genres, and cast members in an organized way through a web interface.

The system follows a structured approach using MVC-like separation with:
- PHP handling backend logic  
- MySQL as the database  
- Twig as the templating engine  
- AJAX for live search  
- Sessions for authentication  

---

##  Admin Login Credentials (For Evaluation)  

- **Username:** admin  
- **Password:** admin123  

(These are default credentials for checking my project. They can be changed by the server administrator if required.)

---

##  How I Posted the Project on the Student Server  

I uploaded my full project folder to the college student server using SSH/SCP from my local machine with the following command:

// ```bash
scp -r -P 50222 . np03CS4a240219@103.41.173.36:~/public_html/movie-booking-system
 

After uploading, I accessed my application through the student server link which I have submitted separately in my assignment document.

## Database Information

My database SQL file is located at:

movie-booking-system/sql/database.sql


This file contains all required tables for:

movies

genres

cast_members

admin

I executed this file in my college phpMyAdmin under my student database:
np03cs4a240219

## Features I Have Implemented
## Authentication & Security

- Admin login system using PHP sessions

- Logout functionality

- Basic form validation

- CSRF protection in forms

## Movie Management

- Add new movies

- Edit existing movies

- Delete movies

- View all movies in a grid layout

## Genre Management

- Add new genres

- Edit genres

- Delete genres

- Display genre list

## Cast Management

- Add cast members

- Edit cast details

- Delete cast members

- View all cast members

## Live Search (AJAX)

I implemented AJAX-based live search so users can search movies without reloading the page.Search results update dynamically as the user types.

## User Interface

- Clean and simple layout

- Responsive design

- Consistent navigation bar across all pages

## Extra Feature – Twig Templating

I used the Twig templating engine to separate PHP logic from HTML views.All my main layouts and pages use Twig templates, making the code cleaner and more structured.

## Location of my database.sql file and README.md file
- movie-booking-system/sql/database.sql
- movie-booking-system/README.md/README.md

👨‍💻 Submitted By

- Student ID: 2501460
- Name: Kushum Rana
- Group: 12