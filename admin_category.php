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

<head><!--Manage product category page-->
<title>Manage Categories</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="admin_style.css">

<script type="text/javascript">
function confirmation()//JavaScript confirm box shown before a category is deleted
{
	let option;
	option=confirm("Are you sure you want to delete this category?");
	return option;
}

function save_category()//Validate the category form before it is submitted to the server
{
	let id,name,description,status;
	let id_status=false,name_status=false,description_status=false,status_status=false;

	id=document.categoryfrm.category_id.value;
	name=document.categoryfrm.category_name.value;
	description=document.categoryfrm.category_desc.value;
	status=document.categoryfrm.category_status.value;

	if(id=="")
	{
		document.getElementById("err_id").innerHTML="Please enter the category ID";
	}
	else
	{
		document.getElementById("err_id").innerHTML="";
		id_status=true;
	}

	if(name=="")
	{
		document.getElementById("err_name").innerHTML="Please enter the category name";
	}
	else
	{
		document.getElementById("err_name").innerHTML="";
		name_status=true;
	}

	if(description=="")
	{
		document.getElementById("err_desc").innerHTML="Please enter a description";
	}
	else
	{
		document.getElementById("err_desc").innerHTML="";
		description_status=true;
	}

	if(status=="0")
	{
		document.getElementById("err_status").innerHTML="Please select a status";
	}
	else
	{
		document.getElementById("err_status").innerHTML="";
		status_status=true;
	}

	if(id_status==true&&name_status==true&&description_status==true&&status_status==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function clear_form(frm)//empty every field in the form (works in both add and update mode)
{
	var i;
	for(i=0;i<frm.elements.length;i++)
	{
		var t=frm.elements[i].type;
		if(t=="text"||t=="email"||t=="password"||t=="number"||t=="date"||t=="textarea")
		{
			frm.elements[i].value="";
		}
		else if(t=="select-one")
		{
			frm.elements[i].selectedIndex=0;
		}
		else if(t=="radio"||t=="checkbox")
		{
			frm.elements[i].checked=false;
		}
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
<a href="admin_product.php">Manage Products</a>
<a href="admin_order.php">Manage Orders</a>
<a href="admin_report.php">Sales Report</a>
<a href="logout.php" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
</div>

<div id="main"><!--Main content section-->

<h2 class="section-title">Manage Categories</h2>
<p class="intro">View, add, update and delete product categories from this page. Click <b>Update</b> on any row to edit a category record, or <b>Delete</b> to remove it.</p>

<h2 class="section-title">Existing Categories</h2>
<table class="manage-table" border="1"><!--Table section for displaying category records from the database-->
<tr>
<th>Category ID</th>
<th>Category Name</th>
<th>Description</th>
<th>Status</th>
<th>Actions</th>
</tr>

<?php
$result = mysqli_query($connect,"SELECT * FROM category WHERE category_isDelete=0");

while($row = mysqli_fetch_assoc($result))
{
?>

<tr>
<td><?php echo $row['category_id']; ?></td>
<td><?php echo $row['category_name']; ?></td>
<td><?php echo $row['category_desc']; ?></td>
<td><?php echo $row['category_status']; ?></td>
<td>
<input type="button" class="update-btn" value="Update" onclick="location='admin_category.php?edit&id=<?php echo $row['category_id']; ?>'">
<input type="button" class="delete-btn" value="Delete" onclick="if(confirmation()==true){location='admin_category.php?del=1&id=<?php echo $row['category_id']; ?>'}">
</td>
</tr>

<?php
}
?>

</table>

<hr>

<?php
//if an Update button was clicked, get the chosen category and fill in the form below
$cid="";
$cname="";
$cdesc="";
$cstatus="";
$form_title="Category Details";
$btn_label="Save Category";

if(isset($_GET["edit"]))
{
	$cid = $_GET["id"];
	$result = mysqli_query($connect,"SELECT * FROM category WHERE category_id='$cid'");
	$row = mysqli_fetch_assoc($result);
	$cname = $row["category_name"];
	$cdesc = $row["category_desc"];
	$cstatus = $row["category_status"];
	$form_title="Update Category (".$cid.")";
	$btn_label="Update Category";
}
?>

<h2 class="section-title">Add / Update Category</h2>
<p class="intro">Fill in the details below to add a new category. To edit an existing category, click <b>Update</b> on the table above and the form will be filled in for you.</p>

<div class="manage-form-box"><!--Form section for user input-->
<form name="categoryfrm" method="post" action="" onsubmit="return save_category()">
<fieldset>
<legend id="form_title"><?php echo $form_title; ?></legend>

<label>Category ID</label>
<input type="text" name="category_id" value="<?php echo $cid; ?>" <?php if(isset($_GET["edit"])) echo "disabled"; ?> placeholder="e.g. C006">
<br><span class="error" id="err_id"></span>

<br><br><label>Category Name</label>
<input type="text" name="category_name" value="<?php echo $cname; ?>" placeholder="e.g. Combo Meals">
<br><span class="error" id="err_name"></span>

<br><br><label>Description</label>
<input type="text" name="category_desc" value="<?php echo $cdesc; ?>" placeholder="Short description of the category">
<br><span class="error" id="err_desc"></span>

<br><br><label>Status</label>
<select name="category_status">
<option value="0">Select a status</option>
<option value="Active" <?php if($cstatus=="Active") echo "selected"; ?>>Active</option>
<option value="Inactive" <?php if($cstatus=="Inactive") echo "selected"; ?>>Inactive</option>
</select>
<br><span class="error" id="err_status"></span>

<div style="clear:both"></div>

<p style="text-align:center;">
<input type="submit" class="save-btn" id="savebtn" name="savebtn" value="<?php echo $btn_label; ?>">
<input type="button" class="save-btn" name="clearbtn" value="Clear" onclick="clear_form(this.form)">
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

//save the category - decide whether to INSERT a new record or UPDATE an existing one
if(isset($_POST["savebtn"]))
{
	$cname = $_POST["category_name"];
	$cdesc = $_POST["category_desc"];
	$cstatus = $_POST["category_status"];

	if(isset($_GET["edit"]))
	{
		//UPDATE mode - the category id comes from the url
		$cid = $_GET["id"];

		mysqli_query($connect,"UPDATE category SET category_name='$cname',
											  category_desc='$cdesc',
											  category_status='$cstatus'
											  WHERE category_id='$cid'");
		?>
		<script>
		alert("Category updated!");
		window.location="admin_category.php";
		</script>
		<?php
	}
	else
	{
		//ADD mode - the category id comes from the form, check it is not already used
		$cid = $_POST["category_id"];

		$check = mysqli_query($connect,"SELECT * FROM category WHERE category_id='$cid'");
		$count = mysqli_num_rows($check);

		if($count != 0)
		{
		?>
			<script>
			alert("The category ID is already in use. Please change.");
			</script>
		<?php
		}
		else
		{
			mysqli_query($connect,"INSERT INTO category(category_id,category_name,category_desc,category_status)VALUES('$cid','$cname','$cdesc','$cstatus')");
			?>
			<script>
			alert("Category saved!");
			window.location="admin_category.php";
			</script>
			<?php
		}
	}
}

//remove a category from the list (soft delete - set category_isDelete to 1)
if(isset($_GET["del"]))
{
	$cid = $_GET["id"];

	mysqli_query($connect,"UPDATE category SET category_isDelete=1 WHERE category_id='$cid'");
	?>
	<script>
	alert("Category removed!");
	window.location="admin_category.php";
	</script>
	<?php
}

?>
