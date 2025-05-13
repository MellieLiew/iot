<?php
$conn = pg_connect("host=localhost dbname=your_db_name user=your_username password=your_password");
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>
