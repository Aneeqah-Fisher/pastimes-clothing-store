# Pastimes Clothing Store

## Project Overview
Pastimes is a web-based eShop designed to promote sustainable fashion by allowing customers to buy and sell quality pre-owned clothing items. The system includes customer registration, administrator verification, shopping cart functionality, checkout processing, seller requests, and purchase history reporting.

## Features

### Customer Features
- User registration and login
- Administrator verification before login
- Browse available clothing items
- View product images and details
- Add items to cart
- Remove items from cart
- Continue shopping
- Checkout and generate order references
- View purchase history with total purchases
- Submit seller requests to sell clothing

### Administrator Features
- Secure administrator login
- Verify newly registered users
- Add, edit and delete users
- Add, edit and delete products
- Manage seller requests
- Approve or reject seller requests

## Technologies Used
- PHP
- MySQL
- phpMyAdmin
- HTML5
- CSS3
- JavaScript
- XAMPP

## Database Tables
- tblUser
- tblAdmin
- tblClothes
- tblAorder
- orderLine
- seller_requests

## Installation Instructions

1. Install XAMPP.
2. Start Apache and MySQL.
3. Copy the Pastimes folder into:

   ```
   C:\xampp\htdocs\
   ```

4. Open phpMyAdmin.
5. Create the ClothingStore database.
6. Import the provided SQL file:

   ```
   myClothingStore.sql
   ```

7. Open the application:

   ```
   http://localhost/Pastimes
   ```

## Sample Login Credentials

### Administrator
Email:
admin@pastimes.co.za

Password:
admin1234

### Customer
Use any verified customer account from tblUser.

## Additional Features
- Purchase History Report
- Seller Request Management
- User Verification Workflow
- Responsive User Interface

## Future Enhancements
- Email-based password reset
- Direct messaging between administrators and sellers
- Online payment gateway integration

## Author
Prepared as part of the Final Portfolio of Evidence (POE).
