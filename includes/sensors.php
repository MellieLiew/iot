<?php if ($sensors): ?>
  <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
    <?php foreach ($sensors as $sensor): ?>
      <div class="col">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($sensor['title']); ?></h5>
            <p class="card-text">
              <strong>Last Value:</strong> <?php echo htmlspecialchars($sensor['lastMeasurement']['value'] ?? 'N/A'); ?>
              <?php echo htmlspecialchars($sensor['unit']); ?><br>
              <strong>Timestamp:</strong> <?php echo htmlspecialchars($sensor['lastMeasurement']['createdAt'] ?? 'N/A'); ?>
            </p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
