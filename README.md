# 👕 Pastimes Clothing Store

## Project Overview

**Pastimes** is a web-based eShop developed to promote sustainable fashion by allowing customers to buy and sell quality pre-owned clothing items. The system provides customer registration, administrator verification, shopping cart functionality, checkout processing, seller request management, and purchase history reporting.

---

## Features

### Customer Features

* User registration and login
* Administrator verification before account access
* Browse available clothing items
* View product images and details
* Add items to the shopping cart
* Remove items from the cart
* Continue shopping
* Checkout and generate order references
* View purchase history with purchase totals
* Submit seller requests to sell clothing

### Administrator Features

* Secure administrator login
* Verify newly registered users
* Add, edit, and delete users
* Add, edit, and delete products
* Manage seller requests
* Approve or reject seller applications

---

## Technologies Used

### Backend

* PHP

### Database

* MySQL
* phpMyAdmin

### Frontend

* HTML5
* CSS3
* JavaScript

### Development Environment

* XAMPP

---

## Database Tables

| Table Name          | Description                     |
| ------------------- | ------------------------------- |
| **tblUser**         | Stores customer information     |
| **tblAdmin**        | Stores administrator accounts   |
| **tblClothes**      | Stores clothing products        |
| **tblAorder**       | Stores order information        |
| **orderLine**       | Stores items within orders      |
| **seller_requests** | Stores customer seller requests |

---

## Installation Instructions

### 1. Install XAMPP

Download and install XAMPP.

### 2. Start Services

Start the following services:

* Apache
* MySQL

### 3. Copy Project Files

Place the **Pastimes** folder inside:

```text
C:\xampp\htdocs\
```

### 4. Create Database

Open **phpMyAdmin** and create a database named:

```sql
ClothingStore
```

### 5. Import Database

Import the provided SQL file:

```text
myClothingStore.sql
```

### 6. Run the Application

Open your browser and navigate to:

```text
http://localhost/Pastimes
```

---

## Sample Login Credentials

### Administrator

| Email                                               | Password  |
| --------------------------------------------------- | --------- |
| [admin@pastimes.co.za](mailto:admin@pastimes.co.za) | admin1234 |

### Customer

Use any verified customer account available in the **tblUser** table.

---

## Additional Features

* Purchase History Report
* Seller Request Management
* User Verification Workflow
* Responsive User Interface

---

## Project Structure

```text
Pastimes/
│
├── index.php
├── login.php
├── register.php
├── products.php
├── cart.php
├── checkout.php
├── purchaseHistory.php
├── sellerRequest.php
├── logout.php
│
├── admin/
│   ├── adminLogin.php
│   ├── adminDashboard.php
│   ├── manageUsers.php
│   ├── manageProducts.php
│   ├── manageSellerRequests.php
│   └── logout.php
│
├── css/
├── js/
├── images/
├── DBConn.php
├── myClothingStore.sql
└── README.md
```

---

## Future Enhancements

* Email-based password reset
* Product search and filtering
* Direct messaging between administrators and sellers
* Image upload functionality
* Online payment gateway integration
* Improved mobile responsiveness

---

## Author

**Prepared as part of the Final Portfolio of Evidence (POE).**

---

## License

This project is intended for **educational purposes only**.
