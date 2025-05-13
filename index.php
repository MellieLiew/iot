<?php
require_once 'includes/config.php';
require_once 'includes/fetch_data.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
<div class="container my-5">
  <h1 class="text-center mb-4">📡 Live Sensor Dashboard</h1>

  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title">📍 Location: <?php echo htmlspecialchars($boxName); ?></h5>
      <p class="card-text">
        <strong>🌍 Country:</strong> <?php echo htmlspecialchars($country); ?><br>
        <strong>🗺️ Coordinates:</strong> <?php echo htmlspecialchars($locationText); ?><br>
        <strong>🕒 Last Updated:</strong> <?php echo htmlspecialchars($updatedAt); ?>
      </p>
    </div>
  </div>

  <?php include 'includes/map.php'; ?>
  <?php include 'includes/sensors.php'; ?>
  <?php include 'includes/chart.php'; ?>
</div>
<?php include 'includes/footer.php'; ?>
</body>
</html>
