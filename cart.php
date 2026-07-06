<?php
//only logged in members can use the cart
session_start();
if(!isset($_SESSION["member_id"]))
{
	header("location:login.php");
	exit();
}
include("dataconnection.php");

//----- cart operations (done before the cart is displayed) -----

//add an item that was chosen from a menu page (increase its quantity by 1)
if(isset($_GET["add"]))
{
	$pid = $_GET["add"];
	if(isset($_SESSION["cart"][$pid]))
	{
		$_SESSION["cart"][$pid] = $_SESSION["cart"][$pid] + 1;
	}
	else
	{
		$_SESSION["cart"][$pid] = 1;
	}
}

//update the quantity of an item
if(isset($_POST["updatebtn"]))
{
	$pid = $_POST["product_id"];
	$qty = $_POST["qty"];
	if($qty<=0)
	{
		unset($_SESSION["cart"][$pid]);
	}
	else
	{
		$_SESSION["cart"][$pid] = $qty;
	}
}

//remove a single item from the cart
if(isset($_GET["remove"]))
{
	$pid = $_GET["remove"];
	unset($_SESSION["cart"][$pid]);
}

//empty the whole cart
if(isset($_GET["clear"]))
{
	unset($_SESSION["cart"]);
}
?>

<!DOCTYPE html>
<html>

<head><!--Shopping cart page-->
<title>Cart</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div id="header"><!--Header section for logo, website name and slogan-->
<a href="index.html"><img src="image/logo.png" width="80px" height="80px" alt="EasyOrder Logo" title="EasyOrder Home"></a>
<h1>EasyOrder</h1>
<p>Your Favourite Fast Food, Just A Few Clicks Away</p>
</div>

<div id="navbar"><!--Customer navigation bar-->
<a href="products.php">Menu</a>
<a href="dashboard.php">My Dashboard</a>
<a href="about.html">About Us</a>
<a href="contact.php">Contact Us</a>
<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
</div>

<div id="main"><!--Main content section-->

<h2 class="section-title">Your Shopping Cart</h2>
<p class="intro">Review the items in your cart below. You can change the quantity or remove items before checking out.</p>

<?php
//show the cart only if it has something in it
if(isset($_SESSION["cart"]) && count($_SESSION["cart"])>0)
{
?>

<table class="menu-table" width="100%" border="1"><!--Table section for displaying the cart items-->
<tr>
<th>Item</th>
<th>Unit Price</th>
<th>Quantity</th>
<th>Subtotal</th>
<th>Action</th>
</tr>

<?php
$cart_total = 0;

//go through every item id stored in the cart
foreach($_SESSION["cart"] as $pid => $qty)
{
	//get the product details from the database
	$result = mysqli_query($connect,"SELECT * FROM product WHERE product_id='$pid'");
	$row = mysqli_fetch_assoc($result);
	$pname = $row["product_name"];
	$pprice = $row["product_price"];
	$subtotal = $pprice * $qty;
	$cart_total = $cart_total + $subtotal;
?>

<tr>
<td><?php echo $pname; ?></td>
<td align="center">RM <?php echo number_format($pprice,2); ?></td>
<td align="center">
<form method="post" action="cart.php" style="display:inline;">
<input type="hidden" name="product_id" value="<?php echo $pid; ?>">
<input type="number" name="qty" class="qty" min="1" max="20" value="<?php echo $qty; ?>">
<input type="submit" name="updatebtn" value="Update">
</form>
</td>
<td align="center">RM <?php echo number_format($subtotal,2); ?></td>
<td align="center"><a class="btn-small" href="cart.php?remove=<?php echo $pid; ?>">Remove</a></td>
</tr>

<?php
}
?>

<tr>
<td colspan="3" align="right"><b>Total</b></td>
<td align="center"><span class="price">RM <?php echo number_format($cart_total,2); ?></span></td>
<td align="center"><a class="btn-small" href="cart.php?clear=1">Clear</a></td>
</tr>

</table>

<p style="text-align:center;"><a class="btn" href="products.php">Continue Shopping</a> &nbsp; <a class="btn" href="checkout.php">Proceed to Checkout</a></p>

<?php
}
else
{
?>

<p class="intro" style="text-align:center;">Your cart is empty. <a href="products.php">Start shopping</a> to add some items.</p>

<?php
}
?>

</div>

<footer><!--Footer section-->
<p>Copyright &copy; 2026 EasyOrder Website. All Rights Reserved.</p>
<p><a href="admin_login.php">Admin Login</a></p>
</footer>

</body>

</html>
