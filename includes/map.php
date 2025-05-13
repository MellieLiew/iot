<?php if ($latitude && $longitude): ?>
  <div class="mb-4" style="height: 400px;">
    <iframe
      width="100%"
      height="100%"
      frameborder="0"
      scrolling="no"
      marginheight="0"
      marginwidth="0"
      src="https://www.openstreetmap.org/export/embed.html?bbox=<?php echo $longitude-0.01; ?>%2C<?php echo $latitude-0.01; ?>%2C<?php echo $longitude+0.01; ?>%2C<?php echo $latitude+0.01; ?>&layer=mapnik&marker=<?php echo $latitude; ?>%2C<?php echo $longitude; ?>">
    </iframe>
  </div>
<?php endif; ?>
