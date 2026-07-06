<?php
//only logged in members can leave a review
session_start();
if(!isset($_SESSION["member_id"]))
{
	header("location:login.php");
	exit();
}
include("dataconnection.php");
?>

<!DOCTYPE html>
<html>

<head><!--Customer comments and rating page-->
<title>Review</title>
<link rel="stylesheet" href="style.css">

<script>
function submit_review()//Validate customer rating and comment form
{
	let rating="",comment;
	let i;

	comment=document.reviewfrm.cust_comment.value;

	for(i=0;i<document.reviewfrm.rating.length;i++)
	{
		if(document.reviewfrm.rating[i].checked)
		{
			rating=document.reviewfrm.rating[i].value;
		}
	}

	if(rating==""||comment=="")
	{
		document.getElementById("msg").innerHTML="Please choose a rating and write your comment.";
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

<h2 class="section-title">Comments and Rating</h2>
<p class="intro">Tell us about your experience with EasyOrder after placing your order.</p>

<form name="reviewfrm" method="post" action="" onsubmit="return submit_review()"><!--Form section for user input-->
<div class="form-box">

<h3>Customer Review Form</h3>

<p>Rating:
<input type="radio" name="rating" value="1">1
<input type="radio" name="rating" value="2">2
<input type="radio" name="rating" value="3">3
<input type="radio" name="rating" value="4">4
<input type="radio" name="rating" value="5">5
</p>

<p>Comment:
<br>
<textarea name="cust_comment" rows="5" cols="55"></textarea>
</p>

<p>
<input type="submit" name="submitbtn" value="Submit Review">
<input type="reset" name="resetbtn" value="Clear">
</p>

<p class="msg"><span id="msg"></span></p>

</div>
</form>

<hr>

<h2 class="section-title">What Our Customers Say</h2>
<table class="menu-table" width="100%" border="1"><!--Table section for displaying reviews joined with the member name-->
<tr>
<th width="180px">Member</th>
<th width="100px">Rating</th>
<th>Comment</th>
<th width="120px">Date</th>
</tr>

<?php
//show all reviews, newest first, with the member name
$result = mysqli_query($connect,"SELECT * FROM review,member WHERE review_member=member_id ORDER BY review_date DESC");

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
<td><?php echo $row["member_name"]; ?></td>
<td align="center"><?php echo $row["review_rating"]; ?> / 5</td>
<td><?php echo $row["review_comment"]; ?></td>
<td align="center"><?php echo $row["review_date"]; ?></td>
</tr>

<?php
}
?>

</table>

</div>

<footer><!--Footer section-->
<p>Copyright &copy; 2026 EasyOrder Website. All Rights Reserved.</p>
<p><a href="admin_login.php">Admin Login</a></p>
</footer>

</body>

</html>

<?php

//save the review when the form is submitted
if(isset($_POST["submitbtn"]))
{
	$mid = $_SESSION["member_id"];
	$rating = $_POST["rating"];
	$comment = $_POST["cust_comment"];
	$date = date("Y-m-d");

	mysqli_query($connect,"INSERT INTO review(review_member,review_rating,review_comment,review_date)VALUES('$mid','$rating','$comment','$date')");
	?>
	<script>
	alert("Thank you for your review!");
	window.location="review.php";
	</script>
	<?php
}

?>
