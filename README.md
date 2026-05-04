# Pastimes Clothing Store

## 📌 Project Description

Pastimes is a web-based clothing store that allows users to browse and purchase pre-owned clothing items. The system includes user registration, login authentication, shopping cart functionality, checkout processing, and an admin dashboard for managing users and products.

---

## 🚀 Features

* User registration and login system
* Admin verification of users
* Product browsing with images and details
* Add to cart functionality
* Shopping cart with quantity updates
* Checkout system with order generation
* Admin dashboard for managing users
* Admin product management (Add, Edit, Delete)

---

## 🛠️ Technologies Used

* PHP (Core PHP)
* MySQL (phpMyAdmin)
* HTML5 & CSS3
* XAMPP (Apache Server)

---

## ⚙️ Setup Instructions

1. Install XAMPP
2. Start Apache and MySQL
3. Open phpMyAdmin
4. Create a database named **ClothingStore**
5. Import the provided `ClothingStore.sql` file
6. Copy the project folder into:
   C:\xampp\htdocs\
7. Run the setup script:
   http://localhost/Pastimes/loadClothingStore.php
8. Open the website:
   http://localhost/Pastimes/index.php

---

## 🔑 Test Logins

### Admin Login

Email: [admin@pastimes.co.za](mailto:admin@pastimes.co.za)
Password: admin1234

### User Login

Username: johndoe
Password: password

---

## 🎥 Video Demonstration

(https://youtu.be/GL-MW6gMtvY)

---

## 📂 Project Structure

* index.php (Homepage)
* login.php / register.php (Authentication)
* products.php (Product listing)
* cart.php (Shopping cart)
* checkout.php (Order processing)
* adminDashboard.php (Admin panel)
* manageProducts.php (Product management)
* DBConn.php (Database connection)
* css/style.css (Styling)
* images/ (Product images)

---

## 📌 Notes

* Users must be verified by admin before logging in
* Images must be stored in the images folder
* Database connection uses MySQLi with prepared statements
