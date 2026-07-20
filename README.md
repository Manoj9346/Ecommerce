# 🛒 Ecommerce Website

A full-stack **E-Commerce Web Application** developed using **PHP, MySQL, HTML, CSS, and JavaScript**. The application provides a seamless shopping experience with user authentication, product management, shopping cart functionality, and an admin dashboard.

---

## 🚀 Features

### 👤 User Features
- User Registration & Login
- Browse Products
- Product Details
- Add to Cart
- Update Cart Quantity
- Remove Items from Cart
- User Profile
- Logout

### 🛠️ Admin Features
- Admin Login
- Dashboard
- Add Products
- Edit Products
- Delete Products
- Manage Products

---

## 🛠️ Tech Stack

| Technology | Usage |
|------------|-------|
| HTML5 | Structure |
| CSS3 | Styling |
| JavaScript | Client-side Interactivity |
| PHP | Backend Development |
| MySQL | Database |
| phpMyAdmin | Database Management |

---

## 📂 Project Structure

```
Ecommerce/
│
├── admin/
│   ├── dashboard.php
│   ├── login.php
│   ├── logout.php
│   ├── add_product.php
│   ├── edit_product.php
│   ├── delete_product.php
│   └── manage_products.php
│
├── css/
│
├── images/
│
├── includes/
│   └── db.php
│
├── pages/
│   ├── login.php
│   ├── logout.php
│   ├── cart.php
│   ├── profile.php
│   └── ...
│
├── index.php
├── README.md
└── database.sql
```

---

## ⚙️ Installation

### 1. Clone Repository

```bash
git clone https://github.com/Manoj9346/Ecommerce.git
```

### 2. Move Project

Copy the project folder into:

```
xampp/htdocs/
```

### 3. Start XAMPP

Start:

- Apache
- MySQL

### 4. Import Database

- Open phpMyAdmin
- Create a new database
- Import the `database.sql` file

### 5. Configure Database

Edit:

```
includes/db.php
```

Example:

```php
$host = "localhost";
$user = "root";
$password = "";
$database = "ecommerce";
```

### 6. Run Project

Open your browser:

```
http://localhost/Ecommerce/
```

---

## 📸 Screenshots

> Add screenshots of:

- Home Page
- Product Listing
- Shopping Cart
- Login Page
- User Profile
- Admin Dashboard

---

## 🎯 Future Enhancements

- Online Payment Gateway
- Wishlist
- Order Tracking
- Product Search
- Product Reviews & Ratings
- Email Notifications
- Responsive Admin Dashboard

---

## 👨‍💻 Developed By

**Manoj Kumar Talari**

- 🎓 B.Tech – Computer Science & Engineering
- 💻 Full Stack Web Development
- 📊 Aspiring Data Analyst

---

## ⭐ If you like this project

Give this repository a ⭐ on GitHub!
