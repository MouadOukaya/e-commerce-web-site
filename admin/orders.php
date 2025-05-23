<?php include("../inc/connect.inc.php"); ?>
<?php 
ob_start();
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("location: login.php");
    $user = "";
} else {
    $user = $_SESSION['admin_login'];
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE id='$user'");
    $get_user_email = mysqli_fetch_assoc($result);
    $uname_db = $get_user_email['firstName'];
}
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
                if ($user != "") {
                    echo '<a style="text-decoration: none;color: #fff;" href="logout.php">LOG OUT</a>';
                }
                ?>
            </div>
            <div class="uiloginbutton signinButton loginButton">
                <?php 
                if ($user != "") {
                    echo '<a style="text-decoration: none;color: #fff;" href="login.php">Hi '.$uname_db.'</a>';
                } else {
                    echo '<a style="text-decoration: none;color: #fff;" href="login.php">LOG IN</a>';
                }
                ?>
            </div>
        </div>
        <div style="float: left; margin: 5px 0px 0px 23px;">
            <a href="dashboard.php">
                <img style="height: 75px; width: 130px;" src="../image/logo.png">
            </a>
        </div>
        <div class="">
            <div id="srcheader">
                <form id="newsearch" method="get" action="http://www.google.com">
                    <input type="text" class="srctextinput" name="q" size="21" maxlength="120" placeholder="Search Here...">
                    <input type="submit" value="search" class="srcbutton">
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
    <a href="export_orders.php" class="catlink">Export CSV</a>

  </div>
</div>

<div class="product-table-wrapper">
  <table class="product-table">
    <thead>
      <tr>
        <th>Id</th>
        <th>User Id</th>
        <th>Product Id</th>
        <th>Q×P = T</th>
        <th>Order Place</th>
        <th>Mobile</th>
        <th>Order Status</th>
        <th>Order Date</th>
        <th>Delivery Date</th>
        <th>User Name</th>
        <th>User Mobile</th>
        <th>User Email</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = "SELECT * FROM orders ORDER BY id DESC";
        $run = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($run)) {
            $oid = $row['id'];
            $ouid = $row['uid'];
            $opid = $row['pid'];
            $oquantity = $row['quantity'];
            $oplace = $row['oplace'];
            $omobile = $row['mobile'];
            $odstatus = $row['dstatus'];
            $odate = $row['odate'];
            $ddate = $row['ddate'];

            // Get user info
            $query1 = "SELECT * FROM user WHERE id='$ouid'";
            $run1 = mysqli_query($conn, $query1);
            $row1 = mysqli_fetch_assoc($run1);

            $ofname = $oumobile = $ouemail = 'Unknown';
            if ($row1) {
                $ofname = $row1['firstName'];
                $oumobile = $row1['mobile'];
                $ouemail = $row1['email'];
            }

            // Get product info
            $query2 = "SELECT * FROM products WHERE id='$opid'";
            $run2 = mysqli_query($conn, $query2);
            $row2 = mysqli_fetch_assoc($run2);

            $opcate = $opitem = $oppicture = 'N/A';
            $oprice = 0;
            if ($row2) {
                $opcate = $row2['category'];
                $opitem = $row2['item'];
                $oppicture = $row2['picture'];
                $oprice = $row2['price'];
            }

            // Total price
            $total = $oquantity * $oprice;
      ?>
      <tr>
        <td><?php echo $oid; ?></td>
        <td><?php echo $ouid; ?></td>
        <td><?php echo $opid; ?></td>
        <td><?php echo "$oquantity × £$oprice = £$total"; ?></td>
        <td><?php echo $oplace; ?></td>
        <td><?php echo $omobile; ?></td>
        <td><?php echo $odstatus; ?></td>
        <td><?php echo $odate; ?></td>
        <td><?php echo $ddate; ?></td>
        <td><?php echo $ofname; ?></td>
        <td><?php echo $oumobile; ?></td>
        <td><?php echo $ouemail; ?></td>
        <td>
          <a href="editorder.php?eoid=<?php echo $oid; ?>">
            <img src="../image/product/<?php echo "$opitem/$oppicture"; ?>" class="table-img" alt="Edit Order">
          </a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>
