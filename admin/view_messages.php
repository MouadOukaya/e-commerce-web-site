<?php include("inc/connect.inc.php"); ?>
<div style="max-width: 700px; margin: 40px auto; font-family: Arial, sans-serif;">

<?php
$query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$run = mysqli_query($conn, $query);

if (mysqli_num_rows($run) > 0) {
    while ($row = mysqli_fetch_assoc($run)) {
        $name = htmlspecialchars($row['name']);
        $email = htmlspecialchars($row['email']);
        $subject = htmlspecialchars($row['subject']);
        $message = nl2br(htmlspecialchars($row['message']));
        $created_at = htmlspecialchars($row['created_at']);

        echo "
        <div style='margin-bottom: 25px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9;'>
            <p><strong>$name</strong> &lt;$email&gt;</p>
            <p><strong>Subject:</strong> $subject</p>
            <p>$message</p>
            <p><em>Sent on: $created_at</em></p>
        </div>";
    }
} else {
    echo "<p>No messages found.</p>";
}
?>

</div>
