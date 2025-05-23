<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
	header("location: login.php");
	$user = "";
}
else {
	$user = $_SESSION['admin_login'];
	$result = mysqli_query($conn,"SELECT * FROM admin WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}

$search_value = "";

?>


<!doctype html>
<html>
	<head>
		<title>Welcome to ebuybd online shop</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
	</head>
	<body class="home-welcome-text" style="background-image: url(../image/homebackgrndimg2.png);">
		<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="logout.php">LOG OUT</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none;color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="dashboard.php">
					<img style=" height: 75px; width: 130px;" src="../image/logo.png">
				</a>
			</div>
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="http://www.google.com">
					        <input type="text" class="srctextinput" name="q" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
		<div class="categolis">
  <div class="category-links">
    <a href="dashboard.php" class="catlink">Home</a>
    <a href="addproduct.php" class="catlink">Add Products</a>
    <a href="newadmin.php" class="catlink">Add Admin</a>
    <a href="allproducts.php" class="catlink">All Available Products</a>
    <a href="orders.php" class="catlink">All available Orders</a>
	<a href="export_products.php" class="catlink">Export CSV</a>
  </div>
</div>
<div class="product-table-wrapper">
  <table class="product-table">
    <thead>
      <tr>
        <th>Id</th>
        <th>P Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Available</th>
        <th>Category</th>
        <th>Type</th>
        <th>Item</th>
        <th>P Code</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        include("../inc/connect.inc.php");
        $query = "SELECT * FROM products ORDER BY id DESC";
        $run = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($run)) {
          $id = $row['id'];
          $pName = substr($row['pName'], 0, 50);
          $descri = $row['description'];
          $price = $row['price'];
          $available = $row['available'];
          $category = $row['category'];
          $type = $row['type'];
          $item = $row['item'];
          $pCode = $row['pCode'];
          $picture = $row['picture'];
      ?>
      <tr>
        <td><?php echo $id; ?></td>
        <td><?php echo $pName; ?></td>
        <td><?php echo $descri; ?></td>
        <td>£<?php echo $price; ?></td>
        <td><?php echo $available; ?></td>
        <td><?php echo $category; ?></td>
        <td><?php echo $type; ?></td>
        <td><?php echo $item; ?></td>
        <td><?php echo $pCode; ?></td>
        <td>
          <a href="editproduct.php?epid=<?php echo $id; ?>">
            <img src="../image/product/<?php echo $item.'/'.$picture; ?>" class="table-img" alt="Edit Product">
          </a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

	</body>
</html>