<?php include("dataconnection.php"); ?>

<!DOCTYPE html>
<html>

<head><!--Product category listing page-->
<title>Menu</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div id="header"><!--Header section for logo, website name and slogan-->
<a href="index.html"><img src="image/logo.png" width="80px" height="80px" alt="EasyOrder Logo" title="EasyOrder Home"></a>
<h1>EasyOrder</h1>
<p>Your Favourite Fast Food, Just A Few Clicks Away</p>
</div>

<div id="navbar"><!--Customer navigation bar-->
<a href="cart.php">Cart</a>
<a href="dashboard.php">My Dashboard</a>
<a href="about.html">About Us</a>
<a href="contact.php">Contact Us</a>
<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
</div>

<div id="main"><!--Main content section-->

<h2 class="section-title">Our Menu</h2>
<p class="intro">Browse our delicious range of fast food. Pick a category below to see all the items.</p>

<?php
//show a card for each active category from the database
$result = mysqli_query($connect,"SELECT * FROM category WHERE category_isDelete=0 AND category_status='Active'");

while($row = mysqli_fetch_assoc($result))
{
	$catname = $row["category_name"];
	$catdesc = $row["category_desc"];

	//the picture and menu page for each category
	if($catname=="Fried Chicken"){ $catimg="cat-chicken.jpg"; $catpage="product_chicken.php"; }
	else if($catname=="Burger"){ $catimg="cat-burger.jpg"; $catpage="product_burger.php"; }
	else if($catname=="Side Dishes"){ $catimg="cat-sides.jpg"; $catpage="product_sides.php"; }
	else if($catname=="Dessert"){ $catimg="cat-dessert.jpg"; $catpage="product_dessert.php"; }
	else if($catname=="Beverage"){ $catimg="cat-beverage.jpg"; $catpage="product_beverage.php"; }
	else { $catimg="logo.png"; $catpage="products.php"; }
?>

<div class="category"><!--Product category card section-->
<a href="<?php echo $catpage; ?>"><img src="image/<?php echo $catimg; ?>" width="150px" height="100px" alt="<?php echo $catname; ?>" title="<?php echo $catname; ?>"></a>
<h4><?php echo $catname; ?></h4>
<p><?php echo $catdesc; ?></p>
<p><a class="btn" href="<?php echo $catpage; ?>">View Items</a></p>
</div>

<?php
}
?>

<div style="clear:both"></div>

<hr>

<h2 class="section-title">How To Order</h2>
<ol class="steps">
<li>Browse our menu and choose your preferred items.</li>
<li>Click "Add to Cart" to add the items to your shopping cart.</li>
<li>Proceed to checkout and complete your payment.</li>
</ol>

</div>

<footer><!--Footer section-->
<p>Copyright &copy; 2026 EasyOrder Website. All Rights Reserved.</p>
<p><a href="admin_login.php">Admin Login</a></p>
</footer>

</body>

</html>
