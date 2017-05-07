<div id="content" ng-app="approver-app">
    <div ng-view=""></div>
</div>

<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-loading-bar/build/loading-bar.min.css");?>">

<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular-material.css");?>">
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/material-datetimepicker.css");?>">

<style type="text/css">
	.md-button.sm {
		min-height: 25px;
		line-height: 25px;
	}

</style>

<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-route/angular-route.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular-loading-bar/build/loading-bar.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/app/approver/app.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/bootstrap-datepicker/js/bootstrap-datepicker.min.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/public/js/angular-chosen.min.js")?>"></script>

<!-- Angular Material Dependencies -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.js"></script> -->
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular-animate.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular-aria.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular-material.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/angular-material-datetimepicker.js");?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute("/bower_components/angular/moment-with-locales.min.js");?>"></script>