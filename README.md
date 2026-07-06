# EasyOrder Website
**Project Title: EasyOrder Website (Online Fast Food Ordering System)**

**Course: TWP4213 Internet & Web Publishing**

**Tech Stack: PHP, MySQL, HTML, CSS, JavaScript**

**Environment: XAMPP (Apache and MySQL / MariaDB) with phpMyAdmin**

## How to Run
1. Copy the project folder into `htdocs`, for example `C:\xampp\htdocs\easyorder`. Keep the `image` folder inside it.
2. Open the **XAMPP Control Panel** and **Start** both **Apache** and **MySQL**.
3. Click **Admin** next to MySQL to open phpMyAdmin, create a database named **easyorder**, and import `easyorder.sql`.
4. Check `dataconnection.php` (default: host `localhost`, user `root`, empty password).
5. Open `http://localhost/easyorder/index.html` in a browser.

## Login Accounts
**Admin Login**<br>
Admin ID: S001<br>
Password: admin123

**Customer Login**<br>
Email: meiling@email.com<br>
Password: member123

## Database
MySQL database **easyorder** with 8 tables:
1. `category`
2. `product`
3. `staff`
4. `member`
5. `orders`
6. `order_items`
7. `review`
8. `contact_msg`

## Customer Features
1. Register and login
2. Browse menu by category
3. View product details
4. Add to cart
5. Checkout with automatic stock deduction
6. Dashboard with order history
7. Comments and rating
8. Contact Us
9. Logout

## Admin Features
1. Login and dashboard with live statistics
2. Manage staff (add, edit, delete, view)
3. Manage members (add, edit, delete, view)
4. Manage categories (add, edit, delete, view)
5. Manage products (add, edit, delete, view)
6. Manage orders (update status, delete)
7. Sales report (by category, best-selling products)
8. Logout
