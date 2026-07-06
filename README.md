# EasyOrder Website
**Project Title: EasyOrder Website (Online Fast Food Ordering System)**

**Course: TWP4213 Internet & Web Publishing**

**Languages: PHP, MySQL, HTML, CSS, JavaScript**

**Environment: XAMPP (Apache and MySQL / MariaDB) with phpMyAdmin**

## How to Run the Program
1. Install XAMPP on your computer.
2. Copy the whole project folder (all `.php` and `.html` files, both `.css` files, and the `image` folder) into the `htdocs` folder of XAMPP. A common path is `C:\xampp\htdocs\easyorder`.
3. Open the **XAMPP Control Panel** by double-clicking its icon.
4. In the XAMPP Control Panel, click **Start** next to **Apache**, then click **Start** next to **MySQL**. Both turn green when they are running.
5. Click the **Admin** button next to MySQL to open phpMyAdmin in your browser. You can also type `http://localhost/phpmyadmin` into the address bar.
6. In phpMyAdmin, create a new database named **easyorder**, open the **Import** tab, choose the `easyorder.sql` file, and click **Go** to import it.
7. Open `dataconnection.php` and make sure it matches your server. By default it uses host `localhost`, user `root`, and an empty password. If your MySQL account has a password, change it here.
8. Open a browser and go to `http://localhost/easyorder/index.html` to run the website.
9. Keep the `image` folder inside the project folder so the logo, banner, product images and photos display correctly.

## Login Accounts

**Admin Login**<br>
(Open the Admin Login page and log in with a Staff ID and password)<br>
Admin ID: S001<br>
Password: admin123

**Customer Login 1**<br>
(Open the Member Login page and log in with an email and password)<br>
Email: meiling@email.com<br>
Password: member123

**Customer Login 2**<br>
Email: faiz@email.com<br>
Password: member123

*Note: All seeded staff accounts (S001 to S004) use the password `admin123`, and all seeded member accounts use the password `member123`. A new customer account can also be created through the Sign Up page.*

## Database Used
The system uses a MySQL database named **easyorder** with the following 8 tables:
1. `category` (product category records)
2. `product` (menu items, including price, stock and status)
3. `staff` (admin and staff account records)
4. `member` (registered customer account records)
5. `orders` (customer order records)
6. `order_items` (individual item lines for each order)
7. `review` (customer comments and ratings)
8. `contact_msg` (messages sent through the Contact Us form)

All pages connect to the database through the shared `dataconnection.php` file. Styling is provided by two external stylesheets, `style.css` for the customer pages and `admin_style.css` for the administrator pages.

## System Modules

**Customer Module:**
1. Home page
2. Customer registration (Sign Up)
3. Customer login
4. View menu (product categories)
5. View product details (Fried Chicken, Burger, Side Dishes, Dessert, Beverage)
6. Add item to cart
7. Shopping cart (update quantity, remove item, clear cart)
8. Checkout and place order (with automatic stock deduction)
9. User dashboard (profile details and order history)
10. Comments and rating
11. About Us
12. Contact Us
13. Logout

<br>

**Admin Module:**
1. Admin login
2. Admin dashboard (live statistics and latest orders)
3. Manage staff (add, edit, delete, view)
4. Manage members (add, edit, delete, view)
5. Manage categories (add, edit, delete, view)
6. Manage products (add, edit, delete, view)
7. Manage orders (view, update order status, delete)
8. Generate sales report (summary, sales by category, best-selling products)
9. Logout
