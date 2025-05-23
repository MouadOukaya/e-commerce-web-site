<?php
include("../inc/connect.inc.php");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=products_export.csv');

$output = fopen("php://output", "w");

// CSV headers
fputcsv($output, [
    'ID', 'Product Name', 'Description', 'Price', 'Available',
    'Category', 'Type', 'Item', 'Product Code'
]);

$query = "SELECT * FROM products ORDER BY id DESC";
$run = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($run)) {
    fputcsv($output, [
        $row['id'],
        $row['pName'],
        $row['description'],
        $row['price'],
        $row['available'],
        $row['category'],
        $row['type'],
        $row['item'],
        $row['pCode']
    ]);
}

fclose($output);
?>
