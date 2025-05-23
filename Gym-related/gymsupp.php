<?php include("../inc/connect.inc.php"); ?>
<?php 
ob_start();
session_start();

$user = isset($_SESSION['user_login']) ? $_SESSION['user_login'] : "";

if ($user != "") {
  $result = mysqli_query($conn, "SELECT * FROM user WHERE id='$user'");
  $get_user_email = mysqli_fetch_assoc($result);
  $uname_db = $get_user_email['firstName'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IronFuel</title>
  <link rel="stylesheet" href="../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <?php include("../inc/mainheader.inc.php"); ?>

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

  <!-- Product Grid -->
  <main class="product-grid-container">
    <?php 
    $getposts = mysqli_query($conn, "SELECT * FROM products WHERE available >= '1' AND item ='footWear' ORDER BY id DESC LIMIT 10");
    if (mysqli_num_rows($getposts) > 0) {
      while ($row = mysqli_fetch_assoc($getposts)) {
        $id = $row['id'];
        $pName = $row['pName'];
        $price = $row['price'];
        $picture = $row['picture'];
        
        echo '
          <div class="product-card">
            <a href="view_product.php?pid='.$id.'">
              <img src="../image/product/footwear/'.$picture.'" class="home-prodlist-imgi" alt="'.$pName.'">
            </a>
            <div class="product-info">
              <h3>'.$pName.'</h3>
              <p>Price: <strong>'.$price.' £</strong></p>
            </div>
          </div>
        ';
      }
    }
    ?>
  </main>
</body>
</html>
