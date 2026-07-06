<?php include("dataconnection.php"); ?>

<!DOCTYPE html>
<html>

<head><!--Fried chicken product details page-->
<title>Fried Chicken</title>
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

<h2 class="section-title">Fried Chicken</h2>
<p class="intro">Crispy, juicy and golden, fried to perfection with our secret blend of herbs and spices.</p>

<table class="menu-table" width="100%" border="1"><!--Table section for displaying the products in this category-->
<tr>
<th width="140px">Image</th>
<th>Item</th>
<th width="120px">Price</th>
<th width="140px">Order</th>
</tr>

<?php
//show every fried chicken product that is not deleted
$result = mysqli_query($connect,"SELECT * FROM product WHERE product_category='Fried Chicken' AND product_isDelete=0");

while($row = mysqli_fetch_assoc($result))
{
	$pid = $row["product_id"];
	$pname = $row["product_name"];
	$pprice = $row["product_price"];
	$pstock = $row["product_stock"];
	$pstatus = $row["product_status"];

	//the picture and description for each item
	if($pname=="Original Recipe (1 pc)"){ $pimg="chicken-original.jpg"; $pdesc="Our signature crispy fried chicken with the secret blend of 11 herbs and spices."; }
	else if($pname=="Hot & Spicy (1 pc)"){ $pimg="chicken-hotspicy.jpg"; $pdesc="Fiery and flavourful chicken coated in a bold, spicy crust for those who love the heat."; }
	else if($pname=="Crispy Tenders (3 pcs)"){ $pimg="chicken-tenders.jpg"; $pdesc="Tender strips of juicy chicken breast, lightly breaded and fried until perfectly crunchy."; }
	else if($pname=="Nuggets (6 pcs)"){ $pimg="chicken-nuggets.jpg"; $pdesc="Bite-sized golden nuggets that are great for sharing or as a tasty snack on the go."; }
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
