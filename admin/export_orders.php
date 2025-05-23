<?php
include("../inc/connect.inc.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=orders_export.csv');

$output = fopen("php://output", "w");

// CSV headers
fputcsv($output, [
    'Order ID', 'User ID', 'Product ID', 'Quantity', 'Place', 'Mobile', 'Status',
    'Order Date', 'Delivery Date', 'User Name', 'User Mobile', 'User Email', 'Price'
]);

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

    $oprice = 0;
    if ($row2) {
        $oprice = $row2['price'];
    }

    fputcsv($output, [
        $oid, $ouid, $opid, $oquantity, $oplace, $omobile, $odstatus,
        $odate, $ddate, $ofname, $oumobile, $ouemail, $oprice
    ]);
}
fclose($output);
?>
