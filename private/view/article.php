<?php 

extract($params);
$this->import('/template/top-navbar'); 
?>

<div class="container">

	<div class="row text-center">
		<h2><?=$article['name'];?></h2>
	</div>
	<br>
	<div class="col-xs-8 col-md-8 col-xs-offset-2 col-md-offset-2 text-center">
		<img src="<?php echo \Main\Helper\URL::absolute("/public/article_pic/".$article['image_path'])?>" alt="" style="width:100%;">
	</div>

	<div class="clearfix"></div>

	<div class="row">
		<?php

		echo $article['content'];

		?>
	</div>

</div>



<?php $this->import('/template/footer'); ?>