
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

</body>
</html>
