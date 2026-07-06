<?php include("dataconnection.php"); ?>

<!DOCTYPE html>
<html>

<head><!--Side dishes product details page-->
<title>Side Dishes</title>
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

<h2 class="section-title">Side Dishes</h2>
<p class="intro">The perfect sides to complete your meal, crispy and full of flavour.</p>

<table class="menu-table" width="100%" border="1"><!--Table section for displaying the products in this category-->
<tr>
<th width="140px">Image</th>
<th>Item</th>
<th width="120px">Price</th>
<th width="140px">Order</th>
</tr>

<?php
//show every side dish product that is not deleted
$result = mysqli_query($connect,"SELECT * FROM product WHERE product_category='Side Dishes' AND product_isDelete=0");

while($row = mysqli_fetch_assoc($result))
{
	$pid = $row["product_id"];
	$pname = $row["product_name"];
	$pprice = $row["product_price"];
	$pstock = $row["product_stock"];
	$pstatus = $row["product_status"];

	//the picture and description for each item
	if($pname=="French Fries"){ $pimg="side-fries.jpg"; $pdesc="Golden, crispy fries lightly salted and served piping hot."; }
	else if($pname=="Cheezy Wedges"){ $pimg="side-wedges.jpg"; $pdesc="Thick-cut potato wedges drizzled with warm, melty cheese sauce."; }
	else if($pname=="Onion Rings"){ $pimg="side-onionrings.jpg"; $pdesc="Sweet onion rings in a crunchy, golden batter. Great for sharing."; }
	else if($pname=="Corn Cup"){ $pimg="side-corncup.jpg"; $pdesc="Sweet buttered corn kernels served warm in a convenient cup."; }
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
