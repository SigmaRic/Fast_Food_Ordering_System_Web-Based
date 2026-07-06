<?php
//only logged in members can check out
session_start();
if(!isset($_SESSION["member_id"]))
{
	header("location:login.php");
	exit();
}
include("dataconnection.php");

//work out the cart subtotal (used for the display and the JavaScript total)
$subtotal = 0;
if(isset($_SESSION["cart"]))
{
	foreach($_SESSION["cart"] as $pid => $qty)
	{
		$result = mysqli_query($connect,"SELECT * FROM product WHERE product_id='$pid'");
		$row = mysqli_fetch_assoc($result);
		$subtotal = $subtotal + ($row["product_price"] * $qty);
	}
}
?>

<!DOCTYPE html>
<html>

<head><!--Checkout and payment page-->
<title>Checkout</title>
<link rel="stylesheet" href="style.css">

<script>
let subtotal=<?php echo $subtotal; ?>;//cart subtotal passed in from PHP

function toggle_delivery()//show or hide the address box and update the order total
{
	let total=subtotal;

	if(document.checkoutfrm.delivery.checked)
	{
		document.getElementById("delivery_area").innerHTML="<p>Delivery Address:<br><textarea name='cust_address' rows='3' cols='50'></textarea></p>";
		total=subtotal+5.00;
	}
	else
	{
		document.getElementById("delivery_area").innerHTML="";
		total=subtotal;
	}

	document.getElementById("order_total").innerHTML="RM "+total.toFixed(2);
}

function place_order()//check the payment and address before submitting
{
	let payment="";
	let i;

	for(i=0;i<document.checkoutfrm.payment.length;i++)
	{
		if(document.checkoutfrm.payment[i].checked)
		{
			payment=document.checkoutfrm.payment[i].value;
		}
	}

	if(payment=="")
	{
		document.getElementById("msg").innerHTML="Please select a payment method.";
		return false;
	}
	else if(document.checkoutfrm.delivery.checked&&document.checkoutfrm.cust_address.value=="")
	{
		document.getElementById("msg").innerHTML="Please enter your delivery address.";
		return false;
	}
	else
	{
		return true;
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

<div id="navbar"><!--Customer navigation bar-->
<a href="products.php">Menu</a>
<a href="cart.php">Cart</a>
<a href="dashboard.php">My Dashboard</a>
<a href="about.html">About Us</a>
<a href="contact.php">Contact Us</a>
<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
</div>

<div id="main"><!--Main content section-->

<h2 class="section-title">Checkout</h2>
<p class="intro">Please confirm your order, delivery and payment details to complete your order.</p>

<?php
//only show the checkout form if there is something in the cart
if(isset($_SESSION["cart"]) && count($_SESSION["cart"])>0)
{
?>

<table class="menu-table" width="100%" border="1"><!--Order summary-->
<tr>
<th>Item</th>
<th>Unit Price</th>
<th>Quantity</th>
<th>Subtotal</th>
</tr>

<?php
foreach($_SESSION["cart"] as $pid => $qty)
{
	$result = mysqli_query($connect,"SELECT * FROM product WHERE product_id='$pid'");
	$row = mysqli_fetch_assoc($result);
	$pname = $row["product_name"];
	$pprice = $row["product_price"];
	$sub = $pprice * $qty;
?>

<tr>
<td><?php echo $pname; ?></td>
<td align="center">RM <?php echo number_format($pprice,2); ?></td>
<td align="center"><?php echo $qty; ?></td>
<td align="center">RM <?php echo number_format($sub,2); ?></td>
</tr>

<?php
}
?>

</table>

<form name="checkoutfrm" method="post" action="" onsubmit="return place_order()"><!--Form section for user input-->
<div class="form-box">

<h3>Delivery & Payment Details</h3>

<p style="text-align:center; font-size:14pt;">Order Total: <span id="order_total" class="price">RM <?php echo number_format($subtotal,2); ?></span></p>

<p><input type="checkbox" name="delivery" value="Yes" onchange="toggle_delivery()"> Home Delivery (+RM 5.00)</p>

<span id="delivery_area"></span>

<p>Payment Method:
<input type="radio" name="payment" value="Credit Card"> Credit Card
<input type="radio" name="payment" value="Online Banking"> Online Banking
<input type="radio" name="payment" value="Cash"> Cash
</p>

<p><input type="submit" name="placeorderbtn" value="Place Order"></p>

<p class="msg"><span id="msg"></span></p>

</div>
</form>

<?php
}
else
{
?>

<p class="intro" style="text-align:center;">Your cart is empty. <a href="products.php">Browse the menu</a> to add some items first.</p>

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

<?php

//place the order when the Place Order button is pressed
if(isset($_POST["placeorderbtn"]))
{
	$member = $_SESSION["member_id"];
	$date = date("Y-m-d");
	$payment = $_POST["payment"];

	//home delivery or self pickup
	$delivery = "No";
	if(isset($_POST["delivery"]))
	{
		$delivery = "Yes";
	}

	//delivery address (only sent when home delivery is chosen)
	$address = "";
	if(isset($_POST["cust_address"]))
	{
		$address = $_POST["cust_address"];
	}

	//first make sure there is enough stock for every item in the cart
	$enough = true;
	$problem = "";
	foreach($_SESSION["cart"] as $pid => $qty)
	{
		$result = mysqli_query($connect,"SELECT * FROM product WHERE product_id='$pid'");
		$row = mysqli_fetch_assoc($result);
		if($qty > $row["product_stock"])
		{
			$enough = false;
			$problem = $row["product_name"];
		}
	}

	if($enough==false)
	{
		?>
		<script>
		alert("Sorry, there is not enough stock for <?php echo $problem; ?>. Please update your cart.");
		window.location="cart.php";
		</script>
		<?php
	}
	else
	{
		//work out the order total (items plus the delivery fee if chosen)
		$total = 0;
		foreach($_SESSION["cart"] as $pid => $qty)
		{
			$result = mysqli_query($connect,"SELECT * FROM product WHERE product_id='$pid'");
			$row = mysqli_fetch_assoc($result);
			$total = $total + ($row["product_price"] * $qty);
		}
		if($delivery=="Yes")
		{
			$total = $total + 5;
		}

		//save the order, then get the id of the order we just created
		mysqli_query($connect,"INSERT INTO orders(order_member,order_date,order_total,order_payment,order_delivery,order_address,order_status)VALUES('$member','$date','$total','$payment','$delivery','$address','Pending')");
		$orderid = mysqli_insert_id($connect);

		//save each cart item under this order and reduce the product stock
		foreach($_SESSION["cart"] as $pid => $qty)
		{
			$result = mysqli_query($connect,"SELECT * FROM product WHERE product_id='$pid'");
			$row = mysqli_fetch_assoc($result);
			$pname = $row["product_name"];
			$pprice = $row["product_price"];
			$sub = $pprice * $qty;

			mysqli_query($connect,"INSERT INTO order_items(item_order,item_name,item_price,item_qty,item_subtotal)VALUES('$orderid','$pname','$pprice','$qty','$sub')");

			//take the ordered quantity out of the stock
			$newstock = $row["product_stock"] - $qty;
			mysqli_query($connect,"UPDATE product SET product_stock='$newstock' WHERE product_id='$pid'");
		}

		//empty the cart now that the order is placed
		unset($_SESSION["cart"]);
		?>
		<script>
		alert("Your order has been placed successfully! Your order ID is <?php echo $orderid; ?>.");
		window.location="dashboard.php";
		</script>
		<?php
	}
}

?>
