<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!-- Paste your existing sensor dashboard HTML/PHP content below this -->
<!-- For example: -->
<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
<a href="logout.php">Logout</a>
<?php include 'sensor_dashboard.php'; // split out if your dashboard is large ?>
