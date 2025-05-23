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

if (!isset($_REQUEST['pid'])) {
  header('location: index.php');
  exit();
}

$pid = mysqli_real_escape_string($conn, $_REQUEST['pid']);

$getposts = mysqli_query($conn, "SELECT * FROM products WHERE id ='$pid'") or die(mysqli_error($conn));
if (mysqli_num_rows($getposts) > 0) {
  $row = mysqli_fetch_assoc($getposts);
  $id = $row['id'];
  $pName = $row['pName'];
  $price = $row['price'];
  $description = $row['description'];
  $picture = $row['picture'];
  $item = $row['item'];
  $available = $row['available'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $pName; ?> - IronFuel</title>
  <link rel="stylesheet" href="../css/style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

  <?php include("../inc/mainheader.inc.php"); ?>

  <!-- Category Navigation -->
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

  <!-- Product Detail -->
  <main style="padding: 40px 60px;">
  <div style="display: flex; flex-wrap: wrap; gap: 40px; justify-content: center; align-items: flex-start;">

    <!-- Product Image -->
    <div style="flex: 1 1 400px; max-width: 500px;">
      <img src="../image/product/<?php echo $item; ?>/<?php echo $picture; ?>" alt="<?php echo $pName; ?>" 
           style="width: 100%; border-radius: 16px; border: 2px solid #5dade2; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
    </div>

    <!-- Product Info -->
    <div style="flex: 1 1 400px; max-width: 500px; background-color: #ffffff; padding: 30px; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
      <h2 style="font-size: 32px; font-weight: 800; color: #2c3e50; margin-bottom: 20px;"><?php echo $pName; ?></h2>
      <p style="font-size: 22px; color: #27ae60; font-weight: bold; margin-bottom: 15px;">£ <?php echo $price; ?></p>
      
      <h3 style="font-size: 20px; font-weight: 600; color: #2c3e50; margin-bottom: 10px;">Description</h3>
      <p style="font-size: 16px; line-height: 1.7; color: #555;"><?php echo $description; ?></p>

      <form method="post" action="../orderform.php?poid=<?php echo $pid; ?>" style="margin-top: 30px;">
        <input type="submit" value="🛒 Order Now" class="srcbutton" style="width: 100%; font-size: 18px; padding: 14px; border-radius: 10px;">
      </form>
    </div>

  </div>
</main>


  <!-- Recommended Products -->
  <section style="padding: 40px 60px;">
    <h3 style="margin-bottom: 20px;">Recommended Products for You</h3>
    <div class="product-grid-container">
      <?php 
      $recs = mysqli_query($conn, "SELECT * FROM products WHERE available >= 1 AND id != '$pid' AND item = '$item' ORDER BY RAND() LIMIT 4");
      if (mysqli_num_rows($recs) > 0) {
        while ($row = mysqli_fetch_assoc($recs)) {
          echo '
            <div class="product-card">
              <a href="view_product.php?pid='.$row['id'].'">
                <img src="../image/product/'.$item.'/'.$row['picture'].'" class="home-prodlist-imgi" alt="'.$row['pName'].'">
              </a>
              <div class="product-info">
                <h3>'.$row['pName'].'</h3>
                <p>Price: <strong>'.$row['price'].' £</strong></p>
              </div>
            </div>
          ';
        }
      } else {
        echo '<p>No recommendations available.</p>';
      }
      ?>
    </div>
  </section>

</body>
</html>
