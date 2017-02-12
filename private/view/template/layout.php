
<?php extract($params); ?>

<!doctype html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="apple-touch-icon" sizes="180x180" href="<?php echo \Main\Helper\URL::absolute("/public/assets/apple-touch-icon.png")?>">
<link rel="icon" type="image/png" href="<?php echo \Main\Helper\URL::absolute("/public/assets/favicon-32x32.png")?>" sizes="32x32">
<link rel="icon" type="image/png" href="<?php echo \Main\Helper\URL::absolute("/public/assets/favicon-16x16.png")?>" sizes="16x16">
<link rel="manifest" href="<?php echo \Main\Helper\URL::absolute("/public/assets/manifest.json")?>">
<link rel="mask-icon" href="<?php echo \Main\Helper\URL::absolute("/public/assets/safari-pinned-tab.svg")?>" color="#5bbad5">
<meta name="theme-color" content="#ffffff">


<title>AGENT168</title>

<?php $this->import('/template/style'); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
 
  ga('create', 'UA-89796658-1', 'auto');
  ga('send', 'pageview');
</script>

</head>
<body>

<?php $this->import('/'.$page); ?>


<?php $this->import('/template/script'); ?>

<!-- Modal -->
<div class="modal fade" id="fav_list_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Favorite list</h4>
      </div>
      <div class="modal-body">
		<div id="fv_list">
			
		</div>

		<div class="clearfix"></div>
      </div>
    </div>
  </div>
</div>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=201917783227826";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>
