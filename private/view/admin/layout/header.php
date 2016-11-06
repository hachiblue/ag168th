<?php
use Main\Helper;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <style type="text/css">
        
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

    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo Helper\URL::absolute("/public/js/jquery.min.js")?>"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo Helper\URL::absolute("/public/js/bootstrap.min.js")?>"></script>
    <!-- Sweet Alert -->
    <script src="<?php echo Helper\URL::absolute("/public/js/sweet-alert.min.js")?>"></script>
    <link href="<?php echo Helper\URL::absolute("/public/css/sweet-alert.css")?>" rel="stylesheet">
    <link href="<?php echo Helper\URL::absolute("/public/css/ie9.css")?>" rel="stylesheet">
    <!-- font awesome -->
    <link href="<?php echo Helper\URL::absolute("/public/css/font-awesome.min.css")?>" rel="stylesheet">

    <script src="<?php echo \Main\Helper\URL::absolute("/public/js/main.js")?>"></script>
    
    <!-- Material jQuery -->
    <script src="<?php echo Helper\URL::absolute("/public/js/ripples.min.js")?>"></script>
    <script src="<?php echo Helper\URL::absolute("/public/js/material.min.js")?>"></script>

    <link href="<?php echo Helper\URL::absolute("/public/css/chosen.css")?>" rel="stylesheet">
    <link href="<?php echo Helper\URL::absolute("/public/css/admin_style.css")?>" rel="stylesheet">

    <script src="<?php echo \Main\Helper\URL::absolute("/public/js/chosen.jquery.min.js")?>"></script>
    <script src="<?php echo \Main\Helper\URL::absolute("/public/js/jquery.table2excel.min.js")?>"></script>

    <!-- Q -->
    <script src="<?php echo Helper\URL::absolute("/public/js/q.js")?>"></script>
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-37675183-4', 'auto');
  ga('send', 'pageview');

</script>