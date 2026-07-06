# EasyOrder Website
**Online Fast Food Ordering System | TWP4213 Internet & Web Publishing**

**Tech Stack: PHP, MySQL, HTML, CSS, JavaScript**

**Environment: XAMPP (Apache and MySQL / MariaDB) with phpMyAdmin**

## How to Run
1. Copy the whole project folder into the `htdocs` folder of XAMPP, for example `C:\xampp\htdocs\easyorder`. Keep the `image` folder inside it.
2. Open the **XAMPP Control Panel** and click **Start** on both **Apache** and **MySQL** (both turn green when running).
3. Click **Admin** next to MySQL to open phpMyAdmin, create a database named **easyorder**, then use the **Import** tab to import `easyorder.sql`.
4. Check that `dataconnection.php` matches your server. By default it uses host `localhost`, user `root`, and an empty password.
5. Open `http://localhost/easyorder/index.html` in a browser to run the website.

## Login Accounts
**Admin** (Admin Login page, uses Staff ID and password)
Admin ID: S001
Password: admin123

**Customer** (Member Login page, uses email and password)
Email: meiling@email.com
Password: member123

## Database
A MySQL database named **easyorder** with 8 tables: `category`, `product`, `staff`, `member`, `orders`, `order_items`, `review`, and `contact_msg`. All pages connect through the shared `dataconnection.php` file, and styling uses two stylesheets, `style.css` for customer pages and `admin_style.css` for admin pages.

## Features
**Customer:** register and login, browse the menu by category, view product details, add to cart, checkout and place orders with automatic stock deduction, view a personal dashboard with order history, leave comments and ratings, and send contact messages.

**Admin:** login to a dashboard with live statistics, full CRUD management of staff, members, categories and products, update or delete customer orders, and generate a sales report with sales by category and best-selling products.
