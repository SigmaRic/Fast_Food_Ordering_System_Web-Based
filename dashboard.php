<?php
//only logged in members can see their dashboard
session_start();
if(!isset($_SESSION["member_id"]))
{
	header("location:login.php");
	exit();
}
include("dataconnection.php");

//get the logged in member's details
$mid = $_SESSION["member_id"];
$result = mysqli_query($connect,"SELECT * FROM member WHERE member_id='$mid'");
$member = mysqli_fetch_assoc($result);

//count how many orders this member has placed
$result = mysqli_query($connect,"SELECT * FROM orders WHERE order_member='$mid' AND order_isDelete=0");
$order_count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>

<head><!--Customer dashboard page after login-->
<title>My Dashboard</title>
<link rel="stylesheet" href="style.css">

<style>
#welcome-box
{background-color:#FFC72C;
color:#9E0B22;
border-radius:8px;
box-shadow:2px 2px 5px #CCCCCC;
padding:18px 25px 18px 25px;
margin-bottom:20px;
text-align:center;}

#welcome-box h3
{font-family:"Arial Black";
letter-spacing:1px;
margin:5px 0px 5px 0px;}

#welcome-box p
{font-style:italic;
margin:0px;}

.account-table
{width:100%;
margin:auto;}

.account-table td
{padding:8px 12px 8px 12px;
border-bottom:1px solid #EEEEEE;}

td.field
{color:#9E0B22;
font-weight:bold;
width:180px;}
</style>

</head>

<body>

<div id="header"><!--Header section for logo, website name and slogan-->
<a href="index.html"><img src="image/logo.png" width="80px" height="80px" alt="EasyOrder Logo" title="EasyOrder Home"></a>
<h1>EasyOrder</h1>
<p>Your Favourite Fast Food, Just A Few Clicks Away</p>
</div>

<div id="navbar"><!--Customer navigation bar-->
<a href="products.php">Menu</a>
<a href="cart.php">Cart</a>
<a href="about.html">About Us</a>
<a href="contact.php">Contact Us</a>
<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
</div>

<div id="main"><!--Main content section-->

<div id="welcome-box">
<h3>Welcome back, <?php echo $member["member_name"]; ?>!</h3>
<p>This is your account dashboard. Here you can view your profile and track your orders.</p>
</div>

<h2 class="section-title">Account Overview</h2>
<table class="menu-table" width="520px" border="1"><!--Table section for displaying account summary-->
<tr>
<th>Total Orders</th>
<th>Loyalty Points</th>
<th>Member Since</th>
</tr>
<tr>
<td align="center"><?php echo $order_count; ?></td>
<td align="center"><?php echo $member["member_points"]; ?></td>
<td align="center"><?php echo $member["member_joindate"]; ?></td>
</tr>
</table>

<hr>

<h2 class="section-title">My Account Details</h2>
<p class="intro">Your saved account information is shown below.</p>

<div class="form-box">
<h3>Profile Information</h3>

<table class="account-table"><!--Table section for displaying profile information-->
<tr>
<td class="field">Full Name</td>
<td><?php echo $member["member_name"]; ?></td>
</tr>
<tr>
<td class="field">Email Address</td>
<td><?php echo $member["member_email"]; ?></td>
</tr>
<tr>
<td class="field">Phone Number</td>
<td><?php echo $member["member_phone"]; ?></td>
</tr>
<tr>
<td class="field">State</td>
<td><?php echo $member["member_state"]; ?></td>
</tr>
<tr>
<td class="field">Member Since</td>
<td><?php echo $member["member_joindate"]; ?></td>
</tr>
</table>

</div>

<hr>

<h2 class="section-title">My Recent Orders</h2>
<p class="intro">A record of your orders with EasyOrder.</p>

<table class="menu-table" width="100%" border="1"><!--Table section for displaying this member's orders-->
<tr>
<th>Order ID</th>
<th>Date</th>
<th>Items</th>
<th>Total</th>
<th>Status</th>
</tr>

<?php
//show this member's orders, newest first
$result = mysqli_query($connect,"SELECT * FROM orders WHERE order_member='$mid' AND order_isDelete=0 ORDER BY order_date DESC");

while($order = mysqli_fetch_assoc($result))
{
	$oid = $order["order_id"];

	//build a list of the items in this order
	$item_result = mysqli_query($connect,"SELECT * FROM order_items WHERE item_order='$oid'");
	$items_text = "";
	while($item = mysqli_fetch_assoc($item_result))
	{
		$items_text = $items_text.$item["item_name"]." x".$item["item_qty"]."  ";
	}
?>

<tr>
<td align="center"><?php echo $oid; ?></td>
<td align="center"><?php echo $order["order_date"]; ?></td>
<td><?php echo $items_text; ?></td>
<td align="center"><span class="price">RM <?php echo number_format($order["order_total"],2); ?></span></td>
<td align="center"><?php echo $order["order_status"]; ?></td>
</tr>

<?php
}
?>

</table>

<hr>

<h2 class="section-title">Quick Links</h2>
<p style="text-align:center;">
<a class="btn" href="products.php">Order</a>
&nbsp;
<a class="btn" href="review.php">Leave a Review</a>
&nbsp;
<a class="btn" href="contact.php">Contact Support</a>
</p>

</div>

<footer><!--Footer section-->
<p>Copyright &copy; 2026 EasyOrder Website. All Rights Reserved.</p>
<p><a href="admin_login.php">Admin Login</a></p>
</footer>

</body>

</html>
