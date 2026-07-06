<?php include("dataconnection.php"); ?>

<!DOCTYPE html>
<html>

<head><!--Burger product details page-->
<title>Burger</title>
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
<a href="cart.php">Cart</a>
<a href="dashboard.php">My Dashboard</a>
<a href="about.html">About Us</a>
<a href="contact.php">Contact Us</a>
<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
</div>

<div id="main"><!--Main content section-->

<h2 class="section-title">Burger</h2>
<p class="intro">Juicy burgers stacked with fresh ingredients and served the way you love them.</p>

<table class="menu-table" width="100%" border="1"><!--Table section for displaying the products in this category-->
<tr>
<th width="140px">Image</th>
<th>Item</th>
<th width="120px">Price</th>
<th width="140px">Order</th>
</tr>

<?php
//show every burger product that is not deleted
$result = mysqli_query($connect,"SELECT * FROM product WHERE product_category='Burger' AND product_isDelete=0");

while($row = mysqli_fetch_assoc($result))
{
	$pid = $row["product_id"];
	$pname = $row["product_name"];
	$pprice = $row["product_price"];
	$pstock = $row["product_stock"];
	$pstatus = $row["product_status"];

	//the picture and description for each item
	if($pname=="Classic Burger"){ $pimg="burger-classic.jpg"; $pdesc="A timeless favourite with a soft bun, fresh lettuce, tomato and our special sauce."; }
	else if($pname=="Beef Burger"){ $pimg="burger-beef.jpg"; $pdesc="A thick, char-grilled beef patty topped with melted cheese and crisp onions."; }
	else if($pname=="Filet-O-Fish"){ $pimg="burger-fish.jpg"; $pdesc="A golden, crispy fish fillet with tartar sauce and cheese in a steamed bun."; }
	else if($pname=="Zinger Burger"){ $pimg="burger-zinger.jpg"; $pdesc="A spicy, crunchy chicken fillet layered with lettuce and creamy mayo."; }
	else if($pname=="Zinger Double Down"){ $pimg="burger-zingerdouble.jpg"; $pdesc="Our boldest burger with two spicy chicken fillets, bacon and cheese, no bun needed."; }
	else { $pimg="logo.png"; $pdesc=""; }
?>

<tr>
<td align="center"><img src="image/<?php echo $pimg; ?>" width="120px" height="90px" alt="<?php echo $pname; ?>" title="<?php echo $pname; ?>"></td>
<td><b><?php echo $pname; ?></b><br><?php echo $pdesc; ?></td>
<td align="center"><span class="price">RM <?php echo number_format($pprice,2); ?></span></td>
<td align="center">
<?php
if($pstock>0 && $pstatus=="Active")
{
?>
<a class="btn-small" href="cart.php?add=<?php echo $pid; ?>">Add to Cart</a>
<?php
}
else
{
?>
<span class="price">Out of Stock</span>
<?php
}
?>
</td>
</tr>

<?php
}
?>

</table>

<br>

<h4>Good to know:</h4>
<ul class="note">
<li>All prices are in Malaysian Ringgit (RM).</li>
<li>Prices are inclusive of service tax.</li>
</ul>

<p style="text-align:center;"><a class="btn" href="products.php">Back to Menu</a></p>

</div>

<footer><!--Footer section-->
<p>Copyright &copy; 2026 EasyOrder Website. All Rights Reserved.</p>
<p><a href="admin_login.php">Admin Login</a></p>
</footer>

</body>

</html>
