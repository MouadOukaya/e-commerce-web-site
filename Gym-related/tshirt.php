<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($conn,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>IronFuel</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include ( "../inc/mainheader.inc.php" ); ?>
	<div class="categolis">
  <div class="category-links">
    <a href="creatine.php" class="catlink active">creatine</a>
    <a href="acess.php" class="catlink">Accessories</a>
    <a href="tt.php" class="catlink">Tanktops</a>
    <a href="protein.php" class="catlink">Protein</a>
    <a href="preworkout.php" class="catlink">Preworkouts</a>
    <a href="tshirt.php" class="catlink">T-Shirts</a>
    <a href="gymsupp.php" class="catlink">Supplemnts</a>
    <a href="equip.php" class="catlink">Equipements</a>
  </div>
</div>
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php 
			$getposts = mysqli_query($conn,"SELECT * FROM products WHERE available >='1' AND item ='tshirt'  ORDER BY id DESC LIMIT 10") or die(mysql_error());
			if (mysqli_num_rows($getposts) > 0) {
					echo '<ul id="recs">';
					while ($row = mysqli_fetch_assoc($getposts)) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						
						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
										<img src="../image/product/tshirt/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' £</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}
		?>
			
		</div>
	</div>
</body>
</html>