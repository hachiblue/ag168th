<?php
use Main\Helper;

header('Cache-Control: private, max-age=3600');

?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- <meta http-equiv="Cache-control" content="max-age=0">   -->

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>
	<?php
		echo \Main\AppConfig::get("application.title");
	?>
</title>

<!-- Bootstrap -->
<link href="<?php echo Helper\URL::absolute("/public/css/bootstrap.min.css")?>" rel="stylesheet">

<!-- Material Css -->
<link href="<?php echo Helper\URL::absolute("/public/css/roboto.min.css")?>" rel="stylesheet">
<link href="<?php echo Helper\URL::absolute("/public/css/material.min.css")?>" rel="stylesheet">
<link href="<?php echo Helper\URL::absolute("/public/css/ripples.min.css")?>" rel="stylesheet">
<link href="<?php echo Helper\URL::absolute("/public/css/sweet-alert.css")?>" rel="stylesheet">
<link href="<?php echo Helper\URL::absolute("/public/css/ie9.css")?>" rel="stylesheet">

<!-- font awesome -->
<link href="<?php echo Helper\URL::absolute("/public/css/font-awesome.min.css")?>" rel="stylesheet">
<link href="<?php echo Helper\URL::absolute("/public/css/chosen.css")?>" rel="stylesheet">
<link href="<?php echo Helper\URL::absolute("/public/css/admin_style.css")?>" rel="stylesheet">

<style type="text/css">		
	
	body, html {
		height: 100%;
		margin: 0;
		overflow-x: hidden;
		font-family: helvetica;
		font-weight: 100;
	}

	.form-control, select.form-control {
		background-position: center bottom,center calc(100% - 0px);
		border-top: 1px solid #d2d2d2;
		border-left: 1px solid #d2d2d2;
		border-right: 1px solid #d2d2d2;
	}    

	.chosen-container { width: 100% !important;}
	.chosen-single{  
		background-color: #eee !important; 
		color: #333 !important;
		border-top: 1px solid #d2d2d2;
		border-left: 1px solid #d2d2d2;
		border-bottom: 1px solid #d2d2d2;
		border-right: 1px solid #d2d2d2;
		line-height: 17px !important;
		height: 28px !important;
		border-radius: 0px !important;
	}

	.container {
		position: relative;
		height: 100%;
		width: 100%;
		left: 0;
		-webkit-transition: left 0.4s ease-in-out;
		-moz-transition: left 0.4s ease-in-out;
		-ms-transition: left 0.4s ease-in-out;
		-o-transition: left 0.4s ease-in-out;
		transition: left 0.4s ease-in-out;
	}

	.container.open-sidebar {
		left: 240px;
	}

	.swipe-area {
		position: absolute;
		width: 50px;
		left: -14px;
		top: 0;
		height: 100%;
		background: #f3f3f3;
		z-index: 0;
	}

	#sidebar {
		background: #DF314D;
		position: absolute;
		width: 240px;
		height: 100%;
		left: -240px;
		overflow: auto;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
	}

	#sidebar ul {
		margin: 0;
		padding: 0;
		list-style: none;
	}

	#sidebar ul li {
		margin: 0;
	}

	#sidebar ul li a {
		padding: 15px 20px;
		font-size: 16px;
		font-weight: 100;
		color: white;
		text-decoration: none;
		display: block;
		border-bottom: 1px solid #C9223D;
		-webkit-transition: background 0.3s ease-in-out;
		-moz-transition: background 0.3s ease-in-out;
		-ms-transition: background 0.3s ease-in-out;
		-o-transition: background 0.3s ease-in-out;
		transition: background 0.3s ease-in-out;
	}

	#sidebar ul li:hover a {
		background: #C9223D;
	}

	.main-content {
		width: 100%;
		/*height: 100%;*/
		padding: 10px;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		position: relative;
	}

	.main-content .content h1 {
		font-weight: 100;
	}

	.main-content .content p {
		width: 100%;
		line-height: 160%;
	}

	.main-content #sidebar-toggle {
		background: #DF314D;
		border-radius: 3px;
		display: block;
		position: relative;
		padding: 10px 7px;
		float: left;
		margin-left: -16px;
	}

	.main-content #sidebar-toggle .bar {
		display: block;
		width: 18px;
		margin-bottom: 3px;
		height: 2px;
		background-color: #fff;
		border-radius: 1px;
	}

	.main-content #sidebar-toggle .bar:last-child {
		margin-bottom: 0;
	}

	a.bell-alert {
		color:red;
	}

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo Helper\URL::absolute("/public/js/bootstrap.min.js")?>"></script>
<script src="<?php echo Helper\URL::absolute("/public/js/sweet-alert.min.js")?>"></script>
<script src="<?php echo Helper\URL::absolute("/public/js/ripples.min.js")?>"></script>
<script src="<?php echo Helper\URL::absolute("/public/js/material.min.js")?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/js/chosen.jquery.min.js")?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/js/jquery.table2excel.min.js")?>"></script>
<script src="<?php echo Helper\URL::absolute("/public/js/q.js")?>"></script>

<script src="<?php echo \Main\Helper\URL::absolute("/public/js/main.js")?>"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
