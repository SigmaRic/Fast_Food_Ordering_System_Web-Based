-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 05, 2026 at 05:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easyorder`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` char(5) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_desc` varchar(100) NOT NULL,
  `category_status` varchar(10) NOT NULL,
  `category_isDelete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_desc`, `category_status`, `category_isDelete`) VALUES
('C001', 'Fried Chicken', 'Crispy, juicy and golden fried chicken.', 'Active', 0),
('C002', 'Burger', 'Juicy burgers stacked with fresh ingredients.', 'Active', 0),
('C003', 'Side Dishes', 'The perfect sides to complete your meal.', 'Active', 0),
('C004', 'Dessert', 'Sweet treats to end your meal on a high note.', 'Active', 0),
('C005', 'Beverage', 'Cold drinks to keep you refreshed.', 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_msg`
--

CREATE TABLE `contact_msg` (
  `msg_id` int(11) NOT NULL,
  `msg_name` varchar(100) NOT NULL,
  `msg_email` varchar(100) NOT NULL,
  `msg_subject` varchar(50) NOT NULL,
  `msg_message` text NOT NULL,
  `msg_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact_msg`
--

INSERT INTO `contact_msg` (`msg_id`, `msg_name`, `msg_email`, `msg_subject`, `msg_message`, `msg_date`) VALUES
(1, 'Lim Ah Kao', 'ahkao@email.com', 'General Enquiry', 'Do you provide catering for office events?', '2026-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `member_email` varchar(100) NOT NULL,
  `member_password` varchar(50) NOT NULL,
  `member_phone` varchar(15) NOT NULL,
  `member_gender` varchar(10) NOT NULL,
  `member_dob` date NOT NULL,
  `member_state` varchar(30) NOT NULL,
  `member_city` varchar(50) NOT NULL,
  `member_postcode` char(5) NOT NULL,
  `member_points` int(6) NOT NULL DEFAULT 0,
  `member_joindate` date NOT NULL,
  `member_isDelete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `member_name`, `member_email`, `member_password`, `member_phone`, `member_gender`, `member_dob`, `member_state`, `member_city`, `member_postcode`, `member_points`, `member_joindate`, `member_isDelete`) VALUES
(1, 'Tan Mei Ling', 'meiling@email.com', 'member123', '0123344556', 'Female', '2000-05-12', 'Selangor', 'Shah Alam', '40000', 320, '2026-01-12', 0),
(2, 'Muhammad Faiz', 'faiz@email.com', 'member123', '0198877665', 'Male', '1999-08-03', 'Kuala Lumpur', 'Kuala Lumpur', '50000', 150, '2026-02-03', 0),
(3, 'Priya Devi', 'priya@email.com', 'member123', '0167788990', 'Female', '2001-02-21', 'Johor', 'Johor Bahru', '80000', 80, '2026-02-21', 0),
(4, 'Wong Jia Hui', 'jiahui@email.com', 'member123', '0112233445', 'Female', '2000-03-09', 'Pulau Pinang', 'George Town', '10000', 200, '2026-03-09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_member` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_total` decimal(7,2) NOT NULL,
  `order_payment` varchar(20) NOT NULL,
  `order_delivery` varchar(5) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `order_isDelete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_member`, `order_date`, `order_total`, `order_payment`, `order_delivery`, `order_address`, `order_status`, `order_isDelete`) VALUES
(1, 1, '2026-05-20', 26.20, 'Online Banking', 'No', '', 'Delivered', 0),
(2, 2, '2026-05-21', 23.30, 'Credit Card', 'No', '', 'Preparing', 0),
(3, 3, '2026-05-22', 39.20, 'Cash on Delivery', 'Yes', 'No. 12, Jalan Mawar, Taman Pelangi, Johor Bahru', 'Pending', 0),
(4, 4, '2026-05-22', 18.80, 'E-Wallet', 'No', '', 'Out for Delivery', 0),
(5, 1, '2026-05-23', 32.30, 'Credit Card', 'No', '', 'Cancelled', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `item_order` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_price` decimal(5,2) NOT NULL,
  `item_qty` int(4) NOT NULL,
  `item_subtotal` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `item_order`, `item_name`, `item_price`, `item_qty`, `item_subtotal`) VALUES
(1, 1, 'Original Recipe (1 pc)', 7.90, 2, 15.80),
(2, 1, 'Cheezy Wedges', 6.90, 1, 6.90),
(3, 1, 'Sprite', 3.50, 1, 3.50),
(4, 2, 'Zinger Burger', 13.90, 1, 13.90),
(5, 2, 'French Fries', 5.90, 1, 5.90),
(6, 2, 'Coca-Cola', 3.50, 1, 3.50),
(7, 3, 'Classic Burger', 10.90, 2, 21.80),
(8, 3, 'Onion Rings', 6.50, 1, 6.50),
(9, 3, 'Orange Juice', 5.90, 1, 5.90),
(10, 4, 'Nuggets (6 pcs)', 9.90, 1, 9.90),
(11, 4, 'Cheezy Wedges', 6.90, 1, 6.90),
(12, 4, 'Mineral Water', 2.00, 1, 2.00),
(13, 5, 'Beef Burger', 12.90, 2, 25.80),
(14, 5, 'Iced Latte', 6.50, 1, 6.50);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` char(5) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(50) NOT NULL,
  `product_price` decimal(5,2) NOT NULL,
  `product_stock` int(4) NOT NULL,
  `product_status` varchar(20) NOT NULL,
  `product_isDelete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_category`, `product_price`, `product_stock`, `product_status`, `product_isDelete`) VALUES
('P001', 'Original Recipe (1 pc)', 'Fried Chicken', 7.90, 120, 'Active', 0),
('P002', 'Hot & Spicy (1 pc)', 'Fried Chicken', 8.50, 100, 'Active', 0),
('P003', 'Crispy Tenders (3 pcs)', 'Fried Chicken', 11.90, 80, 'Active', 0),
('P004', 'Nuggets (6 pcs)', 'Fried Chicken', 9.90, 90, 'Active', 0),
('P005', 'Classic Burger', 'Burger', 10.90, 75, 'Active', 0),
('P006', 'Beef Burger', 'Burger', 12.90, 70, 'Active', 0),
('P007', 'Filet-O-Fish', 'Burger', 11.50, 60, 'Active', 0),
('P008', 'Zinger Burger', 'Burger', 13.90, 85, 'Active', 0),
('P009', 'Zinger Double Down', 'Burger', 15.90, 50, 'Active', 0),
('P010', 'French Fries', 'Side Dishes', 5.90, 200, 'Active', 0),
('P011', 'Cheezy Wedges', 'Side Dishes', 6.90, 150, 'Active', 0),
('P012', 'Onion Rings', 'Side Dishes', 6.50, 120, 'Active', 0),
('P013', 'Corn Cup', 'Side Dishes', 4.50, 130, 'Active', 0),
('P014', 'Ice Cream Cone', 'Dessert', 3.90, 110, 'Active', 0),
('P015', 'Chocolate Sundae', 'Dessert', 5.50, 95, 'Active', 0),
('P016', 'Apple Pie', 'Dessert', 4.90, 0, 'Out of Stock', 0),
('P017', 'Coca-Cola', 'Beverage', 3.50, 300, 'Active', 0),
('P018', 'Sprite', 'Beverage', 3.50, 280, 'Active', 0),
('P019', 'Orange Juice', 'Beverage', 5.90, 90, 'Active', 0),
('P020', 'Iced Latte', 'Beverage', 6.50, 85, 'Active', 0),
('P021', 'Mineral Water', 'Beverage', 2.00, 250, 'Active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `review_member` int(11) NOT NULL,
  `review_rating` int(1) NOT NULL,
  `review_comment` text NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `review_member`, `review_rating`, `review_comment`, `review_date`) VALUES
(1, 1, 5, 'The food is fantastic!', '2026-05-21'),
(2, 4, 4, 'Quick delivery and the burgers were still hot.', '2026-05-23');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` char(5) NOT NULL,
  `staff_name` varchar(100) NOT NULL,
  `staff_role` varchar(20) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `staff_phone` varchar(15) NOT NULL,
  `staff_password` varchar(50) NOT NULL,
  `staff_isDelete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_role`, `staff_email`, `staff_phone`, `staff_password`, `staff_isDelete`) VALUES
('S001', 'Andrew Tan Yong Ling', 'Manager', 'andrew@easyorder.com', '0123456789', 'admin123', 0),
('S002', 'Siti Nurhaliza', 'Cashier', 'siti@easyorder.com', '0129876543', 'admin123', 0),
('S003', 'Raj Kumar', 'Chef', 'raj@easyorder.com', '0134567890', 'admin123', 0),
('S004', 'Lim Wei Ming', 'Delivery', 'lim@easyorder.com', '0145678901', 'admin123', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact_msg`
--
ALTER TABLE `contact_msg`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_msg`
--
ALTER TABLE `contact_msg`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
