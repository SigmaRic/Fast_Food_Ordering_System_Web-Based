<?php include("dataconnection.php"); ?>

<!DOCTYPE html>
<html>

<head><!--Beverage product details page-->
<title>Beverage</title>
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

<h2 class="section-title">Beverage</h2>
<p class="intro">Cold drinks to keep you refreshed and complete your meal.</p>

<table class="menu-table" width="100%" border="1"><!--Table section for displaying the products in this category-->
<tr>
<th width="140px">Image</th>
<th>Item</th>
<th width="120px">Price</th>
<th width="140px">Order</th>
</tr>

<?php
//show every beverage product that is not deleted
$result = mysqli_query($connect,"SELECT * FROM product WHERE product_category='Beverage' AND product_isDelete=0");

while($row = mysqli_fetch_assoc($result))
{
	$pid = $row["product_id"];
	$pname = $row["product_name"];
	$pprice = $row["product_price"];
	$pstock = $row["product_stock"];
	$pstatus = $row["product_status"];

	//the picture and description for each item
	if($pname=="Coca-Cola"){ $pimg="bev-coke.jpg"; $pdesc="An ice-cold classic cola to go perfectly with any meal."; }
	else if($pname=="Sprite"){ $pimg="bev-sprite.jpg"; $pdesc="A crisp, lemon-lime soda that is light and refreshing."; }
	else if($pname=="Orange Juice"){ $pimg="bev-orangejuice.jpg"; $pdesc="Freshly squeezed orange juice, full of natural sweetness."; }
	else if($pname=="Iced Latte"){ $pimg="bev-icedlatte.jpg"; $pdesc="Smooth espresso with chilled milk over ice for a cool pick-me-up."; }
	else if($pname=="Mineral Water"){ $pimg="bev-water.jpg"; $pdesc="Pure, refreshing bottled mineral water."; }
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
