<?php
//block this page if the admin is not logged in
session_start();
if(!isset($_SESSION["admin_id"]))
{
	header("location:admin_login.php");
	exit();
}
include("dataconnection.php");
?>

<!DOCTYPE html>
<html>

<head><!--Manage order page-->
<title>Manage Orders</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="admin_style.css">

<script type="text/javascript">
function confirmation()//JavaScript confirm box shown before an order record is deleted
{
	let option;
	option=confirm("Are you sure you want to delete this order?");
	return option;
}

function update_status()//Validate the order status form before it is submitted to the server
{
	let status;
	let status_status=false;

	status=document.orderfrm.order_status.value;

	if(status=="0")
	{
		document.getElementById("err_status").innerHTML="Please select an order status";
	}
	else
	{
		document.getElementById("err_status").innerHTML="";
		status_status=true;
	}

	if(status_status==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>

</head>

<body>

<div id="header"><!--Header section for logo, website name and slogan-->
<a href="index.html"><img src="image/logo.png" width="80px" height="80px" alt="EasyOrder Logo" title="EasyOrder Home"></a>
<h1>EasyOrder</h1>
<p>Your Favourite Fast Food, Just A Few Clicks Away</p>
</div>

<div id="admin-navbar"><!--Administrator navigation bar-->
<a href="admin_dashboard.php">Dashboard</a>
<a href="admin_staff.php">Manage Staff</a>
<a href="admin_member.php">Manage Members</a>
<a href="admin_category.php">Manage Categories</a>
<a href="admin_product.php">Manage Products</a>
<a href="admin_report.php">Sales Report</a>
<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
</div>

<div id="main"><!--Main content section-->

<h2 class="section-title">Manage Orders</h2>
<p class="intro">View, update and delete customer orders from this page. Click <b>Update</b> on any row to change an order status, or <b>Delete</b> to remove it.</p>

<h2 class="section-title">Customer Orders</h2>
<table class="manage-table" border="1"><!--Table section for displaying order records (joined with member) from the database-->
<tr>
<th>Order ID</th>
<th>Member</th>
<th>Order Date</th>
<th>Total (RM)</th>
<th>Payment</th>
<th>Status</th>
<th>Actions</th>
</tr>

<?php
//select from 2 tables - match each order to its member to show the member name
$result = mysqli_query($connect,"SELECT * FROM orders,member WHERE order_member=member_id AND order_isDelete=0");

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
<td><?php echo $row['order_id']; ?></td>
<td><?php echo $row['member_name']; ?></td>
<td><?php echo $row['order_date']; ?></td>
<td><?php echo number_format($row['order_total'],2); ?></td>
<td><?php echo $row['order_payment']; ?></td>
<td><?php echo $row['order_status']; ?></td>
<td>
<input type="button" class="update-btn" value="Update" onclick="location='admin_order.php?edit&id=<?php echo $row['order_id']; ?>'">
<input type="button" class="delete-btn" value="Delete" onclick="if(confirmation()==true){location='admin_order.php?del=1&id=<?php echo $row['order_id']; ?>'}">
</td>
</tr>

<?php
}
?>

</table>

<hr>

<?php
//if an Update button was clicked, get the chosen order and fill in the status form below
$oid="";
$ostatus="";
$current_order="No order selected yet. Click <b>Update</b> on an order above.";

if(isset($_GET["edit"]))
{
	$oid = $_GET["id"];
	$result = mysqli_query($connect,"SELECT * FROM orders WHERE order_id='$oid'");
	$row = mysqli_fetch_assoc($result);
	$ostatus = $row["order_status"];
	$current_order="Updating status for Order ".$oid;
}
?>

<h2 class="section-title">Update Order Status</h2>
<p class="intro">Orders are created by customers when they check out, so they cannot be added manually here. Click <b>Update</b> on any order above to change its status.</p>

<div class="manage-form-box"><!--Form section for user input-->
<form name="orderfrm" method="post" action="" onsubmit="return update_status()">
<fieldset>
<legend>Order Status</legend>

<p style="text-align:center; color:#9E0B22; font-weight:bold;"><?php echo $current_order; ?></p>

<label>Order ID</label>
<input type="text" name="order_id" value="<?php echo $oid; ?>" disabled placeholder="Select from table">

<br><br><label>Order Status</label>
<select name="order_status">
<option value="0">Select an order status</option>
<option value="Pending" <?php if($ostatus=="Pending") echo "selected"; ?>>Pending</option>
<option value="Preparing" <?php if($ostatus=="Preparing") echo "selected"; ?>>Preparing</option>
<option value="Ready for Pickup" <?php if($ostatus=="Ready for Pickup") echo "selected"; ?>>Ready for Pickup</option>
<option value="Picked Up" <?php if($ostatus=="Picked Up") echo "selected"; ?>>Picked Up</option>
<option value="Out for Delivery" <?php if($ostatus=="Out for Delivery") echo "selected"; ?>>Out for Delivery</option>
<option value="Delivered" <?php if($ostatus=="Delivered") echo "selected"; ?>>Delivered</option>
<option value="Cancelled" <?php if($ostatus=="Cancelled") echo "selected"; ?>>Cancelled</option>
</select>
<br><span class="error" id="err_status"></span>

<div style="clear:both"></div>

<p style="text-align:center;">
<input type="submit" class="save-btn" id="savebtn" name="savebtn" value="Update Status">
</p>

</fieldset>
</form>
</div>

</div>

<footer><!--Footer section-->
<p>Copyright &copy; 2026 EasyOrder Website. All Rights Reserved.</p>
<p><a href="login.php">User Login</a></p>
</footer>

</body>

</html>

<?php

//update the status of the chosen order (the order id comes from the url)
if(isset($_POST["savebtn"]) && isset($_GET["edit"]))
{
	$oid = $_GET["id"];
	$ostatus = $_POST["order_status"];

	mysqli_query($connect,"UPDATE orders SET order_status='$ostatus' WHERE order_id='$oid'");
	?>
	<script>
	alert("Order status updated!");
	window.location="admin_order.php";
	</script>
	<?php
}

//remove an order from the list (soft delete - set order_isDelete to 1)
if(isset($_GET["del"]))
{
	$oid = $_GET["id"];

	mysqli_query($connect,"UPDATE orders SET order_isDelete=1 WHERE order_id='$oid'");
	?>
	<script>
	alert("Order removed!");
	window.location="admin_order.php";
	</script>
	<?php
}

?>
