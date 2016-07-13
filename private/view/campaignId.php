<?php
$this->import('/layout/header');
?>
<div class="container">
  <hr style="width: 100%;">
  <div>
  <?php echo ($params["item"]["content"]);?>
  </div>
</div>
<?php
$this->import('/layout/footer');
?>
