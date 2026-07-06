<?php include("dataconnection.php"); ?>

<!DOCTYPE html>
<html>

<head><!--Dessert product details page-->
<title>Dessert</title>
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

<h2 class="section-title">Dessert</h2>
<p class="intro">Sweet treats to end your meal on a high note.</p>

<table class="menu-table" width="100%" border="1"><!--Table section for displaying the products in this category-->
<tr>
<th width="140px">Image</th>
<th>Item</th>
<th width="120px">Price</th>
<th width="140px">Order</th>
</tr>

<?php
//show every dessert product that is not deleted
$result = mysqli_query($connect,"SELECT * FROM product WHERE product_category='Dessert' AND product_isDelete=0");

while($row = mysqli_fetch_assoc($result))
{
	$pid = $row["product_id"];
	$pname = $row["product_name"];
	$pprice = $row["product_price"];
	$pstock = $row["product_stock"];
	$pstatus = $row["product_status"];

	//the picture and description for each item
	if($pname=="Ice Cream Cone"){ $pimg="dessert-icecream.jpg"; $pdesc="Smooth, creamy vanilla soft-serve swirled in a crispy cone."; }
	else if($pname=="Chocolate Sundae"){ $pimg="dessert-sundae.jpg"; $pdesc="Creamy soft-serve topped with rich chocolate sauce in a cup."; }
	else if($pname=="Apple Pie"){ $pimg="dessert-applepie.jpg"; $pdesc="A warm, flaky pastry filled with sweet cinnamon apple goodness."; }
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
