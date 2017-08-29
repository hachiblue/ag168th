<div id="content" ng-app="timetable-app">
    <div ng-view=""></div>
</div>


<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute('/bower_components/angular-loading-bar/build/loading-bar.min.css'); ?>">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.20.0/select.css">
<link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute('/public/app/timetable/layout.css'); ?>">

<style type="text/css">
.md-autocomplete-suggestions-container.md-default-theme li .highlight, .md-autocomplete-suggestions-container li .highlight {
	color: #009688;
}
.md-button {
  padding: 0 6px 0 6px;
  margin: 6px 8px 6px 8px;
  min-width: 88px;
  border-radius: 3px;
  font-size: 14px;
  text-align: center;
  text-transform: uppercase;
  text-decoration:none;
  border: none;
  outline: none;
}
</style>

<script src="<?php echo \Main\Helper\URL::absolute('/bower_components/angular/angular.min.js'); ?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute('/bower_components/angular-route/angular-route.min.js'); ?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute('/bower_components/angular-loading-bar/build/loading-bar.min.js'); ?>"></script>
<script src="<?php echo \Main\Helper\URL::absolute('/public/js/angular-chosen.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-select/0.20.0/select.js"></script>

<!-- Angular Material Dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>

<!-- Angular Material Library -->
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.js"></script>


<script src="<?php echo \Main\Helper\URL::absolute('/public/app/timetable/app.js'); ?>"></script>