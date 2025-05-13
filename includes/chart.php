<?php if (!empty($measurements)): ?>
  <div class="card mb-4">
    <div class="card-body">
      <h5 class="card-title">📊 Last Readings for "<?php echo htmlspecialchars($graphSensor['title']); ?>"</h5>
      <canvas id="sensorChart" height="100"></canvas>
      <p class="mt-3 text-muted" id="countdown">Refreshing in <span id="timer">60</span> seconds...</p>
    </div>
  </div>
  <script>
    const ctx = document.getElementById('sensorChart').getContext('2d');
    let chart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: <?php echo json_encode(array_column($measurements, 'createdAt')); ?>,
        datasets: [{
          label: '<?php echo htmlspecialchars($graphSensor['title']) . " (" . htmlspecialchars($graphSensor['unit']) . ")"; ?>',
          data: <?php echo json_encode(array_map('floatval', array_column($measurements, 'value'))); ?>,
          borderColor: 'rgba(54, 162, 235, 1)',
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          fill: true,
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        scales: {
          x: {
            title: { display: true, text: 'Time' },
            ticks: { maxTicksLimit: 10 }
          },
          y: {
            title: { display: true, text: '<?php echo htmlspecialchars($graphSensor["unit"]); ?>' }
          }
        }
      }
    });

    let timeLeft = 60;
    setInterval(() => {
      timeLeft--;
      document.getElementById('timer').textContent = timeLeft;
      if (timeLeft === 0) {
        timeLeft = 60;
        updateChart();
      }
    }, 1000);

    function updateChart() {
      $.getJSON("https://api.opensensemap.org/boxes/<?php echo $boxId; ?>/data/<?php echo $graphSensorId; ?>?format=json&download=false", function(data) {
        const labels = data.map(item => item.createdAt);
        const values = data.map(item => parseFloat(item.value));
        chart.data.labels = labels;
        chart.data.datasets[0].data = values;
        chart.update();
      });
    }
  </script>
<?php endif; ?>
